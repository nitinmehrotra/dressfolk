<?php

    class Staticcontent extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->template->set_template('admin');
        }

        public function index()
        {
            $model = new Common_model();
            $data["alldata"] = $model->getAllData("static_page_id, static_page_title, static_page_content", TABLE_STATIC_PAGES);
//            prd($data);

            $this->template->write_view("content", "staticcontent/static-list", $data);
            $this->template->render();
        }

        public function edit($static_page_id)
        {
            $model = new Common_model();
            if ($static_page_id)
            {
                if ($this->input->post())
                {
                    $arr = $this->input->post();
                    $model->updateData(TABLE_STATIC_PAGES, $arr, array("static_page_id" => $static_page_id));
                    $this->session->set_flashdata("success", "Static page update successfully");
                    redirect(base_url("admin/staticcontent"));
                }
                else
                {
                    $record = $model->fetchSelectedData("*", TABLE_STATIC_PAGES, array("static_page_id" => $static_page_id));
//                prd($record);
                    $data["record"] = $record[0];
                    $data["form_heading"] = "Edit Static Content";
                    $data["form_action"] = base_url("admin/staticcontent/edit/$static_page_id");

                    $this->template->write_view("content", "staticcontent/static-form", $data);
                    $this->template->render();
                }
            }
            else
            {
                redirect(base_url("admin/staticcontent"));
            }
        }

    }

    