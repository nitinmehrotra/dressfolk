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
//$this->output->set_header('Pragma: no-cache');
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
        <meta name="robots" content="<?php echo SEO_INDEX; ?>"/>
        <base target="_parent" />
        <meta name="viewport" content="width=device-width, minimum-scale=1, maximum-scale=1"/>
        <link rel="icon" href="<?php echo IMAGES_PATH; ?>/favicon.ico" type="image/x-icon"/>
        <link rel="shortcut icon" href="<?php echo IMAGES_PATH; ?>/favicon.ico" type="image/x-icon"/>
        <link rel="stylesheet" href="<?php echo JS_PATH; ?>/bootstrap-datepicker/css/datepicker.css"/>
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/owl.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/style.css" media="all" />
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/print.css" media="print" />
        <link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/custom.css" />
        <script type="text/javascript" src="<?php echo JS_PATH; ?>/5164f243df82e4cc8456f4bdf354ac03.js"></script>
        <script type="text/javascript">
            //<![CDATA[
            Mage.Cookies.path = '/';
            Mage.Cookies.domain = '.<?php echo base_url(); ?>';
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
        if ($this->session->flashdata('success'))
        {
            echo '<div class="noti-area"><div class="alert alert-success in fade"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('success') . '</div></div>';
        }
        if ($this->session->flashdata('error'))
        {
            echo '<div class="noti-area"><div class="alert alert-danger in fade"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('error') . '</div></div>';
        }
        if ($this->session->flashdata('warning'))
        {
            echo '<div class="noti-area"><div class="alert alert-warning in fade"><button type="button" class="close" data-dismiss="alert">&times;</button>' . $this->session->flashdata('warning') . '</div></div>';
        }

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

        <!-- // OPEN MAIN CONTAINER // -->
        <section class="main-container col1-layout">
            <?php
            if (isset($breadcrumbArray))
            {
                ?>
                <div class="main-breadcrumbs">
                    <div class="container">
                        <div class="row show-grid">
                            <div class="col-lg-12">
                                <div class="breadcrumbs">
                                    <ul>
                                        <li class="home">
                                            <a href="<?php echo base_url(); ?>" title="Go to Home Page">Home</a>
                                            <span>/ </span>
                                        </li>
                                        <?php
                                        if (!empty($breadcrumbArray))
                                        {
                                            $b_i = 1;
                                            foreach ($breadcrumbArray as $bKey => $bValue)
                                            {
                                                echo '<li class="cms_page"><a href="' . $bValue . '" title="' . $bKey . '">' . $bKey . '</a>';
                                                if ($b_i != count($breadcrumbArray))
                                                {
                                                    echo '<span>/ </span>';
                                                }
                                                echo '</li>';
                                                $b_i++;
                                            }
                                        }
                                        ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <?php
            }