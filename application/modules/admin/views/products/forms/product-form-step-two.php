<style>
    .copy-this>div.clearfix{margin-bottom: 20px}
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
                                        if (isset($record['details_arr']) && !empty($record['details_arr']))
                                        {
                                            foreach ($record['details_arr'] as $key => $value)
                                            {
                                                ?>
                                                <div class='clearfix'>
                                                    <input type='hidden' name='pd_id[]' value='<?php echo $value['pd_id']; ?>'/>
                                                    <div class='span3' style="margin-left: 0">
                                                        <label>Size<span class="required">*</span></label>
                                                        <select class='' required="required" name='product_size[]'>
                                                            <?php
                                                            $size_array = array('S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'Zero');
                                                            foreach ($size_array as $size)
                                                            {
                                                                $size_selected = '';
                                                                if ($value['pd_size'] == $size)
                                                                {
                                                                    $size_selected = ' selected="selected" ';
                                                                }
                                                                echo '<option value="' . $size . '" ' . $size_selected . '>' . $size . '</option>';
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class='span3'>
                                                        <label>Color<span class="required">*</span></label>
                                                        <input type='text' name='product_color[]' required="required" class="" value="<?php echo $value['pd_color_name']; ?>" placeholder="(eg.:- Blue)"/>
                                                    </div>
                                                    <div class='span3'>
                                                        <label>Available quantity with you<span class="required">*</span></label>
                                                        <input type='text' name='product_quantity[]' required="required" class="" value="<?php echo $value['pd_quantity']; ?>" placeholder="(eg.:- 100)"/>
                                                    </div>
                                                    <div class='span3'>
                                                        <label>Min. quantity customer shall order<span class="required">*</span></label>
                                                        <input type='text' name='product_min_quantity[]' required="required" class="" value="<?php echo $value['pd_min_quantity']; ?>" placeholder="(eg.:- 10)"/>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            ?>
                                            <div class='clearfix'>
                                                <input type='hidden' name='pd_id[]' value=''/>
                                                <div class='span3' style="margin-left: 0">
                                                    <label>Size<span class="required">*</span></label>
                                                    <select class='' required="required" name='product_size[]'>
                                                        <?php
                                                        $size_array = array('S', 'M', 'L', 'XL', 'XXL', 'XXXL', 'Zero');
                                                        foreach ($size_array as $size)
                                                        {
                                                            echo '<option value="' . $size . '" ' . $size_selected . '>' . $size . '</option>';
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                                <div class='span3'>
                                                    <label>Color<span class="required">*</span></label>
                                                    <input type='text' name='product_color[]' required="required" class="" value="" placeholder="(eg.:- Blue)"/>
                                                </div>
                                                <div class='span3'>
                                                    <label>Available quantity with you<span class="required">*</span></label>
                                                    <input type='text' name='product_quantity[]' required="required" class="" value="" placeholder="(eg.:- 100)"/>
                                                </div>
                                                <div class='span3'>
                                                    <label>Min. quantity customer shall order<span class="required">*</span></label>
                                                    <input type='text' name='product_min_quantity[]' required="required" class="" value="" placeholder="(eg.:- 10)"/>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>

                            <div class='clearfix'>
                                <p class='text-right'><a href='#' class='add-more'>+ Add more</a></p>
                            </div>

                            <div class="form-actions submit-bttn">
                                <button type="submit" class="btn green">Next&nbsp;<i class='icon-chevron-right'></i></button>
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
        var newdiv = $('span.copy-this').html();
        $('a.add-more').click(function (e) {
            e.preventDefault();
            $('span.copy-this').append(newdiv);
        });
    });
</script>