<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Categories extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->template->set_template('admin');
        $this->admin_id = $this->session->userdata("admin_id");
    }

    public function index()
    {
        $this->childCategories();
    }

    public function parentCategories()
    {
        $model = new Common_model();
        $whereCondArr = array();
        $data["alldata"] = $model->fetchSelectedData('*', TABLE_PARENT_CATEGORY, $whereCondArr);
//            prd($data);

        $this->template->write_view("content", "categories/parent-category-list", $data);
        $this->template->render();
    }

    public function addParentCategory()
    {
        $model = new Common_model();
        if ($this->input->post())
        {
            $arr = $this->input->post();
//                prd($arr);
            $pc_id = $arr["pc_id"];
            $pc_name = $arr["pc_name"];

            $pc_url = getUniqueParentCategoryURL($pc_name);
            $data_array = array(
                'pc_name' => addslashes($pc_name),
                'pc_url' => $pc_url
            );

            if (empty($pc_id))
            {
                //insert
                $is_exists = $model->is_exists("pc_id", TABLE_PARENT_CATEGORY, array("pc_name" => $pc_name));
                if (empty($is_exists))
                {
                    $model->insertData(TABLE_PARENT_CATEGORY, $data_array);
                    $this->session->set_flashdata("success", "Parent category added");
                    redirect(base_url_admin("categories/parentCategories"));
                }
                else
                {
                    $this->session->set_flashdata("error", "Parent category name already exists");
                    redirect(base_url_admin("categories/addParentCategory"));
                }
            }
            else
            {
                //update
                $is_exists = $model->is_exists("pc_id", TABLE_PARENT_CATEGORY, array("pc_name" => $pc_name, "pc_id != " => $pc_id));
                if (empty($is_exists))
                {
                    $model->updateData(TABLE_PARENT_CATEGORY, $data_array, array("pc_id" => $pc_id));
                    $this->session->set_flashdata("success", "Parent category edited");
                    redirect(base_url_admin("categories/parentCategories"));
                }
                else
                {
                    $this->session->set_flashdata("error", "Parent category name already exists");
                    redirect(base_url_admin("categories/editParentCategory/" . $pc_id));
                }
            }
        }
        else
        {
            $data["form_action"] = "";
            $data["form_heading"] = "Add Parent Category";
            $this->template->write_view("content", "categories/parent-category-form", $data);
            $this->template->render();
        }
    }

    public function editParentCategory($pc_id)
    {
        if ($pc_id)
        {
            $model = new Common_model();
            $record = $model->fetchSelectedData("*", TABLE_PARENT_CATEGORY, array("pc_id" => $pc_id));
//                prd($record);
            $data["record"] = $record[0];
            $data["form_heading"] = "Edit parent category";
            $data["form_action"] = base_url_admin("categories/addParentCategory");
            $this->template->write_view("content", "categories/parent-category-form", $data);
            $this->template->render();
        }
        else
        {
            redirect(base_url_admin("categories/parentCategories"));
        }
    }

    public function childCategories()
    {
        $model = new Common_model();
        $tableArrayWithJoinCondition = array(
            TABLE_PARENT_CATEGORY . " as pc" => "pc.pc_id = cc.cc_pc_id"
        );
        $data["alldata"] = $model->getAllDataFromJoin("*", TABLE_CHILD_CATEGORY . " as cc", $tableArrayWithJoinCondition);
//            prd($data);

        $this->template->write_view("content", "categories/child-category-list", $data);
        $this->template->render();
    }

    public function addChildCategory()
    {
        $model = new Common_model();
        if ($this->input->post())
        {
            $arr = $this->input->post();
//                prd($arr);
            $cc_id = $arr["cc_id"];
            $cc_name = $arr["cc_name"];

            $cc_url = getUniqueChildCategoryURL($cc_name);
            $data_array = array(
                'cc_name' => addslashes($cc_name),
                'cc_url' => $cc_url,
                'cc_pc_id' => $arr["pc_id"],
            );

            if (empty($cc_id))
            {
                //insert
                $is_exists = $model->is_exists("cc_id", TABLE_CHILD_CATEGORY, array("cc_name" => $cc_name));
                if (empty($is_exists) == TRUE)
                {
                    $model->insertData(TABLE_CHILD_CATEGORY, $data_array);
                    $this->session->set_flashdata("success", "Child category added");
                    redirect(base_url_admin("categories/childCategories"));
                }
                else
                {
                    $this->session->set_flashdata("error", "Child category name already exists");
                    redirect(base_url_admin("categories/addChildCategory"));
                }
            }
            else
            {
                //update
                $is_exists = $model->is_exists("cc_id", TABLE_CHILD_CATEGORY, array("cc_name" => $cc_name, "cc_id != " => $cc_id));
                if (empty($is_exists))
                {
                    $model->updateData(TABLE_CHILD_CATEGORY, $data_array, array("cc_id" => $cc_id));
                    $this->session->set_flashdata("success", "Child category edited");
                    redirect(base_url_admin("categories/childCategories"));
                }
                else
                {
                    $this->session->set_flashdata("error", "Child category name already exists");
                    redirect(base_url_admin("categories/editChildCategory/" . $cc_id));
                }
            }
        }
        else
        {
            $data["form_action"] = "";
            $data["parent_cat_array"] = $model->fetchSelectedData("*", TABLE_PARENT_CATEGORY, array(), "pc_name");
            $data["form_heading"] = "Add Child Category";
            $this->template->write_view("content", "categories/child-category-form", $data);
            $this->template->render();
        }
    }

    public function editChildCategory($cc_id)
    {
        if ($cc_id)
        {
            $model = new Common_model();
            $record = $model->fetchSelectedData("*", TABLE_CHILD_CATEGORY, array("cc_id" => $cc_id));
//                prd($record);
            $data["record"] = $record[0];
            $data["parent_cat_array"] = $model->fetchSelectedData("*", TABLE_PARENT_CATEGORY, array(), "pc_name");
            $data["form_heading"] = "Edit child category";
            $data["form_action"] = base_url_admin("categories/addChildCategory");
            $this->template->write_view("content", "categories/child-category-form", $data);
            $this->template->render();
        }
        else
        {
            redirect(base_url_admin("categories/childCategories"));
        }
    }

    public function deleteParentCategory($pc_id)
    {
        if ($pc_id)
        {
            $model = new Common_model();
            $model->deleteData(TABLE_PARENT_CATEGORY, array("pc_id" => $pc_id));
            $this->session->set_flashdata("success", "Parent category removed");
        }
        redirect(base_url_admin("categories/parentCategories"));
    }

    public function deleteChildCategory($cc_id)
    {
        if ($cc_id)
        {
            $model = new Common_model();
            $model->deleteData(TABLE_CHILD_CATEGORY, array("cc_id" => $cc_id));
            $this->session->set_flashdata("success", "Child category removed");
        }
        redirect(base_url_admin("categories/childCategories"));
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
                $str .= '<option>select</option>';
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

    public function changeHomepageDisplayStatus($pc_id, $status_code)
    {
        $model = new Common_model();
        $model->updateData(TABLE_PARENT_CATEGORY, array('pc_display' => $status_code), array('pc_id' => $pc_id));
        $this->session->set_flashdata('success', 'Category homepage display status changed');
        redirect(base_url_admin('categories/parentCategories'));
    }

}
