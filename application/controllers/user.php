<?php

class User extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->myAccount();
    }

    public function myAccount()
    {
        $model = new Common_model();
        $user_id = $this->session->userdata['user_id'];
        if ($this->input->post())
        {
            $arr = $this->input->post();
            $user_email = strtolower($arr["email"]);

            $is_exists = $model->is_exists("user_id", TABLE_USERS, array("user_email" => $user_email, 'user_id !=' => $user_id));
            if (empty($is_exists))
            {
                $data_array = array(
                    'user_fullname' => addslashes($arr['fullname']),
                    'user_contact' => substr($arr['contact'], -10, 10),
                    'user_gender' => strtolower($arr['gender']),
                    'user_ipaddress' => USER_IP,
                    'user_useragent' => USER_AGENT,
                );
                $model->updateData(TABLE_USERS, $data_array, array('user_id' => $user_id));

                $this->session->userdata['user_fullname'] = $arr['fullname'];

                $this->session->set_flashdata("success", "Account details updated");
            }
            else
            {
                $this->session->set_flashdata("error", "<strong>Sorry!</strong> Email already exists.");
            }
            redirect(base_url('my-account'));
        }
        else
        {
            $data = array();
            $fields = 'user_fullname, user_gender, user_contact';
            $record = $model->fetchSelectedData($fields, TABLE_USERS, array('user_id' => $user_id));

            $data['record'] = $record[0];
            $data['meta_title'] = 'My account | ' . SITE_NAME;
            $this->template->write_view("content", "pages/user/my-account", $data);
            $this->template->render();
        }
    }

    public function updatePassword()
    {
        if ($this->input->post())
        {
            $model = new Common_model();
            $user_id = $this->session->userdata['user_id'];
            $arr = $this->input->post();
            $new_password = $arr['new_password'];
            $confirm_password = $arr['confirm_password'];

            if (strcmp($new_password, $confirm_password) == 0)
            {
                $data_array = array(
                    'user_password' => md5($confirm_password),
                    'user_ipaddress' => USER_IP,
                    'user_useragent' => USER_AGENT,
                );
                $model->updateData(TABLE_USERS, $data_array, array('user_id' => $user_id));

                $this->session->set_flashdata("success", "Password successfully changed");
            }
            else
            {
                $this->session->set_flashdata("error", "Passwords you entered do not match");
            }
        }

        redirect(base_url('my-account'));
    }

}
