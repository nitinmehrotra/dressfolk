<div class="main-breadcrumbs">
    <div class="container">
        <div class="row show-grid">
            <div class="col-lg-12">
            </div>
        </div>
    </div>
</div>
<div class="main-wrapper">
    <div class="main">
        <div class="site-preface"></div>
        <div class="container">
            <div class="row show-grid">
                <div class="widget widget-static-block"><div class="home-banner">
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="inner-banner">
                                <div class="overlay">
                                    <span class="widget widget-category-link"><a href="#"><i class="fs1" aria-hidden="true" data-icon="$"></i></a></span>
                                </div>
                                <div class="banner-img"><span class="text">Shoes</span><img alt="" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/Shoes-banner.jpg" /></div>
                            </div>
                            <div class="inner-banner">
                                <div class="overlay"><span class="widget widget-category-link"><a href="#"><i class="fs1" aria-hidden="true" data-icon="$"></i></a></span></div>
                                <div class="banner-img"><span class="text">Shirts</span><img alt="" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/shirt-banner.jpg" /></div>
                            </div>
                        </div> 
                        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <div class="inner-banner">
                                <div class="overlay"><span class="widget widget-category-link"><a href="#"><i class="fs1" aria-hidden="true" data-icon="$"></i></a></span></div>
                                <div class="banner-img"><span class="text">Bag</span><img alt="" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/bags-banner.jpg" /></div>
                            </div>
                            <div class="inner-banner">
                                <div class="overlay"><span class="widget widget-category-link"><a href="#"><i class="fs1" aria-hidden="true" data-icon="$"></i></a></span></div>
                                <div class="banner-img"><span class="text">Pants</span><img alt="" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/pant-banner.jpg" /></div>
                            </div>
                        </div> 
                    </div></div>
                <div class="widget-products-new home-new-product" id="block-4e8ee2e7dccf59d2682a0d27c4713f19">
                    <h3 class="title-widget"><span>New Products</span></h3>
                    <div class="category-products">
                        <ul class="products-grid  owl-carousel">
                            <?php
                            foreach ($products_arr as $pKey => $pValue)
                            {
                                $product_id = $pValue['product_id'];
                                $product_url = getProductUrl($pValue['product_url_key']);
                                $product_title = stripslashes($pValue['product_title']);
                                $product_image_1 = getImage('');
                                $product_image_2 = getImage('');
                                $product_price = $pValue['product_price'];
                                ?>
                                <li class="item effect-pageLeft">
                                    <div class="product-action">
                                        <!-- // Product Label -->
                                        <div class="product-new-label">New</div>       
                                        <!-- // End Product Label -->
                                        <a class="product-image" href="<?php echo $product_url; ?>" title="<?php echo $product_title; ?>">
                                            <img class="lazyOwl img-responsive" data-src="<?php echo $product_image_1; ?>" data-srcX2="<?php echo $product_image_2; ?>" src="<?php echo IMAGES_PATH; ?>/AjaxLoader.gif" alt="<?php echo $product_title; ?>"/>
                                            <img class="img-responsive alt-img lazy" data-src="<?php echo $product_image_1; ?>" data-srcX2="<?php echo $product_image_2; ?>" src="<?php echo IMAGES_PATH; ?>/AjaxLoader.gif" alt="<?php echo $product_title; ?>" />
                                        </a>

                                        <div class="actions">
                                            <div class="action-list quickview hidden-xs">
                                                <div class="quickview-wrapper" onclick="quickview(this);" data-url="<?php echo $product_url; ?>">
                                                    <i class="fa fa-search-plus"></i>
                                                </div>
                                            </div>
                                            <!-- // Product Button Add To Link -->
                                            <div class="action-list">
                                                <ul class="add-to-links">
                                                    <li><a href="javascript:void();" class="link-wishlist wishlist-action bootstrap-tooltip" data-toggle="tooltip" data-placement="left" title="Wishlist" data-productid="<?php echo getEncryptedString($product_id); ?>"><i class="fa fa-heart"></i></a></li>
                                                </ul>
                                            </div>
                                            <!-- // End Product Button Add To Link -->
                                        </div>
                                    </div>
                                    <div class="product-content">
                                        <h3 class="product-name">
                                            <a href="<?php echo $product_url ?>" title="<?php echo $product_title; ?>"><?php echo $product_title; ?></a>
                                        </h3>

                                        <div class="price-box">
                                            <p class="special-price">
                                                <span class="price-label">Price:</span>
                                                <span class="price"><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($product_price, 2); ?></span>
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
                <script type="text/javascript">
                    jQuery(document).ready(function () {
                        widgetConfig.init('block-4e8ee2e7dccf59d2682a0d27c4713f19', {
                            carousel: {"enable": true, "pagination": false, "autoPlay": 10000, "items": 4, "singleItem": false, "lazyLoad": true, "lazyEffect": false, "addClassActive": true, "navigation": true, "navigationText": ["<i class=\"fs1\" aria-hidden=\"true\" data-icon=\"#\"><\/i>", "<i class=\"fs1\" aria-hidden=\"true\" data-icon=\"$\"><\/i>"]},
                            countdown: {"enable": false, "yearText": "years", "monthText": "months", "weekText": "weeks", "dayText": "days", "hourText": "hours", "minText": "mins", "secText": "secs", "yearSingularText": "year", "monthSingularText": "month", "weekSingularText": "week", "daySingularText": "day", "hourSingularText": "hour", "minSingularText": "min", "secSingularText": "sec"},
                            countdownTemplate: '<div class="day"><span class="no">%d</span><span class="text">days</span></div><div class="hours"><span class="no">%h</span><span class="text">hours</span></div><div class="min"><span class="no">%i</span><span class="text">min</span></div><div class="second"><span class="no">%s</span><span class="text">secs</span></div>'
                        });
                    });
                </script>
            </div>
        </div>
    </div>
</div>