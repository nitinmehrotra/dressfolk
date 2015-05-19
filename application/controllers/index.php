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

}
