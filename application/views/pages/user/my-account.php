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
                                <h1>My Account</h1>
                            </div>
                            <form action="" method="post" id="form-validate">
                                <div class="fieldset">
                                    <h2 class="legend">Personal Information</h2>
                                    <ul class="form-list">
                                        <li class="fields">
                                            <div class="customer-name">
                                                <div class="field name-firstname">
                                                    <label for="firstname" class="required"><em>*</em>Full Name</label>
                                                    <div class="input-box">
                                                        <input type="text" id="firstname" name="fullname" value="<?php echo stripslashes($record['user_fullname']); ?>" title="Full Name" maxlength="255" class="input-text required-entry"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="contact" class="required"><em>*</em>Mobile</label>
                                            <div class="input-box">
                                                <input type="contact" name="contact" id="contact" value="<?php echo stripslashes($record['user_contact']); ?>" title="Mobile" maxlength="10" class="input-text required-entry" />
                                            </div>
                                        </li>
                                        <li class="signup-gender-radio">
                                            <label for="gender" class="required"><em>*</em>Gender</label>
                                            <div class="input-box">
                                                <input type="radio" name="gender" value="male" <?php echo ($record['user_gender'] == 'male' ? 'checked="checked"' : ''); ?> class="input-text" />Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="gender" <?php echo ($record['user_gender'] == 'female' ? 'checked="checked"' : ''); ?> value="female" class="input-text" />Female
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="buttons-set">
                                    <div>
                                        <p class="required">* Required Fields</p>
                                    </div>
                                    <button type="submit" title="Update" class="button"><span><span>Update</span></span></button>
                                </div>
                            </form>
                            <script type="text/javascript">
                                //<![CDATA[
                                var dataForm = new VarienForm('form-validate', true);
                                //]]>
                            </script>
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