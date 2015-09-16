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
    $result["pc_id"] = "";
    $result["pc_name"] = "";
}

if (!isset($form_action))
    $form_action = "";

?>

<!-- BEGIN PAGE -->  
<div class="page-content">
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
                        <form action="<?php echo $form_action; ?>" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <input type="hidden" name="pc_id" value="<?php echo set_value("pc_id", $result["pc_id"]); ?>"/>

                            <div class="control-group">
                                <label class="control-label">Parent Category Name<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="text" name="pc_name" required="required" value="<?php echo set_value("pc_name", $result["pc_name"]); ?>" data-required="1" class="span6 m-wrap"/>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Image<span class="required">*</span></label>
                                <div class="controls">
                                    <input type="file" name="pc_img" class="span6 m-wrap"/>
                                </div>
                            </div>

                            <div class="form-actions submit-bttn">
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