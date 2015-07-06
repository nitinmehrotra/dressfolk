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
                    <div class="account-login">
                        <div class="page-title">
                            <h1>Login or Create an Account</h1>
                        </div>
                        <form action="" method="post" id="login-form">
                            <div class="col2-set">
                                <div class="col-1 new-users">
                                    <div class="content">
                                        <h2>New Customers</h2>
                                        <p>By creating an account with our store, you will be able to move through the checkout process faster, store multiple shipping addresses, view and track your orders in your account and more.</p>
                                    </div>
                                    <div class="buttons-set">
                                        <button type="button" title="Create an Account" class="button" onclick="window.location = '<?php echo base_url('signup'); ?>';"><span><span>Create an Account</span></span></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col2-set2">
                                <div class="col-2 registered-users">
                                    <div class="content">
                                        <h2>Registered Customers</h2>
                                        <div class="text-center">
                                            <button type="submit" class="button" title="Login with Facebook" onclick="window.location = '<?php echo base_url('facebook-login'); ?>';"><span><span>Login with Facebook</span></span></button>
                                        </div>
                                        <p>Or, If you have an account with us, please log in.</p>
                                        <input type="hidden" name="url" value="<?php echo isset($_GET['next']) == true ? $_GET['next'] : base_url(); ?>"/>
                                        <ul class="form-list">
                                            <li>
                                                <label for="email" class="required"><em>*</em>Email Address</label>
                                                <div class="input-box">
                                                    <input type="email" name="email" value="" id="email" class="input-text required-entry validate-email" title="Email Address" />
                                                </div>
                                            </li>
                                            <li>
                                                <label for="pass" class="required"><em>*</em>Password</label>
                                                <div class="input-box">
                                                    <input type="password" name="password" class="input-text required-entry validate-password" id="pass" title="Password" />
                                                </div>
                                            </li>
                                        </ul>
                                        <p class="required">* Required Fields</p>
                                    </div>
                                    <div class="buttons-set">
                                        <a href="<?php echo base_url('forgot-password'); ?>" class="f-left">Forgot Your Password?</a>
                                        <button type="submit" class="button" title="Login" name="send" id="send2"><span><span>Login</span></span></button>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <script type="text/javascript">
                            //<![CDATA[
                            var dataForm = new VarienForm('login-form', true);
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