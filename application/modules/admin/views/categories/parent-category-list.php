<!-- BEGIN PAGE -->
<div class="page-content">
    <!-- BEGIN PAGE CONTAINER-->			
    <div class="container-fluid">
        <!-- BEGIN PAGE HEADER-->
        <div class="row-fluid">
            <div class="span12">	
                <h3 class="page-title">Parent Categories</h3>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row-fluid">
            <div class="span12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <h4><i class="icon-edit"></i>Parent Categories</h4>
                    </div>
                    <div class="portlet-body">
                        <div class="clearfix">
                            <div class="btn-group">
                                <a href="<?php echo base_url_admin("categories/addParentCategory"); ?>"><button class="btn green">
                                        Add New <i class="icon-plus"></i>
                                    </button></a>
                            </div>
                        </div>
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Image</th>
                                    <th>Parent Category Name</th>
                                    <th>Edit</th>
                                    <th>Homepage</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
//                                    prd($alldata);
                                foreach ($alldata as $a_key => $a_value)
                                {
                                    $pc_id = $a_value["pc_id"];
                                    $pc_name = $a_value["pc_name"];
                                    $image = getImage($a_value['pc_image']);
                                    ?>
                                    <tr>
                                        <td class="center"><img src="<?php echo $image; ?>" alt="image" style="width: 200px"/></td>
                                        <td class="center"><?php echo $pc_name; ?></td>
                                        <td class="center"><a href="<?php echo base_url_admin("categories/editParentCategory/" . $pc_id); ?>"><i class="icon-pencil"></i></a></td>
                                        <td class="center"><a href="<?php echo base_url_admin('categories/changeHomepageDisplayStatus/'.$pc_id.'/'. ($a_value['pc_display'] == '1' ? '0' : '1'));?>" onclick="return confirm('Sure to change status?')" class="btn <?php echo $a_value['pc_display'] == '1' ? 'green' : 'yellow' ?>"><?php echo $a_value['pc_display'] == '1' ? 'Displaying' : 'Not displaying' ?></a></td>
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