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
                            <a class="btn green mini" href="<?php echo goBack();?>">
                                <i class="icon-arrow-left"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo $form_action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Full Name<span class="required">*</span></label>
                                <div class="controls">
                                    <?php echo stripslashes($wc_fullname); ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email<span class="required">*</span></label>
                                <div class="controls">
                                    <?php echo $wc_email; ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contact Number<span class="required">*</span></label>
                                <div class="controls">
                                    <?php echo $wc_contact; ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Subject<span class="required">*</span></label>
                                <div class="controls">
                                    <?php echo stripslashes($wc_subject); ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Message<span class="required">*</span></label>
                                <div class="controls">
                                    <?php echo stripslashes($wc_message); ?>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Request ID<span class="required">*</span></label>
                                <div class="controls">
                                    #<?php echo $wc_request_id; ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Date-Time</label>
                                <div class="controls">
                                    <?php echo date("d-M-Y h:i A", strtotime($wc_timestamp)); ?>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Status<span class="required">*</span></label>
                                <div class="controls">
                                    <select class="span6 m-wrap required" name="wc_processed" required="required">
                                        <?php
                                            for ($i = 0; $i <= 3; $i++)
                                            {
                                                $selected = '';
                                                if ($i == $wc_processed)
                                                {
                                                    $selected = ' selected="selected" ';
                                                }
                                                ?>
                                                <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo getWebsiteContactStatusText($i); ?></option>
                                                <?php
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Reply</label>
                                <div class="controls">
                                    <textarea class="span6 m-wrap ckeditor" name="reply_message"></textarea>
                                    <div class="help-block">(A mail will be sent to the request creator. Leave empty if don't want to)</div>
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