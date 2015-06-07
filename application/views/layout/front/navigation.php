<?php
$controller = $this->router->fetch_class();
$method = $this->router->fetch_method();
$path = $controller . "/" . $method;

$model = new Common_model();
$pc_id_array = array();
$cc_records = array();
$pc_records = $model->fetchSelectedData('*', TABLE_PARENT_CATEGORY, NULL, 'pc_name', 'ASC', 5);
foreach ($pc_records as $pc)
{
    $pc_id_array[] = $pc['pc_id'];
}
$cc_sql = 'SELECT cc_pc_id, cc_id, cc_name, cc_url FROM ' . TABLE_CHILD_CATEGORY . ' as cc WHERE cc_pc_id IN (' . implode(', ', $pc_id_array) . ') ORDER BY cc_name LIMIT 0,4';
$cc_data = $model->db->query($cc_sql)->result_array();
foreach ($cc_data as $ccKey => $ccValue)
{
    $cc_records[$ccValue['cc_pc_id']][] = $ccValue;
}
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
                                        <?php
                                        if (!empty($cc_records[$pcValue['pc_id']]))
                                        {
                                            echo '<ul class="level0"><li class="level1 item nav-7-1 first parent"><ul class="level1">';
                                            foreach ($cc_records[$pcValue['pc_id']] as $ccKey => $ccValue)
                                            {
                                                echo '<li class="level2 nav-7-1-1 first"><a href="' . $cc_records[$pcValue['pc_id']][$ccKey]['cc_url'] . '"><span>' . stripslashes($cc_records[$pcValue['pc_id']][$ccKey]['cc_name']) . '</span></a></li>';
                                            }
                                            echo '</ul></li></ul>';
                                        }
                                        ?>
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
                                            <?php
                                            if (!empty($cc_records[$pcValue['pc_id']]))
                                            {
                                                echo '<ul class="level0"><li class="level1 item nav-7-1 first parent"><ul class="level1">';
                                                foreach ($cc_records[$pcValue['pc_id']] as $ccKey => $ccValue)
                                                {
                                                    echo '<li class="level2 nav-7-1-1 first"><a href="' . $cc_records[$pcValue['pc_id']][$ccKey]['cc_url'] . '"><span>' . stripslashes($cc_records[$pcValue['pc_id']][$ccKey]['cc_name']) . '</span></a></li>';
                                                }
                                                echo '</ul></li></ul>';
                                            }
                                            ?>
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
                    <?php
                    if (isset($this->session->userdata['user_id']))
                    {
                        ?>
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
                            </div>           
                        </div>
                        <?php
                    }
                    ?>
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
                                        <li class="first" ><a href="<?php echo base_url('logout'); ?>" title="Logout" >Logout</a></li>
                                        <li ><a href="<?php echo base_url('my-account'); ?>" title="My Account" >My Account</a></li>
                                        <li ><a href="<?php echo base_url('my-wishlist'); ?>" title="My Wishlist" >My Wishlist</a></li>
                                        <li ><a href="<?php echo base_url('cart'); ?>" title="My Cart" class="top-link-cart">My Cart</a></li>
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
                <img class="x1" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/puro/logo/<?php echo $path == 'index/index' ? 'homepage/logo_puro.png' : 'logo_puro_1_1.png'; ?>" alt="Puro Theme" />
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

                                                <?php
                                                if (!empty($cc_records[$pcValue['pc_id']]))
                                                {
                                                    echo '<ul class="level0"><li class="level1 item nav-7-1 first parent"><ul class="level1">';
                                                    foreach ($cc_records[$pcValue['pc_id']] as $ccKey => $ccValue)
                                                    {
                                                        echo '<li class="level2 nav-7-1-1 first"><a href="' . $cc_records[$pcValue['pc_id']][$ccKey]['cc_url'] . '"><span>' . stripslashes($cc_records[$pcValue['pc_id']][$ccKey]['cc_name']) . '</span></a></li>';
                                                    }
                                                    echo '</ul></li></ul>';
                                                }
                                                ?>
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
                                                    <?php
                                                    if (!empty($cc_records[$pcValue['pc_id']]))
                                                    {
                                                        echo '<ul class="level0"><li class="level1 item nav-7-1 first parent"><ul class="level1">';
                                                        foreach ($cc_records[$pcValue['pc_id']] as $ccKey => $ccValue)
                                                        {
                                                            echo '<li class="level2 nav-7-1-1 first"><a href="' . $cc_records[$pcValue['pc_id']][$ccKey]['cc_url'] . '"><span>' . stripslashes($cc_records[$pcValue['pc_id']][$ccKey]['cc_name']) . '</span></a></li>';
                                                        }
                                                        echo '</ul></li></ul>';
                                                    }
                                                    ?>
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
                <?php
                if (isset($this->session->userdata['user_id']))
                {
                    ?>
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
                    <?php
                }
                ?>
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
                                    <li class="first" ><a href="<?php echo base_url('logout'); ?>" title="Logout" >Logout</a></li>
                                    <li ><a href="<?php echo base_url('my-account'); ?>" title="My Account" >My Account</a></li>
                                    <li ><a href="<?php echo base_url('my-wishlist'); ?>" title="My Wishlist" >My Wishlist</a></li>
                                    <li ><a href="<?php echo base_url('cart'); ?>" title="My Cart" class="top-link-cart">My Cart</a></li>
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
                                        <?php
                                        foreach ($pc_records as $pcKey => $pcValue)
                                        {
                                            echo '<li><a href="javascript:void(0)" data-value="' . $pcValue['pc_id'] . '">' . stripslashes($pcValue['pc_name']) . '</a></li>';
                                        }
                                        ?>
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