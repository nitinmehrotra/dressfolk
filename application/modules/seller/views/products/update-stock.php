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
        $result["product_id"] = "";
        $result["product_title"] = "";
        $result["product_code"] = "";
        $result["product_stock_count"] = "";
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
                                <label class="control-label">Product Title<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="product_id" id="product_id" class="span6 m-wrap required" required="required">
                                        <?php
                                            if (!empty($product_records))
                                            {
                                                echo '<option>select product</option>';
                                                foreach ($product_records as $key => $value)
                                                {
                                                    $product_id = $value["product_id"];
                                                    $product_title = $value["product_title"];
                                                    $product_code = $value["product_code"];

                                                    $selected = '';
                                                    if ($selected_product_id == $product_id)
                                                        $selected = 'selected="selected"';

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

                            <?php
                                if (!empty($product_sizes))
                                {
                                    ?>
                                    <div class="control-group">
                                        <label class="control-label">Product Sizes<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="product_size" id="product_size" class="span6 m-wrap required" required="required">
                                                <?php
                                                echo '<option>select size</option>';
                                                foreach ($product_sizes as $key => $value)
                                                {
                                                    $size_selected = '';
                                                    if ($selected_product_size == $value['product_size'])
                                                        $size_selected = 'selected="selected"';

                                                    echo '<option value="' . $value['product_size'] . '" ' . $size_selected . '>' . $value['product_size'] . '</option> ';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                }
                      
                                if (!empty($product_colors))
                                {
                                    ?>
                                    <div class="control-group">
                                        <label class="control-label">Product Colors<span class="required">*</span></label>
                                        <div class="controls">
                                            <select name="product_color" id="product_color" class="span6 m-wrap required" required="required">
                                                <option value="">select color</option>
                                                <?php
                                                foreach ($product_colors as $key => $value)
                                                {
                                                    echo '<option value="' . $value['product_color'] . '">' . $value['product_color'] . '</option> ';
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <?php
                                }
                            ?>

                            <div class="control-group">
                                <label class="control-label">Update Stock By:<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="product_stock" required="required" value="<?php echo set_value("product_stock_count", $result["product_stock_count"]); ?>" type="text" class="span6 m-wrap"/>
                                    <span class="help-block">(Enter the number of pieces you want to add to the existing stock)</span>
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
                                $(document).ready(function() {
                                    $("#product_id").change(function() {
                                        var product_id = $(this).val();
                                        if (product_id !== "")
                                        {
                                            window.location.href = '<?php echo base_url_seller('products/updateStock'); ?>/' + product_id;
                                        }
                                    });

                                    $("#product_size").change(function() {
                                        var product_size = $(this).val();
                                        if (product_size !== "")
                                        {
                                            window.location.href = '<?php echo base_url_seller('products/updateStock'); ?>/' + $("#product_id").val() + '/' + product_size;
                                        }
                                    });
                                });
</script>