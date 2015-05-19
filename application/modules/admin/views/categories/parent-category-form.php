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
        $result["pc_id"] = "";
        $result["pc_gc_id"] = "";
        $result["pc_name"] = "";
    }

    if (!isset($form_action))
        $form_action = "";

    if (empty($result["pc_id"]))
    {
        ?>
        <style>
            #pc_name_box{display: none;}
            .submit-bttn{display: none;}
        </style>
        <?php
    }
?>

<!-- BEGIN PAGE -->  
<div class="page-content">
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
                        <form action="<?php echo $form_action; ?>" method="post" class="form-horizontal">
                            <input type="hidden" name="pc_id" value="<?php echo set_value("pc_id", $result["pc_id"]); ?>"/>
                            <div class="control-group">
                                <label class="control-label">Grand Category<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="gc_id" class="span6 m-wrap" id="gc_id">
                                        <?php
                                            if (!empty($grand_cat_array))
                                            {
                                                echo '<option>select</option>';
                                                foreach ($grand_cat_array as $gcKey => $gcValue)
                                                {
                                                    $gc_id = $gcValue["gc_id"];
                                                    $gc_name = $gcValue["gc_name"];

                                                    $selected = "";
                                                    if ($result["pc_gc_id"] == $gc_id)
                                                        $selected = "selected='selected'";

                                                    echo '<option value="' . $gc_id . '" ' . $selected . '>' . $gc_name . '</option>';
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

                            <span id="pc_name_box">
                                <div class="control-group">
                                    <label class="control-label">Parent Category Name<span class="required">*</span></label>
                                    <div class="controls">
                                        <input type="text" name="pc_name" required="required" value="<?php echo set_value("pc_name", $result["pc_name"]); ?>" data-required="1" class="span6 m-wrap"/>
                                    </div>
                                </div>
                            </span>

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

<script>
                                $(document).ready(function() {
                                    $("#gc_id").change(function() {
                                        var gc_id = $(this).val();
                                        if (gc_id !== "")
                                        {
                                            $("#pc_name_box").show();
                                            $(".submit-bttn").show();
                                        }
                                        else
                                        {
                                            $("#pc_name_box").hide();
                                            $(".submit-bttn").hide();
                                        }
                                    });
                                });
</script>