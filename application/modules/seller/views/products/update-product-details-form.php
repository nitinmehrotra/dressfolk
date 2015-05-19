<style>
    .copy-this>div.clearfix{margin-bottom: 20px}
    span.required{color: #ff0000;}
</style>

<?php
    extract($record);
    
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
                                        <div class='clearfix'>
                                            <div class='span3' style="margin-left: 0">
                                                <label>Size<span class="required">*</span></label>
                                                <select class='' required="required" name='pd_size'>
                                                    <?php
                                                        $size_array = array('S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'Zero');
                                                        foreach ($size_array as $size)
                                                        {
                                                            $size_selected = '';
                                                            if ($pd_size == $size)
                                                                $size_selected = 'selected="selected"';

                                                            echo '<option value="' . $size . '" ' . $size_selected . '>' . $size . '</option>';
                                                        }
                                                    ?>
                                                </select>
                                            </div>
                                            <div class='span3'>
                                                <label>Color<span class="required">*</span></label>
                                                <input type='text' name='pd_color_name' required="required" class="" placeholder="(eg.:- Blue)" value="<?php echo $pd_color_name; ?>"/>
                                            </div>
                                            <div class='span3'>
                                                <label>Available quantity with you<span class="required">*</span></label>
                                                <input type='text' name='pd_quantity' required="required" class="" placeholder="(eg.:- 100)" value="<?php echo $pd_quantity; ?>"/>
                                            </div>
                                            <div class='span3'>
                                                <label>Min. quantity customer shall order<span class="required">*</span></label>
                                                <input type='text' name='pd_min_quantity' required="required" class="" placeholder="(eg.:- 10)" value="<?php echo $pd_min_quantity; ?>"/>
                                            </div>
                                        </div>
                                    </span>
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