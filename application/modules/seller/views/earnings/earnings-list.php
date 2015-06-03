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
                        <div class="row-fluid">
                            <div class="span12">
                                <form class="form-inline">
                                    <div class="control-group">
                                        <div class="controls">
                                            <input type="text" name="from" required="required" value="<?php echo $date_range['from']; ?>" data-required="1" class=" m-wrap datepicker" placeholder="From"/> -> 
                                            <input type="text" name="to" required="required" value="<?php echo $date_range['to']; ?>" data-required="1" class=" m-wrap datepicker" placeholder="To"/>
                                            <button type="submit" class="btn green">Submit</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="clearfix"> 
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Customer</th>
                                    <th>Shipping Address</th>
                                    <th>Total Amount</th>
                                    <th>Sold On</th>
                                    <th>Payment settled?</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                    $total_earning = 0;
                                    foreach ($alldata as $key => $value)
                                    {
                                        $order_id = stripslashes($value['sd_order_id']);
                                        $shipping_address = stripslashes(trim($value['sd_shipping_address'] . ' ' . $value['sd_shipping_location'] . ' ' . $value['sd_shipping_postcode']));
                                        $amount = DEFAULT_CURRENCY_SYMBOL . number_format($value['payment_amount'], 2);
                                        $order_status = $value['sod_paid_to_seller'] == '0' ? 'Pending' : 'Paid';
                                        if ($value['sod_paid_to_seller'] == '0')
                                        {
                                            $total_earning = $total_earning + $value['sd_seller_earning'];
                                        }
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo base_url_seller('orders/orderDetail?id=' . $order_id); ?>" title="View Detail" target="_blank">#<?php echo $order_id; ?></a></td>                                                                                                                      
                                            <td><?php echo $value['sd_shipping_fullname']; ?></td>
                                            <td><?php echo $shipping_address; ?></td>
                                            <td><?php echo $amount; ?></td>
                                            <td><?php echo date('d-M-Y',  strtotime($value['sod_timestamp'])); ?></td>
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
            <div>
                <p><strong>Total (unsettled amount): </strong><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($total_earning, 2); ?></p>
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->