
<div class="container">
    <div class="push-up blocks-spacer">
        <div class="row">

            <!--  ==========  -->
            <!--  = Sidebar =  -->
            <!--  ==========  -->
            <aside class="span3 left-sidebar" id="tourStep1">
                <div class="sidebar-item sidebar-filters" id="sidebarFilters">

                    <!--  ==========  -->
                    <!--  = Sidebar Title =  -->
                    <!--  ==========  -->
                    <div class="underlined">
                        <h3><span class="light">Shop</span> by filters</h3>
                    </div>

                    <!--  ==========  -->
                    <!--  = Categories =  -->
                    <!--  ==========  -->
                    <div class="accordion-group" id="tourStep2">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" href="#filterOne">Categories <b class="caret"></b></a>
                        </div>
                        <div id="filterOne" class="accordion-body collapse in">
                            <div class="accordion-inner">

                                <?php
                                    $exclude_cat_arr = array();
                                    foreach ($category_name_records as $cKey => $cValue)
                                    {
                                        if (!in_array($cValue, $exclude_cat_arr))
                                        {
                                            $exclude_cat_arr[] = $cValue;
                                            echo '<a href="#" data-target=".filter--' . $cValue . '" class="selectable"><i class="box"></i> ' . $cValue . '</a>';
                                        }
                                    }
                                ?>

                            </div>
                        </div>
                    </div> <!-- /categories -->

                    <!--  ==========  -->
                    <!--  = Prices slider =  -->
                    <!--  ==========  -->
                    <div class="accordion-group">
                        <div class="accordion-heading">
                            <a class="accordion-toggle" data-toggle="collapse" href="#filterPrices">Price <b class="caret"></b></a>
                        </div>
                        <div id="filterPrices" class="accordion-body in collapse" data-currency="<?php echo DEFAULT_CURRENCY_SYMBOL; ?>">
                            <div class="accordion-inner with-slider">
                                <div class="jqueryui-slider-container">
                                    <div id="pricesRange"></div>
                                </div>
                                <?php
                                    $model = new Common_model();
                                    $sql = 'SELECT MAX(product_price) as max_price, MIN(product_price) as min_price FROM ' . TABLE_PRODUCTS;
                                    $record = $this->db->query($sql)->result_array();
                                ?>
                                <input type="text" data-initial="<?php echo ceil($record[0]['max_price']); ?>" class="max-val pull-right" disabled />
                                <input type="text" data-initial="<?php echo round($record[0]['min_price']); ?>" class="min-val" disabled />
                            </div>
                        </div>
                    </div> <!-- /prices slider -->

                    <a href="#" class="remove-filter" id="removeFilters"><span class="icon-ban-circle"></span> Remove All Filters</a>

                </div>

                <div class="" id="google-ads">
                    <?php
                        if (USER_IP != '127.0.0.1')
                        {
                            echo getGoogleAdCode();
                        }
                    ?>
                </div>        
            </aside> <!-- /sidebar -->

            <!--  ==========  -->
            <!--  = Main content =  -->
            <!--  ==========  -->
            <section class="span9">

                <!--  ==========  -->
                <!--  = Title =  -->
                <!--  ==========  -->
                <div class="underlined push-down-20">
                    <div class="row">
                        <div class="span4">
                            <h3><?php echo $product_page_heading; ?></h3>
                        </div>
                        <div class="span5 align-right sm-align-left">
                            <div class="form-inline sorting-by" id="tourStep4">
                                <label for="isotopeSorting" class="black-clr">Sort:</label>
                                <select id="isotopeSorting" class="span3">
                                    <option value='{"sortBy":"price", "sortAscending":"true"}'>By Price (Low to High) &uarr;</option>
                                    <option value='{"sortBy":"price", "sortAscending":"false"}'>By Price (High to Low) &darr;</option>
                                    <option value='{"sortBy":"name", "sortAscending":"true"}'>By Name (Low to High) &uarr;</option>
                                    <option value='{"sortBy":"name", "sortAscending":"false"}'>By Name (High to Low) &darr;</option>
                                    <option value='{"sortBy":"popularity", "sortAscending":"true"}'>By Popularity (Low to High) &uarr;</option>
                                    <option value='{"sortBy":"popularity", "sortAscending":"false"}'>By Popularity (High to Low) &darr;</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div> <!-- /title -->

                <!--  ==========  -->
                <!--  = Products =  -->
                <!--  ==========  -->
                <div class="row popup-products">
                    <div id="isotopeContainer" class="isotope-container">

                        <?php
                            $no_results_found = TRUE;
                            if (!empty($records))
                            {
                                $no_results_found = FALSE;
                                foreach ($records as $key => $value)
                                {
//                                    prd($value);
                                    $product_id = $value["product_id"];
                                    $product_title = stripslashes($value["product_title"]);
                                    $product_price = $value["product_price"];
                                    $category_name = $value["cc_name"];
                                    $product_brand = getSellerDisplayName($value['seller_fullname'], $value['seller_company_name']);
                                    $product_image = getImage($value['pi_image_path']);
                                    $product_size = '';
                                    $product_color = '';
                                    ?>

                                    <!--  ==========  -->
                                    <!--  = Single Product =  -->
                                    <!--  ==========  -->
                                    <div class="span3 isotope--target filter--<?php echo $category_name ?>" data-price="<?php echo $product_price; ?>" data-popularity="2" data-size="<?php echo $product_size; ?>" data-color="<?php echo $product_color; ?>" data-brand="<?php echo $product_brand; ?>">
                                        <div class="product">
                                            <div class="product-inner">
                                                <div class="product-img">
                                                    <div class="picture">
                                                        <img class="lazy" width="540" height="374" alt="<?php echo $product_title; ?>" src="<?php echo $product_image; ?>" data-original="<?php echo $product_image; ?>" />
                                                        <div class="img-overlay">
                                                            <a class="btn more btn-primary" href="<?php echo getProductUrl($product_url_key); ?>">View</a>
                                                            <!--<a class="btn buy btn-danger" href="<?php echo base_url("products/addToCartGet/$product_id"); ?>">Add to Cart</a>-->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="main-titles no-margin">
                                                    <h4 class="title"><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($product_price, 2); ?></h4>
                                                    <h5 class="no-margin isotope--title"><?php echo $product_title; ?></h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- /single product -->

                                    <?php
                                }
                            }
                        ?>

                    </div>
                    <?php
                        if ($no_results_found)
                            echo '<div class="span5"><p>Sorry, no matching results found.</p></div>';
                    ?>
                </div>
                <hr />
            </section> <!-- /main content -->
        </div>
    </div>
</div> <!-- /container -->