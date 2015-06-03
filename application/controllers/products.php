<?php

class Products extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->allProductsList();
    }

    public function view($pc_name = null, $cc_name = null, $url_key = null)
    {
        if (isset($pc_name) && !isset($cc_name) && !isset($url_key))
        {
            $pc_name = urldecode($pc_name);
            $this->childList($pc_name);
        }
        else if (isset($cc_name) && !isset($url_key))
        {
            $cc_name = urldecode($cc_name);
            $this->productsList($cc_name);
        }
        else if (isset($url_key))
        {
            $url_key = urldecode($url_key);
            $this->productDetail($url_key);
        }
        else
        {
            $this->allProductsList();
        }
    }

    public function parentList()
    {
        $this->allProductsList();
    }

    public function childList($pc_name)
    {
        $custom_model = new Custom_model();
        $records = $custom_model->getAllProductsList(NULL, array("pc_name" => $pc_name, "product_status" => "1"), "product_id", "DESC");
        $category_name_records = array();
        foreach ($records as $key => $value)
        {
            $category_name_records[] = $value['cc_name'];
        }

        $data["records"] = $records;
        $data["category_name_records"] = $category_name_records;
        $data["product_page_heading"] = urldecode($pc_name);
        $breadcrumbArray = array(
            $pc_name => base_url("products/view/" . rawurlencode($pc_name)),
        );
        $data["breadcrumbArray"] = $breadcrumbArray;
        $data["meta_title"] = $records[0]["pc_name"] . " | " . SITE_NAME;
        $this->template->write_view("content", "pages/products/products-grid", $data);
        $this->template->render();
    }

    public function productsList($cc_name)
    {
        $custom_model = new Custom_model();
        $fields = 'product_id, product_title, product_code, product_price, product_description, pi_image_path, pi_image_title, cc_name, pc_name, seller_fullname, seller_company_name';
        $records = $custom_model->getAllProductsList($fields, array("cc_name" => $cc_name, "product_status" => "1"), "product_id", "DESC");
        $pc_name = $records[0]["pc_name"];

        $data["records"] = $records;

        $category_name_records = array();
        foreach ($records as $key => $value)
        {
            $category_name_records[] = $value['cc_name'];
        }
        $data["category_name_records"] = $category_name_records;
        $data["product_page_heading"] = urldecode($cc_name);
        $breadcrumbArray = array(
            urldecode($pc_name) => base_url("products/view/" . rawurlencode($pc_name)),
            urldecode($cc_name) => base_url("products/view/" . rawurlencode($pc_name) . "/" . rawurlencode($cc_name)),
        );
        $data["breadcrumbArray"] = $breadcrumbArray;
        $data["meta_title"] = $records[0]["cc_name"] . " | " . SITE_NAME;
        $this->template->write_view("content", "pages/products/products-grid", $data);
        $this->template->render();
    }

    public function allProductsList($whereCondArr = NULL, $pageHeading = NULL)
    {
        $data = array();
        $custom_model = new Custom_model();

        if ($whereCondArr == NULL)
        {
            if ($pageHeading == NULL)
            {
                $pageHeading = "All Products";
            }
        }
        else
        {
            if ($pageHeading == NULL)
            {
                $pageHeading = "Search results";
            }
        }
        $whereCondArr['product_status'] = '1';

        $fields = 'product_id, product_title, product_code, product_price, product_description, pi_image_path, pi_image_title, cc_name, pc_name, seller_fullname, seller_company_name';
        $records = $custom_model->getAllProductsList($fields, $whereCondArr, "product_id", "DESC");

        $category_name_records = array();
        foreach ($records as $key => $value)
        {
            $category_name_records[] = $value['cc_name'];
        }

        $data["records"] = $records;
        $data["category_name_records"] = $category_name_records;
        $data["product_page_heading"] = $pageHeading;
        $breadcrumbArray = array(
            $pageHeading => base_url("products"),
        );
        $data["breadcrumbArray"] = $breadcrumbArray;
        $data["meta_title"] = $pageHeading . " | " . SITE_NAME;
        $this->template->write_view("content", "pages/products/products-grid", $data);
        $this->template->render();
    }

    public function productDetail($url_key)
    {
        require_once APPPATH . "controllers/index.php";
        $indexController = new Index();
        $data = array();
        $model = new Common_model();
        $custom_model = new Custom_model();
        $product_record = $model->fetchSelectedData('product_id', TABLE_PRODUCTS, array("product_url_key" => $url_key, 'product_status' => '1'));

        if (empty($product_record))
        {
            $indexController->pageNotFound();
        }
        else
        {
            $product_id = $product_record[0]['product_id'];
            $product_fields = "*";
            $detail_fields = "*";
            $images_fields = "*";
            $record = $custom_model->getAllProductsDetails($product_id, $product_fields, $detail_fields, $images_fields, array("product_url_key" => $url_key, 'product_status' => '1'));
//                prd($record);
            if ($record["product_status"] == "0")
            {
                $indexController->pageNotFound();
            }
            else
            {
                $similar_records = $custom_model->getAllProductsList($product_fields, array("product_id != " => $product_id, "pc_id" => $record["pc_id"]), 'rand()', 'DESC', 4);
//                prd($similar_records);
                $is_in_wishlist = FALSE;
                if (isset($this->session->userdata['user_id']))
                {
                    $is_exists_wishlist = $model->fetchSelectedData('wishlist_id', TABLE_WISHLIST, array('wishlist_product_id' => $product_id, 'wishlist_user_id' => $this->session->userdata['user_id']));
                    if (!empty($is_exists_wishlist))
                    {
                        $is_in_wishlist = TRUE;
                    }
                }

                $data["record"] = $record;
                $data["similar_records"] = $similar_records;
                $data["is_in_wishlist"] = $is_in_wishlist;

                $breadcrumbArray = array(
                    $record["pc_name"] => base_url("products/view/" . rawurlencode($record["pc_name"])),
                    $record["cc_name"] => base_url("products/view/" . rawurlencode($record["pc_name"]) . "/" . rawurlencode($record["cc_name"])),
                    $record["product_title"] => base_url($record["pc_name"]),
                );
                $data["breadcrumbArray"] = $breadcrumbArray;
                $data["meta_title"] = stripslashes($record["product_title"]) . " | " . getSellerDisplayName($record['seller_fullname'], $record['seller_company_name']) . " | " . SITE_NAME;
                $data["meta_keywords"] = stripslashes($record["product_meta_keywords"]);
                $data["meta_description"] = stripslashes($record["product_meta_description"]);
                $data["meta_logo_image"] = getImage(@$record['images_arr'][0]['pi_image_path']);

                if (USER_IP != '127.0.0.1')
                {
                    $this->addProductVisit($product_id);
                }

                $this->template->write_view("content", "pages/products/product-detail", $data);
                $this->template->render();
            }
        }
    }

    public function addToCart($redirect_url = NULL)
    {
        if ($redirect_url == NULL)
        {
            $redirect_url = base_url();
        }

        if ($this->input->post())
        {
            $model = new Common_model();
            $custom_model = new Custom_model();
            $user_id = $this->session->userdata['user_id'];
            $arr = $this->input->post();

            $product_details = $custom_model->getAllProductsDetails($arr['product_id'], 'product_id', 'pd_id', 'pi_id', array('pd_product_id' => $arr['product_id'], 'pd_color_name' => $arr['product_color'], 'pd_size' => $arr['product_size']));
//                prd($product_details);
            if (!empty($product_details))
            {
                if (isset($this->session->userdata['user_id']))
                {
                    $pd_id = $product_details['details_arr'][0]['pd_id'];
                    $is_exist = $model->is_exists('cart_id', TABLE_SHOPPING_CART, array('cart_pd_id' => $pd_id, 'cart_quantity' => $arr['product_quantity'], 'cart_user_id' => $user_id));
                    if (empty($is_exist))
                    {
                        $data_array = array(
                            'cart_pd_id' => $pd_id,
                            'cart_quantity' => $arr['product_quantity'],
                            'cart_user_id' => $user_id,
                            'cart_ipaddress' => USER_IP,
                            'cart_useragent' => USER_AGENT
                        );
                        $model->insertData(TABLE_SHOPPING_CART, $data_array);
                        $this->session->set_flashdata("success", "<strong>Success!</strong> Your cart has been updated");
                    }
                    else
                    {
                        $this->session->set_flashdata("warning", "This product is already in your cart");
                    }
                    redirect(getProductUrl($arr["product_url_key"]));
                }
                else
                {
                    $this->session->set_flashdata("error", "Please login to add product to your cart");
                    redirect(getProductUrl($arr["product_url_key"]));
                }
            }
            else
            {
                $this->session->set_flashdata("warning", "<strong>Sorry!</strong> Unexpected error occurred");
            }

            redirect(base_url());
        }
        else
        {
            redirect($redirect_url);
        }
    }

    public function addToCompare($product_id)
    {
        $model = new Common_model();
        if ($product_id && isset($this->session->userdata["user_id"]))
        {
            $product_detail = $model->fetchSelectedData("product_status, product_url_key", TABLE_PRODUCTS, array("product_id" => $product_id));
            if ($product_detail[0]["product_status"] == "1")
            {
                $user_id = $this->session->userdata["user_id"];
                $is_exists = $model->is_exists("compare_id", TABLE_COMPARE, array("product_id" => $product_id, "user_id" => $user_id));
//                    prd($is_exists);
                if (empty($is_exists))
                {
                    $data_array = array(
                        "product_id" => $product_id,
                        "user_id" => $user_id,
                        "user_ipaddress" => USER_IP,
                        "user_agent" => USER_AGENT
                    );
                    $model->insertData(TABLE_COMPARE, $data_array);
                    $this->session->set_flashdata("success", "<strong>Success!</strong> Product added to your compare list");
                }
                else
                {
                    $this->session->set_flashdata("warning", "<strong>Wait!</strong> You already have this product in your compare list");
                }
            }
        }
        else
        {
            $this->session->set_flashdata("warning", "<strong>Just a sec!</strong> You will need to login to add a product to compare list");
        }
        redirect(getProductUrl($product_detail[0]['product_url_key']));
    }

    public function search()
    {
        if ($this->input->get("search"))
        {
            $model = new Common_model();
            $custom_model = new Custom_model();
            $category_name_records = array();
            $query = urldecode($this->input->get("search"));

            $whereCondArr = array(
                'product_title' => $query,
                'product_description' => $query,
            );
            $whereString = 'product_title = "' . $query . '" ';
            foreach ($whereCondArr as $wKey => $wValue)
            {
                $whereString .= ' OR ' . $wKey . ' LIKE "%' . $wValue . '%" ';
            }

            $product_fields = '*';
            $productWhereCondStr = '(' . $whereString . ') AND product_status = "1"';
            $records = $custom_model->getAllSearchProductsList($product_fields, $productWhereCondStr, 'rand()');

            foreach ($records as $key => $value)
            {
                $category_name_records[] = $value['cc_name'];
            }

            $pageHeading = 'Search Results';
            $data["records"] = $records;
            $data["category_name_records"] = $category_name_records;
            $data["product_page_heading"] = $pageHeading;
            $breadcrumbArray = array(
                'Search: ' . $query => current_url(),
            );
            $data["breadcrumbArray"] = $breadcrumbArray;
            $data["meta_title"] = $pageHeading . " | " . SITE_NAME;
            $this->template->write_view("content", "pages/products/products-grid", $data);
            $this->template->render();
        }
        else
        {
            $this->allProductsList();
        }
    }

    public function addProductVisit($product_id, $user_id = NULL)
    {
        // storing the product visit in the table
        if ($user_id == NULL)
        {
            $user_id = 0;
            if (isset($this->session->userdata["user_id"]))
            {
                $user_id = $this->session->userdata["user_id"];
            }
        }

        $visit_data_array = array(
            "pv_product_id" => $product_id,
            "pv_user_id" => $user_id,
            "pv_ipaddress" => USER_IP,
            "pv_useragent" => USER_AGENT
        );
        $model = new Common_model();
        $model->insertData(TABLE_PRODUCT_VISIT, $visit_data_array);
    }

    public function saveProductReview()
    {
        if (isset($this->session->userdata["user_id"]) && $this->input->post())
        {
            $model = new Common_model();
            $arr = $this->input->post();

            $product_id = getEncryptedString($arr['product_id'], 'decode');
            $comment = addslashes($arr['comment']);
            $rating = $arr['rating'];
            $overall_rating = ($rating['value'] + $rating['quality'] + $rating['price']) / count($rating);

            $rating_array = array(
                'rating_product_id' => $product_id,
                'rating_user_id' => $this->session->userdata["user_id"],
                'rating_count' => $overall_rating,
                'rating_value' => $rating['value'],
                'rating_quality' => $rating['quality'],
                'rating_price' => $rating['price'],
                'rating_comment' => $comment,
                'rating_ipaddress' => USER_IP,
                'rating_useragent' => USER_AGENT,
            );
            $model->insertData(TABLE_RATINGS, $rating_array);

            $product_record = $model->fetchSelectedData('product_title, product_url_key', TABLE_PRODUCTS, array('product_id' => $product_id));

            $this->session->set_flashdata('success', 'You have successfully rated ' . stripslashes($product_record[0]['product_title']));
            redirect(getProductUrl($product_record[0]['product_url_key']));
        }
        else
        {
            redirect(base_url());
        }
    }

}
