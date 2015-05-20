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
        $data = array();

        $data['meta_title'] = 'Signup | ' . SITE_NAME;
        $this->template->write_view("content", "pages/index/signup", $data);
        $this->template->render();
    }

    public function forgotPassword()
    {
        $data = array();

        $data['meta_title'] = 'Forgot password | ' . SITE_NAME;
        $this->template->write_view("content", "pages/index/forgot-password", $data);
        $this->template->render();
    }

}
