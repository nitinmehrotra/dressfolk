<div class="main-wrapper">
    <div class="container">
        <div class="main">
            <div class="row show-grid">
                <div class="col-lg-12">
                    <div class="site-preface"></div>
                </div>
            </div>
            <div class="row show-grid">
                <div class="col-lg-12">
                </div>
            </div>
            <div class="row show-grid">
                <div class="col-lg-12">
                    <div class="col-main">
                        <div class="std">
                            <div class="page-title text-center">
                                <h1>Testimonials</h1>
                            </div>
                            <?php
                            if (!empty($record))
                            {
                                foreach ($record as $key => $value)
                                {
                                    ?>
                                    <div class="testimonial-row">
                                        <h4><?php echo stripslashes($value['user_fullname']); ?></h4>
                                        <p><?php echo stripslashes($value['rating_comment']); ?></p>
                                    </div>
                                    <?php
                                }
                            }
                            else
                            {
                                ?>
                            <div class="text-center"><p>Testimonials coming soon!</p></div>
                                <?php
                            }
                            ?>
                        </div>     
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>