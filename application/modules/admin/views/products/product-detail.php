<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->			
                <h3 class="page-title"><?php echo stripslashes($record['product_title']); ?></h3>
                <p><strong>Status: </strong><?php echo getProductStatusText($record['product_status']); ?></p>
                <p><strong>Change status to: </strong>
                    <?php
                        for ($i = 0; $i <= 4; $i++)
                        {
                            $url = base_url_admin('products/updateProductStatus/' . $record['product_id'] . '/' . $i);
                            $onclick_text = 'Are you sure to change status to ' . getProductStatusText($i);
                            echo '<a href="' . $url . '" style="margin-left:10px" onclick="return confirm(\'' . $onclick_text . '\');">' . getProductStatusText($i) . '</a>, ';
                        }
                    ?>
                </p>
                <div class="actions pull-right">
                    <a class="btn green mini" href="<?php echo goBack(); ?>">
                        <i class="icon-arrow-left"></i>
                        Back
                    </a>
                </div>
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
                            <div class="span12 clear">
                                <h3>Images</h3>
                                <?php
                                    if (!empty($record['images_arr']))
                                    {
                                        foreach ($record['images_arr'] as $imageKey => $imageValue)
                                        {
                                            $title = stripslashes($imageValue['pi_image_title']);
                                            $url = getImage($imageValue['pi_image_path']);
                                            ?>
                                            <div class="span2 text-center">
                                                <p><?php echo $title ?></p>
                                                <img src="<?php echo $url; ?>" alt="<?php echo $title; ?>" style="max-width: 100px;max-height: 100px"/>
                                            </div>
                                            <?php
                                        }
                                    }
                                    else
                                    {
                                        echo '<p>No images found</p>';
                                    }
                                ?>
                            </div>

                            <div class="margin-top-40 clear span12">
                                <h3>Product Basics</h3>
                                <ul class="unstyled span5">
                                    <li><span>Product Code</span><span>#<?php echo stripslashes($record['product_code']); ?></span></li>
                                    <li><span>Product Title</span><span><?php echo stripslashes($record['product_title']); ?></span></li>
                                    <li><span>Product Description</span><span><?php echo stripslashes($record['product_description']); ?></span></li>
                                    <li><span>View Product</span><span><a href="<?php echo getProductUrl($record['product_id']); ?>" target="_blank">Click here</a></span></li>
                                </ul>
                                <ul class="unstyled span5 offset1">
                                    <li><span>Seller</span><span><a href='<?php echo base_url_admin('sellers/sellerDetail/' . $record['seller_id']); ?>' target="_blank"><?php echo getSellerDisplayName($record['seller_fullname'], $record['seller_company_name']); ?></a></span></li>
                                    <li><span>Seller's Margin</span><span><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($record['product_seller_price'], 2); ?></span></li>
                                    <li><span>Selling Price</span><span><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($record['product_price'], 2); ?></span></li>
                                    <li><span>Profit Percent</span><span><?php echo number_format($record['product_profit_percent'], 2); ?>%</span></li>
                                    <li><span>Shipping Charge</span><span><?php echo $record['product_shipping_charge'] == 0 ? 'Free' : (DEFAULT_CURRENCY_SYMBOL . number_format($record['product_shipping_charge'], 2)); ?></span></li>
                                    <li><span>Gift Charge</span><span><?php echo $record['product_gift_charge'] == 0 ? 'Free' : (DEFAULT_CURRENCY_SYMBOL . number_format($record['product_shipping_charge'], 2)); ?></span></li>
                                </ul>
                            </div>

                            <div class="margin-top-40 clear span12">
                                <h3>Product Details</h3>
                                <div class='clear'>
                                    <?php
                                        if (!empty($record['details_arr']))
                                        {
                                            ?>
                                            <ul class="unstyled span12 clear">
                                                <li class="span2"><strong>Size</strong></li>
                                                <li class="span2"><strong>Color</strong></li>
                                                <li class="span2"><strong>Min. Quantity</strong></li>
                                                <li class="span2"><strong>Quantity</strong></li>
                                                <li class="span3"><strong>Status</strong></li>
                                            </ul>

                                            <?php
                                            foreach ($record['details_arr'] as $pkey => $pvalue)
                                            {
                                                ?>
                                                <ul class="unstyled clear">
                                                    <li class="span2"><?php echo $pvalue['pd_size']; ?></li>
                                                    <li class="span2"><?php echo $pvalue['pd_color_name']; ?></li>
                                                    <li class="span2"><?php echo $pvalue['pd_quantity']; ?></li>
                                                    <li class="span2"><?php echo $pvalue['pd_min_quantity']; ?></li>
                                                    <li class="span3">
                                                        <p class="pull-left"><?php echo getProductStatusText($pvalue['pd_status']); ?></p>
                                                        <p class="pull-right">
                                                            <?php
                                                            if ($pvalue['pd_status'] != 1)
                                                            {
                                                                ?>
                                                                <a href="<?php echo base_url_admin('products/updateProductDetailStatus/' . $pvalue['pd_id'] . '/1'); ?>" onclick="return confirm('Are you sure to approve?');"><span class='icon-check'></span></a>
                                                                <?php
                                                            }
                                                            if ($pvalue['pd_status'] != 0)
                                                            {
                                                                ?>
                                                                <a href="<?php echo base_url_admin('products/updateProductDetailStatus/' . $pvalue['pd_id'] . '/0'); ?>" onclick="return confirm('Are you sure to deactivate?');"><span class='icon-remove-circle'></span></a>
                                                                    <?php
                                                                }
                                                                ?>
                                                        </p>
                                                    </li>
                                                </ul>
                                                <?php
                                            }
                                        }
                                        else
                                        {
                                            echo '<p>No product details found</p>';
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--END TABS-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->
    </div>
    <!-- END PAGE CONTAINER-->	
</div>
<!-- END PAGE -->