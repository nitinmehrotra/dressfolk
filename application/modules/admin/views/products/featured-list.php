<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">	
                <h3 class="page-title">Featured Products</h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-edit"></i>Featured Products</h4>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix">
                            <div class="btn-group">
                                <a href="<?php echo base_url("admin/products/addFeaturedProduct"); ?>"><button class="btn green">
                                        Add New <i class="icon-plus"></i>
                                    </button></a>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Selling Price</th>
                                    <th>Start Date</th>
                                    <th>Expiry Date</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                    foreach ($alldata as $a_key => $a_value)
                                    {
                                        $feature_id = $a_value["feature_id"];
                                        $product_id = $a_value["product_id"];
                                        $product_title = $a_value["product_title"];
                                        $product_code = $a_value["product_code"];
                                        $product_cost_price = $a_value["product_price"];
                                        $a_value["start_time"] = empty($a_value["start_time"]) == TRUE ? 'NA' : (date('d-M-Y h:i A', strtotime($a_value["start_time"])));
                                        $a_value["end_time"] = empty($a_value["end_time"]) == TRUE ? 'NA' : (date('d-M-Y h:i A', strtotime($a_value["end_time"])));
                                        $feature_status = $a_value["feature_status"] == '1' ? 'Active' : 'Deactivated';
                                        ?>
                                        <tr>
                                            <td><p><?php echo $product_title; ?> (<strong><?php echo $product_code;?></strong>)</p></td>
                                            <td><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($product_cost_price, 2); ?></td>
                                            <td><?php echo $a_value["start_time"]; ?></td>
                                            <td><?php echo $a_value["end_time"] ?></td>
                                            <td class="center"><?php echo $feature_status; ?></td>
                                            <td class="center">
                                                <a href="<?php echo base_url("admin/products/editFeaturedProduct/" . $feature_id); ?>"><i class="icon-pencil"></i>&nbsp;Edit</a><br/>
                                                <a href="<?php echo base_url("admin/products/removeFeatured/" . $feature_id); ?>" onclick="return confirm('Are you sure to remove <?php echo $product_title; ?> from featured ?');"><i class="icon-remove"></i>&nbsp;Remove</a><br/>
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