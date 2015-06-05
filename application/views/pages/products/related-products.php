<?php
if (isset($product_id) && !empty($product_id))
{
    $custom_model = new Custom_model();
    $product_fields = 'product_id, product_title, product_price, product_url_key';
    $records = $custom_model->getRelatedproducts($product_id, $product_fields);
    if (count($records) >= 4)
    {
        ?>
        <div class="widget-products-related">
            <h3 class="title-widget"><span>Related Products</span></h3>
            <div class="category-products">
                <ul class="products-grid  owl-carousel">
                    <?php
                    foreach ($records as $key => $value)
                    {
                        $product_title = stripslashes($value['product_title']);
                        $product_url = getProductUrl($value['product_url_key']);
                        ?>
                        <li class="item">
                            <div class="product-action">
                                <a class="product-image" href="<?php echo $product_url; ?>" title="<?php echo $product_title; ?>">
                                    <img class="lazyOwl img-responsive" data-src="<?php echo $value['images_arr'][0]['pi_image_path']; ?>" data-srcX2="<?php echo $records['images_arr'][0]['pi_image_path']; ?>" alt="<?php echo $product_title; ?>"/>
                                </a>
                            </div>
                            <div class="product-content">
                                <h3 class="product-name"><a href="<?php echo $product_url; ?>" title="<?php echo $product_title; ?>"><?php echo $product_title; ?></a></h3>
                                <div class="price-box">
                                    <span class="regular-price">
                                        <span class="price"><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($value['product_price'], 2); ?></span>            
                                    </span>
                                </div>
                                <div class="product-date" data-date=""></div>
                            </div>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <script type="text/javascript">
                decorateList('block-related', 'none-recursive')
                //<![CDATA[
                $$('.related-checkbox').each(function (elem) {
                    Event.observe(elem, 'click', addRelatedToProduct)
                });

                var relatedProductsCheckFlag = false;
                function selectAllRelated(txt) {
                    if (relatedProductsCheckFlag == false) {
                        $$('.related-checkbox').each(function (elem) {
                            elem.checked = true;
                        });
                        relatedProductsCheckFlag = true;
                        txt.innerHTML = "unselect all";
                    } else {
                        $$('.related-checkbox').each(function (elem) {
                            elem.checked = false;
                        });
                        relatedProductsCheckFlag = false;
                        txt.innerHTML = "select all";
                    }
                    addRelatedToProduct();
                }

                function addRelatedToProduct() {
                    var checkboxes = $$('.related-checkbox');
                    var values = [];
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].checked)
                            values.push(checkboxes[i].value);
                    }
                    if ($('related-products-field')) {
                        $('related-products-field').value = values.join(',');
                    }
                }
                //]]>

                jQuery(document).ready(function () {
                    jQuery('.widget-products-related .owl-carousel').owlCarousel({
                        pagination: false,
                        autoPlay: 5000,
                        items: 4,
                        singleItem: false,
                        lazyLoad: true,
                        lazyEffect: false,
                        addClassActive: true,
                        navigation: true,
                        navigationText: ['<div class="fs1" aria-hidden="true" data-icon="#"></div>', '<div class="fs1" aria-hidden="true" data-icon="$"></div>']
                    });
                });
            </script>
        </div>
        <?php
    }
}