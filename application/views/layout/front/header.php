<?php
    if (!isset($meta_title))
        $meta_title = SITE_TITLE;

    if (!isset($meta_keywords))
        $meta_keywords = SEO_KEYWORDS;

    if (!isset($meta_description))
        $meta_description = SEO_DESCRIPTION;

    if (!isset($meta_logo_image))
        $meta_logo_image = IMAGES_PATH . "/logo.png";

    clearstatcache();
    $this->output->set_header('Expires: Tue, 01 Jan 2000 00:00:00 GMT');
    $this->output->set_header('Last-Modified:' . gmdate('D, d M Y H:i:s') . 'GMT');
    $this->output->set_header('Cache-Control: no-store, no-cache, must-revalidate');
    $this->output->set_header('Cache-Control: post-check=0, pre-check=0', false);
    $this->output->set_header('Pragma: no-cache');
//    prd($meta_logo_image);
?> 

<!DOCTYPE html>
<!--[if lt IE 8]>      <html class="no-js lt-ie10 lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie10 lt-ie9"> <![endif]-->
<!--[if IE 9]>         <html class="no-js lt-ie10"> <![endif]-->
<!--[if IE]><meta http-equiv=”X-UA-Compatible” content=”IE=9″><![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
    <head>
        <title><?php echo $meta_title; ?></title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
        <meta name="description" content="<?php echo $meta_description ?>"/>
        <meta name="author" content="<?php echo SITE_NAME; ?>"/>
        <meta name="robots" content="index,follow"/>
        <meta name="robots" content="robots.txt"/>
        <meta property="og:url" content="<?php echo current_url(); ?>"/>
        <meta property="og:type" content="website"/>
        <meta property="og:title" content="<?php echo $meta_title; ?>"/>
        <meta property="og:description" content="<?php echo $meta_description; ?>"/>
        <meta property="og:image" content="<?php echo $meta_logo_image; ?>"/>
        <meta name="geo.region" content="India" />
        <meta property="og:locale" content="en_US" />
        <!--Google plus essentials START-->
        <link href="https://plus.google.com/+ThreadCraftsJodhpur" rel="publisher" />
        <script type="text/javascript" async defer src="https://apis.google.com/js/platform.js?publisherid=101035726513260358778"></script>
        <!--Google plus essentials END-->
        <link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo IMAGES_PATH; ?>/apple-touch/144.png"/>
        <link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo IMAGES_PATH; ?>/apple-touch/114.png"/>
        <link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo IMAGES_PATH; ?>/apple-touch/72.png"/>
        <link rel="apple-touch-icon-precomposed" href="<?php echo IMAGES_PATH; ?>/apple-touch/57.png"/>
        <link rel="shortcut icon" href="<?php echo IMAGES_PATH; ?>/favicon.ico"/>        
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/style.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo JS_PATH; ?>/jquery-ui-1.10.3/css/smoothness/jquery-ui-1.10.3.custom.min.css"/>
        <link href='https://fonts.googleapis.com/css?family=Pacifico' rel='stylesheet' type='text/css'>
        <script type="text/javascript" src="<?php echo JS_PATH; ?>/jquery-core-n-modernizer.min.js"></script>
        <script type="text/javascript">
            if (window.location.hash && window.location.hash == '#_=_') {
                window.location.hash = '';
            }
            var baseUrl = '<?php echo base_url(); ?>';
        </script>
    </head>
    <body>
        <?php
            $this->load->view('layout/front/navigation');
            