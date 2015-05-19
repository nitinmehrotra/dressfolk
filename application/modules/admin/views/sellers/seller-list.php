<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">	
                <h3 class="page-title">Users</h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-edit"></i>Sellers</h4>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix">
                            <div class="btn-group">
                                <a href="<?php echo base_url_admin("sellers/addSeller"); ?>"><button class="btn green">
                                        Add New <i class="icon-plus"></i>
                                    </button></a>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Full Name</th>
                                    <th>Email</th>
                                    <th>Contact</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                    foreach ($alldata as $a_key => $a_value)
                                    {
                                        $seller_id = $a_value["seller_id"];
                                        $full_name = ucwords($a_value["seller_fullname"]);
                                        $seller_email = $a_value["seller_email"];
                                        $seller_mobile = $a_value["seller_mobile"];
                                        $seller_status = getSellerStatusText($a_value["seller_status"]);
                                        ?>
                                        <tr>
                                            <td><?php echo $full_name; ?></td>
                                            <td><?php echo $seller_email; ?></td>
                                            <td><?php echo $seller_mobile; ?></td>
                                            <td class="center"><?php echo $seller_status; ?></td>
                                            <td class="center">
                                                <a href="<?php echo base_url_admin("sellers/sellerDetail/" . $seller_id); ?>" title="View Detail"><i class="icon-search"></i>&nbsp;Details</a><br/>
                                                <a href="<?php echo base_url_admin("sellers/editUser/" . $seller_id); ?>"><i class="icon-pencil"></i>&nbsp;Edit</a><br/>
                                                <?php
                                                if ($a_value["seller_status"] == '1')
                                                {
                                                    ?>
                                                    <a href="<?php echo base_url_admin("sellers/deactivateUser/" . $seller_id); ?>" onclick="return confirm('Are you sure to deactivate <?php echo $full_name; ?> ?');"><i class="icon-warning-sign"></i>&nbsp;Deactivate</a><br/>
                                                    <?php
                                                }
                                                else
                                                {
                                                    ?>   
                                                        <a href="<?php echo base_url_admin("sellers/activateUser/" . $seller_id); ?>" onclick="return confirm('Are you sure to activate <?php echo $full_name; ?> ?');"><i class="icon-check"></i>&nbsp;Activate</a><br/>                                    
                                                        <?php
                                                    }
                                                    ?>
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