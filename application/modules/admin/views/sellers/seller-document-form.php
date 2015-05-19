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
                        <form action="" method="post" class="form-horizontal" enctype="multipart/form-data">
                            <div class="control-group">
                                <label class="control-label">Document type<span class='required'>*</span></label>
                                <div class="controls">
                                    <select name='sdc_document_type[]' class='m-wrap span6'>
                                        <option value=''>Please select</option>
                                        <?php
                                            $seller_doc_type = json_decode(SELLER_DOC_TYPE_ARRAY);
                                            foreach ($seller_doc_type as $val)
                                            {
                                                echo '<option value="' . $val . '">' . ucwords($val) . '</option>';
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Additional comments</label>
                                <div class="controls">
                                    <textarea name='sdc_additional_comments[]' class='m-wrap span6' placeholder="Additonal comments (optional)"></textarea>
                                </div>
                            </div>

                            <div class="control-group">
                                <label class="control-label">Upload document<span class='required'>*</span></label>
                                <div class="controls">
                                    <input type="file" name="seller_doc[]" class="m-wrap span6" required="required"/>
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