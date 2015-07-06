<?php

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->template->set_template('admin');
        $this->load->library('form_validation');
    }

    public function index()
    {
        $this->load->model('custom_model');
        $custom_model = new Custom_model();
        $fields = 'product_id, product_title, product_code, product_price, product_seller_price, product_status, pc_name, cc_name';
        $whereCondArr = NULL;
        $data["alldata"] = $custom_model->getAllProductsList($fields, $whereCondArr);
//            prd($data);

        $this->template->write_view("content", "products/products-list", $data);
        $this->template->render();
    }

    public function deleteProduct($product_id)
    {
        if ($product_id)
        {
            $model = new Common_model();
            $model->deleteData(TABLE_PRODUCTS, array("product_id" => $product_id));

            for ($i = "1"; $i <= MAX_PRODUCT_IMAGES; $i++)
            {
                $file_name = APPPATH . "../" . PRODUCT_IMG_PATH_LARGE . "/" . $product_id . "-" . $i . ".jpg";
                if (is_file($file_name))
                {
                    unlink($file_name);
                }
            }

            $this->session->set_flashdata("success", "Product removed");
        }
        redirect(base_url_admin("products"));
    }

    public function deactivateProduct($product_id, $ajax = FALSE)
    {
        if ($product_id)
        {
            $model = new Common_model();
            $model->updateData(TABLE_PRODUCTS, array("product_status" => "0"), array("product_id" => $product_id));
            $this->session->set_flashdata("success", "Product deactivated");
        }

        if ($ajax == FALSE)
            redirect(base_url_admin("products"));
    }

    public function activateProduct($product_id, $ajax = FALSE)
    {
        if ($product_id)
        {
            $model = new Common_model();
            $model->updateData(TABLE_PRODUCTS, array("product_status" => "1"), array("product_id" => $product_id));
            $this->session->set_flashdata("success", "Product deactivated");
        }

        if ($ajax == FALSE)
            redirect(base_url_admin("products"));
    }

    public function uploadImages($fileName, $filesTmp, $width = PRODUCT_IMG_WIDTH_LARGE, $height = PRODUCT_IMG_HEIGHT_LARGE)
    {
        $this->load->library("SimpleImage");
        $img = new SimpleImage();
        $img->load($filesTmp);

        if ($height == NULL || empty($height))
        {
            $img->resizeToWidth($width);
        }
        else
        {
            $img->resize($width, $height);
        }

        //save large size image
        $path_large = PRODUCT_IMG_PATH_LARGE . "/" . $fileName;
//            move_uploaded_file($filesTmp, $path_large);
        $img->save($path_large);
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

    public function featuredList()
    {
        $model = new Common_model();
        $fields = "*";
        $tableArrayWithJoinCondition = array(
            TABLE_PRODUCTS . " as p" => "product_id = feature_product_id"
        );
        $records = $model->getAllDataFromJoin($fields, TABLE_FEATURED . " as f", $tableArrayWithJoinCondition, "LEFT", NULL, "product_id", "DESC");

        $data["alldata"] = $records;

        $this->template->write_view("content", "products/featured-list", $data);
        $this->template->render();
    }

    public function editFeaturedProduct($feature_id)
    {
        if ($feature_id)
        {
            $model = new Common_model();
            $product_records = $model->fetchSelectedData("product_id, product_title, product_code", TABLE_PRODUCTS);
//                prd($product_records);
            $data["form_heading"] = "Add Featured Product";
            $data["form_action"] = base_url_admin("products/addFeaturedProduct");
            $data["product_array"] = $product_records;
            $record = $model->fetchSelectedData("*", TABLE_FEATURED, array("feature_id" => $feature_id));
            $data["record"] = $record[0];
//                prd($record[0]);

            $this->template->write_view("content", "products/featured-form", $data);
            $this->template->render();
        }
        else
        {
            redirect(base_url_admin("products/FeaturedList"));
        }
    }

    public function addFeaturedProduct()
    {
        $model = new Common_model();

        if ($this->input->post())
        {
            $arr = $this->input->post();
            $feature_id = $arr["feature_id"];
//                prd($arr);
            $todays_date = strtotime(date("Y-m-d"));
            if (strtotime($arr["feature_start_time"]) < $todays_date)
            {
                // date wrong, earlier date selected
                $this->session->set_flashdata("error", "Start time should be either today or greater than today's time");
                if (empty($feature_id))
                {
                    redirect(base_url_admin("products/addFeaturedProduct"));
                }
                else
                {
                    redirect(base_url_admin("products/editFeaturedProduct/$feature_id"));
                }
            }
            else
            {
                if (strtotime($arr["feature_end_time"]) <= $todays_date)
                {
                    // wrong end date, either current time or earlier date selected
                    $this->session->set_flashdata("error", "End time should be greater than today's time");
                    if (empty($feature_id))
                    {
                        redirect(base_url_admin("products/addFeaturedProduct"));
                    }
                    else
                    {
                        redirect(base_url_admin("products/editFeaturedProduct/$feature_id"));
                    }
                }
                else
                {
                    $data_array = array(
                        'feature_product_id' => $arr['feature_product_id'],
                        'feature_start_time' => $arr['feature_start_time'],
                        'feature_end_time' => $arr['feature_end_time'],
                        'feature_added_by' => $this->session->userdata['admin_id'],
                        'feature_status' => '1',
                        'feature_ipaddress' => USER_IP,
                        'feature_useragent' => USER_AGENT
                    );

                    if (empty($feature_id))
                    {
                        // insert
                        $model->insertData(TABLE_FEATURED, $data_array);
                        $this->session->set_flashdata("success", "Featured product added");
                    }
                    else
                    {
                        // update
                        $model->updateData(TABLE_FEATURED, $data_array, array("feature_id" => $feature_id));
                        $this->session->set_flashdata("success", "Featured product edited");
                    }
                }
            }
            redirect(base_url_admin("products/FeaturedList"));
        }
        else
        {
            $product_records = $model->fetchSelectedData("product_id, product_title, product_code", TABLE_PRODUCTS);
            $data["form_heading"] = "Add Featured Product";
            $data["form_action"] = "";
            $data["product_array"] = $product_records;

            $this->template->write_view("content", "products/featured-form", $data);
            $this->template->render();
        }
    }

    public function removeFeatured($feature_id)
    {
        if ($feature_id)
        {
            $model = new Common_model();
            $model->deleteData(TABLE_FEATURED, array("feature_id" => $feature_id));
            $this->session->set_flashdata("success", "Product removed from featured list");
        }
        redirect(base_url_admin("products/FeaturedList"));
    }

    public function productDetail($product_id)
    {
        if ($product_id)
        {
            $custom_model = new Custom_model();
            $data = array();

            $product_fields = '*';
            $detail_fields = 'pd_id, pd_size, pd_color_name, pd_quantity, pd_min_quantity, pd_status';
            $images_fields = 'pi_id, pi_image_title, pi_image_path';
            $record = $custom_model->getAllProductsDetails($product_id, $product_fields, $detail_fields, $images_fields, NULL);
//            prd($record);

            $data["record"] = $record;
            $this->template->write_view("content", "products/product-detail", $data);
            $this->template->render();
        }
    }

    public function updateProductDetails($product_detail_arr, $product_id)
    {
        if (!empty($product_id) && !empty($product_detail_arr))
        {
            $model = new Common_model();
            $model->deleteData(TABLE_PRODUCT_DETAILS, array('product_id' => $product_id));
            foreach ($product_detail_arr as $key => $value)
            {
                if (!empty($value['size']))
                {
                    $size = $value['size'];
                    foreach ($value['color'] as $tmpKey => $tmpValue)
                    {
                        if (!empty($tmpValue))
                        {
                            $color = $tmpValue;
                            $stock_count = $value['stock'][$tmpKey];

                            $data_array = array(
                                'product_id' => $product_id,
                                'product_size' => $size,
                                'product_color' => $color,
                                'product_stock' => $stock_count,
                            );
                            $model->insertData(TABLE_PRODUCT_DETAILS, $data_array);
                        }
                    }
                }
            }
        }
    }

    public function updateProductStatus($product_id, $code)
    {
        $model = new Common_model();
        $model->updateData(TABLE_PRODUCTS, array('product_status' => $code), array('product_id' => $product_id));
        $this->session->set_flashdata('success', 'Product status updated to ' . getProductStatusText($code));
        redirect(base_url_admin('products/productDetail/' . $product_id));
    }

    public function updateProductDetailStatus($pd_id, $code)
    {
        $model = new Common_model();
        $product_record = $model->fetchSelectedData('pd_product_id', TABLE_PRODUCT_DETAILS, array('pd_id' => $pd_id));
        $model->updateData(TABLE_PRODUCT_DETAILS, array('pd_status' => $code), array('pd_id' => $pd_id));
        $this->session->set_flashdata('success', 'Product details status updated');
        redirect(base_url_admin('products/productDetail/' . $product_record[0]['pd_product_id']));
    }

    public function editProduct($product_id = NULL)
    {
        $model = new Common_model();
        $custom_model = new Custom_model();

        if ($this->input->post())
        {
            $arr = $this->input->post();

            $profit_percent_record = $model->fetchSelectedData('cc_profit_percent', TABLE_CHILD_CATEGORY, array('cc_id' => $arr['product_child_category']));

            $data_array = array(
                'product_title' => ucwords(addslashes($arr['product_title'])),
                'product_description' => (addslashes($arr['product_description'])),
                'product_child_category' => $arr['product_child_category'],
                'product_price' => addProfitPercentToPrice($arr['product_seller_price'], $profit_percent_record[0]['cc_profit_percent'], $arr['product_shipping_charge']),
                'product_seller_price' => round($arr['product_seller_price'], 2),
                'product_shipping_charge' => round($arr['product_shipping_charge'], 2),
                'product_gift_charge' => round($arr['product_gift_charge'], 2),
                'product_meta_keywords' => addslashes(getNWordsFromString($arr['product_description'], 20)),
                'product_meta_description' => addslashes(getNWordsFromString($arr['product_description'], 40)),
            );

            if ($product_id != NULL)
            {
                $data_array['product_profit_percent'] = $profit_percent_record[0]['cc_profit_percent'];

                $model->updateData(TABLE_PRODUCTS, $data_array, array('product_id' => $product_id));
                $this->session->set_flashdata('success', 'Product updated. Please update the details as well');
            }
            else
            {
                $data_array['product_code'] = getUniqueProductCode();
                $data_array['product_url_key'] = getUniqueProductURLKey(strtolower(trim($arr['product_title'])));

                $model->insertData(TABLE_PRODUCTS, $data_array);
                $product_id = $this->db->insert_id();
                $this->session->set_flashdata('success', 'Product added. Please update the details as well');
            }

            redirect(base_url_admin('products/editProductStepTwo/' . $product_id));
        }
        else
        {
            if ($product_id != NULL)
            {
                $product_fields = 'product_id, product_title, product_description, pc_id, cc_id, product_seller_price, product_shipping_charge, product_gift_charge';
                $detail_fields = 'pd_id';
                $images_fields = 'pi_id';
                $record = $custom_model->getAllProductsDetails($product_id, $product_fields, $detail_fields, $images_fields);
                $data["record"] = $record;
                $data["form_heading"] = 'Edit Product Detail';
            }
            else
            {
                $data["form_heading"] = 'Add Product Detail';
            }

            $data["product_parent_category"] = $model->fetchSelectedData('*', TABLE_PARENT_CATEGORY, array());
            $this->template->write_view("content", "products/forms/product-form", $data);
            $this->template->render();
        }
    }

    public function editProductStepTwo($product_id)
    {
        $model = new Common_model();
        $custom_model = new Custom_model();

        $model->deleteData(TABLE_PRODUCT_DETAILS, array('pd_product_id' => $product_id));
        if ($this->input->post() && isset($product_id))
        {
            $arr = $this->input->post();

            foreach ($arr['pd_id'] as $key => $value)
            {
                $data_array = array(
                    'pd_product_id' => $product_id,
                    'pd_size' => ($arr['product_size'][$key]),
                    'pd_color_name' => ucwords($arr['product_color'][$key]),
                    'pd_quantity' => ($arr['product_quantity'][$key]),
                    'pd_min_quantity' => ($arr['product_min_quantity'][$key]),
                    'pd_ipaddress' => USER_IP,
                    'pd_useragent' => USER_AGENT,
                    'pd_status' => '1'
                );

//                update
//                $model->updateData(TABLE_PRODUCT_DETAILS, $data_array, array('pd_product_id' => $product_id, 'pd_id' => $value));
                $model->insertData(TABLE_PRODUCT_DETAILS, $data_array);
            }

            $this->session->set_flashdata('success', 'Product details updated.');
            redirect(base_url_admin('products/editProductStepThree/' . $product_id));
        }
        else
        {
            $product_fields = 'product_id';
            $detail_fields = 'pd_id, pd_size, pd_color_name, pd_min_quantity, pd_quantity';
            $images_fields = 'pi_id';
            $record = $custom_model->getAllProductsDetails($product_id, $product_fields, $detail_fields, $images_fields);

            $data["form_heading"] = 'Edit Product Details';
            $data["record"] = $record;
            $this->template->write_view("content", "products/forms/product-form-step-two", $data);
            $this->template->render();
        }
    }

    public function editProductStepThree($product_id)
    {
        $model = new Common_model();
        $custom_model = new Custom_model();

        if ($this->input->post() && isset($product_id))
        {
            $arr = $this->input->post();

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

            redirect(base_url_admin('products/productDetail/' . $product_id));
        }
        else
        {
            $product_fields = 'product_id';
            $detail_fields = 'pd_id';
            $images_fields = 'pi_id, pi_image_size, pi_image_title, pi_primary';
            $record = $custom_model->getAllProductsDetails($product_id, $product_fields, $detail_fields, $images_fields);

            $data["form_heading"] = 'Edit Product Details';
            $data["record"] = $record;
            $this->template->write_view("content", "products/forms/product-form-step-three", $data);
            $this->template->render();
        }
    }

    public function deleteProductImage($pi_id, $pi_image_path)
    {
        $model = new Common_model();
        if (unlink($pi_image_path))
        {
            $model->deleteData(TABLE_PRODUCT_IMAGES, array('pi_id' => $pi_id));
        }
        return TRUE;
    }

    public function deleteAllImages($product_id)
    {
        $model = new Common_model();
        $records = $model->fetchSelectedData('pi_id, pi_image_path', TABLE_PRODUCT_IMAGES, array('pi_product_id' => $product_id, 'pi_image_path !=' => ''));
        foreach ($records as $key => $value)
        {
            if (unlink($value['pi_image_path']))
            {
                $model->deleteData(TABLE_PRODUCT_IMAGES, array('pi_id' => $value['pi_id']));
            }
        }
        return TRUE;
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

}
