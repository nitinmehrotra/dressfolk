<div class="main-wrapper">
    <div class="container">
        <div class="main">
            <div class="row show-grid">
                <div class="col-lg-3  sidebar">
                    <?php $this->load->view('pages/products/search-sidebar'); ?>
                </div>
                <div class="col-lg-9 ">
                    <div class="col-main">
                        <div class="category-products">
                            <div class="toolbar">
                                <div class="row">
                                    <div class="col-lg-9 col-md-9 col-sm-9 col-xs-12">
                                        <div class="row">
                                            <div class="col-lg-9">
                                                <?php $this->load->view('pages/products/search-sorter-wrap'); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <ul class="products-grid itemgrid itemgrid-adaptive products-itemgrid-3col show-grid">
                                <?php
                                if (!empty($records))
                                {
                                    foreach ($records as $pKey => $pValue)
                                    {
                                        $product_id = $pValue['product_id'];
                                        $product_url = getProductUrl($pValue['product_url_key']);
                                        $product_title = stripslashes($pValue['product_title']);
                                        $product_image_1 = getImage($pValue['pi_image_path']);
                                        $product_image_2 = getImage($pValue['pi_image_path']);
                                        $product_price = $pValue['product_price'];
                                        ?>
                                        <li class="item effect-pageLeft">
                                            <div class="product-action">
                                                <!-- // Product Label -->
                                                <div class="product-new-label">New</div>       
                                                <!-- // End Product Label -->
                                                <a class="product-image" href="<?php echo $product_url; ?>" title="<?php echo $product_title; ?>">
                                                    <img class="lazyOwl img-responsive" data-src="<?php echo $product_image_1; ?>" data-srcX2="<?php echo $product_image_1; ?>" src="<?php echo $product_image_1; ?>" alt="<?php echo $product_title; ?>" style="display: block;"/>
                                                    <img class="img-responsive alt-img lazy" data-src="<?php echo $product_image_2; ?>" data-srcX2="<?php echo $product_image_2; ?>" src="<?php echo $product_image_2; ?>" alt="<?php echo $product_title; ?>" style="display: block;"/>
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
                                }
                                else
                                {
                                    echo '<h4>No results found</h4>';
                                }
                                ?>
                            </ul>
                            <script type="text/javascript">decorateGeneric($$('ul.products-grid'), ['odd', 'even', 'first', 'last'])</script>
                        </div>

                        <script type="text/javascript">
                            jQuery(document).on('product-media-loaded', function () {
                                ConfigurableMediaImages.init('small_image');
                                ConfigurableMediaImages.setImageFallback(33, jQuery.parseJSON('{"option_labels":[],"small_image":{"33":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/g\/i\/girl.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(59, jQuery.parseJSON('{"option_labels":[],"small_image":{"59":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/3\/2\/32_1.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(57, jQuery.parseJSON('{"option_labels":[],"small_image":{"57":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/3\/0\/30.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(56, jQuery.parseJSON('{"option_labels":[],"small_image":{"56":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/2\/4\/24.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(55, jQuery.parseJSON('{"option_labels":[],"small_image":{"55":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/2\/0\/20_1_1_1.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(52, jQuery.parseJSON('{"option_labels":{"black":{"configurable_product":{"small_image":null,"base_image":null},"products":["53"]},"white":{"configurable_product":{"small_image":null,"base_image":null},"products":["54"]},"m":{"configurable_product":{"small_image":null,"base_image":null},"products":["53","54"]}},"small_image":{"53":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/1\/8\/18_4.jpg","52":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/2\/8\/28.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(51, jQuery.parseJSON('{"option_labels":[],"small_image":{"51":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/1\/8\/18_2_1.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(50, jQuery.parseJSON('{"option_labels":[],"small_image":{"50":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/2\/2\/22.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(46, jQuery.parseJSON('{"option_labels":{"beige":{"configurable_product":{"small_image":null,"base_image":null},"products":["47"]},"black":{"configurable_product":{"small_image":null,"base_image":null},"products":["48"]},"red":{"configurable_product":{"small_image":null,"base_image":null},"products":["49"]},"m":{"configurable_product":{"small_image":null,"base_image":null},"products":["47","49"]},"l":{"configurable_product":{"small_image":null,"base_image":null},"products":["48"]}},"small_image":{"47":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/2\/0\/20.jpg","48":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/1\/8\/18_1.jpg","46":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/1\/6\/16.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(42, jQuery.parseJSON('{"option_labels":[],"small_image":{"42":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/i\/m\/image1xxl_1_.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(41, jQuery.parseJSON('{"option_labels":[],"small_image":{"41":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/g\/i\/girl12_1.jpg"},"base_image":[]}'));
                                ConfigurableMediaImages.setImageFallback(36, jQuery.parseJSON('{"option_labels":{"beige":{"configurable_product":{"small_image":null,"base_image":null},"products":["37"]},"pink":{"configurable_product":{"small_image":null,"base_image":null},"products":["38"]},"red":{"configurable_product":{"small_image":null,"base_image":null},"products":["39"]},"white":{"configurable_product":{"small_image":null,"base_image":null},"products":["40"]}},"small_image":{"37":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/g\/i\/girl12.jpg","38":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/g\/i\/girl9.jpg","39":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/g\/i\/girl11_1.jpg","36":"http:\/\/puro.icotheme.com\/media\/catalog\/product\/cache\/1\/small_image\/663x700\/040ec09b1e35df139433887a97daa66f\/i\/m\/image1xxl_2_.jpg"},"base_image":[]}'));
                                jQuery(document).trigger('configurable-media-images-init', ConfigurableMediaImages);
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>