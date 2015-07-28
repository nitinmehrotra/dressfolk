<?php
$custom_model = new Custom_model();
$nested_category = $custom_model->getNestedCategories();
?>
<div class="col-left">
    <!-- Category Navigation BOF -->
    <div class="block block-nav">
        <div class="block-title">
            <strong><span>Categories</span></strong>
        </div>
        <div class="block-content">
            <ul id="categories_nav" class="nav-accordion nav-categories">
                <?php
                foreach ($nested_category as $pcKey => $pcValue)
                {
                    ?>
                    <li class="level0 nav-1 active level-top first parent">
                        <a href="<?php echo base_url($pcValue['pc_url']); ?>" class="level-top">
                            <span><?php echo stripslashes($pcValue['pc_name']); ?></span>
                        </a>
                        <?php
                        if (!empty($pcValue['cc_records']))
                        {
                            echo '<ul class="level0">';
                            foreach ($pcValue['cc_records'] as $ccKey => $ccValue)
                            {
                                ?>                                                    
                            <li class="level1 item nav-1-1 first parent">
                                <a href="<?php echo base_url($ccValue['cc_url']); ?>">
                                    <span><?php echo stripslashes($ccValue['cc_name']); ?></span>
                                </a>
                            </li>
                            <?php
                        }
                        echo '</ul>';
                    }
                    ?>
                    </li>
                    <?php
                }
                ?>
            </ul>
        </div>
    </div>
    <!-- Category Navigation EOF --><div class="block block-layered-nav">
        <div class="block-title">
            <strong><span>Shop By</span></strong>
            <span class="mobile-button visible-xs active"></span>
        </div>
        <div class="block-content">
            <dl id="narrow-by-list">
                <dt>Category</dt>
                <dd>
                    <ol>
                        <li>
                            <a href="women-cat=27.html">
                                Styliest Bag                                <span class="count">9</span>
                            </a>
                        </li>
                        <li>
                            <a href="women-cat=28.html">
                                Material Bag                                <span class="count">9</span>
                            </a>
                        </li>
                        <li>
                            <a href="women-cat=29.html">
                                Shoes                                <span class="count">9</span>
                            </a>
                        </li>
                    </ol>
                </dd>
                <dt>Price</dt>
                <dd>
                    <ol>
                        <li>
                            <a href="women-price=100-200.html">
                                <span class="price">$100.00</span> - <span class="price">$199.99</span>                                <span class="count">3</span>
                            </a>
                        </li>
                        <li>
                            <a href="women-price=200-.html">
                                <span class="price">$200.00</span> and above                                <span class="count">12</span>
                            </a>
                        </li>
                    </ol>
                </dd>
                <dt>Manufacturer</dt>
                <dd>
                    <ol class="configurable-swatch-list">
                        <li>
                            <a href="women-manufacturer=21.html" class="swatch-link">
                                <span class="swatch-label">
                                    Chanel                                    </span>
                                <span class="count">1</span>
                            </a>
                        </li>
                        <li>
                            <a href="women-manufacturer=9.html" class="swatch-link">
                                <span class="swatch-label">
                                    Gucci                                    </span>
                                <span class="count">1</span>
                            </a>
                        </li>
                        <li>
                            <a href="women-manufacturer=19.html" class="swatch-link">
                                <span class="swatch-label">
                                    Hermes                                    </span>
                                <span class="count">1</span>
                            </a>
                        </li>
                        <li>
                            <a href="women-manufacturer=22.html" class="swatch-link">
                                <span class="swatch-label">
                                    HM                                    </span>
                                <span class="count">1</span>
                            </a>
                        </li>
                        <li>
                            <a href="women-manufacturer=20.html" class="swatch-link">
                                <span class="swatch-label">
                                    Zara                                    </span>
                                <span class="count">1</span>
                            </a>
                        </li>
                    </ol>
                </dd>
                <dt>Color</dt>
                <dd>
                    <ol class="configurable-swatch-list">
                        <li style="line-height: 24px;">
                            <a href="women-color=18.html" class="swatch-link has-image">
                                <span class="swatch-label" style="height:22px; width:22px;">
                                    <img src="media/catalog/swatches/1/20x20/media/beige.png" alt="Beige" title="Beige"
                                         width="20" height="20"/>
                                </span>
                                <span class="count">3</span>
                            </a>
                        </li>
                        <li style="line-height: 24px;">
                            <a href="women-color=16.html" class="swatch-link has-image">
                                <span class="swatch-label" style="height:22px; width:22px;">
                                    <img src="media/catalog/swatches/1/20x20/media/black.png" alt="Black" title="Black"
                                         width="20" height="20"/>
                                </span>
                                <span class="count">7</span>
                            </a>
                        </li>
                        <li style="line-height: 24px;">
                            <a href="women-color=15.html" class="swatch-link has-image">
                                <span class="swatch-label" style="height:22px; width:22px;">
                                    <img src="media/catalog/swatches/1/20x20/media/burgundy.png" alt="Burgundy" title="Burgundy"
                                         width="20" height="20"/>
                                </span>
                                <span class="count">2</span>
                            </a>
                        </li>
                        <li style="line-height: 24px;">
                            <a href="women-color=10.html" class="swatch-link has-image">
                                <span class="swatch-label" style="height:22px; width:22px;">
                                    <img src="media/catalog/swatches/1/20x20/media/light-blue.png" alt="Light Blue" title="Light Blue"
                                         width="20" height="20"/>
                                </span>
                                <span class="count">1</span>
                            </a>
                        </li>
                        <li style="line-height: 24px;">
                            <a href="women-color=11.html" class="swatch-link has-image">
                                <span class="swatch-label" style="height:22px; width:22px;">
                                    <img src="media/catalog/swatches/1/20x20/media/navi.png" alt="Navi" title="Navi"
                                         width="20" height="20"/>
                                </span>
                                <span class="count">1</span>
                            </a>
                        </li>
                        <li style="line-height: 24px;">
                            <a href="women-color=14.html" class="swatch-link has-image">
                                <span class="swatch-label" style="height:22px; width:22px;">
                                    <img src="media/catalog/swatches/1/20x20/media/red.png" alt="Red" title="Red"
                                         width="20" height="20"/>
                                </span>
                                <span class="count">2</span>
                            </a>
                        </li>
                        <li style="line-height: 24px;">
                            <a href="women-color=8.html" class="swatch-link has-image">
                                <span class="swatch-label" style="height:22px; width:22px;">
                                    <img src="media/catalog/swatches/1/20x20/media/white.png" alt="White" title="White"
                                         width="20" height="20"/>
                                </span>
                                <span class="count">3</span>
                            </a>
                        </li>
                    </ol>
                </dd>
                <dt>Size</dt>
                <dd>
                    <ol class="configurable-swatch-list">
                        <li>
                            <a href="women-size=4.html" class="swatch-link">
                                <span class="swatch-label">
                                    L                                    </span>
                                <span class="count">2</span>
                            </a>
                        </li>
                        <li>
                            <a href="women-size=5.html" class="swatch-link">
                                <span class="swatch-label">
                                    M                                    </span>
                                <span class="count">8</span>
                            </a>
                        </li>
                    </ol>
                </dd>
            </dl>
            <script type="text/javascript">decorateDataList('narrow-by-list')</script>
        </div>
    </div>
</div>