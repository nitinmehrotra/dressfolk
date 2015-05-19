<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->			
                <h3 class="page-title">
                    Order Detail
                </h3>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid profile">
            <div class="span12">
                <!--BEGIN TABS-->
                <div class="tabbable tabbable-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#tab_1_1" data-toggle="tab">Overview</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane profile-classic row-fluid active" id="tab_1_1">
                            <?php
                                $productImages = getProductImages($record["product_image_and_color"]);
                                foreach ($productImages as $key => $value)
                                {
                                    $product_image_name = $productImages[$key]['url'];
                                    ?>
                                    <div class="span2">
                                        <img src="<?php echo $product_image_name; ?>" alt="" />
                                    </div>
                                    <?php
                                }
                            ?>
                            <ul class="unstyled span10">
                                <?php
                                    $exclude_array = array();
//                                    prd($record);
                                    foreach ($record as $key => $value)
                                    {
                                        if (!in_array($key, $exclude_array))
                                        {
                                            echo '<li><span>' . ucwords(str_replace("_", " ", $key)) . ':</span> ' . $value . '</li>';
                                        }
                                    }
                                ?>
                            </ul>
                        </div>
                    </div>

                    <form id="change-package-status-form validate-form" action="<?php echo base_url('admin/orders/changeStatus'); ?>" method="get">
                        <input type="hidden" name="payment_id" value="<?php echo $record['payment_id']; ?>"/>
                        <!--<input type="hidden" name="next" value="<?php echo current_url(); ?>"/>-->
                        <div class="control-group">
                            <label class="control-label">Package Status<span class="required">*</span></label>
                            <div class="controls">
                                <select name="package_status" class="span6 m-wrap required" required="required">
                                    <option value="">Select</option>
                                    <option value="processing">Processing</option>
                                    <option value="dispatched">Dispatched</option>
                                    <option value="delivered">Delivered</option>
                                    <option value="cancelled">Cancelled</option>
                                    <option value="returned">Returned</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-actions submit-bttn">
                            <button type="submit" class="btn green">Submit</button>
                        </div>
                    </form>
                </div>
                <!--END TABS-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->	
</div>
<!-- END PAGE -->