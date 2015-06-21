<?php
$product_title = stripslashes($record['product_title']);
?>
<div class="main-wrapper">
    <div class="main">
        <div class="container">
            <div class="row show-grid">
                <div class="col-main">
                    <div id="messages_product_view"></div>
                    <div class="product-view">
                        <div class="product-essential show-grid">
                            <form action="" method="post" id="product_addtocart_form">
                                <div class="product-img-box col-md-6 col-sm-6">
                                    <div class="product-img-list">
                                        <div class="more-views-verticle">
                                            <a class="more-views-prev more-views-nav" href="javascript:void(0)" id="carousel-up" style="display: block;">
                                                <i class="fa fa-caret-square-o-up"></i>
                                            </a>

                                            <div class="media-list">
                                                <div id="more-slides" class="verticl-carousel product-image-thumbs">
                                                    <?php
                                                    foreach ($record['images_arr'] as $piKey => $piValue)
                                                    {
                                                        ?>
                                                        <a class="thumb-link" href="#" title="<?php echo $product_title; ?>" data-image-index="0">
                                                            <img class="img-responsive" src="<?php echo getImage($piValue['pi_image_path']); ?>" alt="<?php echo $product_title . '-' . $piKey; ?>"/>
                                                        </a>
                                                        <?php
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <a class="more-views-next more-views-nav" href="javascript:void(0)" id="carousel-down" style="display: block;">
                                                <i class="fa fa-caret-square-o-down"></i>
                                            </a>
                                        </div>
                                        <div class="product-image product-image-zoom">
                                            <div class="product-image-gallery">
                                                <img id="image-main" class="gallery-image visible" src="<?php echo getImage($record['images_arr'][0]['pi_image_path']); ?>" alt="<?php echo $product_title; ?>" title="<?php echo $product_title; ?>"/>
                                                <?php
                                                foreach ($record['images_arr'] as $piKey => $piValue)
                                                {
                                                    ?>
                                                    <img id="image-<?php echo $piKey ?>" class="gallery-image" src="<?php echo getImage($piValue['pi_image_path']); ?>" data-zoom-image="<?php echo getImage($piValue['pi_image_path']); ?>" alt="<?php echo $product_title . '-' . $piKey; ?>" title="<?php echo $product_title . '-' . $piKey; ?>"/>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="product-shop col-md-6 col-sm-6">
                                    <div class="product-shop-wrapper">
                                        <div class="product-name top-product-detail">
                                            <h2><?php echo $product_title; ?></h2>
                                        </div>
                                        <div class="middle-product-detail">
                                            <div class="review-product-details">
                                                <p class="no-rating"><a href="#review-form">Be the first to review this product</a></p>
                                            </div>
                                            <div class="product-type-data">
                                                <div class="price-box">
                                                    <span class="regular-price">
                                                        <span class="price"><?php echo DEFAULT_CURRENCY_SYMBOL . number_format($record['product_price'], 2); ?></span>                 
                                                    </span>
                                                </div>
                                                <p class="availability in-stock">Availability: <span>In stock</span></p>
                                            </div>
                                            <div class="short-description-detail">
                                                <div class="short-description">
                                                    <h2>Quick Overview</h2>
                                                    <div class="std"><?php echo getNWordsFromString(stripslashes($record['product_description']), 150); ?></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="product-options-wrapper" class="product-options">

                                            <dl class="last">
                                                <dt class="swatch-attr">
                                                <label class="required" id="color_label">
                                                    <em>*</em>Color:
                                                    <span class="select-label" id="select_label_color">Black</span>
                                                </label>
                                                </dt>
                                                <dd class="clearfix swatch-attr last">
                                                    <div class="input-box">
                                                        <select class="required-entry super-attribute-select no-display swatch-select validation-failed" id="attribute92" name="super_attribute[92]">
                                                            <option value="">Choose an Option...</option>
                                                            <option value="16" price="0" data-label="black">Black</option><option value="15" price="0" data-label="burgundy">Burgundy</option><option value="10" price="0" data-label="light blue">Light Blue</option><option value="12" price="0" data-label="grey">Grey</option></select><div style="" id="advice-required-entry-attribute92" class="validation-advice">This is a required field.</div>
                                                        <ul class="configurable-swatch-list clearfix" id="configurable_swatch_color">
                                                            <li id="option16" class="option-black is-media selected">
                                                                <a style="height: 23px; width: 23px;" title="Black" class="swatch-link swatch-link-92 has-image" id="swatch16" name="black" href="javascript:void(0)">
                                                                    <span style="height: 21px; width: 21px; line-height: 21px;" class="swatch-label">
                                                                        <img width="21" height="21" alt="Black" src="http://puro.icotheme.com/media/catalog/swatches/2/21x21/media/black.png">
                                                                    </span>
                                                                    <span class="x">X</span>
                                                                </a>
                                                            </li>
                                                            <li id="option15" class="option-burgundy is-media">
                                                                <a style="height: 23px; width: 23px;" title="Burgundy" class="swatch-link swatch-link-92 has-image" id="swatch15" name="burgundy" href="javascript:void(0)">
                                                                    <span style="height: 21px; width: 21px; line-height: 21px;" class="swatch-label">
                                                                        <img width="21" height="21" alt="Burgundy" src="http://puro.icotheme.com/media/catalog/swatches/2/21x21/media/burgundy.png">
                                                                    </span>
                                                                    <span class="x">X</span>
                                                                </a>
                                                            </li>
                                                            <li id="option10" class="option-light-blue is-media">
                                                                <a style="height: 23px; width: 23px;" title="Light Blue" class="swatch-link swatch-link-92 has-image" id="swatch10" name="light-blue" href="javascript:void(0)">
                                                                    <span style="height: 21px; width: 21px; line-height: 21px;" class="swatch-label">
                                                                        <img width="21" height="21" alt="Light Blue" src="http://puro.icotheme.com/media/catalog/swatches/2/21x21/media/light-blue.png">
                                                                    </span>
                                                                    <span class="x">X</span>
                                                                </a>
                                                            </li>
                                                            <li id="option12" class="option-grey is-media">
                                                                <a style="height: 23px; width: 23px;" title="Grey" class="swatch-link swatch-link-92 has-image" id="swatch12" name="grey" href="javascript:void(0)">
                                                                    <span style="height: 21px; width: 21px; line-height: 21px;" class="swatch-label">
                                                                        <img width="21" height="21" alt="Grey" src="http://puro.icotheme.com/media/catalog/swatches/2/21x21/media/grey.png">
                                                                    </span>
                                                                    <span class="x">X</span>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </dd>
                                            </dl>
                                            <p class="required">* Required Fields</p>
                                        </div>
                                        <div class="actions-wrapper">
                                            <div class="add-to-cart">
                                                <div class="input-box pull-left">
                                                    <div class="reduced items" onclick="var result = document.getElementById('qty');
                                                            var qty = result.value;
                                                            if (!isNaN(qty) && qty > 1)
                                                                result.value--;
                                                            return false;">
                                                        <i class="fa fa-minus"></i>
                                                    </div>
                                                    <input type="text" name="qty" id="qty" maxlength="12" value="1" title="Qty" class="input-text qty" />
                                                    <div class="increase items" onclick="var result = document.getElementById('qty');
                                                            var qty = result.value;
                                                            if (!isNaN(qty))
                                                                result.value++;
                                                            return false;">
                                                        <i class="fa fa-plus"></i>
                                                    </div>
                                                </div>
                                                <div class="actions">
                                                    <div class="action-list addtocart">
                                                        <button type="button" title="Add to cart" data-button="<i class='fs1' aria-hidden='true' data-icon=''></i><span>Add to Cart</span>" class="btn-cart" <?php echo isset($this->session->userdata['user_id']) == TRUE ? '' : 'onclick="alert(\'Please login\')"' ?>>
                                                            <span>
                                                                <span>
                                                                    <i class="fs1" aria-hidden="true" data-icon=""></i>
                                                                    <span>Add to Cart</span>
                                                                </span>
                                                            </span>
                                                        </button>
                                                    </div>
                                                    <div class="action-list wishlist">
                                                        <ul class="add-to-links">
                                                            <li class="first wishlist">
                                                                <a href="#" data-productid="<?php echo getEncryptedString($record['product_id']); ?>" class="link-wishlist wishlist-action"><i class="fa <?php echo $is_in_wishlist == FALSE ? 'fa-heart-o' : 'fa-heart'; ?>"></i>Wishlist</a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="product-collateral">
                            <ul id="product-tab" class="nav nav-tabs" role="tablist">
                                <li class=" active first">
                                    <a href="#product_tabs_description" role="tab" data-toggle="tab">More Information</a>
                                </li>
                                <li class="">
                                    <a href="#product_tabs_tabreviews" role="tab" data-toggle="tab">Reviews</a>
                                </li>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <div class="tab-pane in active first" id="product_tabs_description">
                                    <div class="product-tabs-content-inner clearfix">
                                        <h2>Details</h2>
                                        <div class="std"><?php echo stripslashes($record['product_description']); ?></div>
                                    </div>
                                </div>
                                <div class="tab-pane last" id="product_tabs_tabreviews">
                                    <div class="product-tabs-content-inner clearfix">
                                        <div class="box-collateral box-reviews" id="customer-reviews">
                                            <?php
                                            if ($is_reviewed == FALSE)
                                            {
                                                ?>
                                                <div class="form-add">
                                                    <h2>Write Your Own Review</h2>
                                                    <form action="<?php echo base_url('products/saveProductReview'); ?>" method="post" id="review-form">
                                                        <input type="hidden" name="product_id" value="<?php echo getEncryptedString($record['product_id']); ?>"/>
                                                        <fieldset>
                                                            <h3>You're reviewing: <span> <?php echo $product_title; ?></span></h3>
                                                            <h4>How do you rate this product? <em class="required">*</em></h4>
                                                            <span id="input-message-box"></span>
                                                            <table class="data-table" id="product-review-table">
                                                                <col />
                                                                <col width="1" />
                                                                <col width="1" />
                                                                <col width="1" />
                                                                <col width="1" />
                                                                <col width="1" />
                                                                <thead>
                                                                    <tr>
                                                                        <th>&nbsp;</th>
                                                                        <th><span class="nobr">1 star</span></th>
                                                                        <th><span class="nobr">2 stars</span></th>
                                                                        <th><span class="nobr">3 stars</span></th>
                                                                        <th><span class="nobr">4 stars</span></th>
                                                                        <th><span class="nobr">5 stars</span></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <tr>
                                                                        <th>Value</th>
                                                                        <td class="value"><input type="radio" name="ratings[value]" id="Value_1" value="6" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[value]" id="Value_2" value="7" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[value]" id="Value_3" value="8" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[value]" id="Value_4" value="9" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[value]" id="Value_5" value="10" class="radio" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Quality</th>
                                                                        <td class="value"><input type="radio" name="ratings[quality]" id="Quality_1" value="1" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[quality]" id="Quality_2" value="2" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[quality]" id="Quality_3" value="3" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[quality]" id="Quality_4" value="4" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[quality]" id="Quality_5" value="5" class="radio" /></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <th>Price</th>
                                                                        <td class="value"><input type="radio" name="ratings[price]" id="Price_1" value="11" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[price]" id="Price_2" value="12" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[price]" id="Price_3" value="13" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[price]" id="Price_4" value="14" class="radio" /></td>
                                                                        <td class="value"><input type="radio" name="ratings[price]" id="Price_5" value="15" class="radio" /></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                            <input type="hidden" name="validate_rating" class="validate-rating" value="" />
                                                            <script type="text/javascript">decorateTable('product-review-table')</script>
                                                            <ul class="form-list">
                                                                <li>
                                                                    <label for="review_field" class="required"><em>*</em>Comment</label>
                                                                    <div class="input-box">
                                                                        <textarea name="comment" id="review_field" cols="25" rows="2" class="required-entry"></textarea>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </fieldset>
                                                        <div class="buttons-set">
                                                            <?php
                                                            $onlick = '';
                                                            if (!isset($this->session->userdata['user_id']))
                                                            {
                                                                $onlick = 'onclick="alert(\'Please login to review\');return false;"';
                                                            }
                                                            ?>
                                                            <button type="submit" title="Submit Review" class="button" <?php echo $onlick; ?>><span><span>Submit Review</span></span></button>
                                                        </div>
                                                    </form>
                                                </div>
                                                <?php
                                            }
                                            else
                                            {
                                                echo '<h4>You have already reviewed this product</h4>';
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>                       
                        <?php echo $this->load->view('pages/products/related-products', array('product_id' => $record['product_id'])); ?>                                               
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    decorateTable('product-attribute-specs-table');
//    var optionsPrice = new Product.OptionsPrice([]);
    dataZoom = {};
    dataZoom.position = 'inside'

    var lifetime = 3600;
    var expireAt = Mage.Cookies.expires;
    if (lifetime > 0) {
        expireAt = new Date();
        expireAt.setTime(expireAt.getTime() + lifetime * 1000);
    }
    Mage.Cookies.set('external_no_cache', 1, expireAt);
    //<![CDATA[
    var addTagFormJs = new VarienForm('addTagForm');
    function submitTagForm() {
        if (addTagFormJs.validator.validate()) {
            addTagFormJs.form.submit();
        }
    }
    //]]>

    //<![CDATA[
    var dataForm = new VarienForm('review-form');
    Validation.addAllThese(
            [
                ['validate-rating', 'Please select one of each of the ratings above', function (v) {
                        var trs = $('product-review-table').select('tr');
                        var inputs;
                        var error = 1;
                        for (var j = 0; j < trs.length; j++) {
                            var tr = trs[j];
                            if (j > 0) {
                                inputs = tr.select('input');
                                for (i in inputs) {
                                    if (inputs[i].checked == true) {
                                        error = 0;
                                    }
                                }

                                if (error == 1) {
                                    return false;
                                } else {
                                    error = 1;
                                }
                            }
                        }
                        return true;
                    }]
            ]
            );
    //]]>

    jQuery(function ($) {
        var carCount = $('.product-img-box .verticl-carousel').find('a').length;
        if (carCount <= 3) {
            $('.product-img-box .more-views-nav').hide();
        }
        $(".product-img-box #carousel-up").on("click", function () {
            if (!$(".product-img-box .verticl-carousel").is(':animated')) {
                var bottom = $(".product-img-box .verticl-carousel > a:last-child");
                var clone = $(".product-img-box .verticl-carousel > a:last-child").clone();
                clone.prependTo(".product-img-box .verticl-carousel");
                $(".product-img-box .verticl-carousel").animate({
                    "top": "-=85"
                }, 0).stop().animate({
                    "top": '+=85'
                }, 250, function () {
                    bottom.remove();
                });
                ProductMediaManager.init();
            }
        });
        $(".product-img-box #carousel-down").on("click", function () {
            if (!$(".product-img-box .verticl-carousel").is(':animated')) {
                var top = $(".product-img-box .verticl-carousel > a:first-child");
                var clone = $(".product-img-box .verticl-carousel > a:first-child").clone();
                clone.appendTo(".product-img-box .verticl-carousel");
                $(".product-img-box .verticl-carousel").animate({
                    "top": '-=85'
                }, 250, function () {
                    top.remove();
                    $(".product-img-box .verticl-carousel").animate({
                        "top": "+=85"
                    }, 0);
                });
                ProductMediaManager.init();
            }
        });
    });
    //<![CDATA[
    var productAddToCartForm = new VarienForm('product_addtocart_form');
    productAddToCartForm.submit = function (button, url) {
        if (this.validator.validate()) {
            var form = this.form;
            var oldUrl = form.action;
            if (url) {
                form.action = url;
            }
            var e = null;
            try {
                this.form.submit();
            } catch (e) {
            }
            this.form.action = oldUrl;
            if (e) {
                throw e;
            }

            if (button && button != 'undefined') {
                button.disabled = true;
            }
        }
    }.bind(productAddToCartForm);
    productAddToCartForm.submitLight = function (button, url) {
        if (this.validator) {
            var nv = Validation.methods;
            delete Validation.methods['required-entry'];
            delete Validation.methods['validate-one-required'];
            delete Validation.methods['validate-one-required-by-name'];
            // Remove custom datetime validators
            for (var methodName in Validation.methods) {
                if (methodName.match(/^validate-datetime-.*/i)) {
                    delete Validation.methods[methodName];
                }
            }
            if (this.validator.validate()) {
                if (url) {
                    this.form.action = url;
                }
                this.form.submit();
            }
            Object.extend(Validation.methods, nv);
        }
    }.bind(productAddToCartForm);
    //]]>
</script>