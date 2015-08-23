<?php
$model = new Common_model();
$static_record = $model->fetchSelectedData('static_page_content', TABLE_STATIC_PAGES, array('static_page_key' => 'about-us-short'));
?>
</section>
<!--// CLOSE MAIN CONTAINER //-->
<!-- // FOOTER // -->
<footer class="footer-wrapper">
    <div class="footer-top">
        <div class="container">
            <div class="footer-container">
                <div class="row show-grid">
                    <div class="block-container footer-top" id="block-footer">
                        <div class="">
                            <div class="">
                                <div class="about-social col-lg-4 col-md-4 col-sm-4 col-xs-12">
                                    <div class="about"><img alt="logo" src="<?php echo FRONT_ASSETS_PATH; ?>/wysiwyg/icotheme/puro/logo/logo_puro.png" />
                                        <div class="about-text"><p><?php echo stripslashes($static_record[0]['static_page_content']); ?></p></div>
                                        <div class="social">
                                            <div class="title-footer">FOLLOW US</div>
                                            <ul class="social-icons small light">
                                                <li class="facebook"><a class="fa fa-facebook" href="<?php echo FACEBOOK_SOCIAL_LINK; ?>" target="_blank"><span>Facebook</span></a></li>
                                                <li class="twitter"><a class="fa fa-twitter" href="<?php echo TWITTER_SOCIAL_LINK; ?>" target="_blank"><span>Twitter</span></a></li>
                                                <li class="instagram"><a class="fa fa-instagram" href="<?php echo INSTAGRAM_SOCIAL_LINK; ?>" target="_blank"><span>Behance</span></a></li>
                                                <li class="gplus"><a class="fa fa-google-plus" href="<?php echo GOOGLE_PLUS_SOCIAL_LINK; ?>" target="_blank"><span>Google plus</span></a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="list-footer col-lg-8 col-md-8 col-sm-8 col-xs-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newslettter">    <div class="block block-subscribe">
                                                <div class="block-title">
                                                    <span>Newsletter Signup</span>
                                                </div>
                                                <form action="<?php echo base_url('index/saveNewsletter'); ?>" method="post" id="newsletter-validate-detail">
                                                    <div class="block-content">
                                                        <div class="form-subscribe-header">
                                                            <div class="input-box">
                                                                <input type="hidden" name="url" value="<?php echo current_url(); ?>"/>
                                                                <input type="email" name="email" id="newsletter" title="Sign up for our newsletter" class="input-text required-entry validate-email"/>
                                                            </div>
                                                            <div class="actions">
                                                                <button type="submit" title="Subscribe" class="button"><span><span>Subscribe</span></span></button>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </form>
                                                <script type="text/javascript">
                                                    //<![CDATA[
                                                    var newsletterSubscriberFormDetail = new VarienForm('newsletter-validate-detail');
                                                    //]]>
                                                </script>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-links">
                                            <div class="footer-links">
                                                <div class="row">
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 info-footer">
                                                        <div class="footer-block-title">
                                                            <h3>Infomation<span class="mobile-button visible-xs active">accordion-footer</span></h3>
                                                        </div>
                                                        <div class="custom-footer-content">
                                                            <ul class="footer-list">
                                                                <li><span class="widget widget-cms-link"><a href="<?php echo base_url('about-us'); ?>" title="About Us"><span>About Us</span></a></span>
                                                                </li>
                                                                <li><span class="widget widget-cms-link"><a href="<?php echo base_url('contact-us'); ?>" title="Contact Us"><span>Contact Us</span></a></span>
                                                                </li>
                                                                <li><span class="widget widget-cms-link"><a href="<?php echo base_url('terms'); ?>" title="Term &amp; Conditions"><span>Term &amp; Conditions</span></a></span>
                                                                </li>
                                                                <li><span class="widget widget-cms-link"><a href="<?php echo base_url('privacy-policy'); ?>" title="Privacy Policy"><span>Privacy Policy</span></a></span>
                                                                </li>
                                                                <li><span class="widget widget-cms-link"><a href="<?php echo base_url('return-policy'); ?>" title="Return Policy"><span>Return Policy</span></a></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 info-footer">
                                                        <div class="footer-block-title">
                                                            <h3>Why choose<span class="mobile-button visible-xs active">accordion-footer</span></h3>
                                                        </div>
                                                        <div class="custom-footer-content">
                                                            <ul class="footer-list">
                                                                <li><span class="widget widget-cms-link"><a href="<?php echo base_url('all-products'); ?>" title="All Products"><span>All Products</span></a></span>
                                                                </li>
                                                                <li><span class="widget widget-cms-link"><a href="<?php echo base_url('review-us'); ?>" title="Review Us"><span>Review Us</span></a></span>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 info-footer">
                                                        <div class="footer-block-title">
                                                            <h3>My Account<span class="mobile-button visible-xs active">accordion-footer</span></h3>
                                                        </div>
                                                        <div class="custom-footer-content">
                                                            <ul class="footer-list">
                                                                <?php
                                                                if (!isset($this->session->userdata['user_id']))
                                                                {
                                                                    ?>
                                                                    <li><span class="widget widget-cms-link"><a href="<?php echo base_url('login'); ?>" title="Login"><span>Login</span></a></span>
                                                                    </li>
                                                                    <li><span class="widget widget-cms-link"><a href="<?php echo base_url('signup'); ?>" title="Sign Up"><span>Sign Up</span></a></span>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                else
                                                                {
                                                                    ?>
                                                                    <li><span class="widget widget-cms-link"><a href="<?php echo base_url('my-wishlist'); ?>" title="My Wishlist"><span>My Wishlist</span></a></span>
                                                                    </li>
                                                                    <li><span class="widget widget-cms-link"><a href="<?php echo base_url('cart'); ?>" title="View Cart"><span>View Cart</span></a></span>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>       
                            </div>
                        </div>
                        <script type="text/javascript">
                            jQuery(document).ready(function () {
                                jQuery('#block-footer .owl-carousel').owlCarousel({"enable": false, "pagination": false, "autoPlay": false, "items": 2, "singleItem": false, "lazyLoad": true, "lazyEffect": false, "addClassActive": true, "navigation": false, "navigationText": [null, null]});
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-container">
                <div class="row show-grid">
                </div>
                <div id="back-top" class="hidden-phone">
                    <a href="#top">
                        <div class="sticker-wrapper">
                            <div class="sticker" title="Back to Top">
                                <i class="fa fa-angle-up"></i>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-copyright">
        <div class="container">
            <div class="row">
                <div class="col-lg-8"><address>Copyright &copy; <?php echo date('Y'); ?> <a href="<?php echo base_url(); ?>" target="_blank"><?php echo SITE_NAME; ?></a>. All rights reserved.</address></div>
                <div class="col-lg-4"></div>
            </div>
        </div>
    </div>
</footer>
<script type="text/javascript">
    var frontendData = {};
    frontendData.confGridEqualHeight = true;
    frontendData.displayAddtocart = '2';
    frontendData.displayAddtolink = '1';
    frontendData.compareHeader = '1';
    frontendData.logo = 'logo_puro.png';
    frontendData.logoHome = 'logo_puro_2.png';
    frontendData.logoRetina = 'logo_puro_1.png';
    frontendData.logoHomeRetina = 'logo_puroX2.png';
    frontendData.colFull = '3';
    frontendData.col768_640 = '3';
    frontendData.col480_640 = '2';
    frontendData.col480 = '2';
    frontendData.enableSticky = true;
    frontendData.enableAjax = true;
</script>
<script type="text/javascript" src="<?php echo JS_PATH; ?>/frontend.js"></script>
<script type="text/javascript" src="<?php echo JS_PATH; ?>/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
<script>
    $ = jQuery;
    jQuery(document).ready(function () {
        jQuery('.datepicker').datepicker();

        jQuery(document).on('click', 'a.wishlist-action', function (e) {
            e.preventDefault();
            var is_loggedin = '<?php echo isset($this->session->userdata['user_id']) == true ? "1" : "0"; ?>';
            if (is_loggedin == '0')
            {
                alert('Please login');
                return false;
            }
            else
            {
                var product_id = jQuery(this).attr('data-productid');
                var obj = jQuery(this);
                jQuery.ajax({
                    type: 'POST',
                    dataType: 'json',
                    url: '<?php echo base_url('products/wishlistActionAjax'); ?>',
                    data: {product_id: product_id},
                    success: function (response) {
                        if (response.response == 'added')
                        {
                            obj.children().removeClass('fa-heart-o');
                            obj.find('.fa').addClass('fa-heart');
                        }
                        else if (response.response == 'removed')
                        {
                            obj.find('.fa').addClass('fa-heart-o');
                            obj.find('.fa').removeClass('fa-heart');
                        }
                        else if (response.response == 'error')
                        {
                            alert(response.text);
                        }
                    }
                });
            }
        });

        $('.form-search ul.dropdown-menu li a').click(function () {
            var cat_id = $(this).attr('data-value');
            var cat_name = $(this).html();
            $('.category-filter button span.category-label').html(cat_name);
            $('.search_cat_id').val(cat_id);
        })
    })
</script>
</body>
</html>