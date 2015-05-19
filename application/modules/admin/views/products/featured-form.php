<?php
    $result = array();
    if (isset($record))
    {
        foreach ($record as $key => $value)
        {
            $result[$key] = $value;
        }
    }
    else
    {
        $result["feature_id"] = "";
        $result["product_id"] = "";
        $result["product_title"] = "";
        $result["product_code"] = "";
        $result["end_time"] = "";
        $result["start_time"] = "";
        $result["feature_status"] = "";
    }

    if (!isset($form_action))
        $form_action = "";
    
//    prd($result);
?>

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
                            <input type="hidden" name="feature_id" value="<?php echo set_value("feature_id", $result["feature_id"]); ?>"/>

                            <div class="control-group">
                                <label class="control-label">Select Product<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="product_id" class="span6 m-wrap">
                                        <?php
                                            if (!empty($product_array))
                                            {
                                                echo '<option>select</option>';
                                                foreach ($product_array as $gcKey => $gcValue)
                                                {
                                                    $product_id = $gcValue["product_id"];
                                                    $product_title = $gcValue["product_title"];
                                                    $product_code = $gcValue["product_code"];

                                                    $selected = "";
                                                    if ($result["product_id"] == $product_id)
                                                        $selected = "selected='selected'";

                                                    echo '<option value="' . $product_id . '" ' . $selected . '>' . $product_title . ' (' . $product_code . ')</option>';
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
                                <label class="control-label">Start Date</label>
                                <div class="controls">
                                    <input name="start_time" value="<?php echo set_value("start_time", $result["start_time"]); ?>" type="text" class="span6 m-wrap datepicker"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">End Date</label>
                                <div class="controls">
                                    <input name="end_time" value="<?php echo set_value("end_time", $result["end_time"]); ?>" type="text" class="span6 m-wrap datepicker"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Feature Status<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="feature_status" class="span6 m-wrap" required="required">
                                        <option value="1" <?php echo set_select("feature_status", "1", $result["feature_status"] == "1") ?>>Active</option>
                                        <option value="0" <?php echo set_select("feature_status", "0", $result["feature_status"] == "0") ?>>Deactive</option>
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