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
                                <label class="control-label">Your Price<span class="required">*</span></label>
                                <div class="controls">
                                    <div class='input-prepend'>
                                        <span class='add-on'><?php echo DEFAULT_CURRENCY_SYMBOL; ?></span>
                                        <input name="product_seller_price" id="product_seller_price" required="required" maxlength="10" value="<?php echo $product_seller_price ?>" type="text" class=" m-wrap"/>
                                    </div>
                                    <div class="help-block">(Your selling price)</div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Shipping Charge<span class="required">*</span></label>
                                <div class="controls">
                                    <div class='input-prepend'>
                                        <span class='add-on'><?php echo DEFAULT_CURRENCY_SYMBOL; ?></span>
                                        <input name="product_shipping_charge" id="product_shipping_charge" required="required" maxlength="5" value="<?php echo $product_shipping_charge ?>" type="text" class=" m-wrap"/>
                                    </div>
                                    <div class="help-block">(Customer will have to pay)</div>
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