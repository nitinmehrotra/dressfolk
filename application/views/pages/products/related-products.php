<div class="widget-products-related">
    <h3 class="title-widget"><span>Related Products</span></h3>
    <p class="block-subtitle">Check items to add to the cart or&nbsp;<a href="#" onclick="selectAllRelated(this); return false;">select all</a></p>
    <div class="category-products">
        <ul class="products-grid  owl-carousel">
            <li class="item">
                <div class="product-action">
                    <a class="product-image" href="../suit-jacket-in-burgundy.html"
                       title="Suit Jacket In Burgundy">
                        <img
                            class="lazyOwl img-responsive" data-src="../media/catalog/product/cache/4/small_image/360x/040ec09b1e35df139433887a97daa66f/b/u/bungady.jpg" data-srcX2="http://puro.icotheme.com/media/catalog/product/cache/4/small_image/720x/040ec09b1e35df139433887a97daa66f/b/u/bungady.jpg"                                        alt="Suit Jacket In Burgundy"/>
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="product-name">
                        <a href="../suit-jacket-in-burgundy.html"
                           title="Suit Jacket In Burgundy">
                            Suit Jacket In Burgundy                                </a>
                    </h3>



                    <div class="price-box">
                        <span class="regular-price">
                            <span class="price">$145.00</span>                                    </span>

                    </div>

                    <input type="checkbox" class="checkbox related-checkbox" id="related-checkbox20" name="related_products[]" value="20"/>
                    <div class="product-date" data-date=""></div>
                </div>
            </li>
            <li class="item">
                <div class="product-action">
                    <a class="product-image" href="../hr-jasper-blazer-154.html"
                       title="HR Jasper Blazer">
                        <img
                            class="lazyOwl img-responsive" data-src="../media/catalog/product/cache/4/small_image/360x/040ec09b1e35df139433887a97daa66f/v/e/vest7.jpg" data-srcX2="http://puro.icotheme.com/media/catalog/product/cache/4/small_image/720x/040ec09b1e35df139433887a97daa66f/v/e/vest7.jpg"                                        alt="HR Jasper Blazer"/>
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="product-name">
                        <a href="../hr-jasper-blazer-154.html"
                           title="HR Jasper Blazer">
                            HR Jasper Blazer                                </a>
                    </h3>



                    <div class="price-box">
                        <span class="regular-price">
                            <span class="price">$220.00</span>                                    </span>

                    </div>

                    <input type="checkbox" class="checkbox related-checkbox" id="related-checkbox12" name="related_products[]" value="12"/>
                    <div class="product-date" data-date=""></div>
                </div>
            </li>
            <li class="item">
                <div class="product-action">
                    <a class="product-image" href="../island-waistcoat.html"
                       title="Island Waistcoat">
                        <img
                            class="lazyOwl img-responsive" data-src="../media/catalog/product/cache/4/small_image/360x/040ec09b1e35df139433887a97daa66f/v/e/vest8.jpg" data-srcX2="http://puro.icotheme.com/media/catalog/product/cache/4/small_image/720x/040ec09b1e35df139433887a97daa66f/v/e/vest8.jpg"                                        alt="Island Waistcoat"/>
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="product-name">
                        <a href="../island-waistcoat.html"
                           title="Island Waistcoat">
                            Island Waistcoat                                </a>
                    </h3>



                    <div class="price-box">

                        <p class="old-price">
                            <span class="price-label">Regular Price:</span>
                            <span class="price">
                                $230.00                </span>
                        </p>

                        <p class="special-price">
                            <span class="price-label">Special Price</span>
                            <span class="price">
                                $200.00                </span>
                        </p>


                    </div>

                    <input type="checkbox" class="checkbox related-checkbox" id="related-checkbox13" name="related_products[]" value="13"/>
                    <div class="product-date" data-date="2016-03-04 00:00:00"></div>
                </div>
            </li>
            <li class="item">
                <div class="product-action">
                    <a class="product-image" href="../hr-jasper-blazer.html"
                       title="HR Jasper Blazer">
                        <img
                            class="lazyOwl img-responsive" data-src="../media/catalog/product/cache/4/small_image/360x/040ec09b1e35df139433887a97daa66f/v/e/vest1-1.jpg" data-srcX2="http://puro.icotheme.com/media/catalog/product/cache/4/small_image/720x/040ec09b1e35df139433887a97daa66f/v/e/vest1-1.jpg"                                        alt="HR Jasper Blazer"/>
                    </a>
                </div>
                <div class="product-content">
                    <h3 class="product-name">
                        <a href="../hr-jasper-blazer.html"
                           title="HR Jasper Blazer">
                            HR Jasper Blazer                                </a>
                    </h3>



                    <div class="price-box">
                        <span class="regular-price">
                            <span class="price">$220.00</span>                                    </span>

                    </div>

                    <input type="checkbox" class="checkbox related-checkbox" id="related-checkbox11" name="related_products[]" value="11"/>
                    <div class="product-date" data-date=""></div>
                </div>
            </li>
        </ul>
    </div>
    <script type="text/javascript">decorateList('block-related', 'none-recursive')</script>
    <script type="text/javascript">
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
    </script>
    <script type="text/javascript">
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