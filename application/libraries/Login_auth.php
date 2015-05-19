<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Login_auth
    {

        public function __construct()
        {
            $this->ci = & get_instance();
            $this->ci->load->database();
            $this->ci->load->model('Common_model');
            $this->checkIfLoggedIn();
        }

        public function login($user_email, $user_password, $success_redirect_to = NULL, $error_redirect_to = NULL)
        {
            $model = $this->ci->Common_model;
            $whereCondArr = array("user_email" => $user_email, "user_password" => $user_password);
            $record = $model->fetchSelectedData("*", TABLE_USERS, $whereCondArr, NULL, NULL, "1");
            if (!empty($record))
            {
                $record = $record[0];
                $user_status = $record["user_status"];
                if ($user_status == "1")
                {
                    //login successful

                    $data_array = array(
                        "ul_user_id" => $record["user_id"],
                        "ul_login_time" => date('Y-m-d H:i:s'),
                        "ul_useragent" => USER_AGENT,
                        "ul_ipaddress" => USER_IP,
                    );
                    $model->insertData(TABLE_USER_LOG, $data_array);

                    $user_array = array(
                        "user_id" => $record["user_id"],
                        "user_email" => $record["user_email"],
                        "user_fullname" => stripslashes($record["user_fullname"]),
                        "user_session_expire_time" => time() + USER_TIMEOUT_TIME,
                    );

                    foreach ($user_array as $key => $value)
                    {
                        $this->ci->session->set_userdata($key, $value);
                    }

                    if ($success_redirect_to == NULL)
                        $success_redirect_to = base_url();

                    redirect($success_redirect_to);
                }
                else
                {
                    $this->ci->session->set_flashdata("warning", "Your account is not active yet");
                    redirect(base_url());
                }
            }
            else
            {
                if ($error_redirect_to == NULL)
                    $error_redirect_to = base_url();

                $this->ci->session->set_flashdata('error', "<strong>Error!</strong> Invalid Email or Password.");
                redirect($error_redirect_to);
            }
        }

        public function checkIfLoggedIn($user_id = NULL)
        {
            if (isset($this->ci->session->userdata["user_id"]))
            {
                //logged in
                if ($user_id == NULL)
                    $user_id = $this->ci->session->userdata["user_id"];

                $user_session_expire_time = $this->ci->session->userdata["user_session_expire_time"];

                if ($user_session_expire_time >= time())
                {
                    //Update User session time
                    $newTime = (time() + ADMIN_TIMEOUT_TIME);
                    @$this->ci->session->set_userdata("user_session_expire_time", $newTime);
                }
                else
                {
                    //Session expired, logout
                    $this->logout($user_id, base_url(), "<strong>Sorry!</strong> Your session expired.");
                }
            }
        }

        public function logout($user_id = NULL, $redirect_to = NULL, $logout_message = NULL)
        {
            if ($user_id == NULL)
            {
                if (isset($this->ci->session->userdata["user_id"]))
                {
                    $user_id = $this->ci->session->userdata ["user_id"];
                }
            }

            if ($redirect_to == NULL)
            {
                $redirect_to = base_url();
            }

            if ($user_id != NULL || !empty($user_id))
            {
                $model = $this->ci->Common_model;

                $record = $model->fetchSelectedData("ul_id", TABLE_USER_LOG, array("ul_user_id" => $user_id, "ul_logout_time" => NULL), "ul_id", "DESC", "1");
                $ul_id = $record[0]["ul_id"];

                $update_data_array = array();
                $update_data_array["ul_logout_time"] = date('Y-m-d H:i:s');

                $whereCondArr = array();
                $whereCondArr["ul_id"] = $ul_id;
                $whereCondArr["ul_user_id"] = $user_id;

                $model->updateData(TABLE_USER_LOG, $update_data_array, $whereCondArr);
            }


            $this->ci->session->unset_userdata();
            $this->ci->session->sess_destroy();
            if ($logout_message != NULL)
            {
                $this->ci->session->set_flashdata('error', $logout_message);
            }

            redirect($redirect_to);
        }

    }
    