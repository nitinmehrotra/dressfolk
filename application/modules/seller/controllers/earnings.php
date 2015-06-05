<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Earnings extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->template->set_template('seller');
            if (isset($this->session->userdata["seller_id"]))
            {
                $this->seller_id = $this->session->userdata["seller_id"];
            }
        }

        public function index()
        {
            $custom_model = new Custom_model();

            $from = date('Y-m') . '-01';
            $to = date('Y-m-d');
            if ($this->input->get('from') && $this->input->get('to'))
            {
                $from = $this->input->get('from');
                $to = $this->input->get('to');
            }
            $whereCondArr['seller_id'] = $this->seller_id;
            $whereCondArr['sd_order_id !='] = '';
            $whereCondArr['sd_paid'] = '1';
            $whereCondArr['sod_timestamp >='] = date('Y-m-d', strtotime($from));
            $whereCondArr['sod_timestamp <='] = date('Y-m-d', strtotime($to)) . ' 23:59:59';
            $fields = 'sd_order_id, sd_shipping_fullname, sd_shipping_address, sd_shipping_location, sd_shipping_postcode, payment_amount, sod_order_id, sod_order_status, sod_paid_to_seller, sd_seller_earning, sod_timestamp';
            $records = $custom_model->getOrdersList($fields, $whereCondArr);

            $data["date_range"] = array('from' => $from, 'to' => $to);
            $data["alldata"] = $records;
            $data["page_title"] = 'Earnings';
            $this->template->write_view("content", "earnings/earnings-list", $data);
            $this->template->render();
        }

    }
    