
</div>
<!-- END CONTAINER -->

<!-- BEGIN FOOTER -->
<div class="footer">
    <?php echo date("Y") . " &copy; " . SITE_NAME; ?>
    <div class="span pull-right">
        <span class="go-top"><i class="icon-angle-up"></i></span>
    </div>
</div>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS -->
<!-- Load javascripts at bottom, this will reduce page load time -->
<script src="<?php echo ADMIN_ASSETS_PATH; ?>/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script src="<?php echo ADMIN_ASSETS_PATH; ?>/ckeditor/ckeditor.js"></script>	
<script src="<?php echo ADMIN_ASSETS_PATH; ?>/breakpoints/breakpoints.js"></script>	
<script src="<?php echo ADMIN_ASSETS_PATH; ?>/bootstrap/js/bootstrap.min.js"></script>		
<script src="<?php echo ADMIN_ASSETS_PATH; ?>/js/jquery.blockui.js"></script>
<script src="<?php echo ADMIN_ASSETS_PATH; ?>/js/jquery.cookie.js"></script>
<!-- ie8 fixes -->
<!--[if lt IE 9]>
<script src="<?php echo ADMIN_ASSETS_PATH; ?>/js/excanvas.js"></script>
<script src="<?php echo ADMIN_ASSETS_PATH; ?>/js/respond.js"></script>
<![endif]-->	
<script type="text/javascript" src="<?php echo ADMIN_ASSETS_PATH; ?>/uniform/jquery.uniform.min.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_ASSETS_PATH; ?>/data-tables/jquery.dataTables.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_ASSETS_PATH; ?>/data-tables/DT_bootstrap.js"></script>
<script type="text/javascript" src="<?php echo ADMIN_ASSETS_PATH; ?>/bootstrap-fileupload/bootstrap-fileupload.js"></script>

<script src="<?php echo ADMIN_ASSETS_PATH; ?>/js/app.js"></script>		
<script>
    jQuery(document).ready(function () {
        // initiate layout and plugins
        App.setPage("table_editable");
        App.init();
        App.initUniform('.fileupload-toggle-checkbox'); // initialize uniform checkboxes

        jQuery(".datepicker").datepicker({format: 'yyyy-mm-dd'});
    });
</script>

<script type="text/javascript" src="http://maps.googleapis.com/maps/api/js?libraries=places&sensor=false"></script>
<script>
    var num_of_inputs = jQuery(".gMapLocation").length;
    var i;
    var loop = num_of_inputs - 1;
    for (i = "0"; i <= loop; i++)
    {
        var input = jQuery(".gMapLocation")[i];
        var autocomplete = new google.maps.places.Autocomplete(input);
    }

    $(document).ready(function () {
        setTimeout(function () {
            $('.login-success').slideUp();
            $('.login-error').slideUp();
        }, 3000);
    });
</script>
</body>
<!-- END BODY -->
</html>
