<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">	
                <h3 class="page-title"><?php echo $page_title; ?></h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-edit"></i><?php echo $page_title; ?></h4>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix">                            
                            <div class="btn-group">
                                <button class="btn dropdown-toggle" data-toggle="dropdown"><?php echo $page_title; ?> <i class="icon-angle-down"></i>
                                </button>
                                <ul class="dropdown-menu">
                                    <li><a href="<?php echo base_url_seller("orders/index/0"); ?>">New Orders</a></li>
                                    <li><a href="<?php echo base_url_seller("orders/index/1"); ?>">Dispatched Orders</a></li>
                                    <li><a href="<?php echo base_url_seller("orders/index/2"); ?>">Delivered Orders</a></li>
                                    <li><a href="<?php echo base_url_seller("orders/index/3"); ?>">Cancelled Orders</a></li>
                                    <li><a href="<?php echo base_url_seller("orders/index/4"); ?>">Returned Orders</a></li>
                                </ul>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Shipping Address</th>
                                    <th>Total Amount</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                    foreach ($alldata as $key => $value)
                                    {
                                        $order_id = stripslashes($value['sd_order_id']);
                                        $shipping_address = stripslashes(trim($value['sd_shipping_address'] . ' ' . $value['sd_shipping_location'] . ' ' . $value['sd_shipping_postcode']));
                                        $amount = DEFAULT_CURRENCY_SYMBOL . number_format($value['payment_amount'], 2);
                                        $order_status = getOrderStatusText($value['sod_order_status']);
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo base_url_seller('orders/orderDetail?id=' . $order_id); ?>" title="View Detail" target="_blank">#<?php echo $order_id; ?></a></td>                                                                                                                      
                                            <td><?php echo $value['sd_shipping_fullname']; ?></td>
                                            <td><?php echo $shipping_address; ?></td>
                                            <td><?php echo $amount; ?></td>
                                            <td><?php echo $order_status; ?></td>
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