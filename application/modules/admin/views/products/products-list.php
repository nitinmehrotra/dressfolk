<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">	
                <h3 class="page-title">Products</h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-list"></i>Products</h4>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix">
<!--                            <div class="btn-group">
                                <a href="<?php echo base_url("admin/products/addProduct"); ?>"><button class="btn green">
                                        Add New <i class="icon-plus"></i>
                                    </button></a>
                            </div>-->
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Category</th>
                                    <th>Seller's Margin</th>
                                    <th>Selling Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                    foreach ($alldata as $a_key => $a_value)
                                    {
                                        $product_id = $a_value["product_id"];
                                        $product_title = $a_value["product_title"];
                                        $product_code = $a_value["product_code"];
                                        $product_seller_price = $a_value["product_seller_price"];
                                        $product_cost_price = $a_value["product_price"];
                                        $product_status = getProductStatusText($a_value["product_status"]);

                                        $category = '<a href="' . base_url_admin('products/category?pc=' . urlencode($a_value["pc_name"])) . '">' . $a_value["pc_name"] . '</a> -> <a href="' . base_url_admin('products/category?cc=' . urlencode($a_value["cc_name"])) . '">' . $a_value["cc_name"] . '</a>';
                                        ?>
                                        <tr>
                                            <td>
                                                <p><?php echo $product_title; ?> (<strong><?php echo $product_code; ?></strong>)</p>
                                            </td>
                                            <td><?php echo $category; ?></td>
                                            <td><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($product_seller_price, 2); ?></td>
                                            <td><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($product_cost_price, 2); ?></td>
                                            <td class="center"><?php echo $product_status; ?></td>
                                            <td class="center">
                                                <a href="<?php echo base_url("admin/products/productDetail/" . $product_id); ?>" title="View Detail"><i class="icon-search"></i>&nbsp;Details</a><br/>
                                                <a href="<?php echo base_url("admin/products/editProduct/" . $product_id); ?>"><i class="icon-pencil"></i>&nbsp;Edit</a><br/>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->