<div class="main-breadcrumbs">
    <div class="container">
        <div class="row show-grid">
            <div class="col-lg-12">
            </div>
        </div>
    </div>
</div>
<div class="main-wrapper">
    <div class="main">
        <div class="site-preface"></div>
        <div class="container">
            <div class="row show-grid">
            </div>
        </div>
        <div class="container">
            <div class="row show-grid">
                <div class="col-main">
                    <div class="col-md-6">
                        <div class="account-create">
                            <div class="page-title">
                                <h1>My Addresses</h1>
                            </div>

                            <div class="fieldset">
                                <h2 class="legend">Address details</h2>
                                <?php
                                if (empty($records))
                                {
                                    echo '<h3>No addresses found</h3>';
                                }
                                else
                                {
                                    echo '<ul class="form-list">';
                                    $i = 1;
                                    foreach ($records as $key => $value)
                                    {
                                        ?>                                        
                                        <li class="fields clearfix" style="margin:20px 0;">
                                            <div class="customer-name">
                                                <div class="field name-firstname">
                                                    <div class="pull-left">
                                                        <label><?php echo $i . ') ' . stripslashes($value['ua_line1'] . ' ' . $value['ua_line2'] . ' ' . $value['ua_location'] . ' ' . $value['ua_postcode']); ?></label>
                                                    </div>
                                                    <div class="pull-right">
                                                        <a href="<?php echo base_url('user/removeAddress/' . $value['ua_id']); ?>" onclick="return confirm('Are you sure to remove this address');"><i class="icon_trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>                                        
                                        <?php
                                        $i++;
                                    }
                                    echo '</ul>';
                                }
                                ?>
                            </div>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="account-create">
                            <div class="page-title">
                                <h1>Add address</h1>
                            </div>
                            <form action="" method="post" id="form-validate">
                                <div class="fieldset">
                                    <h2 class="legend">Add address</h2>
                                    <ul class="form-list">
                                        <li class="fields">
                                            <div class="customer-name">
                                                <div class="field">
                                                    <label for="address_line1" class="required"><em>*</em>Address Line 1</label>
                                                    <div class="input-box">
                                                        <input type="text" id="address_line1" name="address_line1" value="" title="Address Line 1" maxlength="255" class="input-text required-entry"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="fields">
                                            <div class="customer-name">
                                                <div class="field">
                                                    <label for="address_line2" class="">Address Line 2</label>
                                                    <div class="input-box">
                                                        <input type="text" id="address_line2" name="address_line2" value="" title="Address Line 2" maxlength="255" class="input-text"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="fields">
                                            <div class="customer-name">
                                                <div class="field">
                                                    <label for="landmark" class="">Landmark</label>
                                                    <div class="input-box">
                                                        <input type="text" id="landmark" name="landmark" value="" title="Landmark" maxlength="255" class="input-text"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="fields">
                                            <div class="customer-name">
                                                <div class="field">
                                                    <label for="location" class="required"><em>*</em>Location</label>
                                                    <div class="input-box">
                                                        <input type="text" id="location" name="location" value="" placeholder="" title="Location" maxlength="255" class="input-text required-entry gMapLocation"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="fields">
                                            <div class="customer-name">
                                                <div class="field">
                                                    <label for="pincode" class="required"><em>*</em>Pincode</label>
                                                    <div class="input-box">
                                                        <input type="text" id="pincode" name="pincode" value="" title="Pincode" maxlength="6" class="input-text required-entry"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="buttons-set">
                                    <div>
                                        <p class="required">* Required Fields</p>
                                    </div>
                                    <button type="submit" title="Add" class="button"><span><span>Add</span></span></button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="deal">
            <div class="row show-grid">
            </div>
        </div>
        <div class="container">
            <div class="row show-grid">
            </div>
        </div>
        <div class="site-postscript"></div>
    </div>
</div>

<!--  = Google Maps API =  -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?libraries=places&amp;sensor=false"></script>
<script type="text/javascript">
                                                            var num_of_inputs = jQuery(".gMapLocation").length;
                                                            var i;
                                                            var loop = num_of_inputs - 1;
                                                            for (i = "0"; i <= loop; i++)
                                                            {
                                                                var input = jQuery(".gMapLocation")[i];
                                                                var autocomplete = new google.maps.places.Autocomplete(input);
                                                            }
</script>