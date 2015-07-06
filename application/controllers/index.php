<?php

class Index extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data = array();
        $model = new Common_model();
        $custom_model = new Custom_model();
        $product_fields = 'product_id, product_title, product_price, product_url_key, pi_image_path';
        $products_Arr = $custom_model->getAllProductsList($product_fields, array('product_status' => '1'), 'pd_id', 'DESC', 8);
        // to fetch featured products
        $featured_product_arr = $custom_model->getFeaturedProducts($product_fields, array('feature_start_time <=' => date('Y-m-d'), 'feature_end_time >=' => date('Y-m-d'), 'feature_status' => '1'), 'rand()', 'ASC', 8);

        $data['products_arr'] = $products_Arr;
        $data['featured_products_arr'] = $featured_product_arr;
        $this->template->write_view("content", "pages/index/index", $data);
        $this->template->render();
    }

    public function login()
    {
        if ($this->input->post())
        {
            $arr = $this->input->post();
            $user_email = $arr["email"];
            $user_password = md5($arr["password"]);
            $url = $arr["url"];
            $loginAuth = new Login_auth();
            $loginAuth->login($user_email, $user_password, $url, base_url('login'));
        }
        else
        {
            $data = array();

            $breadcrumbArray = array(
                'Login' => base_url('login')
            );
            $data["breadcrumbArray"] = $breadcrumbArray;
            $data['meta_title'] = 'Login | ' . SITE_NAME;
            $this->template->write_view("content", "pages/index/login", $data);
            $this->template->render();
        }
    }

    public function logout()
    {
        $loginAuth = new Login_auth();
        $loginAuth->logout();
    }

    public function signup()
    {
        if ($this->input->post())
        {
            $model = new Common_model();
            $arr = $this->input->post();
            $user_email = strtolower($arr["email"]);

            $is_exists = $model->is_exists("user_id", TABLE_USERS, array("user_email" => $user_email));
            if (empty($is_exists))
            {
                $activation_code = getActivationKey($user_email . USER_IP . time());
                $data_array = array(
                    'user_fullname' => addslashes($arr['fullname']),
                    'user_contact' => substr($arr['contact'], -10, 10),
                    'user_gender' => strtolower($arr['gender']),
                    'user_email' => $user_email,
                    'user_password' => md5($arr["password"]),
                    'user_activation_code' => $activation_code,
                    'user_ipaddress' => USER_IP,
                    'user_useragent' => USER_AGENT,
                    'user_joined_date' => date('Y-m-d H:i:s')
                );
                $model->insertData(TABLE_USERS, $data_array);

                // to insert into the newsletters db table
                $this->saveNewsLetterInfo($user_email);

                if ($_SERVER["REMOTE_ADDR"] != '127.0.0.1')
                {
                    // send email here
                    $full_name = ucwords($arr["fullname"]);
                    $confirmation_link = base_url("activation/" . $activation_code);
                    $subject = "Verify email address | " . SITE_NAME;
                    $to_email = $user_email;

                    $this->load->library('EmailTemplates');
                    $EmailTemplate = new EmailTemplates();

                    $registerEmailText = $EmailTemplate->registerEmail($full_name, $confirmation_link);
                    sendMail($to_email, $subject, $registerEmailText);
                }

                $this->session->set_flashdata("success", "<strong>Success!</strong> We have sent you a confirmation link on your email. Please check.");
            }
            else
            {
                $this->session->set_flashdata("error", "<strong>Sorry!</strong> Email already exists.");
            }
            redirect(base_url('login'));
        }
        else
        {
            $data = array();

            $breadcrumbArray = array(
                'Signup' => base_url('signup')
            );
            $data["breadcrumbArray"] = $breadcrumbArray;
            $data['meta_title'] = 'Signup | ' . SITE_NAME;
            $this->template->write_view("content", "pages/index/signup", $data);
            $this->template->render();
        }
    }

    public function forgotPassword()
    {
        $data = array();

        $breadcrumbArray = array(
            'Forgot Password' => base_url('forgot-password')
        );
        $data["breadcrumbArray"] = $breadcrumbArray;
        $data['meta_title'] = 'Forgot password | ' . SITE_NAME;
        $this->template->write_view("content", "pages/index/forgot-password", $data);
        $this->template->render();
    }

    public function saveNewsletter()
    {
        if ($this->input->post())
        {
            $this->saveNewsLetterInfo($this->input->post('email'));
            $this->session->set_flashdata("error", "Your email has been added to our newsletters");
            redirect($this->input->post('url'));
        }
    }

    public function saveNewsLetterInfo($email)
    {
        $model = new Common_model();
        $is_exists = $model->is_exists('newsletter_id', TABLE_NEWSLETTER, array('newsletter_email' => $email));
        if (empty($this->input->post('email')))
        {
            $newsletter_data_array = array(
                "newsletter_email" => strtolower($email),
                "newsletter_ipaddress" => USER_IP,
                "newsletter_useragent" => USER_AGENT,
            );
            $model->insertData(TABLE_NEWSLETTER, $newsletter_data_array);
        }
    }

    public function reviewUs()
    {
        if ($this->input->post())
        {
            if (isset($this->session->userdata["user_id"]))
            {
                $model = new Common_model();
                $arr = $this->input->post();

                $comment = addslashes($arr['comment']);
                $rating = $arr['rating'];
                $overall_rating = ($rating['value'] + $rating['quality'] + $rating['price']) / count($rating);
                $data_array = array(
                    'rating_product_id' => 0,
                    'rating_user_id' => $this->session->userdata['user_id'],
                    'rating_count' => $overall_rating,
                    'rating_value' => $rating['value'],
                    'rating_quality' => $rating['quality'],
                    'rating_price' => $rating['price'],
                    'rating_comment' => $comment,
                    'rating_ipaddress' => USER_IP,
                    'rating_useragent' => USER_AGENT,
                    'rating_is_general' => '1'
                );
                $model->insertData(TABLE_RATINGS, $data_array);

                $this->session->set_flashdata('success', 'Thank you for your valuable feedback. We appreciate it.');
            }
            else
            {
                $this->session->set_flashdata('error', 'Please login in order to leave us a feedback');
            }
            redirect(base_url('review-us'));
        }
        else
        {
            $data = array();
            $breadcrumbArray = array(
                'Review Us' => base_url('review-us')
            );
            $data["breadcrumbArray"] = $breadcrumbArray;
            $data['meta_title'] = 'Review Us | ' . SITE_NAME;
            $this->template->write_view("content", "pages/index/review-us", $data);
            $this->template->render();
        }
    }

    public function testimonials()
    {
        $custom_model = new Custom_model();
        $record = $custom_model->getAllGeneralRatings('user_fullname, rating_comment', NULL, 'rating_id', 'DESC', 8);
//        prd($record);
        $breadcrumbArray = array(
            'Testimonials' => base_url('testimonials')
        );
        $data["breadcrumbArray"] = $breadcrumbArray;
        $data['meta_title'] = 'Testimonials | ' . SITE_NAME;
        $data['record'] = $record;
        $this->template->write_view("content", "pages/index/testimonials", $data);
        $this->template->render();
    }
    
         public function loginsocial($network = "facebook")
        {
            if (!empty($network) && $network != NULL)
            {
                $this->load->library("SocialLib");
                $socialLib = new SocialLib();

                $login_url = base_url();
                if ($network == "facebook")
                {
                    $login_url = $socialLib->getFacebookLoginUrl();
                }

                redirect($login_url);
            }
            else
            {
                redirect(base_url());
            }
        }

        public function loginWithFacebook()
        {
            $this->load->library("SocialLib");
            $socialLib = new SocialLib();
            $socialLib->loginWithFacebook();
        }

}
