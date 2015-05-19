<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class SellerLogin_auth
    {

        public function __construct()
        {
            $this->ci = & get_instance();
            $this->ci->load->database();
            $this->ci->load->model('Common_model');
            $this->checkIfLoggedIn();
        }

        public function login($seller_email, $seller_password, $success_redirect_to = NULL, $error_redirect_to = NULL)
        {
            $model = $this->ci->Common_model;
            $whereCondArr = array("seller_email" => $seller_email, "seller_password" => $seller_password);
            $record = $model->fetchSelectedData("seller_id, seller_email, seller_status, seller_fullname, seller_company_name", TABLE_SELLER, $whereCondArr, NULL, NULL, "1");
            if (!empty($record))
            {
                //login successful
                $record = $record[0];
//                prd($record);

                if ($record['seller_status'] == 1)  //activated
                {
                    $data_array = array(
                        "sl_seller_id" => $record["seller_id"],
                        "sl_login_time" => date('Y-m-d H:i:s'),
                        "sl_useragent" => $this->ci->session->userdata["user_agent"],
                        "sl_ipaddress" => $this->ci->session->userdata["ip_address"]
                    );
                    $model->insertData(TABLE_SELLER_LOG, $data_array);

                    $user_array = array(
                        "seller_id" => $record["seller_id"],
                        "seller_fullname" => ucwords($record["seller_fullname"]),
                        "seller_company_name" => stripslashes($record["seller_company_name"]),
                        "seller_email" => $record["seller_email"],
                        "seller_session_expire_time" => time() + SELLER_TIMEOUT_TIME,
                    );

                    foreach ($user_array as $key => $value)
                    {
                        $this->ci->session->set_userdata($key, $value);
                    }

                    if ($success_redirect_to == NULL)
                        $success_redirect_to = base_url_seller();

                    redirect($success_redirect_to);
                }
                elseif ($record['seller_status'] == 0)  //deactivated
                {
                    $this->ci->session->set_flashdata('error', "<strong>Error!</strong> Your account is deactivated.");

                    if ($error_redirect_to == NULL)
                        $error_redirect_to = base_url_seller();

                    redirect($error_redirect_to);
                }
                elseif ($record['seller_status'] == 2)  // waiting for activation
                {
                    $this->ci->session->set_flashdata('error', "<strong>Error!</strong> Your account is activate. Please be patient");

                    if ($error_redirect_to == NULL)
                        $error_redirect_to = base_url_seller();

                    redirect($error_redirect_to);
                }
                else
                {
                    $this->ci->session->set_flashdata('error', "<strong>Error!</strong> Please contact administrator");

                    if ($error_redirect_to == NULL)
                        $error_redirect_to = base_url_seller();

                    redirect($error_redirect_to);
                }
            }
            else
            {
                if ($error_redirect_to == NULL)
                    $error_redirect_to = base_url_seller();

                $this->ci->session->set_flashdata('error', "<strong>Error!</strong> Invalid login details.");
                redirect($error_redirect_to);
            }
        }

        public function checkIfLoggedIn($seller_id = NULL)
        {
            if (isset($this->ci->session->userdata["seller_id"]))
            {
                //logged in
                if ($seller_id == NULL)
                    $seller_id = $this->ci->session->userdata["seller_id"];

                $seller_session_expire_time = $this->ci->session->userdata["seller_session_expire_time"];

                if ($seller_session_expire_time >= time())
                {
                    //Update User session time
                    @$this->ci->session->set_userdata("seller_session_expire_time", time() + SELLER_TIMEOUT_TIME);
                }
                else
                {
                    //Session expired, logout
                    $this->logout($seller_id, base_url_seller(), "<strong>Sorry!</strong> Your session expired.");
                }
            }
            else
            {
                $path = $this->ci->router->class . "/" . $this->ci->router->method;
                if ($path != "seller/index" && $this->ci->router->module == "seller")
                    redirect(base_url_seller());
            }
        }

        public function logout($seller_id = NULL, $redirect_to = NULL, $logout_message = NULL)
        {
            if ($seller_id == NULL)
                $seller_id = $this->ci->session->userdata["seller_id"];

            if ($redirect_to == NULL)
                $redirect_to = base_url_seller();

            $model = $this->ci->Common_model;

            $record = $model->fetchSelectedData("sl_id", TABLE_SELLER_LOG, array("sl_seller_id" => $seller_id, "sl_logout_time" => NULL), "sl_id", "DESC", "1");
            $sl_id = $record[0]["sl_id"];

            $update_data_array = array();
            $update_data_array["sl_logout_time"] = date('Y-m-d H:i:s');

            $whereCondArr = array();
            $whereCondArr["sl_id"] = $sl_id;

            $model->updateData(TABLE_SELLER_LOG, $update_data_array, $whereCondArr);

            $this->ci->session->unset_userdata();
            $this->ci->session->sess_destroy();
            if ($logout_message != NULL)
                $this->ci->session->set_flashdata('error', $logout_message);

            redirect($redirect_to);
        }

    }
    