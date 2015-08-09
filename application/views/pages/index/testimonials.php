<link rel="stylesheet" type="text/css" href="<?php echo CSS_PATH; ?>/../testimonial_page/style.css" media="screen">

<div class="main-wrapper">
    <div class="main">
        <div class="site-preface"></div>
        <div class="container">
            <div class="row show-grid">
            </div>
        </div>
        <div class="container">
            <div class="row show-grid">
                <div class="col-md-12 clearfix">
                    <div class="col-main">
                        <div class="account-create">
                            <div class="page-title">
                                <h1 style="margin: 0">Testimonials</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <?php
                if (!empty($record))
                {
                    ?>
                    <section class="cd-container col-md-12" id="cd-timeline">
                        <?php
                        foreach ($record as $key => $value)
                        {
                            ?>
                            <!-- cd-timeline-content -->
                            <div class="cd-timeline-block">
                                <div class="cd-timeline-img cd-picture">
                                    <img alt="<?php echo stripslashes($value['user_fullname']); ?>" src="<?php echo CSS_PATH; ?>/../testimonial_page/<?php echo stripslashes($value['user_gender']); ?>.png">
                                </div><!-- cd-timeline-img -->
                                <div class="cd-timeline-content">
                                    <h2><?php echo stripslashes($value['user_fullname']); ?></h2>
                                    <p><?php echo stripslashes($value['rating_comment']); ?></p>
                                </div><!-- cd-timeline-content -->
                            </div>
                            <?php
                        }
                        ?>
                    </section>
                    <?php
                }
                else
                {
                    echo '<h3 class="text-center">No testimonials found</h3>';
                }
                ?>
            </div>
        </div>
    </div>
</div>


