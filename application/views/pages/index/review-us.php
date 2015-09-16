<div class="main-wrapper">
    <div class="main">
        <div class="container">
            <div class="row show-grid">
                <div class="col-main">
                    <div class="product-view">
                        <div class="form-add">
                            <h2>Write Your Own Review</h2>
                            <form action="" method="post" id="review-form">
                                <fieldset>
                                    <h3>Review Us</h3>
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>