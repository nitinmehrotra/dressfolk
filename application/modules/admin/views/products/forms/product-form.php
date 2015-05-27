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
    $result["product_description"] = "";
    $result["product_seller_price"] = "";
    $result["product_shipping_charge"] = "";
    $result["product_gift_charge"] = "25";
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
                            <input type="hidden" name="product_id" value="<?php echo set_value("product_id", $result["product_id"]); ?>"/>
                            <div class="control-group">
                                <label class="control-label">Product Title<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="product_title" required="required" value="<?php echo set_value("product_title", $result["product_title"]); ?>" data-required="1" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Product Description<span class="required">*</span></label>
                                <div class="controls">
                                    <textarea name="product_description" required="required" minlength='400' rows="3" class="span6 m-wrap required"><?php echo set_value("product_description", $result["product_description"]); ?></textarea>
                                    <div class="help-block">(minimum <?php echo PRODUCT_DESC_MIN_LENGTH; ?> characters)</div>
                                </div>
                            </div>

                            <?php
                            if (!empty($product_parent_category))
                            {
                                echo '<div class="control-group">
                                                    <label class="control-label">Category<span class="required">*</span></label>
                                                    <div class="controls">
                                                        <select name="product_parent_category" class="span6 m-wrap" id="pc_id">
                                                            <option>select</option>';

                                foreach ($product_parent_category as $pcKey => $pcValue)
                                {
                                    $pc_id = $pcValue["pc_id"];
                                    $pc_name = $pcValue["pc_name"];

                                    $selected = "";
                                    if ($result["product_parent_category"] == $pc_id)
                                    {
                                        $selected = "selected='selected'";
                                    }

                                    echo '<option value="' . $pc_id . '" ' . $selected . '>' . $pc_name . '</option>';
                                }

                                echo '</select></div></div>';
                            }
                            ?>                         

                            <span id="cc_select_box">
                                <?php
                                if (!empty($result["product_child_category"]))
                                {
                                    echo '<div class="control-group">
                                                    <label class="control-label">Sub-Category<span class="required">*</span></label>
                                                    <div class="controls">
                                                        <select name="product_child_category" class="span6 m-wrap" id="pc_id">';

                                    if (!empty($child_cat_array))
                                    {
                                        echo '<option>select</option>';
                                        foreach ($child_cat_array as $ccKey => $ccValue)
                                        {
                                            $cc_id = $ccValue["cc_id"];
                                            $cc_name = $ccValue["cc_name"];

                                            $selected = "";
                                            if ($result["product_child_category"] == $cc_id)
                                                $selected = "selected='selected'";

                                            echo '<option value="' . $cc_id . '" ' . $selected . '>' . $cc_name . '</option>';
                                        }
                                    }
                                    else
                                    {
                                        echo '<option>No data</option>';
                                    }

                                    echo '</select>
                                                </div>
                                            </div>';
                                }
                                ?>
                            </span>
                            <div class="control-group">
                                <label class="control-label">Your Price<span class="required">*</span></label>
                                <div class="controls">
                                    <div class='input-prepend'>
                                        <span class='add-on'><?php echo DEFAULT_CURRENCY_SYMBOL; ?></span>
                                        <input name="product_seller_price" id="product_seller_price" required="required" maxlength="10" value="<?php echo set_value("product_seller_price", $result["product_seller_price"]); ?>" type="text" class=" m-wrap"/>
                                    </div>
                                    <div class="help-block">(Your selling price)</div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Shipping Charge<span class="required">*</span></label>
                                <div class="controls">
                                    <div class='input-prepend'>
                                        <span class='add-on'><?php echo DEFAULT_CURRENCY_SYMBOL; ?></span>
                                        <input name="product_shipping_charge" id="product_shipping_charge" required="required" maxlength="5" value="<?php echo set_value("product_shipping_charge", $result["product_shipping_charge"]); ?>" type="text" class=" m-wrap"/>
                                    </div>
                                    <div class="help-block">(Customer will have to pay)</div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Gift-wrap Charge<span class="required">*</span></label>
                                <div class="controls">
                                    <div class='input-prepend'>
                                        <span class='add-on'><?php echo DEFAULT_CURRENCY_SYMBOL; ?></span>
                                        <input name="product_gift_charge" id="product_gift_charge" required="required" readonly="true" maxlength="5" value="<?php echo set_value("product_gift_charge", $result["product_gift_charge"]); ?>" type="text" class=" m-wrap"/>
                                    </div>
                                    <div class="help-block">(Customer will have to pay)</div>
                                </div>
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
        $("#pc_id").live("change", function () {
            $("#cc_select_box").html("Loading...");
            var pc_id = $(this).val();
            if (pc_id !== "")
            {
                $.ajax({
                    url: "<?php echo base_url_admin("products/getChildCategoriesAjax"); ?>" + "/" + pc_id,
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