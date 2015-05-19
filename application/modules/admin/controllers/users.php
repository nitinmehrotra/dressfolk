<?php

    class Users extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->template->set_template('admin');
            $this->load->library('form_validation');
        }

        public function index()
        {
            $model = new Common_model();
            $data["alldata"] = $model->getAllData("*", TABLE_USERS);
//            prd($data);

            $this->template->write_view("content", "users/user-list", $data);
            $this->template->render();
        }

        public function sellers()
        {
            $model = new Common_model();
            $data["alldata"] = $model->getAllData("*", TABLE_SELLER);
//            prd($data);

            $this->template->write_view("content", "users/seller-list", $data);
            $this->template->render();
        }

        public function deactivateUser($user_id)
        {
            if ($user_id)
            {
                $model = new Common_model();
                $model->updateData(TABLE_USERS, array('user_status' => '0'), array('user_id' => $user_id));
                $this->session->set_flashdata("success", "User deactivated");
            }
            redirect(base_url_admin("users"));
        }

        public function activateUser($user_id)
        {
            if ($user_id)
            {
                $model = new Common_model();
                $model->updateData(TABLE_USERS, array('user_status' => '1'), array('user_id' => $user_id));
                $this->session->set_flashdata("success", "User activated");
            }
            redirect(base_url_admin("users"));
        }

        public function checkIfUserEmailExists($user_email, $user_id = NULL)
        {
            $returnValue = FALSE;
            $model = new Common_model();

            $whereCondArr = array("user_email" => $user_email);
            if ($user_id != NULL)
                $whereCondArr = array("user_email" => $user_email, "user_id !=" => $user_id);

//            prd($whereCondArr);

            $is_exists = $model->is_exists("user_id", TABLE_USERS, $whereCondArr);
            if (!empty($is_exists))
                $returnValue = TRUE;

            return $returnValue;
        }

        public function userDetail($user_id)
        {
            if ($user_id)
            {
                $model = new Common_model();
                $data = array();

                $record = $model->fetchSelectedData("*", TABLE_USERS, array("user_id" => $user_id));
                $record = $record[0];
                unset($record["user_password"], $record["user_id"], $record["user_facebook_array"]);
                $data["record"] = $record;
                $data["page_title"] = ucwords($record['user_fullname']);

                $this->template->write_view("content", "users/user-detail", $data);
                $this->template->render();
            }
        }

        public function userLog()
        {
            $model = new Common_model();
            $data = array();

            $record = $model->getAllDataFromJoin("ul.*, user_fullname, user_id", TABLE_USER_LOG . " as ul", array(TABLE_USERS . " as u" => "user_id = ul_user_id"), "LEFT");
            $data["alldata"] = $record;

            $this->template->write_view("content", "users/user-log", $data);
            $this->template->render();
        }

        public function sellerLog()
        {
            $model = new Common_model();
            $data = array();

            $record = $model->getAllDataFromJoin("sl.*, seller_fullname, seller_company_name, seller_id", TABLE_SELLER_LOG. " as sl", array(TABLE_SELLER. " as s" => "seller_id = sl_seller_id"), "LEFT");
            $data["alldata"] = $record;

            $this->template->write_view("content", "users/seller-log", $data);
            $this->template->render();
        }

        public function adminLog()
        {
            $model = new Common_model();
            $data = array();

            $record = $model->getAllDataFromJoin("*", TABLE_ADMIN_LOG . " as al", array(TABLE_ADMIN . " as a" => "admin_id = al_admin_id"), "LEFT");
            $data["alldata"] = $record;

            $this->template->write_view("content", "users/admin-log", $data);
            $this->template->render();
        }

    }
    