<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">	
                <h3 class="page-title">User Log</h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-edit"></i>User Log</h4>
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
                                    <th>Login Via</th>
                                    <th class="hidden-phone hidden-tablet">User Agent</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                    foreach ($alldata as $a_key => $a_value)
                                    {
                                        $user_id = $a_value["user_id"];
                                        $full_name = ucwords($a_value["user_fullname"]);
                                        $login_time = date("d-M-y h:i A", strtotime($a_value["ul_login_time"]));
                                        $logout_time = empty($a_value["logout_time"]) == TRUE ? 'NA' : (date("d-M-y h:i A", strtotime($a_value["ul_logout_time"])));
                                        $ip_address = $a_value["ul_ipaddress"];
                                        $user_agent = $a_value["ul_useragent"];
                                        $login_via = ucwords($a_value["ul_login_via"]);
                                        ?>
                                        <tr>
                                            <td><a href="<?php echo base_url_admin("users/userDetail/" . $user_id); ?>" title="View Detail"><?php echo $full_name; ?></a></td>
                                            <td><?php echo $login_time; ?></td>
                                            <td><?php echo $logout_time; ?></td>
                                            <td><?php echo $ip_address; ?></td>
                                            <td><?php echo $login_via; ?></td>
                                            <td class="hidden-phone hidden-tablet"><?php echo getClientOS($user_agent) . ' - ' . getClientBrowserName($user_agent); ?></td>
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