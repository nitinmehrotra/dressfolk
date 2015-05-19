<?php

    class Products extends CI_Controller
    {

        public function __construct()
        {
            parent::__construct();

            if (!isset($this->session->userdata['seller_id']))
            {
                redirect(base_url_seller('logout'));
            }

            $this->template->set_template('seller');
            $this->load->library('form_validation');
        }

        public function index()
        {
            $this->load->model('custom_model');
            $custom_model = new Custom_model();
            $seller_id = $this->session->userdata['seller_id'];
            $data['page_title'] = 'All Products';
            $whereCondArr = array('product_seller_id' => $seller_id);

            if ($this->input->get('gc'))
            {
                $whereCondArr['gc_name'] = $this->input->get('gc');
                $data['page_title'] = 'Sort: ' . $this->input->get('gc');
            }
            if ($this->input->get('pc'))
            {
                $whereCondArr['pc_name'] = $this->input->get('pc');
                $data['page_title'] = 'Sort: ' . $this->input->get('pc');
            }
            if ($this->input->get('cc'))
            {
                $whereCondArr['cc_name'] = $this->input->get('cc');
                $data['page_title'] = 'Sort: ' . $this->input->get('cc');
            }
            if ($this->input->get('status'))
            {
                switch ($this->input->get('status'))
                {
                    case 'deactivated':
                        $whereCondArr['product_status'] = '0';
                        break;
                    case 'activated':
                        $whereCondArr['product_status'] = '1';
                        break;
                    case 'review':
                        $whereCondArr['product_status'] = '2';
                        break;
                    case 'incomplete':
                        $whereCondArr['product_status'] = '3';
                        break;
                    case 'rejected':
                        $whereCondArr['product_status'] = '4';
                        break;
                }
                $data['page_title'] = 'Sort: ' . ucwords($this->input->get('status')) . ' Products';
            }

            $data['meta_title'] = $data['page_title'] . ' | ' . SITE_NAME;
            $data["alldata"] = $custom_model->getAllProductsList("*", $whereCondArr);
//            prd($data);

            $this->template->write_view("content", "products/products-list", $data);
            $this->template->render();
        }

        public function addProduct($product_id = NULL)
        {
            $model = new Common_model();

            if ($this->input->post())
            {
                $arr = $this->input->post();
                $seller_id = $this->session->userdata['seller_id'];

                $profit_percent_record = $model->fetchSelectedData('cc_profit_percent', TABLE_CHILD_CATEGORY, array('cc_id' => $arr['product_child_category']));

                $data_array = array(
                    'product_title' => ucwords(addslashes($arr['product_title'])),
                    'product_description' => (addslashes($arr['product_description'])),
                    'product_child_category' => $arr['product_child_category'],
                    'product_price' => addProfitPercentToPrice($arr['product_seller_price'], $profit_percent_record[0]['cc_profit_percent'], $arr['product_shipping_charge']),
                    'product_seller_price' => round($arr['product_seller_price'], 2),
                    'product_shipping_charge' => round($arr['product_shipping_charge'], 2),
                    'product_gift_charge' => round($arr['product_gift_charge'], 2),
                    'product_ipaddress' => USER_IP,
                    'product_useragent' => USER_AGENT,
                    'product_meta_keywords' => addslashes(getNWordsFromString($arr['product_description'], 20)),
                    'product_meta_description' => addslashes(getNWordsFromString($arr['product_description'], 40)),
                    'product_seller_id' => $seller_id,
                );

                if ($product_id == NULL)
                {
                    $data_array['product_url_key'] = getUniqueProductURLKey($arr['product_title']);
                    $data_array['product_code'] = getUniqueProductCode();
                    $data_array['product_status'] = '3';
                    $data_array['product_profit_percent'] = $profit_percent_record[0]['cc_profit_percent'];

                    $model->insertData(TABLE_PRODUCTS, $data_array);
                    $product_id = $this->db->insert_id();
                    $this->session->set_flashdata('success', 'Product added. Please add the details about your product');
                }
                else
                {
                    $data_array['product_status'] = '2';
                    $model->updateData(TABLE_PRODUCTS, $data_array, array('product_seller_id' => $seller_id, 'product_id' => $product_id));
                    $this->session->set_flashdata('success', 'Product updated. Please update the details as well');
                }

                redirect(base_url_seller('products/addProductStepTwo/' . $product_id));
            }
            else
            {
                if (isset($product_id) && !empty($product_id) && is_numeric($product_id))
                {
                    $model = new Common_model();
                    $record = $model->fetchSelectedData("*", TABLE_PRODUCTS, array("product_id" => $product_id));
                    $data["record"] = $record[0];
                    $data["grand_cat_array"] = $model->fetchSelectedData("*", TABLE_GRAND_CATEGORY, NULL, "gc_name");
                    $data["parent_cat_array"] = $model->fetchSelectedData("*", TABLE_PARENT_CATEGORY, array("pc_gc_id" => $record[0]["product_grand_category"]), "pc_name");
                    $data["child_cat_array"] = $model->fetchSelectedData("*", TABLE_CHILD_CATEGORY, array("cc_pc_id" => $record[0]["product_parent_category"]), "cc_name");
                    $data["form_heading"] = "Edit product";
                    $data["form_action"] = base_url_seller("products/addProduct/" . $product_id);
                }
                else
                {
                    $data["grand_cat_array"] = $model->fetchSelectedData("gc_id, gc_name", TABLE_GRAND_CATEGORY, NULL, "gc_name");
                    $data["form_heading"] = "Add Product";
                    $data["form_action"] = "";
                }

                $data["meta_title"] = $data["form_heading"] . ' | ' . SITE_NAME;
                $this->template->write_view("content", "products/product-form", $data);
                $this->template->render();
            }
        }

        public function addProductStepTwo($product_id)
        {
            $model = new Common_model();
            $seller_id = $this->session->userdata['seller_id'];
            $is_owner = $model->is_exists('product_id', TABLE_PRODUCTS, array('product_id' => $product_id, 'product_seller_id' => $seller_id));

            if ($this->input->post() && isset($product_id))
            {
                $arr = $this->input->post();

                if (!empty($is_owner))
                {
                    // valid
                    foreach ($arr['pd_id'] as $key => $value)
                    {
                        $data_array = array(
                            'pd_product_id' => $product_id,
                            'pd_size' => ($arr['product_size'][$key]),
                            'pd_color_name' => ucwords($arr['product_color'][$key]),
                            'pd_quantity' => ($arr['product_quantity'][$key]),
                            'pd_min_quantity' => ($arr['product_min_quantity'][$key]),
                            'pd_status' => '2',
                            'pd_ipaddress' => USER_IP,
                            'pd_useragent' => USER_AGENT
                        );

                        if (empty($value))
                        {
                            // insert
                            $model->insertData(TABLE_PRODUCT_DETAILS, $data_array);
                            $this->session->set_flashdata('success', 'Product details added.');
                        }
                        else
                        {
                            // update
                            $model->updateData(TABLE_PRODUCT_DETAILS, $data_array, array('pd_product_id' => $product_id, 'pd_id' => $value));
                            $this->session->set_flashdata('success', 'Product details updated.');
                        }

                        redirect(base_url_seller('products/addProductStepThree/' . $product_id));
                    }
                }
                else
                {
                    // invalid
                    redirect(base_url_seller('products'));
                }
            }
            else
            {
                $data["form_heading"] = "Add Product Details";
                $data["form_action"] = "";

                $data["meta_title"] = $data["form_heading"] . ' | ' . SITE_NAME;
                $this->template->write_view("content", "products/product-form-step-two", $data);
                $this->template->render();
            }
        }

        public function addProductStepThree($product_id)
        {
            $model = new Common_model();
            $seller_id = $this->session->userdata['seller_id'];
            $is_owner = $model->is_exists('product_id', TABLE_PRODUCTS, array('product_id' => $product_id, 'product_seller_id' => $seller_id));

            if ($this->input->post() && isset($product_id))
            {
                $arr = $this->input->post();

                if (!empty($is_owner))
                {
                    // valid
                    foreach ($arr['product_img_title'] as $key => $value)
                    {
                        $file_tmpSource = $_FILES['product_img']['tmp_name'][$key];
                        if (!empty($file_tmpSource) && isset($_FILES['product_img']['tmp_name'][$key]))
                        {
                            $ext = getFileExtension($_FILES['product_img']['name'][$key]);
                            if (isValidImageExt($ext))
                            {
                                $random_number = getRandomNumberLength($file_tmpSource, 15);
                                $new_filename = $random_number . '.' . $ext;

                                // large files
                                $data_array_large = array(
                                    'pi_product_id' => $product_id,
                                    'pi_image_size' => 'large',
                                    'pi_image_title' => empty($value) == TRUE ? NULL : addslashes($value),
                                    'pi_image_path' => PRODUCT_IMG_PATH_LARGE . '/' . $new_filename,
                                    'pi_ipaddress' => USER_IP,
                                    'pi_useragent' => USER_AGENT
                                );
                                uploadImage($file_tmpSource, $new_filename, PRODUCT_IMG_PATH_LARGE, PRODUCT_IMG_WIDTH_LARGE, PRODUCT_IMG_HEIGHT_LARGE);

                                // insert
                                $model->insertData(TABLE_PRODUCT_IMAGES, $data_array_large);
                                $this->session->set_flashdata('success', 'Product images added.');
                            }
                        }
                    }

                    redirect(base_url_seller('products/productDetail/' . $product_id));
                }
                else
                {
                    // invalid
                    redirect(base_url_seller('products'));
                }
            }
            else
            {
                $data["form_heading"] = "Add Product Images";
                $data["form_action"] = "";

                $data["meta_title"] = $data["form_heading"] . ' | ' . SITE_NAME;
                $this->template->write_view("content", "products/product-form-step-three", $data);
                $this->template->render();
            }
        }

        public function resizeImage($source, $width, $height, $createThumb = FALSE, $maintainRatio = FALSE)
        {
            $config['image_library'] = 'gd2';
            $config['source_image'] = $source;
            $config['create_thumb'] = $createThumb;
            $config['maintain_ratio'] = $maintainRatio;
            $config['width'] = $width;
            if ($height != NULL)
                $config['height'] = $height;

            $this->load->library('image_lib', $config);

            $this->image_lib->resize();
        }

        public function productDetail($product_id)
        {
            $seller_id = $this->session->userdata['seller_id'];
            if ($product_id && !empty($seller_id))
            {
                $model = new Common_model();
                $custom_model = new Custom_model();
                $data = array();

                $fields = '*';
                $record = $custom_model->getAllProductsList($fields, array('product_id' => $product_id, 'product_seller_id' => $seller_id));
                if (!empty($record))
                {
                    $product_detail_record = $model->fetchSelectedData('*', TABLE_PRODUCT_DETAILS, array('pd_product_id' => $product_id));
                    $product_image_record = $model->fetchSelectedData('pi_image_title, pi_image_path, pi_image_size', TABLE_PRODUCT_IMAGES, array('pi_product_id' => $product_id));

                    $data["record"] = $record[0];
                    $data["meta_title"] = $record[0]['product_title'] . ' | ' . SITE_NAME;
                    $data["product_detail_record"] = $product_detail_record;
                    $data["product_image_record"] = $product_image_record;

                    $this->template->write_view("content", "products/product-detail", $data);
                    $this->template->render();
                }
                else
                {
                    redirect(base_url_seller('products'));
                }
            }
        }

        public function getParentCategoriesAjax($gc_id)
        {
            if ($gc_id)
            {
                $model = new Common_model();
                $records = $model->fetchSelectedData("*", TABLE_PARENT_CATEGORY, array("pc_gc_id" => $gc_id), "pc_name");
//                prd($records);

                $str = '<div class="control-group">
                                <label class="control-label">Parent Category<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="pc_id" class="span6 m-wrap" id="pc_id">';

                if (!empty($records))
                {
                    $str .= '<option value="">Select</option>';
                    foreach ($records as $pcKey => $pcValue)
                    {
                        $pc_id = $pcValue["pc_id"];
                        $pc_name = $pcValue["pc_name"];

                        $str .= '<option value="' . $pc_id . '">' . $pc_name . '</option>';
                    }
                }
                else
                {
                    $str .= '<option>No data</option>';
                }

                $str .= '</select>
                                </div>
                            </div>';

                echo $str;
            }
        }

        public function getChildCategoriesAjax($pc_id)
        {
            if ($pc_id)
            {
                $model = new Common_model();
                $records = $model->fetchSelectedData("*", TABLE_CHILD_CATEGORY, array("cc_pc_id" => $pc_id), "cc_name");
//                prd($records);

                $str = '<div class="control-group">
                                <label class="control-label">Child Category<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="product_child_category" class="span6 m-wrap" id="cc_id">';

                if (!empty($records))
                {
                    $str .= '<option value="">Select</option>';
                    foreach ($records as $pcKey => $pcValue)
                    {
                        $cc_id = $pcValue["cc_id"];
                        $cc_name = $pcValue["cc_name"];

                        $str .= '<option value="' . $cc_id . '">' . $cc_name . '</option>';
                    }
                }
                else
                {
                    $str .= '<option>No data</option>';
                }

                $str .= '</select>
                                </div>
                            </div>';

                echo $str;
            }
        }

        public function category()
        {
            $this->index();
        }

        public function updateProduct($product_id)
        {
            $model = new Common_model();

            if ($this->input->post())
            {
                $arr = $this->input->post();
                $seller_id = $this->session->userdata['seller_id'];

                if (strlen($arr['product_description']) >= PRODUCT_DESC_MIN_LENGTH)
                {
                    $data_array = array(
                        'product_description' => (addslashes($arr['product_description'])),
                        'product_ipaddress' => USER_IP,
                        'product_useragent' => USER_AGENT,
                        'product_meta_description' => addslashes(getNWordsFromString($arr['product_description'], 40)),
                    );

                    $model->updateData(TABLE_PRODUCTS, $data_array, array('product_seller_id' => $seller_id, 'product_id' => $product_id));
                    $this->session->set_flashdata('success', 'Product description updated');

                    redirect(base_url_seller('products/productDetail/' . $product_id));
                }
                else
                {
                    $this->session->set_flashdata('error', 'Please enter atleast 400 characters for product description.');
                    $this->session->set_flashdata('post', $arr);
                    redirect(base_url_seller('products/updateProduct/' . $product_id));
                }
            }
            else
            {
                if (isset($product_id) && !empty($product_id) && is_numeric($product_id))
                {
                    $record = $model->fetchSelectedData("product_title, product_description", TABLE_PRODUCTS, array("product_id" => $product_id, 'product_seller_id' => $seller_id));
                    $data["record"] = $record[0];
                    $data["form_heading"] = "Edit product";
                }

                $data["meta_title"] = $data["form_heading"] . ' | ' . SITE_NAME;
                $this->template->write_view("content", "products/product-update-form", $data);
                $this->template->render();
            }
        }

        public function updateProductPrice($product_id)
        {
            $model = new Common_model();
            $seller_id = $this->session->userdata['seller_id'];
            $record = $model->fetchSelectedData("product_title, product_seller_price, product_shipping_charge, product_profit_percent", TABLE_PRODUCTS, array("product_id" => $product_id, 'product_seller_id' => $seller_id));

            if ($this->input->post())
            {
                $arr = $this->input->post();

                $data_array = array(
                    'product_price' => addProfitPercentToPrice($arr['product_seller_price'], $record[0]['product_profit_percent'], $arr['product_shipping_charge']),
                    'product_seller_price' => round($arr['product_seller_price'], 2),
                    'product_shipping_charge' => round($arr['product_shipping_charge'], 2),
                    'product_ipaddress' => USER_IP,
                    'product_useragent' => USER_AGENT,
                );

                $model->updateData(TABLE_PRODUCTS, $data_array, array('product_seller_id' => $seller_id, 'product_id' => $product_id));
                $this->session->set_flashdata('success', 'Product price updated');

                redirect(base_url_seller('products/productDetail/' . $product_id));
            }
            else
            {
                if (isset($product_id) && !empty($product_id) && is_numeric($product_id))
                {
                    $data["record"] = $record[0];
                    $data["form_heading"] = "Edit product price";
                }

                $data["meta_title"] = $data["form_heading"] . ' | ' . SITE_NAME;
                $this->template->write_view("content", "products/product-price-update-form", $data);
                $this->template->render();
            }
        }

        public function updateProductStock($pd_id)
        {
            $model = new Common_model();
            $seller_id = $this->session->userdata['seller_id'];
            $record = $model->getAllDataFromJoin('pd_size, pd_color_name, pd_quantity, pd_min_quantity, product_id', TABLE_PRODUCT_DETAILS . ' as pd', array(TABLE_PRODUCTS . ' as p' => 'product_id = pd_product_id'), 'INNER', array('pd_id' => $pd_id, 'product_seller_id' => $seller_id));

            if ($this->input->post() && !empty($record))
            {
                $arr = $this->input->post();

                $data_array = array(
                    'pd_size' => ($arr['pd_size']),
                    'pd_color_name' => ucwords($arr['pd_color_name']),
                    'pd_quantity' => ($arr['pd_quantity']),
                    'pd_min_quantity' => ($arr['pd_min_quantity']),
                    'pd_ipaddress' => USER_IP,
                    'pd_useragent' => USER_AGENT,
                );

                $model->updateData(TABLE_PRODUCT_DETAILS, $data_array, array('pd_id' => $pd_id));
                $this->session->set_flashdata('success', 'Product details updated');

                redirect(base_url_seller('products/productDetail/' . $record[0]['product_id']));
            }
            else
            {
                if (isset($pd_id) && !empty($pd_id) && is_numeric($pd_id))
                {
                    $data["record"] = $record[0];
                    $data["form_heading"] = "Edit product details";
                }

                $data["meta_title"] = $data["form_heading"] . ' | ' . SITE_NAME;
                $this->template->write_view("content", "products/update-product-details-form", $data);
                $this->template->render();
            }
        }

    }
    