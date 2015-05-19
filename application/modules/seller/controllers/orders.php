<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Orders extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();

            if (!isset($this->session->userdata['seller_id']))
            {
                redirect(base_url_seller('logout'));
            }

            $this->template->set_template('seller');
            $this->seller_id = $this->session->userdata("seller_id");
        }

        public function index($package_status = '0')
        {
            $data = array();
            $custom_model = new Custom_model();
            $seller_id = $this->session->userdata['seller_id'];
            $whereCondArr = array(
                'sod_order_status' => $package_status,
                'seller_id' => $seller_id
            );
            $records = $custom_model->getOrdersList(NULL, $whereCondArr);
            $data["alldata"] = $records;
//            prd($records);

            $pageTitle = getOrderStatusText($package_status) . " Orders";
            $data["page_title"] = $pageTitle;

            $this->template->write_view("content", "orders/orders-list", $data);
            $this->template->render();
        }

        public function orderDetail($payment_id)
        {
            $data = array();
            if ($payment_id)
            {
                $custom_model = new Custom_model();
                $record = $custom_model->getMyOrdersList(NULL, NULL, NULL, NULL, TRUE, array("payment_id" => $payment_id));
                $data["record"] = $record[0];

                $this->template->write_view("content", "orders/order-detail", $data);
                $this->template->render();
            }
        }

        public function changeStatus()
        {
            if ($this->session->userdata("seller_id"))
            {
                $arr = $this->input->get();
//                prd($arr);
                $payment_id = $arr['payment_id'];
                $package_status = $arr['package_status'];

                $model = new Common_model();
                $model->updateData(TABLE_PAYMENT, array("package_status" => $package_status), array("payment_id" => $payment_id));
                $this->session->set_flashdata('success', 'Package status changed');

                $next_url = NULL;
                if ($this->input->get('next'))
                {
                    $next_url = $this->input->get('next');
                }

                if ($next_url == NULL)
                {
                    redirect(base_url_seller('orders/index/processing'));
                }
                else
                {
                    redirect($next_url);
                }
            }
            else
            {
                redirect(base_url_seller('orders'));
            }
        }

    }
    