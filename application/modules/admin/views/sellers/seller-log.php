<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">	
                <h3 class="page-title">Seller Log</h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-edit"></i>Seller Log</h4>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix"></div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Login Time</th>
                                    <th>Logout Time</th>
                                    <th>IP Address</th>
                                    <th class="hidden-phone hidden-tablet">User Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                    foreach ($alldata as $a_key => $a_value)
                                    {
                                        $seller_id = $a_value["seller_id"];
                                        $full_name = ucwords($a_value["seller_fullname"]);
                                        $login_time = date("d-M-y h:i A", strtotime($a_value["sl_login_time"]));
                                        $logout_time = empty($a_value["logout_time"]) == TRUE ? 'NA' : (date("d-M-y h:i A", strtotime($a_value["sl_logout_time"])));
                                        $ip_address = $a_value["sl_ipaddress"];
                                        $seller_agent = $a_value["sl_useragent"];
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo base_url_admin("users/userDetail/" . $seller_id); ?>" title="View Detail"><?php echo $full_name; ?></a></td>
                                            <td><?php echo $login_time; ?></td>
                                            <td><?php echo $logout_time; ?></td>
                                            <td><?php echo $ip_address; ?></td>
                                            <td class="hidden-phone hidden-tablet"><?php echo getClientOS($seller_agent) . ' - ' . getClientBrowserName($seller_agent); ?></td>
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