<style>
    .copy-this>div.clearfix{margin-bottom: 30px}
    span.required{color: #ff0000;}
</style>

<?php
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
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo $form_action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label"><strong>Product Details</strong></label>
                            </div>
                            <div class="control-group">
                                <div class="controls">
                                    <span class='copy-this'>
                                        <?php
                                            for ($i = 1; $i <= MAX_PRODUCT_IMAGES; $i++)
                                            {
                                                $required_input = '';
                                                $required_text = '';
                                                if ($i <= MIN_PRODUCT_IMAGES)
                                                {
                                                    $required_input = ' required="required" ';
                                                    $required_text = '<span class="required">*</span>';
                                                }
                                                ?>
                                                <div class='clearfix'>
                                                    <input type='hidden' name='pi_id[]' value=''/>
                                                    <div class='span3'>
                                                        <label>Select image<?php echo $required_text; ?></label>
                                                        <input type='file' name='product_img[]' class='m-wrap' <?php echo $required_input; ?> style="max-width: 100%;"/>
                                                    </div>
                                                    <div class='span3'>
                                                        <label>Image Title</label>
                                                        <input type='text' name='product_img_title[]' class="m-wrap" placeholder="(eg.:- Front view)"/>
                                                    </div>
                                                    <div class='span3'>
                                                        <label>Preview</label>
                                                        <div style="width: 50px;height: 50px">
                                                            <img src='<?php echo NO_PRODUCT_IMG_PATH; ?>' alt='no-image' style="max-width: 100%"/>
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        ?>
                                    </span>
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