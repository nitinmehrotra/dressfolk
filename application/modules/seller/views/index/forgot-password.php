<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>Forgot Password | Seller's Panel | <?php echo SITE_NAME; ?></title>
        <meta name="robots" content="nofollow"/>
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta content="Seller's Panel" name="description" />
        <meta content="Seller's Panel" name="author" />
        <link href="<?php echo ADMIN_ASSETS_PATH ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
        <link href="<?php echo ADMIN_ASSETS_PATH ?>/css/metro.css" rel="stylesheet" />
        <link href="<?php echo ADMIN_ASSETS_PATH ?>/font-awesome/css/font-awesome.css" rel="stylesheet" />
        <link href="<?php echo ADMIN_ASSETS_PATH ?>/css/style.css" rel="stylesheet" />
        <link href="<?php echo ADMIN_ASSETS_PATH ?>/css/style_responsive.css" rel="stylesheet" />
        <link href="<?php echo ADMIN_ASSETS_PATH ?>/css/style_default.css" rel="stylesheet" id="style_color" />
        <link href="<?php echo ADMIN_ASSETS_PATH ?>/css/custom.css" rel="stylesheet" id="style_color" />
        <link rel="stylesheet" type="text/css" href="<?php echo ADMIN_ASSETS_PATH ?>/uniform/css/uniform.default.css" />
        <link rel="icon" href="<?php echo IMAGES_PATH ?>/favicon.ico" />
    </head>
    <!-- END HEAD -->


    <!-- BEGIN BODY -->
    <body class="login">

        <!-- BEGIN LOGO -->
        <div class="logo">
            <a class="brand" href="<?php echo base_url_seller('') ?>">
                <img src="<?PHP echo IMAGES_PATH; ?>/logo.png" alt="<?php echo SITE_NAME; ?>" width="100"/>
            </a>
        </div>
        <!-- END LOGO -->


        <!-- BEGIN LOGIN -->
        <div class="content">
            <?php
                if ($this->session->flashdata('error'))
                {
                    echo '<div class="login-error">' . $this->session->flashdata('error') . '</div>';
                }
            ?>
            <!-- BEGIN LOGIN FORM -->
            <form class="form-vertical login-form" action=""  method="post"  >
                <h3 class="form-title">Forgot Password</h3>
                <div class="control-group">
                    <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                    <label class="control-label visible-ie8 visible-ie9">Email</label>
                    <div class="controls">
                        <div class="input-icon left">
                            <i class="icon-user"></i>
                            <input id="input-username" class="m-wrap placeholder-no-fix" type="email" required placeholder="Email" value="" name="seller_email">
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <button type="submit" class="btn green pull-right">
                        Submit <i class="m-icon-swapright m-icon-white"></i>
                    </button>            
                </div>
                <div class="control-group">
                    <div class="controls text-center">
                        <a href='<?php echo base_url_seller();?>'>Login</a>
                    </div>
                </div>

            </form>
            <!-- END LOGIN FORM -->        


        </div>
        <!-- END LOGIN -->
        <!-- BEGIN COPYRIGHT -->
        <div class="copyright">
            <?php echo date("Y"); ?> &copy; <?php echo SITE_NAME; ?>.
        </div>
        <!-- END COPYRIGHT -->
        <!-- BEGIN JAVASCRIPTS -->
        <script src="<?PHP echo ADMIN_ASSETS_PATH ?>/js/jquery-1.8.3.min.js"></script>
        <script src="<?PHP echo ADMIN_ASSETS_PATH ?>/bootstrap/js/bootstrap.min.js"></script>  
        <script src="<?PHP echo ADMIN_ASSETS_PATH ?>/jquery-validation/dist/jquery.validate.min.js" type="text/javascript" ></script>
        <script src="<?PHP echo ADMIN_ASSETS_PATH ?>/js/app.js"></script>
        <script>
            jQuery(document).ready(function() {
                App.initLogin('Login');
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>