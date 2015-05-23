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
$controller = $this->router->fetch_class();
$method = $this->router->fetch_method();
$path = $controller . "/" . $method;
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title><?php echo $meta_title; ?></title>
        <meta name="description" content="<?php echo $meta_description; ?>"/>
        <meta name="keywords" content="<?php echo $meta_keywords; ?>"/>
        <meta name="robots" content="INDEX,FOLLOW"/>
        <base target="_parent" />
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1"/>
        <link rel="icon" href="<?php echo IMAGES_PATH; ?>/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="<?php echo IMAGES_PATH; ?>/favicon.ico" type="image/x-icon"/>
        <!--[if lt IE 7]>
        <script type="text/javascript">
            //<![CDATA[
            var BLANK_URL = 'http://puro.icotheme.com/js/blank.html';
            var BLANK_IMG = 'http://puro.icotheme.com/js/spacer.gif';
        //]]>
        </script>
        <![endif]-->
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/437006133d9d6342b2e498ea089b0cf7.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/36bc63752380e29e215776dd85d7047e.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/976e407bad0f6ef8b3c84752e70679a7.css" media="print" />
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/custom.css" />
        <script type="text/javascript" src="<?php echo JS_PATH; ?>/5164f243df82e4cc8456f4bdf354ac03.js"></script>
        <!--[if lt IE 8]>
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/e3abd5ccfeb574ea6ab6aa54081488b2.css" media="all" />
        <![endif]-->
        <!--[if lt IE 7]>
        <script type="text/javascript" src="<?php echo JS_PATH; ?>/daf32c11099ae3bdc0c12fc49c58d4ef.js"></script>
        <![endif]-->
        <!--[if lt IE 9]>
        <script type="text/javascript" src="<?php echo JS_PATH; ?>/0708f4cc60b3173c34d0e617f1d6536d.js"></script>
        <![endif]-->

        <script type="text/javascript">
            //<![CDATA[
            Mage.Cookies.path = '/';
            Mage.Cookies.domain = '.puro.icotheme.com';
            //]]>
            //<![CDATA[
            optionalZipCountries = ["HK", "IE", "MO", "PA"];
            //]]>
            //<![CDATA[
            var Translator = new Translate([]);
            //]]></script>  
        <link href='http://fonts.googleapis.com/css?family=Montserrat:300italic,400italic,600italic,700italic,800italic,700,300,600,800,400&subset=latin' rel='stylesheet' type='text/css'/>
    </head>
    <body class="slidebar-left <?php echo $path == 'index/index' ? 'cms-home cms-index-index' : ''; ?>">
        <!-- // HEADER // -->
        <?php
        $this->load->view('layout/front/navigation');
        ?>

        <noscript>
            <div class="global-site-notice noscript">
                <div class="notice-inner">
                    <p>
                        <strong>JavaScript seems to be disabled in your browser.</strong><br />
                        You must have JavaScript enabled in your browser to utilize the functionality of this website.
                    </p>
                </div>
            </div>
        </noscript>
