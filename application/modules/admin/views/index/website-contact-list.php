<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">	
                <h3 class="page-title">Website Contact</h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-edit"></i>Website Contact</h4>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix">
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Subject</th>
                                    <th>Request ID</th>
                                    <th>Status</th>
                                    <th>Reply</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                    foreach ($alldata as $a_key => $a_value)
                                    {
                                        $wc_id = $a_value["wc_id"];
                                        $wc_fullname = $a_value["wc_fullname"];
                                        $user_email = $a_value["wc_email"];
                                        $user_contact = $a_value["wc_contact"];
                                        $wc_subject = $a_value["wc_subject"];
                                        $wc_request_id = $a_value["wc_request_id"];
                                        $wc_processed = getWebsiteContactStatusText($a_value["wc_processed"]);
                                        ?>
                                        <tr>
                                            <td><?php echo $wc_fullname; ?></td>
                                            <td><?php echo $user_email; ?></td>
                                            <td><?php echo $user_contact; ?></td>
                                            <td><?php echo $wc_subject; ?></td>
                                            <td><?php echo $wc_request_id; ?></td>
                                            <td class="center"><?php echo $wc_processed; ?></td>
                                            <td class="center"><a href="<?php echo base_url_admin("websiteContact/" . $wc_id); ?>"><i class="icon-pencil"></i></a></td>
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