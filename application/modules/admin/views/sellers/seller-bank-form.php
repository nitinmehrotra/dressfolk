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
                                <label class="control-label">Bank Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="sb_bank_name" required="required" value="<?php echo set_value("sb_bank_name", $result["sb_bank_name"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Account Holder Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="sb_account_holder" required="required" value="<?php echo set_value("sb_account_holder", $result["sb_account_holder"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">Account Number<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="sb_account_number" required="required" value="<?php echo set_value("sb_account_number", $result["sb_account_number"]); ?>" type="text" class="span6 m-wrap"/>
                                </div>
                            </div>
                            <div class="control-group">
                                <label class="control-label">IFS Code<span class="required">*</span></label>
                                <div class="controls">
                                    <input name="sb_ifsc_code" required="required" value="<?php echo set_value("sb_ifsc_code", $result["sb_ifsc_code"]); ?>" type="text" class="span6 m-wrap"/>
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