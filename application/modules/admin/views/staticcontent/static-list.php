<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN PAGE TITLE & BREADCRUMB-->			
                <h3 class="page-title">
                    Static Pages		
                </h3>
                <!-- END PAGE TITLE & BREADCRUMB-->
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-edit"></i>Static Pages</h4>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix"></div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Page Title</th>
                                    <th class="hidden-phone hidden-tablet">Page Content</th>
                                    <th>Edit</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    foreach ($alldata as $key => $value)
                                    {
                                        $static_page_id = $value["static_page_id"];
                                        $static_page_title = $value["static_page_title"];
                                        $static_page_content = substr($value["static_page_content"], 0, 100) . "...";
                                        ?>
                                        <tr class="">
                                            <td><?php echo $static_page_title; ?></td>
                                            <td class="hidden-phone hidden-tablet"><?php echo $static_page_content; ?></td>
                                            <td><a class="" href="<?php echo base_url("admin/staticcontent/edit/$static_page_id"); ?>">Edit</a></td>
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