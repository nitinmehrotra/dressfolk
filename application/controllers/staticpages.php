<?php

    class Staticpages extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
        }

        public function index($static_page_key)
        {
            if ($static_page_key)
            {
                $static_page_key = urldecode($static_page_key);
//                prd($static_page_key);
                $data = array();

                $model = new Common_model();
                $record = $model->fetchSelectedData("static_page_content,static_page_title,static_page_key", TABLE_STATIC_PAGES, array("static_page_key" => $static_page_key));
                if (!empty($record))
                {
                    $breadcrumbArray = array(
                        $record[0]["static_page_title"] => base_url("static/" . $record[0]["static_page_key"])
                    );
                    $data["breadcrumbArray"] = $breadcrumbArray;
                    $data["static_page_title"] = stripslashes($record[0]["static_page_title"]);
                    $data["meta_title"] = stripslashes($record[0]["static_page_title"]) . ' | ' . SITE_NAME;
                    $data["content"] = $record[0]["static_page_content"];

                    $this->template->write_view("content", "pages/static/static-content", $data);
                    $this->template->render();
                }
                else
                {
                    require_once APPPATH . "controllers/index.php";
                    $indexController = new Index();
                    $indexController->pageNotFound();
                }
            }
        }

        public function contactUs()
        {
            $data = array();

            $breadcrumbArray = array(
                "Contact Us" => base_url("contact-us")
            );
            $data["breadcrumbArray"] = $breadcrumbArray;

            $this->template->write_view("content", "pages/static/contactus", $data);
            $this->template->render();

            if ($this->input->post())
            {
                $model = new Common_model();
                $arr = $this->input->post();
//                prd($arr);
                $wc_request_id = getUniqueContactRequestId(time());
                $full_name = addslashes(ucwords($arr['full_name']));
                $user_email = strtolower($arr['user_email']);
                $user_contact = $arr['user_contact'];
                $mail_subject = addslashes($arr['wc_subject']);
                $mail_message = addslashes($arr['wc_message']);

                $data_array = array(
                    'wc_fullname' => $full_name,
                    'wc_email' => $user_email,
                    'wc_contact' => $user_contact,
                    'wc_subject' => $mail_subject,
                    'wc_message' => $mail_message,
                    'wc_request_id' => $wc_request_id,
                    'wc_ipaddress' => USER_IP,
                    'wc_useragent' => USER_AGENT
                );

                $model->insertData(TABLE_WEBSITE_CONTACT, $data_array);

                if (USER_IP != '127.0.0.1')
                {
                    $this->load->model('Email_model');
                    $this->load->library('EmailTemplates');
                    $Email_model = new Email_model();
                    $EmailTemplates = new EmailTemplates();
                    $contactUsMailText = $EmailTemplates->contactUsEmail($full_name, $wc_request_id);

                    $subject = SITE_NAME . " : Request received";
                    $Email_model->sendMail($user_email, $subject, $contactUsMailText);

                    $mySelfText = stripslashes('
                                <p><strong>Full Name: </strong>' . $full_name . '</p><br/>
                                <p><strong>Email: </strong>' . $user_email . '</p><br/>
                                <p><strong>Contact Number: </strong>' . $user_contact . '</p><br/>
                                <p><strong>Subject: </strong>' . $mail_subject . '</p><br/>
                                <p><strong>Message: </strong>' . $mail_message . '</p><br/>
                        ');
                    $Email_model->sendMail(SITE_EMAIL_GMAIL, "You have received a new message via website", $mySelfText);
                }

                $this->session->set_flashdata("success", "<strong>Thank you!</strong> You request #" . $wc_request_id . " will be processed soon.");
                redirect(base_url('contact-us'));
            }
        }

        public function updateSitemap()
        {
            $this->ci = & get_instance();
            $this->ci->load->database();
            $this->ci->load->model('Common_model');
//            $model = $this->ci->Common_model;
            $model = new Common_model();

            $xml = '<?xml version = "1.0" encoding = "UTF-8"?>' . "\n";
            $xml .= '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9 http://www.sitemaps.org/schemas/sitemap/0.9/sitemap.xsd">' . "\n";
            $xml .= '<url><loc>' . base_url() . '</loc><changefreq>weekly</changefreq><priority>1.00</priority></url>' . "\n";

            // all the static links
            $static_links_without_base_url = array(
                'home',
                'blog',
                'products',
                'contact-us',
                'about-us',
                'disclaimer',
                'privacy-policy',
                'return-policy',
                'shipping-details',
                'terms',
                'login',
                'signup',
                'forgot-password',
            );
            foreach ($static_links_without_base_url as $slKey => $slValue)
            {
                $xml .= '<url><loc>' . base_url($slValue) . '</loc><changefreq>weekly</changefreq><priority>1.00</priority></url>' . "\n";
            }

            // all the active grand categories
            $grand_category_records = $model->fetchSelectedData('gc_name', TABLE_GRAND_CATEGORY);
            foreach ($grand_category_records as $gcKey => $gcValue)
            {
                $grand_category_url = base_url('products/view/' . rawurlencode($gcValue['gc_name']));
                $xml .= '<url><loc>' . $grand_category_url . '</loc><changefreq>weekly</changefreq><priority>1.00</priority></url>' . "\n";
            }

            // all the active parent categories
            $parent_category_records = $model->getAllDataFromJoin('gc_name, pc_name', TABLE_PARENT_CATEGORY . ' as pc', array(TABLE_GRAND_CATEGORY . ' as gc' => 'pc_gc_id = gc_id'), 'LEFT');
            foreach ($parent_category_records as $pcKey => $pcValue)
            {
                $parent_category_url = base_url('products/view/' . rawurlencode($pcValue['gc_name']) . '/' . rawurlencode($pcValue['pc_name']));
                $xml .= '<url><loc>' . $parent_category_url . '</loc><changefreq>weekly</changefreq><priority>1.00</priority></url>' . "\n";
            }

            // all the active child categories
            $child_category_records = $model->getAllDataFromJoin('gc_name, pc_name, cc_name', TABLE_CHILD_CATEGORY . ' as cc', array(TABLE_PARENT_CATEGORY . ' as pc' => 'cc_pc_id = pc_id', TABLE_GRAND_CATEGORY . ' as gc' => 'pc_gc_id = gc_id'), 'LEFT');
            foreach ($child_category_records as $pcKey => $pcValue)
            {
                $child_category_url = base_url('products/view/' . rawurlencode($pcValue['gc_name']) . '/' . rawurlencode($pcValue['pc_name']) . '/' . rawurlencode($pcValue['cc_name']));
                $xml .= '<url><loc>' . $child_category_url . '</loc><changefreq>weekly</changefreq><priority>1.00</priority></url>' . "\n";
            }

            // all the active products
            $product_records = $model->fetchSelectedData('product_url_key', TABLE_PRODUCTS, array('product_status' => '1'));
            foreach ($product_records as $pKey => $pValue)
            {
                $product_url = getProductUrl($pValue['product_url_key']);
                $xml .= '<url><loc>' . $product_url . '</loc><changefreq>weekly</changefreq><priority>1.00</priority></url>' . "\n";
            }

            // all the active sellers
            $seller_records = $model->fetchSelectedData('seller_url_key', TABLE_SELLER, array('seller_status' => '1'));
            foreach ($seller_records as $sKey => $sValue)
            {
                $seller_url = base_url('s/' . rawurlencode($sValue['seller_url_key']));
                $xml .= '<url><loc>' . $seller_url . '</loc><changefreq>weekly</changefreq><priority>1.00</priority></url>' . "\n";
            }

            $xml .= '</urlset>';
//            prd($xml);

            $file = fopen((APPPATH . '/../sitemap.xml'), 'w');
            fwrite($file, $xml);
            fclose($file);
            die;
        }

    }
    