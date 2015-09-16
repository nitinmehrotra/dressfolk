<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 newslettter">
    <div class="block block-subscribe">
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