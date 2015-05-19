<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">	
                <h3 class="page-title">Child Categories</h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-edit"></i>Child Categories</h4>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix">
                            <div class="btn-group">
                                <a href="<?php echo base_url_admin("categories/addChildCategory"); ?>"><button class="btn green">
                                        Add New <i class="icon-plus"></i>
                                    </button></a>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Child Category Name</th>
                                    <th>Parent Category Name</th>
                                    <th>Grand Category Name</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                    foreach ($alldata as $a_key => $a_value)
                                    {
                                        $cc_id = $a_value["cc_id"];
                                        $gc_name = $a_value["gc_name"];
                                        $pc_name = $a_value["pc_name"];
                                        $cc_name = $a_value["cc_name"];
                                        ?>
                                        <tr>
                                            <td class="center"><?php echo $cc_name; ?></td>
                                            <td class="center"><?php echo $pc_name; ?></td>
                                            <td class="center"><?php echo $gc_name; ?></td>
                                            <td class="center"><a href="<?php echo base_url_admin("categories/editChildCategory/" . $cc_id); ?>"><i class="icon-pencil"></i></a></td>
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