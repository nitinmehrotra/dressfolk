<?php
    $result = array();

    if ($this->session->flashdata('post'))
    {
        $record = $this->session->flashdata('post');
    }

    if (isset($record))
    {
        foreach ($record as $key => $value)
        {
            $result[$key] = $value;
        }
    }
    else
    {
        $result["seller_id"] = "";
        $result["seller_fullname"] = "";
        $result["seller_company_name"] = "";
        $result["seller_company_regid"] = "";
        $result["seller_email"] = "";
        $result["seller_address_line1"] = "";
        $result["seller_address_line2"] = "";
        $result["seller_location"] = "";
        $result["seller_mobile"] = "";
        $result["seller_postcode"] = "";
        $result["seller_internal_comments"] = "";
        $result["sb_bank_name"] = "";
        $result["sb_account_holder"] = "";
        $result["sb_account_number"] = "";
        $result["sb_ifsc_code"] = "";
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
                            <div class="control-group">
                                <label class="control-label">Owner Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="seller_fullname" required="required" value="<?php echo set_value("seller_fullname", $result["seller_fullname"]); ?>" data-required="1" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Company Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="seller_company_name" required="required" value="<?php echo set_value("seller_company_name", $result["seller_company_name"]); ?>" data-required="1" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Company Reg. Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="seller_company_regid" required="required" value="<?php echo set_value("seller_company_regid", $result["seller_company_regid"]); ?>" data-required="1" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Email Address<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="seller_email" required="required" value="<?php echo set_value("seller_email", $result["seller_email"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Mobile Number<span class="required">*</span></label>
                                <div class="controls">
                                    <div class="input-prepend">
                                        <span class="add-on">+91</span>
                                        <input name="seller_mobile" required="required" maxlength="10" value="<?php echo set_value("seller_mobile", $result["seller_mobile"]); ?>" type="text" class="m-wrap"/>
                                    </div>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address Line 1<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="seller_address_line1" required="required" value="<?php echo set_value("seller_address_line1", $result["seller_address_line1"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Address Line 2</label>
                                <div class="controls">
                                    <input name="seller_address_line1" value="<?php echo set_value("seller_address_line1", $result["seller_address_line1"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Location<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="seller_location" required="required" value="<?php echo set_value("seller_location", $result["seller_location"]); ?>" type="text" class="span6 m-wrap gMapLocation"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Postcode<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="seller_postcode" required="required" value="<?php echo set_value("seller_postcode", $result["seller_postcode"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Internal Comments</label>
                                <div class="controls">
                                    <textarea name="seller_internal_comments" value="<?php echo set_value("seller_internal_comments", $result["seller_internal_comments"]); ?>" class="span6 m-wrap"></textarea>
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