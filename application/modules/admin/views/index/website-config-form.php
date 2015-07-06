<?php
if (isset($record))
{
    extract($record);
}

if (!isset($form_action))
    $form_action = "";
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
                            <div class="control-group">
                                <label class="control-label">Site Name<span class="required">*</span></label>
                                <div class="controls"><input class="span6 m-wrap" type="text" data-required="1" name="site_name" required="required" value="<?php echo $alldata['site_name']; ?>"></div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Site Title<span class="required">*</span></label>
                                <div class="controls"><input class="span6 m-wrap" type="text" data-required="1" name="site_title" required="required" value="<?php echo $alldata['site_title']; ?>"></div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Site Email<span class="required">*</span></label>
                                <div class="controls"><input class="span6 m-wrap" type="text" data-required="1" name="site_email" required="required" value="<?php echo $alldata['site_email']; ?>"></div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Site Contact Number<span class="required">*</span></label>
                                <div class="controls"><input class="span6 m-wrap" type="text" data-required="1" name="site_contact_number" required="required" value="<?php echo $alldata['site_contact_number']; ?>"></div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Site URL<span class="required">*</span></label>
                                <div class="controls"><input class="span6 m-wrap" type="text" data-required="1" name="site_url" required="required" value="<?php echo $alldata['site_url']; ?>"></div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Slider Image 1 Text<span class="required">*</span></label>
                                <div class="controls"><input class="span6 m-wrap" type="text" data-required="1" name="slider_text_one" required="required" value="<?php echo ($alldata['slider_text_one']); ?>"></div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Slider Image 2 Text<span class="required">*</span></label>
                                    <div class="controls"><input class="span6 m-wrap" type="text" data-required="1" name="slider_text_two" required="required" value="<?php echo ($alldata['slider_text_two']); ?>"></div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Slider Image 3 Text<span class="required">*</span></label>
                                <div class="controls"><input class="span6 m-wrap" type="text" data-required="1" name="slider_text_three" required="required" value="<?php echo ($alldata['slider_text_three']); ?>"></div>
                            </div>

                            <div class="form-actions submit-bttn">
                                <button type="submit" class="btn green">Update</button>
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
    $(document).ready(function () {
        $("#pc_id").live("change", function () {
            $("#cc_select_box").html("Loading...");
            var pc_id = $(this).val();
            if (pc_id !== "")
            {
                $.ajax({
                    url: "<?php echo base_url("admin/categories/getChildCategoriesAjax"); ?>" + "/" + pc_id,
                    success: function (response) {
                        $("#cc_select_box").html(response);
                    }
                });
            }
            else
            {
                $("#cc_select_box").html("");
            }
        });

        $("#pc_id").live("change", function () {
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
    });
</script>