<?php
    extract($record);
    if ($this->session->flashdata('post'))
    {
        extract($this->session->flashdata('post'));
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
                                <label class="control-label">Product Title</label>
                                <div class="controls">
                                    <!--<input type="text" name="product_title" required="required" value="<?php echo $product_title; ?>" data-required="1" class="span6 m-wrap"/>-->
                                    <p style="margin-top: 8px;"><?php echo $product_title; ?></p>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Description<span class="required">*</span></label>
                                <div class="controls">
                                    <textarea name="product_description" required="required" minlength='400' rows="3" class="span6 m-wrap required"><?php echo $product_description; ?></textarea>
                                    <div class="help-block">(minimum <?php echo PRODUCT_DESC_MIN_LENGTH; ?> characters)</div>
                                </div>
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
        $("#gc_id").change(function () {
            $("#pc_select_box").html("Loading...");
            var gc_id = $(this).val();
            if (gc_id !== "")
            {
                $.ajax({
                    url: "<?php echo base_url_seller("products/getParentCategoriesAjax"); ?>" + "/" + gc_id,
                    success: function (response) {
                        $("#pc_select_box").html(response);
                    }
                });
            }
            else
            {
                $("#pc_select_box").html("");
            }
        });

        $("#pc_id").live("change", function () {
            $("#cc_select_box").html("Loading...");
            var pc_id = $(this).val();
            if (pc_id !== "")
            {
                $.ajax({
                    url: "<?php echo base_url_seller("products/getChildCategoriesAjax"); ?>" + "/" + pc_id,
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