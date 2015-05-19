<?php

    class Discountcoupon extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();
            $this->template->set_template('admin');
        }

        public function index($type = "all")
        {
            $model = new Common_model();
            $whereCondArr = NULL;

            if ($type == "all")
            {
                $whereCondArr = NULL;
                $pageTitle = "All Coupons";
            }
            else if ($type == "expired")
            {
                $whereCondArr = array("dc_end_time < " => time());
                $pageTitle = "Expired Coupons";
            }
            else if ($type == "active")
            {
                $whereCondArr = array("dc_status" => "1");
                $pageTitle = "Active Coupons";
            }
            else
            {
                $whereCondArr = array("dc_status" => "0");
                $pageTitle = "Deactive Coupons";
            }

            $coupon_records = $model->fetchSelectedData("*", TABLE_DISCOUNT_COUPONS, $whereCondArr);
            $data["alldata"] = $coupon_records;
            $data["pageTitle"] = $pageTitle;
//            prd($data);

            $this->template->write_view("content", "discountcoupon/discountcoupon-list", $data);
            $this->template->render();
        }

        public function detail($dc_id)
        {
            if ($dc_id)
            {
                $model = new Common_model();
                $whereCondArr = array("dc_id" => $dc_id);
                $coupon_records = $model->fetchSelectedData("*", TABLE_DISCOUNT_COUPONS, $whereCondArr);
                $data["record"] = $coupon_records[0];
//            prd($data);

                $this->template->write_view("content", "discountcoupon/discountcoupon-detail", $data);
                $this->template->render();
            }
        }

        public function changeStatus($dc_id, $status_code = 0)
        {
            if ($dc_id)
            {
                $model = new Common_model();
                $model->updateData(TABLE_DISCOUNT_COUPONS, array("dc_status" => $status_code), array("dc_id" => $dc_id));
                $this->session->set_flashdata('success', 'Coupon status changed');
            }
            redirect('admin/discountcoupon');
        }

        public function deleteCoupon($dc_id)
        {
            if ($dc_id)
            {
                $model = new Common_model();
                $model->deleteData(TABLE_DISCOUNT_COUPONS, "dc_id = $dc_id");
                $this->session->set_flashdata('success', 'Coupon removed');
            }
            redirect('admin/discountcoupon');
        }

        public function addCoupon()
        {
            $model = new Common_model();
            if ($this->input->post())
            {
                $arr = $this->input->post();
                $dc_id = $arr["dc_id"];
                $arr["dc_added_by"] = $this->session->userdata["admin_id"];
                $arr["user_ipaddress"] = $this->session->userdata["ip_address"];
                $arr["user_agent"] = $this->session->userdata["user_agent"];
                $arr["dc_start_time"] = strtotime($arr["dc_start_time"]);
                $arr["dc_end_time"] = strtotime($arr["dc_end_time"]);
//                prd($arr);

                if (empty($dc_id))
                {
                    $is_exists = $model->is_exists("dc_id", TABLE_DISCOUNT_COUPONS, array("dc_code" => $arr["dc_code"]));
                }
                else
                {
                    $is_exists = $model->is_exists("dc_id", TABLE_DISCOUNT_COUPONS, array("dc_code" => $arr["dc_code"], "dc_id != " => $dc_id));
                }

                if (empty($is_exists))
                {
                    //valid
                    if (empty($dc_id))
                    {
                        $model->insertData(TABLE_DISCOUNT_COUPONS, $arr);
                        $this->session->set_flashdata("success", "Discount Coupon Added");
                    }
                    else
                    {
                        $model->updateData(TABLE_DISCOUNT_COUPONS, $arr, array("dc_id" => $dc_id));
                        $this->session->set_flashdata("success", "Discount Coupon Updated");
                    }

                    redirect(base_url("admin/discountcoupon"));
                }
                else
                {
                    // duplicate coupon code    

                    $this->session->set_flashdata("error", "Coupon code already exists");

                    $data["record"] = $arr;
                    $data["child_cat_array"] = $model->fetchSelectedData("cc_id, cc_name", TABLE_CHILD_CATEGORY, NULL, "cc_name");
                    $data["form_heading"] = "Add Discount Coupon";
                    $data["form_action"] = base_url("admin/discountcoupon/addCoupon");
                    $this->template->write_view("content", "discountcoupon/discountcoupon-form", $data);
                    $this->template->render();
                }
            }
            else
            {
                $data = array();
                $data["child_cat_array"] = $model->fetchSelectedData("cc_id, cc_name", TABLE_CHILD_CATEGORY, NULL, "cc_name");
                $data["form_heading"] = "Add Discount Coupon";
                $data["form_action"] = "";

                $this->template->write_view("content", "discountcoupon/discountcoupon-form", $data);
                $this->template->render();
            }
        }

        public function editCoupon($dc_id)
        {
            if ($dc_id)
            {
                $model = new Common_model();
                $record = $model->fetchSelectedData("*", TABLE_DISCOUNT_COUPONS, array("dc_id" => $dc_id));

                $data["record"] = $record[0];
                $data["child_cat_array"] = $model->fetchSelectedData("cc_id, cc_name", TABLE_CHILD_CATEGORY, NULL, "cc_name");
                $data["form_heading"] = "Add Discount Coupon";
                $data["form_action"] = base_url("admin/discountcoupon/addCoupon");
                $this->template->write_view("content", "discountcoupon/discountcoupon-form", $data);
                $this->template->render();
            }
            else
            {
                redirect(base_url("admin/discountcoupon"));
            }
        }

    }