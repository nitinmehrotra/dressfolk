<?php

class Custom_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
        // Load DB here
        $this->load->database();
    }

    public function getPopularProducts($fields, $whereCondArr = NULL, $orderByFieldName = null, $orderByType = null, $limit = "4")
    {
        if (empty($fields))
        {
            $fields = "COUNT(pv.pv_product_id) as count";
        }
        else
        {
            $fields .= ", COUNT(pv.pv_product_id) as count";
        }

        if ($orderByFieldName == NULL)
            $orderByFieldName = "count";

        if ($orderByType == NULL)
            $orderByType = "DESC";

        $result = $this->db->select($fields);
        $result = $result->group_by("product_id");
        $result = $result->join(TABLE_PRODUCTS . " as p", "p.product_id=pv.pv_product_id", "INNER");
        $result = $result->join(TABLE_PRODUCT_IMAGES . " as pi", "pi_product_id=product_id AND pi_primary = 1", "LEFT");
        $result = $result->order_by($orderByFieldName, $orderByType);
        $result = $result->limit($limit);
        $result = $result->get_where(TABLE_PRODUCT_VISIT . " as pv", $whereCondArr);
        $result = $result->result_array();

        return $result;
    }

    public function getFeaturedProducts($fields = null, $whereCondArr = NULL, $orderByFieldName = NULL, $orderByType = "ASC", $limit = null)
    {
        if ($fields == NULL)
        {
            $fields = 'product_id, product_title, product_code, product_price, product_description, pi_image_path, pi_image_title';
        }

        $result = $this->db->select($fields);
        $result = $result->group_by("product_id");
        $result = $result->join(TABLE_PRODUCTS . " as p", "p.product_id=f.feature_product_id", "LEFT");
        $result = $result->join(TABLE_PRODUCT_IMAGES . " as pi", "pi_product_id=product_id AND pi_primary = 1", "LEFT");

        if ($orderByFieldName != NULL)
        {
            $result = $result->order_by($orderByFieldName, $orderByType);
        }

        if ($limit != NULL)
        {
            $result = $result->limit($limit);
        }

        $result = $result->get_where(TABLE_FEATURED . " as f", $whereCondArr);
        $result = $result->result_array();

        return $result;
    }

    public function getAllProductsDetails($product_id, $product_fields, $detail_fields = '*', $images_fields = '*', $whereCondArr = NULL, $orderByFieldName = NULL, $orderByType = "ASC", $limit = null)
    {
        $result = $this->db->select($product_fields);
        $result = $result->join(TABLE_PRODUCT_DETAILS . " as pd", "pd.pd_product_id=p.product_id", "LEFT");
        $result = $result->join(TABLE_PRODUCT_IMAGES . " as pi", "pi.pi_product_id=p.product_id", "LEFT");
        $result = $result->join(TABLE_CHILD_CATEGORY . " as cc", "cc.cc_id=p.product_child_category", "INNER");
        $result = $result->join(TABLE_PARENT_CATEGORY . " as pc", "pc.pc_id=cc.cc_pc_id", "INNER");
        $result = $result->join(TABLE_SELLER . " as s", "s.seller_id=p.product_seller_id", "INNER");

        if ($orderByFieldName != NULL)
        {
            $result = $result->order_by($orderByFieldName, $orderByType);
        }

        if ($limit != NULL)
        {
            $result = $result->limit($limit);
        }

        if ($product_id != NULL || $product_id != 0)
        {
            $whereCondArr['product_id'] = $product_id;
        }
        $result = $result->get_where(TABLE_PRODUCTS . " as p", $whereCondArr);

        $result = $result->result_array();

        // to get product details and images now
        $model = new Common_model();
        $result[0]['details_arr'] = $details_Record = $model->fetchSelectedData($detail_fields, TABLE_PRODUCT_DETAILS, array('pd_product_id' => $product_id));
        $result[0]['images_arr'] = $images_Record = $model->fetchSelectedData($images_fields, TABLE_PRODUCT_IMAGES, array('pi_product_id' => $product_id), 'pi_primary', 'ASC');

        return $result[0];
    }

    public function getAllSearchProductsList($product_fields = NULL, $productWhereCondStr = NULL, $orderByFieldName = NULL, $orderByType = "ASC", $limit = null)
    {
        if ($product_fields == NULL)
        {
            $product_fields = 'product_id, product_title, product_code, product_price, product_description, pi_image_path, pi_image_title, gc_name, cc_name, pc_name';
        }

        $result = $this->db->select($product_fields);
        $result = $this->db->group_by('product_id');
        $result = $result->join(TABLE_CHILD_CATEGORY . " as cc", "cc.cc_id=p.product_child_category", "INNER");
        $result = $result->join(TABLE_PARENT_CATEGORY . " as pc", "pc.pc_id=cc.cc_pc_id", "INNER");
        $result = $result->join(TABLE_SELLER . " as s", "s.seller_id=p.product_seller_id", "INNER");
        $result = $result->join(TABLE_PRODUCT_IMAGES . " as pi", "product_id = pi_product_id AND pi_primary = 1", "LEFT");
        $result = $result->join(TABLE_PRODUCT_DETAILS . " as pd", "product_id = pd_product_id", "LEFT");

        if ($orderByFieldName != NULL)
        {
            $result = $result->order_by($orderByFieldName, $orderByType);
        }

        if ($limit != NULL)
        {
            $result = $result->limit($limit);
        }

        $result = $result->get_where(TABLE_PRODUCTS . " as p", $productWhereCondStr);
        $result = $result->result_array();

        return $result;
    }

    public function getAllProductsList($product_fields = NULL, $productWhereCondArr = NULL, $orderByFieldName = NULL, $orderByType = "ASC", $limit = null)
    {
        if ($product_fields == NULL)
        {
            $product_fields = 'product_id, product_title, product_code, product_price, product_description, pi_image_path, pi_image_title, cc_name, pc_name, seller_fullname, seller_company_name';
        }

        $result = $this->db->select($product_fields);
        $result = $this->db->group_by('product_id');
        $result = $result->join(TABLE_CHILD_CATEGORY . " as cc", "cc.cc_id=p.product_child_category", "INNER");
        $result = $result->join(TABLE_PARENT_CATEGORY . " as pc", "pc.pc_id=cc.cc_pc_id", "INNER");
        $result = $result->join(TABLE_SELLER . " as s", "s.seller_id=p.product_seller_id", "INNER");
        $result = $result->join(TABLE_PRODUCT_IMAGES . " as pi", "product_id = pi_product_id AND pi_primary = 1", "LEFT");
        $result = $result->join(TABLE_PRODUCT_DETAILS . " as pd", "product_id = pd_product_id", "LEFT");

        if ($orderByFieldName != NULL)
        {
            $result = $result->order_by($orderByFieldName, $orderByType);
        }

        if ($limit != NULL)
        {
            $result = $result->limit($limit);
        }

        $result = $result->get_where(TABLE_PRODUCTS . " as p", $productWhereCondArr);
        $result = $result->result_array();

        return $result;
    }

    public function getOrdersList($fields = null, $whereCondArr = null, $orderByField = 'sod_id', $orderByType = "DESC", $limit = NULL)
    {
        if ($fields == NULL)
        {
            $fields = 'sd_quantity, sd_order_id, sd_shipping_fullname, sd_shipping_contact, sd_shipping_email, sd_shipping_address, sd_shipping_location, sd_shipping_postcode, payment_amount, sd_timestamp, sd_status, pd_color_name, pd_size, product_title, pi_image_path, sod_order_id, sod_order_status, seller_fullname, seller_company_name';
        }

        $whereCondArr['pi_primary'] = '1';
        $records = $this->db->select($fields)
                ->join(TABLE_SHIPPING_DETAILS . ' as sd', 'sod_order_id = sd_order_id', 'LEFT')
                ->join(TABLE_PRODUCT_DETAILS . ' as pd', 'pd_id = sd_pd_id', 'INNER')
                ->join(TABLE_PRODUCTS . ' as p', 'product_id = pd_product_id', 'INNER')
                ->join(TABLE_PRODUCT_IMAGES . ' as pi', 'product_id = pi_product_id', 'LEFT')
                ->join(TABLE_PAYMENTS . ' as py', 'payment_sod_id = sod_id', 'LEFT')
                ->join(TABLE_SELLER . ' as s', 'seller_id = product_seller_id', 'LEFT')
                ->group_by('sd_order_id')
                ->order_by($orderByField, $orderByType);

        if ($limit != NULL)
        {
            $records = $records->limit($limit);
        }
        $records = $records->get_where(TABLE_SHIPPING_ORDER_DETAILS . ' as sod', $whereCondArr)->result_array();

        return $records;
    }

    public function getMyOrdersList($user_id, $fields = null, $whereCondArr = null, $orderByField = 'sd_id', $orderByType = "DESC", $limit = NULL)
    {
        if ($fields == NULL)
        {
            $fields = 'sd_quantity, sd_order_id, sd_shipping_fullname, sd_shipping_contact, sd_shipping_email, sd_shipping_address, sd_shipping_location, sd_shipping_postcode, payment_amount, sd_timestamp, sd_status, pd_color_name, pd_size, product_title, pi_image_path, sod_order_id, sod_order_status';
        }

        $whereCondArr['sd_user_id'] = $user_id;
        $whereCondArr['pi_primary'] = '1';
        $records = $this->db->select($fields)
                ->join(TABLE_SHIPPING_DETAILS . ' as sd', 'sod_order_id = sd_order_id', 'LEFT')
                ->join(TABLE_PRODUCT_DETAILS . ' as pd', 'pd_id = sd_pd_id', 'INNER')
                ->join(TABLE_PRODUCTS . ' as p', 'product_id = pd_product_id', 'INNER')
                ->join(TABLE_PRODUCT_IMAGES . ' as pi', 'product_id = pi_product_id', 'LEFT')
                ->join(TABLE_PAYMENTS . ' as py', 'payment_sod_id = sod_id', 'LEFT')
                ->group_by('sd_order_id')
                ->order_by($orderByField, $orderByType);

        if ($limit != NULL)
        {
            $records = $records->limit($limit);
        }
        $records = $records->get_where(TABLE_SHIPPING_ORDER_DETAILS . ' as sod', $whereCondArr)->result_array();

        return $records;
    }

    public function getCartDetails($user_id, $fields = NULL, $whereCondArr = null, $orderByField = 'cart_id', $orderByType = "DESC", $limit = NULL)
    {
        if ($fields == NULL)
        {
            $fields = 'product_id, product_title, cart_quantity, pi_image_path, product_price, cart_id, pd_color_name, pd_size, pd_id';
        }

        $whereCondArr['cart_user_id'] = $user_id;
        $whereCondArr['cart_status'] = '1';
        $whereCondArr['pi_primary'] = '1';
        $records = $this->db->select($fields)
                ->join(TABLE_PRODUCT_DETAILS . ' as pd', 'pd_id = cart_pd_id', 'INNER')
                ->join(TABLE_PRODUCTS . ' as p', 'product_id = pd_product_id', 'INNER')
                ->join(TABLE_PRODUCT_IMAGES . ' as pi', 'product_id = pi_product_id', 'LEFT')
                ->order_by($orderByField, $orderByType);

        if ($limit != NULL)
        {
            $records = $records->limit($limit);
        }
        $records = $records->get_where(TABLE_SHOPPING_CART . ' as sc', $whereCondArr)->result_array();

        return $records;
    }

    public function getMyWishlistRecords($fields, $whereCondArr = null, $orderByFieldName = 'wishlist_id', $orderByType = "DESC", $limit = NULL)
    {
        if ($fields == NULL)
        {
            $fields = 'wishlist_id, product_id, product_title, pi_image_path, product_price, pd_color_name, pd_size, pd_id';
        }

        $result = $this->db->select($fields);
        $result = $this->db->group_by('product_id');
        $result = $result->join(TABLE_PRODUCTS . " as p", "product_id = wishlist_product_id", "INNER");
        $result = $result->join(TABLE_PRODUCT_DETAILS . " as pd", "pd_product_id = product_id", "INNER");
        $result = $result->join(TABLE_CHILD_CATEGORY . " as cc", "cc.cc_id=p.product_child_category", "INNER");
        $result = $result->join(TABLE_PARENT_CATEGORY . " as pc", "pc.pc_id=cc.cc_pc_id", "INNER");
        $result = $result->join(TABLE_SELLER . " as s", "s.seller_id=p.product_seller_id", "INNER");
        $result = $result->join(TABLE_PRODUCT_IMAGES . " as pi", "product_id = pi_product_id AND pi_primary = 1", "LEFT");

        if ($orderByFieldName != NULL)
        {
            $result = $result->order_by($orderByFieldName, $orderByType);
        }

        if ($limit != NULL)
        {
            $result = $result->limit($limit);
        }

        $whereCondArr['product_status'] = '1';
        $result = $result->get_where(TABLE_WISHLIST . " as w", $whereCondArr)->result_array();

        return $result;
    }

    public function getRelatedproducts($product_id_to_relate, $product_fields, $productWhereCondArr = null, $orderByFieldName = 'rand()', $orderByType = 'ASC', $limit = 12)
    {
        $model = new Common_model();
        $record = $model->fetchSelectedData('product_child_category', TABLE_PRODUCTS, array('product_id' => $product_id_to_relate));
        if ($productWhereCondArr = NULL)
        {
            $productWhereCondArr = array();
        }
        $productWhereCondArr['product_child_category'] = $record[0]['product_child_category'];
        $output = $this->getAllProductsList($product_fields, $productWhereCondArr, $orderByFieldName, $orderByType, $limit);
        return $output;
    }

}
