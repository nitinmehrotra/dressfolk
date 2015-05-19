<style>
    .profile-classic li:first-child{border-top: 1px solid #f5f5f5;}
    ul.unstyled li > span:first-child{min-width: 130px;display: table-cell;color: #666}
    ul.unstyled li > span{display: table-cell;color: #000}
</style>

<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->			
                <h3 class="page-title"><?php echo $page_title; ?></h3>
                <p><strong>Status: </strong><?php echo getSellerStatusText($record['seller_status']); ?></p>
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
                        <li class="active"><a href="#tab_1_1" data-toggle="tab">My Profile</a></li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane profile-classic row-fluid active" id="tab_1_1">
                            <div class='span12'>
                                <h3><?php echo $page_title; ?></h3>
                                <div class="span2 text-center">
                                    <p>Logo</p>
                                    <img src="<?php echo getImage($record['seller_logo_image']); ?>" alt="<?php echo $page_title; ?>" style="max-width: 100%;max-height: 100px;"/>
                                    <p><a href="#logoModal" role="button" data-toggle="modal" style="color: inherit;font-size: inherit;background: none;opacity: 1;position: static"><span class="icon-picture"></span>&nbsp;Change logo</a></p>
                                </div>
                                <div class="span9 text-center">
                                    <p>Cover Image</p>
                                    <img src="<?php echo getImage($record['seller_cover_image']); ?>" alt="<?php echo $page_title; ?>" style="max-width: 100%;max-height: 100px;"/>
                                    <p><a href="#coverModal" role="button" data-toggle="modal" style="color: inherit"><span class="icon-picture"></span>&nbsp;Change cover</a></p>
                                </div>
                            </div>

                            <div class='span12' style="margin-top: 20px">
                                <div class='span4'>
                                    <h3>Personal Details</h3>
                                    <ul class="unstyled">
                                        <li><span>Owner Name: </span><span><?php echo $record['seller_fullname']; ?></span></li>
                                        <li><span>Email: </span><span><?php echo $record['seller_email']; ?></span></li>
                                        <li><span>Mobile: </span><span><?php echo $record['seller_mobile']; ?></span></li>
                                        <li><span>Joined on: </span><span><?php echo date('d-M-Y h:i A', strtotime($record['seller_joined_date'])); ?></span></li>
                                        <li><span>Last updated on: </span><span><?php echo date('d-M-Y h:i A', strtotime($record['seller_timestamp'])); ?></span></li>
                                        <li><span>Store URL: </span><span><a href='#' target="_blank">Click here</a></span></li>
                                    </ul>
                                </div>
                                <div class='span4'>
                                    <h3>Company Details</h3>
                                    <ul class="unstyled">
                                        <li><span>Company Name: </span><span><?php echo empty($record['seller_company_name']) == TRUE ? 'NA' : stripslashes($record['seller_company_name']); ?></span></li>
                                        <li><span>Company Reg. No.: </span><span><?php echo empty($record['seller_company_regid']) == TRUE ? 'NA' : stripslashes($record['seller_company_regid']); ?></span></li>
                                        <li><span>Address: </span><span><?php echo str_replace('  ', ' ', stripslashes($record['seller_address_line1'] . ' ' . $record['seller_address_line2'] . ' ' . $record['seller_location'] . ' ' . $record['seller_postcode'])); ?></span></li>
                                    </ul>
                                </div>
                                <div class='span4'>
                                    <h3>Bank Details</h3>
                                    <ul class="unstyled">
                                        <li><span>Bank Name: </span><span><?php echo empty($record['sb_bank_name']) == TRUE ? 'NA' : stripslashes($record['sb_bank_name']); ?></span></li>
                                        <li><span>Account Holder: </span><span><?php echo empty($record['sb_account_holder']) == TRUE ? 'NA' : stripslashes($record['sb_account_holder']); ?></span></li>
                                        <li><span>Account Number: </span><span><?php echo empty($record['sb_account_number']) == TRUE ? 'NA' : stripslashes($record['sb_account_number']); ?></span></li>
                                        <li><span>IFS Code: </span><span><?php echo empty($record['sb_ifsc_code']) == TRUE ? 'NA' : stripslashes($record['sb_ifsc_code']); ?></span></li>
                                    </ul>
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

<!-- Cover Modal -->
<div id="coverModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Change cover</h3>
    </div>
    <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url_seller('changeCover'); ?>">
            <div class="control-group">
                <label class="control-label">Choose image</label>
                <div class="controls">
                    <input type="file" name="cover_img" required="required" data-required="1" class="span6 m-wrap"/>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn green">Upload</button>
    </div>
</div>

<!-- Logo Modal -->
<div id="logoModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Change logo</h3>
    </div>
    <div class="modal-body">
        <form method="post" enctype="multipart/form-data" action="<?php echo base_url_seller('changeLogo'); ?>">
            <div class="control-group">
                <label class="control-label">Choose image</label>
                <div class="controls">
                    <input type="file" name="logo_img" required="required" data-required="1" class="span6 m-wrap"/>
                </div>
            </div>
        </form>
    </div>
    <div class="modal-footer">
        <button class="btn green">Upload</button>
    </div>
</div>