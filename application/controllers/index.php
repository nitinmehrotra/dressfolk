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

        $this->template->write_view("content", "pages/index/index", $data);
        $this->template->render();
    }

    public function login()
    {
        $data = array();

        $data['meta_title'] = 'Login | ' . SITE_NAME;
        $this->template->write_view("content", "pages/index/login", $data);
        $this->template->render();
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
                    'user_contact' => substr($arr['mobile'], -10, 10),
                    'user_gender' => strtolower($arr['gender']),
                    'user_email' => $user_email,
                    'user_password' => md5($arr["password"]),
                    'activation_code' => $activation_code,
                    'user_ipaddress' => USER_IP,
                    'user_agent' => USER_AGENT,
                    'user_joined_date' => date('Y-m-d H:i:s')
                );
                $model->insertData(TABLE_USERS, $data_array);

                // to insert into the newsletters db table
                $newsletter_data_array = array(
                    "user_email" => $user_email,
                    "user_ipaddress" => USER_IP,
                    "user_agent" => USER_AGENT,
                );
                $model->insertData(TABLE_NEWSLETTER, $newsletter_data_array);

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

            $data['meta_title'] = 'Signup | ' . SITE_NAME;
            $this->template->write_view("content", "pages/index/signup", $data);
            $this->template->render();
        }
    }

    public function forgotPassword()
    {
        $data = array();

        $data['meta_title'] = 'Forgot password | ' . SITE_NAME;
        $this->template->write_view("content", "pages/index/forgot-password", $data);
        $this->template->render();
    }

}
