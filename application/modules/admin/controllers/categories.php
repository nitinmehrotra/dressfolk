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

        public function grandCategories()
        {
            $model = new Common_model();
            $data["alldata"] = $model->getAllData("*", TABLE_GRAND_CATEGORY);
//            prd($data);

            $this->template->write_view("content", "categories/grand-category-list", $data);
            $this->template->render();
        }

        public function addGrandCategory()
        {
            $data["form_action"] = "";
            $data["form_heading"] = "Add Grand Category";
            $this->template->write_view("content", "categories/grand-category-form", $data);
            $this->template->render();

            if ($this->input->post())
            {
                $model = new Common_model();
                $arr = $this->input->post();
                $gc_id = trim($arr["gc_id"]);
                $gc_name = trim($arr["gc_name"]);

                if (empty($gc_id))
                {
                    //insert
                    $is_exists = $model->is_exists("gc_id", TABLE_GRAND_CATEGORY, array("gc_name" => $gc_name));
                    if (empty($is_exists))
                    {
                        $model->insertData(TABLE_GRAND_CATEGORY, array("gc_name" => $gc_name));
                        $this->session->set_flashdata("success", "Grand category added");
                    }
                    else
                    {
                        $this->session->set_flashdata("error", "Grand category name already exists");
                        redirect(base_url_admin("categories/addGrandCategory"));
                    }
                }
                else
                {
                    //update
                    $is_exists = $model->is_exists("gc_id", TABLE_GRAND_CATEGORY, array("gc_name" => $gc_name, "gc_id !=" => $gc_id));
                    if (empty($is_exists))
                    {
                        $model->updateData(TABLE_GRAND_CATEGORY, array("gc_name" => $gc_name), array("gc_id" => $gc_id));
                        $this->session->set_flashdata("success", "Grand category edited");
                    }
                    else
                    {
                        $this->session->set_flashdata("error", "Grand category name already exists");
                        redirect(base_url_admin("categories/editGrandCategory/" . $gc_id));
                    }
                }
                redirect(base_url_admin("categories/grandCategories"));
            }
        }

        public function editGrandCategory($gc_id)
        {
            if ($gc_id)
            {
                $model = new Common_model();
                $record = $model->fetchSelectedData("*", TABLE_GRAND_CATEGORY, array("gc_id" => $gc_id));
                $data["record"] = $record[0];
                $data["form_heading"] = "Edit grand category";
                $data["form_action"] = base_url_admin("categories/addGrandCategory");
                $this->template->write_view("content", "categories/grand-category-form", $data);
                $this->template->render();
            }
            else
            {
                redirect(base_url_admin("categories/grandCategories"));
            }
        }

        public function parentCategories()
        {
            $model = new Common_model();
            $tableArrayWithJoinCondition = array(
                TABLE_GRAND_CATEGORY . " as gc" => "gc.gc_id = pc.pc_gc_id"
            );
            $data["alldata"] = $model->getAllDataFromJoin("*", TABLE_PARENT_CATEGORY . " as pc", $tableArrayWithJoinCondition);
//            prd($data);

            $this->template->write_view("content", "categories/parent-category-list", $data);
            $this->template->render();
        }

        public function addParentCategory()
        {
            $model = new Common_model();
            $data["form_action"] = "";
            $data["form_heading"] = "Add Parent Category";
            $data["grand_cat_array"] = $model->fetchSelectedData("*", TABLE_GRAND_CATEGORY, NULL, "gc_name");
            $this->template->write_view("content", "categories/parent-category-form", $data);
            $this->template->render();

            if ($this->input->post())
            {
                $arr = $this->input->post();
//                prd($arr);
                $pc_id = $arr["pc_id"];
                $gc_id = $arr["gc_id"];
                $arr["pc_gc_id"] = $arr["gc_id"];
                unset($arr["gc_id"]);
                $pc_name = $arr["pc_name"];

                if (empty($pc_id))
                {
                    //insert
                    $is_exists = $model->is_exists("pc_id", TABLE_PARENT_CATEGORY, array("pc_name" => $pc_name));
                    if (empty($is_exists))
                    {
                        $model->insertData(TABLE_PARENT_CATEGORY, $arr);
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
                        $model->updateData(TABLE_PARENT_CATEGORY, $arr, array("pc_id" => $pc_id));
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
        }

        public function editParentCategory($pc_id)
        {
            if ($pc_id)
            {
                $model = new Common_model();
                $record = $model->fetchSelectedData("*", TABLE_PARENT_CATEGORY, array("pc_id" => $pc_id));
//                prd($record);
                $data["record"] = $record[0];
                $data["grand_cat_array"] = $model->fetchSelectedData("*", TABLE_GRAND_CATEGORY, NULL, "gc_name");
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
                TABLE_GRAND_CATEGORY . " as gc" => "gc.gc_id = cc.cc_gc_id",
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
            $data["form_action"] = "";
            $data["form_heading"] = "Add Child Category";
            $data["grand_cat_array"] = $model->fetchSelectedData("*", TABLE_GRAND_CATEGORY, NULL, "gc_name");
            $this->template->write_view("content", "categories/child-category-form", $data);
            $this->template->render();

            if ($this->input->post())
            {
                $arr = $this->input->post();
//                prd($arr);
                $cc_id = $arr["cc_id"];
                $arr["cc_pc_id"] = $arr["pc_id"];
                unset($arr["pc_id"]);
                $gc_id = $arr["gc_id"];
                $arr["cc_gc_id"] = $arr["gc_id"];
                unset($arr["gc_id"]);
                $cc_name = $arr["cc_name"];

                if (empty($cc_id))
                {
                    //insert
                    $is_exists = $model->is_exists("cc_id", TABLE_CHILD_CATEGORY, array("cc_name" => $cc_name));
                    if (empty($is_exists))
                    {
                        $model->insertData(TABLE_CHILD_CATEGORY, $arr);
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
                        $model->updateData(TABLE_CHILD_CATEGORY, $arr, array("cc_id" => $cc_id));
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
        }

        public function editChildCategory($cc_id)
        {
            if ($cc_id)
            {
                $model = new Common_model();
                $record = $model->fetchSelectedData("*", TABLE_CHILD_CATEGORY, array("cc_id" => $cc_id));
//                prd($record);
                $data["record"] = $record[0];
                $data["grand_cat_array"] = $model->fetchSelectedData("*", TABLE_GRAND_CATEGORY, NULL, "gc_name");
                $data["parent_cat_array"] = $model->fetchSelectedData("*", TABLE_PARENT_CATEGORY, array("pc_gc_id"=>$record[0]["cc_gc_id"]), "pc_name");
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

        public function deleteGrandCategory($gc_id)
        {
            if ($gc_id)
            {
                $model = new Common_model();
                $model->deleteData(TABLE_GRAND_CATEGORY, array("gc_id" => $gc_id));
                $model->deleteData(TABLE_PARENT_CATEGORY, array("pc_gc_id" => $gc_id));
                $model->deleteData(TABLE_CHILD_CATEGORY, array("cc_gc_id" => $gc_id));
                $this->session->set_flashdata("success", "Grand category removed");
            }
            redirect(base_url_admin("categories/grandCategories"));
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
                    $str .= '<option>select</option>';
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

    }

?>
