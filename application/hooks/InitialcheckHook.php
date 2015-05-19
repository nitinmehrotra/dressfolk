<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class InitialcheckHook
    {

        public function __construct()
        {
            $this->CI = & get_instance();
            $this->setTimezone();
            $this->checkLoggedIn();
            $this->CI->load->database();
        }

        public function checkLoggedIn()
        {
            if ($this->CI->router->fetch_module() == "admin")
            {
                $this->CI->template->set_template('admin');

                $loginAuth = new AdminLogin_auth();
                $loginAuth->checkIfLoggedIn();
            }
            elseif ($this->CI->router->fetch_module() == "seller")
            {
                $this->CI->template->set_template('seller');

                require_once APPPATH.'/libraries/SellerLogin_auth.php';
                $loginAuth = new SellerLogin_auth();
                $loginAuth->checkIfLoggedIn();
            }
            else
            {
                $loginAuth = new Login_auth();
                $loginAuth->checkIfLoggedIn();
            }
        }

        public function setTimezone()
        {
            $this->CI->load->database();
            $this->CI->db->cache_on();
            $this->CI->db->query("SET SESSION time_zone = '+5:30'");
            date_default_timezone_set("Asia/Kolkata");
        }

    }
    