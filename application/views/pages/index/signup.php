<!-- // OPEN MAIN CONTAINER // -->
<section class="main-container col1-layout">
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
                        <div class="account-create">
                            <div class="page-title">
                                <h1>Create an Account</h1>
                            </div>
                            <form action="" method="post" id="form-validate">
                                <div class="fieldset">
                                    <input type="hidden" name="success_url" value="" />
                                    <input type="hidden" name="error_url" value="" />
                                    <h2 class="legend">Personal Information</h2>
                                    <ul class="form-list">
                                        <li class="fields">
                                            <div class="customer-name">
                                                <div class="field name-firstname">
                                                    <label for="firstname" class="required"><em>*</em>Full Name</label>
                                                    <div class="input-box">
                                                        <input type="text" id="firstname" name="fullname" value="" title="Full Name" maxlength="255" class="input-text required-entry"  />
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <label for="email_address" class="required"><em>*</em>Email Address</label>
                                            <div class="input-box">
                                                <input type="email" name="email" id="email_address" value="" title="Email Address" class="input-text validate-email required-entry" />
                                            </div>
                                        </li>
                                        <li>
                                            <label for="password" class="required"><em>*</em>Password</label>
                                            <div class="input-box">
                                                <input type="password" name="password" id="password" value="" title="Password" class="input-text required-entry" />
                                            </div>
                                        </li>
                                        <li>
                                            <label for="contact" class="required"><em>*</em>Mobile</label>
                                            <div class="input-box">
                                                <input type="contact" name="contact" id="contact" value="" title="Mobile" maxlength="10" class="input-text required-entry" />
                                            </div>
                                        </li>
                                        <li class="signup-gender-radio">
                                            <label for="gender" class="required"><em>*</em>Gender</label>
                                            <div class="input-box">
                                                <input type="radio" name="gender" value="male" class="input-text required-entry" />Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                <input type="radio" name="gender" checked="checked" value="female" class="input-text required-entry" />Female
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="buttons-set">
                                    <p class="required">* Required Fields</p>
                                    <p class="back-link"><a href="<?php echo goBack(); ?>" class="back-link"><small>&laquo; </small>Back</a></p>
                                    <button type="submit" title="Signup" class="button"><span><span>Submit</span></span></button>
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
</section>
<!--// CLOSE MAIN CONTAINER //-->