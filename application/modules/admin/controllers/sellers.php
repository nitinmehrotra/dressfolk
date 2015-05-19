<?php

    class Sellers extends CI_Controller
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
            $data["alldata"] = $model->getAllData("*", TABLE_SELLER);
//            prd($data);

            $this->template->write_view("content", "sellers/seller-list", $data);
            $this->template->render();
        }

        public function addSeller($seller_id = NULL)
        {
            $model = new Common_model();

            if ($this->input->post())
            {
                $arr = $this->input->post();

                $is_email_exists = $this->checkIfSellerEmailExists(strtolower($arr['seller_email']), $seller_id);
                if (!$is_email_exists)
                {
                    $data_array = array(
                        'seller_fullname' => addslashes(ucwords($arr['seller_fullname'])),
                        'seller_company_name' => addslashes(ucwords($arr['seller_company_name'])),
                        'seller_company_regid' => addslashes($arr['seller_company_regid']),
                        'seller_email' => (strtolower($arr['seller_email'])),
                        'seller_address_line1' => addslashes($arr['seller_address_line1']),
                        'seller_address_line2' => addslashes($arr['seller_address_line2']),
                        'seller_location' => addslashes($arr['seller_location']),
                        'seller_postcode' => ($arr['seller_postcode']),
                        'seller_mobile' => ($arr['seller_mobile']),
                        'seller_internal_comments' => addslashes($arr['seller_internal_comments']),
                        'seller_ipaddress' => USER_IP,
                        'seller_useragent' => USER_AGENT
                    );

                    if ($seller_id == NULL)
                    {
                        // insert
                        $newpassword = getRandomNumberLength(time(), 6);
                        $data_array['seller_password'] = md5($newpassword);
                        $data_array['seller_joined_date'] = date('Y-m-d H:i:s');
                        $model->insertData(TABLE_SELLER, $data_array);
                        $seller_id = $this->db->insert_id();
                        $this->session->set_flashdata("success", "Seller details added");
                        redirect(base_url_admin('sellers/addSellerBank/' . $seller_id));
                    }
                    else
                    {
                        // update
                        $model->updateData(TABLE_SELLER, $data_array, array('seller_id' => $seller_id));
                        $this->session->set_flashdata("success", "Seller details updated");
                        redirect(base_url_admin('sellers/sellerDetail/' . $seller_id));
                    }
                }
                else
                {
                    $this->session->set_flashdata("error", "Email already exists");
                    $this->session->set_flashdata("post", $arr);
                    redirect(base_url_admin('sellers/addSeller'));
                }
            }
            else
            {
                if ($seller_id == NULL)
                {
                    $data["form_heading"] = "Add Seller";
                }
                else
                {
                    $data["form_heading"] = "Edit Seller";
                }

                $this->template->write_view("content", "sellers/seller-form", $data);
                $this->template->render();
            }
        }

        public function addSellerBank($seller_id, $sb_id = NULL)
        {
            $model = new Common_model();

            if ($this->input->post())
            {
                $arr = $this->input->post();

                $data_array = array(
                    'sb_seller_id' => $seller_id,
                    'sb_bank_name' => addslashes($arr['sb_bank_name']),
                    'sb_account_holder' => addslashes($arr['sb_account_holder']),
                    'sb_account_number' => ($arr['sb_account_number']),
                    'sb_status' => '1',
                    'sb_ifsc_code' => strtoupper($arr['sb_ifsc_code']),
                    'sb_ipaddress' => USER_IP,
                    'sb_useragent' => USER_AGENT
                );

                // to deactivate all other bank details
                $model->updateData(TABLE_SELLER_BANK, array('sb_status' => '0'), array('sb_id' => $sb_id));
                if ($sb_id == NULL)
                {
                    // to insert new bank details
                    $model->insertData(TABLE_SELLER_BANK, $data_array);
                    $this->session->set_flashdata("success", "Bank details added");
                    redirect(base_url_admin('sellers/addSellerDocument/' . $seller_id));
                }
                else
                {
                    // to update the current bank details and activate it
                    $model->updateData(TABLE_SELLER_BANK, $data_array, array('sb_id' => $sb_id));
                    $this->session->set_flashdata("success", "Bank details updated");
                    redirect(base_url_admin('sellers/sellerDetail/' . $seller_id));
                }
            }
            else
            {
                if ($seller_id == NULL)
                {
                    $data["form_heading"] = "Add Bank Details";
                }
                else
                {
                    $data["form_heading"] = "Edit Bank Details";
                    $bank_record = $model->fetchSelectedData('*', TABLE_SELLER_BANK, array('sb_seller_id' => $seller_id), 'sb_id', 'DESC', 1);
                    $data['record'] = @$bank_record[0];
                    $data["form_action"] = base_url_admin('sellers/addSellerBank/' . $seller_id . '/' . @$bank_record[0]['sb_id']);
                }

                $this->template->write_view("content", "sellers/seller-bank-form", $data);
                $this->template->render();
            }
        }

        public function addSellerDocument($seller_id)
        {
            $model = new Common_model();

            if ($this->input->post())
            {
                $arr = $this->input->post();

                foreach ($arr['sdc_document_type'] as $key => $value)
                {
                    $ext = getFileExtension($_FILES['seller_doc']['name'][$key]);
                    $doc_name = getUniqueSellerDocumentName($ext);
                    $doc_path = SELLER_DOC_PATH . '/' . $doc_name;
                    $data_array = array(
                        'sdc_seller_id' => $seller_id,
                        'sdc_document_type' => addslashes($value),
                        'sdc_document_path' => $doc_path,
                        'sdc_additional_comments' => addslashes($arr['sdc_additional_comments'][$key]),
                        'sdc_status' => '1',
                        'sdc_ipaddress' => USER_IP,
                        'sdc_useragent' => USER_AGENT
                    );

                    $img_ext_Array = array('jpg', 'jpeg', 'png', 'gif');
                    if (in_array(strtolower($ext), $img_ext_Array))
                    {
                        list($width, $height, $type, $attr) = getimagesize($_FILES['seller_doc']['tmp_name'][$key]);
                        uploadImage($_FILES['seller_doc']['tmp_name'][$key], $doc_name, SELLER_DOC_PATH, $width);
                    }
                    else
                    {
                        move_uploaded_file($_FILES['seller_doc']['tmp_name'][$key], $doc_path);
                    }

                    // to insert new documents
                    $model->insertData(TABLE_SELLER_DOCUMENTS, $data_array);
                }

                $this->session->set_flashdata("success", "Seller documents added");
                redirect(base_url_admin('sellers/sellerDetail/' . $seller_id));
            }
            else
            {
                $data["form_heading"] = "Add Seller Document";

                $this->template->write_view("content", "sellers/seller-document-form", $data);
                $this->template->render();
            }
        }

        public function deactivateSeller($seller_id)
        {
            if ($seller_id)
            {
                $model = new Common_model();
                $model->updateData(TABLE_SELLER, array('seller_status' => '0'), array('seller_id' => $seller_id));
                $this->session->set_flashdata("success", "Seller deactivated");
            }
            redirect(base_url_admin("sellers"));
        }

        public function activateSeller($seller_id)
        {
            if ($seller_id)
            {
                $model = new Common_model();
                $model->updateData(TABLE_SELLER, array('seller_status' => '1'), array('seller_id' => $seller_id));
                $this->session->set_flashdata("success", "Seller activated");
            }
            redirect(base_url_admin("sellers"));
        }

        public function checkIfSellerEmailExists($seller_email, $seller_id = NULL)
        {
            $returnValue = FALSE;
            $model = new Common_model();

            $whereCondArr = array("seller_email" => $seller_email);
            if ($seller_id != NULL)
                $whereCondArr = array("seller_email" => $seller_email, "seller_id !=" => $seller_id);

//            prd($whereCondArr);

            $is_exists = $model->is_exists("seller_id", TABLE_SELLER, $whereCondArr);
            if (!empty($is_exists))
                $returnValue = TRUE;

            return $returnValue;
        }

        public function sellerDetail($seller_id)
        {
            if ($seller_id)
            {
                $model = new Common_model();
                $data = array();

                $record = $model->fetchSelectedData("*", TABLE_SELLER, array("seller_id" => $seller_id));
                $record = $record[0];
                unset($record["seller_password"], $record["seller_facebook_array"]);

                $bank_record = $model->fetchSelectedData('*', TABLE_SELLER_BANK, array('sb_seller_id' => $seller_id, 'sb_status' => '1'));
                $document_record = $model->fetchSelectedData('*', TABLE_SELLER_DOCUMENTS, array('sdc_seller_id' => $seller_id));

                $data["record"] = $record;
                $data["bank_record"] = @$bank_record[0];
                $data["document_record"] = @$document_record;
                $data["page_title"] = ucwords($record['seller_fullname']);

                $this->template->write_view("content", "sellers/seller-detail", $data);
                $this->template->render();
            }
        }

        public function sellerLog()
        {
            $model = new Common_model();
            $data = array();

            $record = $model->getAllDataFromJoin("sl.*, seller_fullname, seller_company_name, seller_id", TABLE_SELLER_LOG . " as sl", array(TABLE_SELLER . " as s" => "seller_id = sl_seller_id"), "LEFT");
            $data["alldata"] = $record;

            $this->template->write_view("content", "sellers/seller-log", $data);
            $this->template->render();
        }

        public function changeCover()
        {
            if (isset($_FILES['cover_img']) && !empty($_FILES['cover_img']) && $this->input->post('seller_id'))
            {
                $seller_id = $this->input->post('seller_id');
                $upload = changeSellerCover($seller_id);
                if ($upload == TRUE)
                {
                    $this->session->set_flashdata("success", "Cover image uploaded");
                }
                else
                {
                    $this->session->set_flashdata("error", "An error occured while uploading image");
                }

                redirect(base_url_admin('sellers/sellerDetail/' . $seller_id));
            }
        }

        public function changeLogo()
        {
            if (isset($_FILES['logo_img']) && !empty($_FILES['logo_img']) && $this->input->post('seller_id'))
            {
                $seller_id = $this->input->post('seller_id');
                $upload = changeSellerLogo($seller_id);
                if ($upload == TRUE)
                {
                    $this->session->set_flashdata("success", "Logo uploaded");
                }
                else
                {
                    $this->session->set_flashdata("error", "An error occured while uploading logo");
                }

                redirect(base_url_admin('sellers/sellerDetail/' . $seller_id));
            }
        }

        public function changeDocumentStatus($sdc_id, $code)
        {
            $model = new Common_model();
            $record = $model->fetchSelectedData('sdc_seller_id', TABLE_SELLER_DOCUMENTS, array('sdc_id' => $sdc_id));
            $model->updateData(TABLE_SELLER_DOCUMENTS, array('sdc_status' => $code), array('sdc_id' => $sdc_id));
            $this->session->set_flashdata("success", "Document status changed to " . getSellerDocumentStatusText($code));
            redirect(base_url_admin('sellers/sellerDetail/' . $record[0]['sdc_seller_id']));
        }

    }
    