<?php
    $result = array();
    if (isset($record))
    {
        foreach ($record as $key => $value)
        {
            $result[$key] = $value;
        }
        $result["dc_start_time"] = date("Y-m-d H:i", $result["dc_start_time"]);
        $result["dc_end_time"] = date("Y-m-d H:i", $result["dc_end_time"]);
    }
    else
    {
        $result["dc_id"] = "";
        $result["dc_title"] = "";
        $result["dc_code"] = "";
        $result["dc_cc_id"] = "";
        $result["dc_start_time"] = "";
        $result["dc_end_time"] = "";
        $result["dc_count"] = "0";
        $result["dc_count_available"] = "0";
        $result["dc_percent"] = "0";
        $result["dc_status"] = "";
    }

    if (!isset($form_action))
        $form_action = "";
?>

<link rel="stylesheet" type="text/css" href="<?php echo ADMIN_ASSETS_PATH; ?>/bootstrap-datetimepicker/datetimepicker.css"/>

<!-- BEGIN PAGE -->  
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->   
        <div class="row-fluid">
            <div class="span12">  
                <h3 class="page-title">
                    <?php echo $form_heading; ?>
                </h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-reorder"></i><?php echo $form_heading; ?></h4>
                        <div class="actions">
                            <a class="btn green mini" href="<?php echo goBack(); ?>">
                                <i class="icon-arrow-left"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo $form_action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="dc_id" value="<?php echo set_value("dc_id", $result["dc_id"]); ?>"/>
                            <div class="control-group">
                                <label class="control-label">Coupon Title<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="dc_title" required="required" value="<?php echo set_value("dc_title", $result["dc_title"]); ?>" data-required="1" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Coupon Code<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="dc_code" required="required" value="<?php echo set_value("dc_code", $result["dc_code"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Total Coupon Count<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="dc_count" required="required" value="<?php echo set_value("dc_count", $result["dc_count"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Coupons Available<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="dc_count_available" required="required" value="<?php echo set_value("dc_count_available", $result["dc_count_available"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Discount Percent<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="dc_percent" required="required" value="<?php echo set_value("dc_percent", $result["dc_percent"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Applicable To Product<span class="required">*</span></label>
                                <div class="controls">

                                    <select name="dc_cc_id" class="span6 m-wrap" id="cc_id">
                                        <?php
                                            if (!empty($child_cat_array))
                                            {
                                                echo '<option value="">All</option>';
                                                foreach ($child_cat_array as $ccKey => $ccValue)
                                                {
                                                    $cc_id = $ccValue["cc_id"];
                                                    $cc_name = $ccValue["cc_name"];

                                                    $selected = "";
                                                    if ($result["dc_cc_id"] == $cc_id)
                                                        $selected = "selected='selected'";

                                                    echo '<option value="' . $cc_id . '" ' . $selected . '>' . $cc_name . '</option>';
                                                }
                                            }
                                            else
                                            {
                                                echo '<option>No data</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Start Time<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="dc_start_time" required="required" value="<?php echo set_value("dc_start_time", $result["dc_start_time"]); ?>" type="text" class="span6 m-wrap datetimepicker"/>
                                </div>
                            </div>                          

                            <div class="control-group">
                                <label class="control-label">End Time<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="dc_end_time" required="required" value="<?php echo set_value("dc_end_time", $result["dc_end_time"]); ?>" type="text" class="span6 m-wrap datetimepicker"/>
                                </div>
                            </div>                          

                            <div class="control-group">
                                <label class="control-label">Product Status<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="dc_status" class="span6 m-wrap" required="required">
                                        <option value="1" <?php echo set_select("dc_status", "1", $result["dc_status"] == "1") ?>>Active</option>
                                        <option value="0" <?php echo set_select("dc_status", "0", $result["dc_status"] == "0") ?>>Deactive</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-actions submit-bttn">
                                <button type="submit" class="btn green">Submit</button>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->         
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE --> 

<script type="text/javascript" src="<?php echo ADMIN_ASSETS_PATH; ?>/bootstrap-datetimepicker/bootstrap-datetimepicker.min.js"></script>
<script>
                                $(document).ready(function() {
                                    $("#cc_id").change(function() {
                                        $("#pc_select_box").html("Loading...");
                                        var cc_id = $(this).val();
                                        if (cc_id !== "")
                                        {
                                            $.ajax({
                                                url: "<?php echo base_url("admin/categories/getParentCategoriesAjax"); ?>" + "/" + cc_id,
                                                success: function(response) {
                                                    $("#pc_select_box").html(response);
                                                }
                                            });
                                        }
                                        else
                                        {
                                            $("#pc_select_box").html("");
                                        }
                                    });

                                    $("#pc_id").live("change", function() {
                                        $("#cc_select_box").html("Loading...");
                                        var pc_id = $(this).val();
                                        if (pc_id !== "")
                                        {
                                            $.ajax({
                                                url: "<?php echo base_url("admin/categories/getChildCategoriesAjax"); ?>" + "/" + pc_id,
                                                success: function(response) {
                                                    $("#cc_select_box").html(response);
                                                }
                                            });
                                        }
                                        else
                                        {
                                            $("#cc_select_box").html("");
                                        }
                                    });

                                    $("#pc_id").live("change", function() {
                                        var pc_id = $(this).val();
                                        if (pc_id != "")
                                        {
                                            $("#cc_name_box").show();
                                            $(".submit-bttn").show();
                                        }
                                        else
                                        {
                                            $("#cc_name_box").hide();
                                            $(".submit-bttn").hide();
                                        }
                                    });

                                    $(".datetimepicker").datetimepicker();
                                });
</script>