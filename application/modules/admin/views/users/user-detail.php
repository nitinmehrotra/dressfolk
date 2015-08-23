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
                <h3 class="page-title"><?php echo $page_title;?></h3>
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
                            <div class="span2"><img src="<?php echo empty($record['user_facebook_id']) == TRUE ? NO_PRODUCT_IMG_PATH : (getFacebookUserImageSource($record['user_facebook_id'], NULL, USER_IMG_WIDTH)); ?>" alt="" style="max-width: 100%;"/></div>
                            <div class="span4">
                                <h3>Personal Details</h3>
                                <ul class="unstyled">
                                    <li><span>Status: </span><span><?php echo $record['user_status'] == '1' ? 'Active' : 'Deactivated'; ?></span></li>
                                    <li><span>Fullname: </span><span><?php echo ucwords($record['user_fullname']); ?></span></li>
                                    <li><span>Email: </span><span><a href="mailto:<?php echo ($record['user_email']); ?>"><?php echo ($record['user_email']); ?></a></span></li>
                                    <li><span>Contact: </span><span><?php echo ($record['user_contact']); ?></span></li>
                                    <li><span>Gender: </span><span><?php echo ucwords($record['user_gender']); ?></span></li>
                                    <li><span>Last modified: </span><span><?php echo date('d-M-Y h:i A', strtotime($record['user_timestamp'])); ?></span></li>
                                    <li><span>Joined on: </span><span><?php echo date('d-M-Y h:i A', strtotime($record['user_joined_date'])); ?></span></li>
                                    <!--<li><span>Added By: </span><span><?php echo $record['user_added_by']; ?></span></li>-->
                                </ul>
                            </div>

                            <div class="span4">
                                <h3>Facebook Account</h3>
                                <ul class="unstyled">
                                    <?php
                                        if (!empty($record['user_facebook_id']))
                                        {
                                            ?>
                                            <li><span>Profile: </span><span><a href="https://www.facebook.com/<?php echo $record['user_facebook_id']; ?>" target="_blank">Click here</a></span></li>
                                            <?php
                                        }
                                        else
                                        {
                                            echo '<li><span></span><p class="btn red">Not connected</p></li>';
                                        }
                                    ?>
                                </ul>
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