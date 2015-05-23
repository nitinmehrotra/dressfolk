<?php
$controller = $this->router->fetch_class();
$method = $this->router->fetch_method();
$path = $controller . "/" . $method;

$model = new Common_model();
$pc_records = $model->fetchSelectedData('*', TABLE_PARENT_CATEGORY, NULL, 'pc_name', 'ASC', 5);
?>
<header class="header-wrapper">
    <div class="header-container">
        <div id="mobile-sticky" class="main-header visible-xs">
            <div class="header-content visible-xs">
                <!-- navigation BOF -->
                <div class="navbar visible-xs">
                    <div class="navbar">
                        <div class="navbar-header">
                            <button class="navbar-toggle collapsed" type="button" data-toggle="collapse" data-target=".bs-navbar-collapse">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                            <a href="" class="navbar-brand">Navigation</a>
                        </div>
                        <nav class="collapse bs-navbar-collapse" role="navigation">
                            <ul class="nav-accordion nav-mobile-accordion">
                                <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                <?php
                                foreach ($pc_records as $pcKey => $pcValue)
                                {
                                    ?>
                                    <li class="level0 nav-7 level-top parent">
                                        <a href="<?php echo base_url($pcValue['pc_url']); ?>" class="level-top">
                                            <span><?php echo stripslashes($pcValue['pc_name']); ?></span>
                                        </a>
                                        <ul class="level0">
                                            <li class="level1 item nav-7-1 first parent">
                                                <a href="men/dress.html">
                                                    <span>Dress</span>
                                                </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-7-1-1 first">
                                                        <a href="men/dress/cocktail.html">
                                                            <span>Cocktail</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-1-2">
                                                        <a href="men/dress/day.html">
                                                            <span>Day</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-1-3">
                                                        <a href="men/dress/evening.html">
                                                            <span>Evening</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-1-4 last">
                                                        <a href="men/dress/sports.html">
                                                            <span>Sports</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li><li class="level1 item nav-7-2 parent">
                                                <a href="men/shoes.html">
                                                    <span>Shoes</span>
                                                </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-7-2-5 first">
                                                        <a href="men/shoes/sandal.html">
                                                            <span>Sandal</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-2-6">
                                                        <a href="men/shoes/sport.html">
                                                            <span>Sport</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-2-7">
                                                        <a href="men/shoes/books.html">
                                                            <span>Books</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-2-8 last">
                                                        <a href="men/shoes/sock.html">
                                                            <span>Sock</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li><li class="level1 item nav-7-3 parent">
                                                <a href="men/handbags.html">
                                                    <span>Handbags</span>
                                                </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-7-3-9 first">
                                                        <a href="men/handbags/blazers.html">
                                                            <span>Blazers</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-3-10">
                                                        <a href="men/handbags/table.html">
                                                            <span>Table</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-3-11">
                                                        <a href="men/handbags/coats.html">
                                                            <span>Coats</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-3-12 last">
                                                        <a href="men/handbags/kids.html">
                                                            <span>Kids</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li><li class="level1 item nav-7-4 parent">
                                                <a href="men/styliest-bag.html">
                                                    <span>Styliest Bag</span>
                                                </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-7-4-13 first">
                                                        <a href="men/styliest-bag/clutch-handbags.html">
                                                            <span>Clutch Handbags</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-4-14">
                                                        <a href="men/styliest-bag/diaper-bags.html">
                                                            <span>Diaper Bags</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-4-15">
                                                        <a href="men/styliest-bag/bags.html">
                                                            <span>Bags</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-4-16 last">
                                                        <a href="men/styliest-bag/hobo-handbags.html">
                                                            <span>Hobo Handbags</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li><li class="level1 item nav-7-5 parent">
                                                <a href="men/material-bag.html">
                                                    <span>Material Bag</span>
                                                </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-7-5-17 first">
                                                        <a href="men/material-bag/beaded-handbags.html">
                                                            <span>Beaded Handbags</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-5-18">
                                                        <a href="men/material-bag/fabric-handbags.html">
                                                            <span>Fabric Handbags</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-5-19">
                                                        <a href="men/material-bag/handbags.html">
                                                            <span>Handbags</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-5-20 last">
                                                        <a href="men/material-bag/leather-handbags.html">
                                                            <span>Leather Handbags</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li><li class="level1 item nav-7-6 last parent">
                                                <a href="men/jwellery.html">
                                                    <span>Jwellery</span>
                                                </a>
                                                <ul class="level1">
                                                    <li class="level2 nav-7-6-21 first">
                                                        <a href="men/jwellery/bracelets.html">
                                                            <span>Bracelets</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-6-22">
                                                        <a href="men/jwellery/necklaces-pendants.html">
                                                            <span>Necklaces &amp; Pendants</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-6-23">
                                                        <a href="men/jwellery/pendants.html">
                                                            <span>Pendants</span>
                                                        </a>
                                                    </li><li class="level2 nav-7-6-24 last">
                                                        <a href="men/jwellery/pins-brooches.html">
                                                            <span>Pins &amp; Brooches</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php
                                }
                                ?>
                                <li><a href="<?php echo base_url('blog'); ?>">Blog</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="navigation-wrapper hidden-xs">
                    <div class="main-navigation">
                        <ul class="top-navigation">
                            <li class="level0 home level-top  active m-dropdown parent">
                                <a href="<?php echo base_url(); ?>" class="level-top"><span>Home</span></a>
                            </li>
                            <?php
                            foreach ($pc_records as $pcKey => $pcValue)
                            {
                                ?>
                                <li class="level0 nav-2 level-top parent parent">
                                    <a href="<?php echo base_url($pcValue['pc_url']); ?>" class="level-top">
                                        <span><?php echo stripslashes($pcValue['pc_name']); ?></span>
                                    </a>
                                    <div class="level0 menu-wrap-sub">
                                        <div class="ulmenu-block ulmenu-block-center menu-items grid12-9 itemgrid itemgrid-3col">
                                            <ul class="level0">
                                                <li class="level1 groups item nav-2-1 first">
                                                    <a href="men/dress.html">
                                                        <span class="title_group">Dress</span>
                                                    </a>
                                                    <div class="menu-wrapper">
                                                        <ul class="level1">
                                                            <li class="level2 nav-2-1-1 first">
                                                                <a href="men/dress/cocktail.html">
                                                                    <span>Cocktail</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-1-2">
                                                                <a href="men/dress/day.html">
                                                                    <span>Day</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-1-3">
                                                                <a href="men/dress/evening.html">
                                                                    <span>Evening</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-1-4 last">
                                                                <a href="men/dress/sports.html">
                                                                    <span>Sports</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li><li class="level1 groups item nav-2-2">
                                                    <a href="men/shoes.html">
                                                        <span class="title_group">Shoes</span>
                                                    </a>
                                                    <div class="menu-wrapper">
                                                        <ul class="level1">
                                                            <li class="level2 nav-2-2-5 first">
                                                                <a href="men/shoes/sandal.html">
                                                                    <span>Sandal</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-2-6">
                                                                <a href="men/shoes/sport.html">
                                                                    <span>Sport</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-2-7">
                                                                <a href="men/shoes/books.html">
                                                                    <span>Books</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-2-8 last">
                                                                <a href="men/shoes/sock.html">
                                                                    <span>Sock</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li><li class="level1 groups item nav-2-3">
                                                    <a href="men/handbags.html">
                                                        <span class="title_group">Handbags</span>
                                                    </a>
                                                    <div class="menu-wrapper">
                                                        <ul class="level1">
                                                            <li class="level2 nav-2-3-9 first">
                                                                <a href="men/handbags/blazers.html">
                                                                    <span>Blazers</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-3-10">
                                                                <a href="men/handbags/table.html">
                                                                    <span>Table</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-3-11">
                                                                <a href="men/handbags/coats.html">
                                                                    <span>Coats</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-3-12 last">
                                                                <a href="men/handbags/kids.html">
                                                                    <span>Kids</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li><li class="level1 groups item nav-2-4">
                                                    <a href="men/styliest-bag.html">
                                                        <span class="title_group">Styliest Bag</span>
                                                    </a>
                                                    <div class="menu-wrapper">
                                                        <ul class="level1">
                                                            <li class="level2 nav-2-4-13 first">
                                                                <a href="men/styliest-bag/clutch-handbags.html">
                                                                    <span>Clutch Handbags</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-4-14">
                                                                <a href="men/styliest-bag/diaper-bags.html">
                                                                    <span>Diaper Bags</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-4-15">
                                                                <a href="men/styliest-bag/bags.html">
                                                                    <span>Bags</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-4-16 last">
                                                                <a href="men/styliest-bag/hobo-handbags.html">
                                                                    <span>Hobo Handbags</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li><li class="level1 groups item nav-2-5">
                                                    <a href="men/material-bag.html">
                                                        <span class="title_group">Material Bag</span>
                                                    </a>
                                                    <div class="menu-wrapper">
                                                        <ul class="level1">
                                                            <li class="level2 nav-2-5-17 first">
                                                                <a href="men/material-bag/beaded-handbags.html">
                                                                    <span>Beaded Handbags</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-5-18">
                                                                <a href="men/material-bag/fabric-handbags.html">
                                                                    <span>Fabric Handbags</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-5-19">
                                                                <a href="men/material-bag/handbags.html">
                                                                    <span>Handbags</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-5-20 last">
                                                                <a href="men/material-bag/leather-handbags.html">
                                                                    <span>Leather Handbags</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li><li class="level1 groups item nav-2-6 last">
                                                    <a href="men/jwellery.html">
                                                        <span class="title_group">Jwellery</span>
                                                    </a>
                                                    <div class="menu-wrapper">
                                                        <ul class="level1">
                                                            <li class="level2 nav-2-6-21 first">
                                                                <a href="men/jwellery/bracelets.html">
                                                                    <span>Bracelets</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-6-22">
                                                                <a href="men/jwellery/necklaces-pendants.html">
                                                                    <span>Necklaces &amp; Pendants</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-6-23">
                                                                <a href="men/jwellery/pendants.html">
                                                                    <span>Pendants</span>
                                                                </a>
                                                            </li><li class="level2 nav-2-6-24 last">
                                                                <a href="men/jwellery/pins-brooches.html">
                                                                    <span>Pins &amp; Brooches</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="menu-static-blocks ulmenu-block ulmenu-block-right pull-right grid12-3">
                                            <img class="img-responsive" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/puro/menu/men.jpg" alt="" />
                                        </div>
                                    </div>
                                </li>     
                                <?php
                            }
                            ?>
                            <li class="level0 level-top link-external"><a href="<?php echo base_url('blog'); ?>" class="level-top"><span>Blog</span></a></li>
                        </ul>
                    </div>
                </div>
                <!-- navigation EOF -->               
                <div class="header-logo pull-left">
                    <a href="<?php echo base_url(); ?>" title="Puro Theme" class="logo">
                        <img class="x1" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/puro/logo/homepage/logo_puro_2.png" alt="Puro Theme" />
                        <img class="logo-sticky" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/puro/logo/logo_puro_1_1.png" alt="Puro Theme" />
                    </a>
                </div>
                <div class="right-header-menu">
                    <div class="header-maincart">
                        <div class="cart-container">
                            <a href="javascript:void(0);" title="Cart header" class="icon-cart-header">
                                <span class="icon_bag_alt"></span>
                            </a>

                            <div class="cart-wrapper">
                                <div class="cart-content">
                                    <p class="no-items-in-cart">You have no items in your shopping cart.</p>
                                </div>
                            </div>
                        </div>                    </div>
                    <div class="header-setting">
                        <div class="setting-switcher switcher-wrap">
                            <div class="overwrite-setting">
                                <span class="fa fa-bars"></span>
                            </div>
                            <div class="switcher-content">
                                <ul class="links">
                                    <?php
                                    if (isset($this->session->userdata['user_id']))
                                    {
                                        ?>
                                        <li class="first" ><a href="<?php echo base_url('my-account'); ?>" title="My Account" >My Account</a></li>
                                        <li ><a href="<?php echo base_url('my-wishlist'); ?>" title="My Wishlist" >My Wishlist</a></li>
                                        <li ><a href="<?php echo base_url('cart'); ?>" title="My Cart" class="top-link-cart">My Cart</a></li>
                                        <li ><a href="<?php echo base_url('checkout'); ?>" title="Checkout" class="top-link-checkout">Checkout</a></li>
                                        <?php
                                    }
                                    else
                                    {
                                        ?>
                                        <li ><a href="<?php echo base_url('login'); ?>" title="Log In" >Log In</a></li>
                                        <li ><a href="<?php echo base_url('signup'); ?>" title="Sign Up" >Sign Up</a></li>
                                        <?php
                                    }
                                    ?>
                                    <li class=" last"><a href="<?php echo base_url('blog'); ?>" title="Blog" >Blog</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="main-header" class="main-header hidden-xs">
            <a href="<?php echo base_url(); ?>" title="Puro Theme" class="logo">
                <img class="x1" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/puro/logo/homepage/logo_puro.png" alt="Puro Theme" />
                <img class="logo-sticky" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/puro/logo/logo_puro_1_1.png" alt="Puro Theme" />
            </a>
            <div class="wrapper-top-menu container">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!-- navigation BOF -->
                        <div class="navbar visible-xs">
                            <div class="navbar">
                                <div class="navbar-header">
                                    <button class="navbar-toggle collapsed" type="button" data-toggle="collapse"
                                            data-target=".bs-navbar-collapse">
                                        <span class="sr-only">Toggle navigation</span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                        <span class="icon-bar"></span>
                                    </button>
                                    <a href="" class="navbar-brand">Navigation</a>
                                </div>
                                <nav class="collapse bs-navbar-collapse" role="navigation">
                                    <ul class="nav-accordion nav-mobile-accordion">
                                        <li><a href="<?php echo base_url(); ?>">Home</a></li>
                                        <?php
                                        foreach ($pc_records as $pcKey => $pcValue)
                                        {
                                            ?>
                                            <li class="level0 nav-7 level-top parent">
                                                <a href="<?php echo base_url($pcValue['pc_url']); ?>" class="level-top">
                                                    <span><?php echo stripslashes($pcValue['pc_name']); ?></span>
                                                </a>
                                                <ul class="level0">
                                                    <li class="level1 item nav-7-1 first parent">
                                                        <a href="men/dress.html">
                                                            <span>Dress</span>
                                                        </a>
                                                        <ul class="level1">
                                                            <li class="level2 nav-7-1-1 first">
                                                                <a href="men/dress/cocktail.html">
                                                                    <span>Cocktail</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-1-2">
                                                                <a href="men/dress/day.html">
                                                                    <span>Day</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-1-3">
                                                                <a href="men/dress/evening.html">
                                                                    <span>Evening</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-1-4 last">
                                                                <a href="men/dress/sports.html">
                                                                    <span>Sports</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li><li class="level1 item nav-7-2 parent">
                                                        <a href="men/shoes.html">
                                                            <span>Shoes</span>
                                                        </a>
                                                        <ul class="level1">
                                                            <li class="level2 nav-7-2-5 first">
                                                                <a href="men/shoes/sandal.html">
                                                                    <span>Sandal</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-2-6">
                                                                <a href="men/shoes/sport.html">
                                                                    <span>Sport</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-2-7">
                                                                <a href="men/shoes/books.html">
                                                                    <span>Books</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-2-8 last">
                                                                <a href="men/shoes/sock.html">
                                                                    <span>Sock</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li><li class="level1 item nav-7-3 parent">
                                                        <a href="men/handbags.html">
                                                            <span>Handbags</span>
                                                        </a>
                                                        <ul class="level1">
                                                            <li class="level2 nav-7-3-9 first">
                                                                <a href="men/handbags/blazers.html">
                                                                    <span>Blazers</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-3-10">
                                                                <a href="men/handbags/table.html">
                                                                    <span>Table</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-3-11">
                                                                <a href="men/handbags/coats.html">
                                                                    <span>Coats</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-3-12 last">
                                                                <a href="men/handbags/kids.html">
                                                                    <span>Kids</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li><li class="level1 item nav-7-4 parent">
                                                        <a href="men/styliest-bag.html">
                                                            <span>Styliest Bag</span>
                                                        </a>
                                                        <ul class="level1">
                                                            <li class="level2 nav-7-4-13 first">
                                                                <a href="men/styliest-bag/clutch-handbags.html">
                                                                    <span>Clutch Handbags</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-4-14">
                                                                <a href="men/styliest-bag/diaper-bags.html">
                                                                    <span>Diaper Bags</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-4-15">
                                                                <a href="men/styliest-bag/bags.html">
                                                                    <span>Bags</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-4-16 last">
                                                                <a href="men/styliest-bag/hobo-handbags.html">
                                                                    <span>Hobo Handbags</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li><li class="level1 item nav-7-5 parent">
                                                        <a href="men/material-bag.html">
                                                            <span>Material Bag</span>
                                                        </a>
                                                        <ul class="level1">
                                                            <li class="level2 nav-7-5-17 first">
                                                                <a href="men/material-bag/beaded-handbags.html">
                                                                    <span>Beaded Handbags</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-5-18">
                                                                <a href="men/material-bag/fabric-handbags.html">
                                                                    <span>Fabric Handbags</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-5-19">
                                                                <a href="men/material-bag/handbags.html">
                                                                    <span>Handbags</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-5-20 last">
                                                                <a href="men/material-bag/leather-handbags.html">
                                                                    <span>Leather Handbags</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li><li class="level1 item nav-7-6 last parent">
                                                        <a href="men/jwellery.html">
                                                            <span>Jwellery</span>
                                                        </a>
                                                        <ul class="level1">
                                                            <li class="level2 nav-7-6-21 first">
                                                                <a href="men/jwellery/bracelets.html">
                                                                    <span>Bracelets</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-6-22">
                                                                <a href="men/jwellery/necklaces-pendants.html">
                                                                    <span>Necklaces &amp; Pendants</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-6-23">
                                                                <a href="men/jwellery/pendants.html">
                                                                    <span>Pendants</span>
                                                                </a>
                                                            </li><li class="level2 nav-7-6-24 last">
                                                                <a href="men/jwellery/pins-brooches.html">
                                                                    <span>Pins &amp; Brooches</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <?php
                                        }
                                        ?>     
                                    </ul>
                                </nav>
                            </div>
                        </div>
                        <div class="navigation-wrapper hidden-xs">
                            <div class="main-navigation">
                                <ul class="top-navigation">
                                    <li class="level0 home level-top  active m-dropdown parent">
                                        <a href="<?php echo base_url(); ?>"
                                           class="level-top"><span>Home</span></a>
                                    </li>
                                    <?php
                                    foreach ($pc_records as $pcKey => $pcValue)
                                    {
                                        ?>
                                        <li class="level0 nav-2 level-top parent parent">
                                            <a href="<?php echo base_url($pcValue['pc_url']); ?>" class="level-top">
                                                <span><?php echo stripslashes($pcValue['pc_name']); ?></span>
                                            </a>
                                            </a>
                                            <div class="level0 menu-wrap-sub">
                                                <div class="ulmenu-block ulmenu-block-center menu-items grid12-9 itemgrid itemgrid-3col">
                                                    <ul class="level0">
                                                        <li class="level1 groups item nav-2-1 first">
                                                            <a href="men/dress.html">
                                                                <span class="title_group">Dress</span>
                                                            </a>
                                                            <div class="menu-wrapper">
                                                                <ul class="level1">
                                                                    <li class="level2 nav-2-1-1 first">
                                                                        <a href="men/dress/cocktail.html">
                                                                            <span>Cocktail</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-1-2">
                                                                        <a href="men/dress/day.html">
                                                                            <span>Day</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-1-3">
                                                                        <a href="men/dress/evening.html">
                                                                            <span>Evening</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-1-4 last">
                                                                        <a href="men/dress/sports.html">
                                                                            <span>Sports</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li><li class="level1 groups item nav-2-2">
                                                            <a href="men/shoes.html">
                                                                <span class="title_group">Shoes</span>
                                                            </a>
                                                            <div class="menu-wrapper">
                                                                <ul class="level1">
                                                                    <li class="level2 nav-2-2-5 first">
                                                                        <a href="men/shoes/sandal.html">
                                                                            <span>Sandal</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-2-6">
                                                                        <a href="men/shoes/sport.html">
                                                                            <span>Sport</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-2-7">
                                                                        <a href="men/shoes/books.html">
                                                                            <span>Books</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-2-8 last">
                                                                        <a href="men/shoes/sock.html">
                                                                            <span>Sock</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li><li class="level1 groups item nav-2-3">
                                                            <a href="men/handbags.html">
                                                                <span class="title_group">Handbags</span>
                                                            </a>
                                                            <div class="menu-wrapper">
                                                                <ul class="level1">
                                                                    <li class="level2 nav-2-3-9 first">
                                                                        <a href="men/handbags/blazers.html">
                                                                            <span>Blazers</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-3-10">
                                                                        <a href="men/handbags/table.html">
                                                                            <span>Table</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-3-11">
                                                                        <a href="men/handbags/coats.html">
                                                                            <span>Coats</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-3-12 last">
                                                                        <a href="men/handbags/kids.html">
                                                                            <span>Kids</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li><li class="level1 groups item nav-2-4">
                                                            <a href="men/styliest-bag.html">
                                                                <span class="title_group">Styliest Bag</span>
                                                            </a>
                                                            <div class="menu-wrapper">
                                                                <ul class="level1">
                                                                    <li class="level2 nav-2-4-13 first">
                                                                        <a href="men/styliest-bag/clutch-handbags.html">
                                                                            <span>Clutch Handbags</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-4-14">
                                                                        <a href="men/styliest-bag/diaper-bags.html">
                                                                            <span>Diaper Bags</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-4-15">
                                                                        <a href="men/styliest-bag/bags.html">
                                                                            <span>Bags</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-4-16 last">
                                                                        <a href="men/styliest-bag/hobo-handbags.html">
                                                                            <span>Hobo Handbags</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li><li class="level1 groups item nav-2-5">
                                                            <a href="men/material-bag.html">
                                                                <span class="title_group">Material Bag</span>
                                                            </a>
                                                            <div class="menu-wrapper">
                                                                <ul class="level1">
                                                                    <li class="level2 nav-2-5-17 first">
                                                                        <a href="men/material-bag/beaded-handbags.html">
                                                                            <span>Beaded Handbags</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-5-18">
                                                                        <a href="men/material-bag/fabric-handbags.html">
                                                                            <span>Fabric Handbags</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-5-19">
                                                                        <a href="men/material-bag/handbags.html">
                                                                            <span>Handbags</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-5-20 last">
                                                                        <a href="men/material-bag/leather-handbags.html">
                                                                            <span>Leather Handbags</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li><li class="level1 groups item nav-2-6 last">
                                                            <a href="men/jwellery.html">
                                                                <span class="title_group">Jwellery</span>
                                                            </a>
                                                            <div class="menu-wrapper">
                                                                <ul class="level1">
                                                                    <li class="level2 nav-2-6-21 first">
                                                                        <a href="men/jwellery/bracelets.html">
                                                                            <span>Bracelets</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-6-22">
                                                                        <a href="men/jwellery/necklaces-pendants.html">
                                                                            <span>Necklaces &amp; Pendants</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-6-23">
                                                                        <a href="men/jwellery/pendants.html">
                                                                            <span>Pendants</span>
                                                                        </a>
                                                                    </li><li class="level2 nav-2-6-24 last">
                                                                        <a href="men/jwellery/pins-brooches.html">
                                                                            <span>Pins &amp; Brooches</span>
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="menu-static-blocks ulmenu-block ulmenu-block-right pull-right grid12-3">
                                                    <img class="img-responsive" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/puro/menu/men.jpg" alt="" />
                                                </div>
                                            </div>
                                        </li>         
                                        <?php
                                    }
                                    ?>
                                    <li class="level0 level-top link-external">
                                        <a href="<?php echo base_url('blog'); ?>"class="level-top">
                                            <span>Blog</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <!-- navigation EOF -->             
                    </div>
                </div>
            </div>
            <div class="right-header-menu">
                <div class="header-maincart">
                    <div class="cart-container">
                        <a href="javascript:void(0);" title="Cart" class="icon-cart-header">
                            <span class="icon_bag_alt"></span>
                        </a>

                        <div class="cart-wrapper">
                            <div class="cart-content">
                                <p class="no-items-in-cart">You have no items in your shopping cart.</p>
                            </div>
                        </div>
                    </div>               
                </div>
                <div class="header-setting">
                    <div class="setting-switcher switcher-wrap">
                        <div class="overwrite-setting">
                            <span class="fa fa-bars"></span>
                        </div>

                        <div class="switcher-content">
                            <ul class="links">                               
                                <?php
                                if (isset($this->session->userdata['user_id']))
                                {
                                    ?>
                                    <li class="first" ><a href="<?php echo base_url('my-account'); ?>" title="My Account" >My Account</a></li>
                                    <li ><a href="<?php echo base_url('my-wishlist'); ?>" title="My Wishlist" >My Wishlist</a></li>
                                    <li ><a href="<?php echo base_url('cart'); ?>" title="My Cart" class="top-link-cart">My Cart</a></li>
                                    <li ><a href="<?php echo base_url('checkout'); ?>" title="Checkout" class="top-link-checkout">Checkout</a></li>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <li ><a href="<?php echo base_url('login'); ?>" title="Log In" >Log In</a></li>
                                    <li ><a href="<?php echo base_url('signup'); ?>" title="Sign Up" >Sign Up</a></li>
                                    <?php
                                }
                                ?>
                                <li class=" last"><a href="<?php echo base_url('blog'); ?>" title="Blog" >Blog</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=""></div>
        <?php
        if ($path == 'index/index')
        {
            ?>
            <div class="top-container">
                <div class="slide-home" id="block-slide-home">
                    <div class="slide-home owl-carousel ">
                        <div class="slide-content">
                            <div class="slide-inner-content">
                                <div class="slider-image"><img class="images-resposive" alt="slider 01" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/slide/slide1.jpg" /></div>
                                <div class="slider-text">
                                    <h2 class="slider-title"><span>You can have anything you want <br /> if you dress for it </span></h2>
                                    <p class="slider-desc"><span> Learn about our <a class="slider-link">Shop now</a></span></p>
                                </div>
                            </div>
                        </div>         
                        <div class="slide-content">
                            <div class="slide-inner-content">
                                <div class="slider-image"><img class="images-resposive" alt="slider 02" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/slide/slide2.jpg" /></div>
                                <div class="slider-text">
                                    <h2 class="slider-title"><span>Trendy is the last stage before tacky</span></h2>
                                    <p class="slider-desc"><span> Learn about our <a class="slider-link">Shop now</a></span></p>
                                </div>
                            </div>
                        </div>          
                        <div class="slide-content">
                            <div class="slide-inner-content">
                                <div class="slider-image"><img class="images-resposive" alt="slider 01" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/slide/slide3.jpg" /></div>
                                <div class="slider-text">
                                    <h2 class="slider-title"><span>it's about something else <br/> that comes from within you</span></h2>
                                    <p class="slider-desc"><span> Learn about our <a class="slider-link">Shop now</a></span></p>
                                </div>
                            </div>
                        </div>        
                    </div>
                    <script type="text/javascript">
                        jQuery(document).ready(function () {
                            widgetConfig.init('block-slide-home', {
                                carousel: {"enable": true, "pagination": true, "autoPlay": false, "items": 1, "singleItem": true, "lazyLoad": true, "lazyEffect": false, "addClassActive": true, "navigation": false, "navigationText": [null, null]}});
                        });
                    </script>
                </div>
            </div>            
            <div class="header-search">
                <div class="container">
                    <div class="row">
                        <form id="search_mini_form" action="" method="get">
                            <div class="input-group form-search">
                                <span class="input-group-btn category-filter">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown">
                                        <span class="category-label">
                                            All Categories                
                                        </span>&nbsp;<i class="fa fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a href="javascript:void(0)" data-value="">All</a></li>
                                        <li><a href="javascript:void(0)" data-value="3">Women</a></li>
                                        <li><a href="javascript:void(0)" data-value="4">Men</a></li>
                                        <li><a href="javascript:void(0)" data-value="5">Footwear</a></li>
                                        <li><a href="javascript:void(0)" data-value="6">Jewellery</a></li>
                                        <li><a href="javascript:void(0)" data-value="7">Accessories</a></li>
                                        <li><a href="javascript:void(0)" data-value="8">Shoes</a></li>
                                        <li><a href="javascript:void(0)" data-value="9">Bag</a></li>
                                        <li><a href="javascript:void(0)" data-value="10">Shirts</a></li>
                                        <li><a href="javascript:void(0)" data-value="11">Pants</a></li>
                                    </ul>
                                </span>
                                <input type="hidden" name="cat" value=""/>
                                <input id="search"
                                       type="search"
                                       name="q"
                                       value=""
                                       class="input-text required-entry"
                                       maxlength="128"
                                       />
                                <button type="submit" title="Search" class="search-button"><span><span><i class="fa fa-search"></i></span></span></button>
                            </div>
                            <div id="search_autocomplete" class="search-autocomplete" style="display: none"></div>
                            <script type="text/javascript">
                                //<![CDATA[
                                var CatSearch = Class.create(Varien.searchForm, {
                                    initAutocomplete: function (url, destinationElement) {
                                        new Ajax.Autocompleter(this.field, destinationElement, url, {
                                            paramName: this.field.name,
                                            method: 'get',
                                            minChars: 2,
                                            updateElement: this._selectAutocompleteItem.bind(this),
                                            onShow: function (element, update) {
                                                if (!update.style.position || update.style.position == 'absolute') {
                                                    update.style.position = 'absolute';
                                                    Position.clone(element, update, {
                                                        setHeight: false,
                                                        offsetTop: element.offsetHeight
                                                    });
                                                }
                                                Effect.Appear(update, {duration: 0});
                                            }
                                        });
                                    },
                                    initSearchFilter: function (field, target) {
                                        var fieldElm = this.form.down('input[name="' + field + '"]');
                                        if (!fieldElm)
                                            return;
                                        var targetElm = this.form.down(target);
                                        this.form.select('.form-search .dropdown-menu a').each(function (item) {
                                            Event.observe(item, 'click', function () {
                                                fieldElm.value = item.readAttribute('data-value');
                                                if (targetElm)
                                                    targetElm.update(item.innerHTML);
                                            });
                                        });
                                    }
                                });
                                var searchForm = new CatSearch('search_mini_form', 'search', '');
                                searchForm.initAutocomplete('http://puro.icotheme.com/catalogsearch/ajax/suggest/', 'search_autocomplete');
                                searchForm.initSearchFilter('cat', '.category-label');
                                //]]>
                            </script>
                        </form>
                    </div>
                </div>
            </div>
            <?php
        }
        ?>
    </div>
</header>