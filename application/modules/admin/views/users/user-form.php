<?php
    $result = array();
    if (isset($record))
    {
        foreach ($record as $key => $value)
        {
            $result[$key] = $value;
        }
    }
    else
    {
        $result["user_id"] = "";
        $result["first_name"] = "";
        $result["last_name"] = "";
        $result["user_email"] = "";
        $result["user_address"] = "";
        $result["user_location"] = "";
        $result["user_contact"] = "";
        $result["user_dob"] = "";
        $result["user_status"] = "";
        $result["user_postcode"] = "";
    }

    if (!isset($form_action))
        $form_action = "";
?>

<!-- BEGIN PAGE -->  
<div class="page-content">
    <!-- BEGIN SAMPLE PORTLET CONFIGURATION MODAL FORM-->
    <!-- BEGIN PAGE CONTAINER-->
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->   
        <div class="row-fluid">
            <div class="span12">  
                <h3 class="page-title">
                    <?php echo $form_heading; ?>
                </h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-reorder"></i><?php echo $form_heading; ?></h4>
                        <div class="actions">
                            <a class="btn green mini" href="<?php echo goBack(); ?>">
                                <i class="icon-arrow-left"></i>
                                Back
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <form action="<?php echo $form_action; ?>" method="post" class="form-horizontal">
                            <input type="hidden" name="user_id" value="<?php echo set_value("user_id", $result["user_id"]); ?>"/>
                            <div class="control-group">
                                <label class="control-label">First Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="first_name" required="required" value="<?php echo set_value("first_name", $result["first_name"]); ?>" data-required="1" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Last Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="last_name" required="required" value="<?php echo set_value("last_name", $result["last_name"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email Address<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="user_email" required="required" value="<?php echo set_value("user_email", $result["user_email"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Password</label>
                                <div class="controls">
                                    <input name="user_password" value="<?php echo set_value("user_password"); ?>" type="password" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Contact Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="user_contact" required="required" maxlength="15" value="<?php echo set_value("user_contact", $result["user_contact"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address<span class="required">*</span></label>
                                <div class="controls">
                                    <textarea name="user_address" required="required" rows="3" class="span6 m-wrap"><?php echo set_value("user_address", $result["user_address"]); ?></textarea>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Location<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="user_location" required="required" value="<?php echo set_value("user_location", $result["user_location"]); ?>" type="text" class="span6 m-wrap gMapLocation"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Postcode<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="user_postcode" required="required" value="<?php echo set_value("user_postcode", $result["user_postcode"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Date of Birth<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="user_dob" required="required" value="<?php echo set_value("user_dob", $result["user_dob"]); ?>" type="text" class="span6 m-wrap datepicker"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">User Status<span class="required">*</span></label>
                                <div class="controls">
                                    <select name="user_status" class="span6 m-wrap" required="required">
                                        <option value="1" <?php echo set_select("user_status", "1", $result["user_status"] == "1") ?>>Active</option>
                                        <option value="0" <?php echo set_select("user_status", "0", $result["user_status"] == "0") ?>>Deactive</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-actions">
                                <button type="submit" class="btn green">Submit</button>
                            </div>
                        </form>
                        <!-- END FORM-->
                    </div>
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
        <!-- END PAGE CONTENT-->         
    </div>
    <!-- END PAGE CONTAINER-->
</div>
<!-- END PAGE -->  