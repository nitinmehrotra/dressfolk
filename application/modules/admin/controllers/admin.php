<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Admin extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->template->set_template('admin');
        $this->admin_id = $this->session->userdata("admin_id");
    }

    public function index()
    {
        if (!$this->session->userdata("admin_id"))
        {
            $this->load->view("index/index");

            if ($this->input->post())
            {
                $arr = $this->input->post();
                $admin_username = $arr["admin_username"];
                $admin_password = md5($arr["admin_password"]);
//                prd($arr);
                $AdminLogin_auth = new AdminLogin_auth();
                $AdminLogin_auth->login($admin_username, $admin_password, base_url_admin("dashboard"), base_url("admin"));
            }
        }
        else
        {
//                redirect(base_url_admin("dashboard"));
            $this->dashboard();
        }
    }

    public function dashboard()
    {
        $model = new Common_model();
        $custom_model = new Custom_model();

        $total_customers = $model->getTotalCount('user_id', TABLE_USERS);
        $total_sellers = $model->getTotalCount('seller_id', TABLE_SELLER);
        $total_products = $model->getTotalCount('product_id', TABLE_PRODUCTS);

        $data = array(
            'total_customers' => $total_customers[0]['totalcount'],
            'total_sellers' => $total_sellers[0]['totalcount'],
            'total_products' => $total_products[0]['totalcount'],
            'total_earnings' => 0,
        );

        $this->template->write_view("content", "index/dashboard", $data);
        $this->template->render();
    }

    public function logout()
    {
        $AdminLogin_auth = new AdminLogin_auth();
        $AdminLogin_auth->logout($this->session->userdata("admin_id"));
    }

    public function changepassword()
    {
        $this->template->write_view("content", "index/changepassword");
        $this->template->render();

        if ($this->input->post())
        {
            $model = new Common_model();
            $arr = $this->input->post();
            $old_password = md5($arr["old_password"]);
            $new_password = md5($arr["new_password"]);
            $confirm_password = md5($arr["confirm_password"]);

            $whereCondArr = array(
                "admin_id" => $this->admin_id,
                "admin_password" => $old_password
            );

            $is_exists = $model->is_exists("*", TABLE_ADMIN, $whereCondArr);
            if (!empty($is_exists))
            {
                //update
                if (strcmp($new_password, $confirm_password) == 0)
                {
                    //update
                    $data_array = array(
                        "admin_password" => $confirm_password
                    );
                    $model->updateData(TABLE_ADMIN, $data_array, $whereCondArr);
                    $this->session->set_flashdata('success', "Password changed");
                }
                else
                {
                    //new and confirm not match
                    $this->session->set_flashdata('error', "New password and confirm password does not match");
                }
            }
            else
            {
                //wrong old password
                $this->session->set_flashdata('error', "Old password does not match");
            }
            redirect(base_url_admin("changepassword"));
        }
    }

    public function websiteContact($wc_id = FALSE)
    {
        $model = new Common_model();
        $data = array();

        if (!$wc_id)
        {
            $data["alldata"] = $model->fetchSelectedData("*", TABLE_WEBSITE_CONTACT);

            $this->template->write_view("content", "index/website-contact-list", $data);
            $this->template->render();
        }
        else
        {
            $record = $model->fetchSelectedData("*", TABLE_WEBSITE_CONTACT, array("wc_id" => $wc_id));
            $data["record"] = $record[0];
            $data["form_heading"] = "Reply to <strong>" . $record[0]["wc_fullname"] . "</strong> (" . $record[0]["wc_email"] . ")";
            $data["form_action"] = current_url($wc_id);

            $this->template->write_view("content", "index/website-contact-form", $data);
            $this->template->render();

            if ($this->input->post())
            {
                $arr = $this->input->post();

                $wc_processed = $arr["wc_processed"];
                $reply_message = trim($arr["reply_message"]);

                $reply_data_array = array(
                    "wc_id" => $wc_id,
                    "wc_reply_message" => addslashes($reply_message),
                    "wc_processed" => $wc_processed,
                    "wc_admin_id" => $this->session->userdata["admin_id"],
                    "wc_ipaddress" => USER_IP,
                    "wc_agent" => USER_AGENT,
                );

                $model->insertData(TABLE_REPLY_MESSAGES, $reply_data_array);
                $model->updateData(TABLE_WEBSITE_CONTACT, array("wc_processed" => $wc_processed), array("wc_id" => $wc_id));

                $flashMessage = "Record updated";

                if (!empty($reply_message))
                {
                    if (USER_IP != '127.0.0.1')
                    {
                        $fetchData = $model->fetchSelectedData("wc_request_id, wc_email", TABLE_WEBSITE_CONTACT, array("wc_id" => $wc_id));
                        $wc_request_id = $fetchData[0]["wc_request_id"];
                        $user_email = $fetchData[0]["wc_email"];

                        $subject = "Response to request " . $wc_request_id;
                        sendMail($user_email, $subject, $reply_message);
                    }

                    $flashMessage = "Reply successfully sent to " . $user_email;
                }
                $this->session->set_flashdata("success", $flashMessage);
                redirect(base_url_admin("websiteContact"));
            }
        }
    }

    public function websiteConfig()
    {
        $model = new Common_model();
        if ($this->input->post())
        {
            $arr = $this->input->post();
            foreach ($arr as $key => $value)
            {
                $model->updateData(TABLE_WEBSITE_CONFIG, array('wcg_content' => addslashes($value)), array('wcg_key' => $key));
            }

            $this->session->set_flashdata("success", 'Website config updated');
            redirect(base_url_admin("websiteConfig"));
        }
        else
        {
            $output = array();
            $record = $model->fetchSelectedData("*", TABLE_WEBSITE_CONFIG);
            foreach ($record as $key => $value)
            {
                $output[$value['wcg_key']] = stripslashes($value['wcg_content']);
            }
            $data["alldata"] = $output;
            $data["form_heading"] = 'Website Config';

            $this->template->write_view("content", "index/website-config-form", $data);
            $this->template->render();
        }
    }

}
