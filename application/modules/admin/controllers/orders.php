<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class Orders extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->template->set_template('admin');
            $this->admin_id = $this->session->userdata("admin_id");
        }

        public function index($package_status = '0')
        {
            $data = array();
            $custom_model = new Custom_model();
            $fields = 'sd_quantity, sd_order_id, sd_shipping_fullname, sd_shipping_contact, sd_shipping_email, sd_shipping_address, sd_shipping_location, sd_shipping_postcode, payment_amount, sd_timestamp, sd_status, pd_color_name, pd_size, product_title, pi_image_path, sod_order_id, sod_order_status, seller_fullname, seller_company_name';
            $whereCondArr = array();
            $whereCondArr['sod_order_status'] = $package_status;
            $records = $custom_model->getOrdersList($fields, $whereCondArr);
//            prd($records);
            $data["alldata"] = $records;

            $pageTitle = getOrderStatusText($package_status) . " Orders";
            $data["page_title"] = $pageTitle;

            $this->template->write_view("content", "orders/orders-list", $data);
            $this->template->render();
        }

        public function orderDetail()
        {
            $data = array();
            $custom_model = new Custom_model();
            $order_id = $this->input->get('id');
            $fields = NULL;
            $whereCondArr = array('sod_order_id' => $order_id);
            $record = $custom_model->getOrdersList($fields, $whereCondArr);
            $data["record"] = $record[0];

            $this->template->write_view("content", "orders/order-detail", $data);
            $this->template->render();
        }

        public function changeStatus()
        {
            if ($this->session->userdata("admin_id"))
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
                    redirect(base_url('admin/orders/index/processing'));
                }
                else
                {
                    redirect($next_url);
                }
            }
            else
            {
                redirect(base_url('admin/orders'));
            }
        }

    }
    