<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class EmailTemplates
    {

        public function registerEmail($full_name, $confirmation_link)
        {
            $str = '<body style="margin: 0;padding: 0; font-family: helvetica;width: 86%;">
                            <div style="display: inline-block;width: 100%; padding: 10px 20px;">
                                <h1 style="margin: 0;">' . SITE_NAME . '</h1>
                                <h3>Confirm your email address</h3>
                                <p>Welcome ' . $full_name . ' !</p>
                                <p>You recently signed up on ' . SITE_NAME . '.</p>
                                <p>Please confirm the email address you signed up with by clicking on the button below.</p>
                                <p><a href="' . $confirmation_link . '" style="padding: 10px 30px; border: 0;background: #06ABF3;color: #FFFFFF;text-decoration: none;display: inline-block;">Confirm Email Address</a></p>
                                <br/>
                                <p style="font-size: 12px;margin: 0;">Or alternatively, you can copy and paste this url in your browser:</p>
                                <p style="font-size: 12px;margin: 0;font-weight: bold;">' . $confirmation_link . '</p>
                                <br/>
                                <p>Warm Regards,</p>
                                <p>' . SITE_NAME . ' Team</p>
                                <p style="margin: 0;"><a href="' . SITE_BASE_URL . '">' . SITE_BASE_URL . '</a></p>
                                <br/>
                                <div style="text-align: center; font-size: 12px;width: 100%;">
                                    <p style="margin: 0;">&copy; ' . date("Y") . '. All Rights Reserved.</p>
                                    <p style="margin: 0;">Your opinion is important to us! Send your ideas and feedback to:</p>
                                    <p style="margin: 0;"><a href="' . SITE_BASE_URL . 'contact">' . SITE_BASE_URL . 'contact</a></p>
                                    <br/>
                                    <p>You can also follow us on:</p>
                                    <p style="margin: 0;">
                                        <a href="' . FACEBOOK_SOCIAL_LINK . '" title="' . SITE_NAME . '">Facebook</a>&nbsp;and&nbsp;
                                        <a href="' . TWITTER_SOCIAL_LINK . '" title="' . SITE_NAME . '">Twitter</a>
                                    </p>
                                </div>
                            </div>
                        </body>';

            return $str;
        }

        public function forgotPassword($full_name, $newPassword)
        {
            $str = '<body style="margin: 0;padding: 0; font-family: helvetica;width: 86%;">
                            <div style="display: inline-block;width: 100%; padding: 10px 20px;">
                                <h1 style="margin: 0;">' . SITE_NAME . '</h1>
                                <h3>Your new password</h3>
                                <p>Hey, ' . $full_name . ' !</p>
                                <p>Looks like you have forgotten your password. We have generated a new password for you.</p>
                                <p>You can login with the new password provided below. Do not forget to change your password once you login.</p>
                                <br/>
                                <p>Your new password is: <strong>' . $newPassword . '</strong></p>
                                <br/>
                                <p>Warm Regards,</p>
                                <p>' . SITE_NAME . ' Team</p>
                                <p style="margin: 0;"><a href="' . SITE_BASE_URL . '">' . SITE_BASE_URL . '</a></p>
                                <br/>
                                <div style="text-align: center; font-size: 12px;width: 100%;">
                                    <p style="margin: 0;">&copy; ' . date("Y") . '. All Rights Reserved.</p>
                                    <p style="margin: 0;">Your opinion is important to us! Send your ideas and feedback to:</p>
                                    <p style="margin: 0;"><a href="' . SITE_BASE_URL . 'contact">' . SITE_BASE_URL . 'contact</a></p>
                                    <br/>
                                    <p>You can also follow us on:</p>
                                    <p style="margin: 0;">
                                        <a href="' . FACEBOOK_SOCIAL_LINK . '" title="' . SITE_NAME . '">Facebook</a>&nbsp;and&nbsp;
                                        <a href="' . TWITTER_SOCIAL_LINK . '" title="' . SITE_NAME . '">Twitter</a>
                                    </p>
                                </div>
                            </div>
                        </body>';
        }

        public function contactUsEmail($full_name, $request_id)
        {
            $str = '<body style="margin: 0;padding: 0; font-family: helvetica;width: 86%;">
                            <div style="display: inline-block;width: 100%; padding: 10px 20px;">
                                <h1 style="margin: 0;">' . SITE_NAME . '</h1>
                                <h3>We have received your request</h3>
                                <p>Hello ' . $full_name . ' !</p>
                                <p>Your request will be processed soon. The request ID generated is <strong>' . $request_id . '</strong>.</p>
                                <p>Please refer to the request ID provided above if needed.</p>
                                <p style="font-size: 12px;margin: 0;">Or alternatively, you can contact us on: ' . SITE_EMAIL . '</p>
                                <br/>
                                <p>Warm Regards,</p>
                                <p>' . SITE_NAME . ' Team</p>
                                <p style="margin: 0;"><a href="' . SITE_BASE_URL . '">' . SITE_BASE_URL . '</a></p>
                                <br/>
                                <div style="text-align: center; font-size: 12px;width: 100%;">
                                    <p style="margin: 0;">&copy; ' . date("Y") . '. All Rights Reserved.</p>
                                    <p style="margin: 0;">Your opinion is important to us! Send your ideas and feedback to:</p>
                                    <p style="margin: 0;"><a href="' . SITE_BASE_URL . 'contact">' . SITE_BASE_URL . 'contact</a></p>
                                    <br/>
                                    <p>You can also follow us on:</p>
                                    <p style="margin: 0;">
                                        <a href="' . FACEBOOK_SOCIAL_LINK . '" title="' . SITE_NAME . '">Facebook</a>&nbsp;and&nbsp;
                                        <a href="' . TWITTER_SOCIAL_LINK . '" title="' . SITE_NAME . '">Twitter</a>
                                    </p>
                                </div>
                            </div>
                        </body>';

            return $str;
        }

        public function newProductAdded($product_url)
        {
            $str = '<body style="margin: 0;padding: 0; font-family: helvetica;width: 86%;">
                            <div style="display: inline-block;width: 100%; padding: 10px 20px;">
                                <h1 style="margin: 0;">' . SITE_NAME . '</h1>
                                <h3>We have introduced a new product in our store.</h3>
                                <p>Hello there !</p>
                                <p>As our valued subscriber we would like to inform you about the new product we have added to our store.</p>
                                <p>Well, it might be a good surprise for you. Or otherwise you may want to gift it to someone special.</p>
                                <p>Take a look by clicking here: ' . $product_url . '</p>
                                <p>Hurry! Grab it fast.</p>
                                <br/>
                                <p>Warm Regards,</p>
                                <p>' . SITE_NAME . ' Team</p>
                                <p style="margin: 0;"><a href="' . SITE_BASE_URL . '">' . SITE_BASE_URL . '</a></p>
                                <br/>
                                <div style="text-align: center; font-size: 12px;width: 100%;">
                                    <p style="margin: 0;">&copy; ' . date("Y") . '. All Rights Reserved.</p>
                                    <p style="margin: 0;">Your opinion is important to us! Send your ideas and feedback to:</p>
                                    <p style="margin: 0;"><a href="' . SITE_BASE_URL . 'contact">' . SITE_BASE_URL . 'contact</a></p>
                                    <br/>
                                    <p>You can also follow us on:</p>
                                    <p style="margin: 0;">
                                        <a href="' . FACEBOOK_SOCIAL_LINK . '" title="' . SITE_NAME . '">Facebook</a>&nbsp;and&nbsp;
                                        <a href="' . TWITTER_SOCIAL_LINK . '" title="' . SITE_NAME . '">Twitter</a>
                                    </p>
                                </div>
                            </div>
                        </body>';

            return $str;
        }

        public function productEdited($product_url)
        {
            $str = '<body style="margin: 0;padding: 0; font-family: helvetica;width: 86%;">
                            <div style="display: inline-block;width: 100%; padding: 10px 20px;">
                                <h1 style="margin: 0;">' . SITE_NAME . '</h1>
                                <h3>We have changed a little bit of information of one of our products.</h3>
                                <p>We thought you might be interested to take a look into it.</p>
                                <p>As our valued subscriber we would like to inform you about this little change we have done in one of our products.</p>
                                <p>Well, it might be interesting to you. Maybe an idea you were looking for yourself or to give a gift to your dear ones.</p>
                                <p>Take a look by clicking here: ' . $product_url . '</p>
                                <p>Hurry! Grab it fast.</p>
                                <br/>
                                <p>Warm Regards,</p>
                                <p>' . SITE_NAME . ' Team</p>
                                <p style="margin: 0;"><a href="' . SITE_BASE_URL . '">' . SITE_BASE_URL . '</a></p>
                                <br/>
                                <div style="text-align: center; font-size: 12px;width: 100%;">
                                    <p style="margin: 0;">&copy; ' . date("Y") . '. All Rights Reserved.</p>
                                    <p style="margin: 0;">Your opinion is important to us! Send your ideas and feedback to:</p>
                                    <p style="margin: 0;"><a href="' . SITE_BASE_URL . 'contact">' . SITE_BASE_URL . 'contact</a></p>
                                    <br/>
                                    <p>You can also follow us on:</p>
                                    <p style="margin: 0;">
                                        <a href="' . FACEBOOK_SOCIAL_LINK . '" title="' . SITE_NAME . '">Facebook</a>&nbsp;and&nbsp;
                                        <a href="' . TWITTER_SOCIAL_LINK . '" title="' . SITE_NAME . '">Twitter</a>
                                    </p>
                                </div>
                            </div>
                        </body>';

            return $str;
        }

        public function invoiceTemplate($client_full_name, $client_address, $order_id, $discount_price, $grand_total_price, $product_quant_unit_arr, $payment_currency = 'Rs.')
        {
            $str = '<body style="margin: 0;padding: 0;font-family: sans-serif;">
                            <div style="padding: 25px;width: 800px;margin: auto;display: table;border: 1px solid #777;border-radius: 4px;box-shadow: 2px 2px 2px #777;">
                                <div id="header">
                                    <div style="display: inline-block;width: 49%;vertical-align: top;">
                                        <h2>Invoice</h2>
                                    </div>
                                    <div style="display: inline-block;width: 49%;float: right;">
                                        <a href="' . SITE_URL . '" style="float: right;"><img src="' . IMAGES_PATH . '/logo-name.png" alt="logo" style="max-width: 250px;"/></a>
                                    </div>
                                </div>

                                <div style="clear: both;"></div>

                                <div style="margin-top: 30px;" id="contact-details">
                                    <div style="display: inline-block;width: 49%;vertical-align: top;">
                                        <p style="margin: 10px 0 0 0;border-bottom: 1px solid #e1e1e1; font-size: 14px;"><span style="width: 100px;display: table;font-weight: bold;">To: </span>' . $client_full_name . '</p>
                                        <p style="margin: 10px 0 0 0;border-bottom: 1px solid #e1e1e1; font-size: 14px;"><span style="width: 100px;display: table;font-weight: bold;">Address: </span>' . $client_address . '</p>
                                        <p style="margin: 10px 0 0 0;border-bottom: 1px solid #e1e1e1; font-size: 14px;"><span style="width: 100px;display: table;font-weight: bold;">Order #: </span>#' . $order_id . '</p>
                                        <p style="margin: 10px 0 0 0;border-bottom: 1px solid #e1e1e1; font-size: 14px;"><span style="width: 100px;display: table;font-weight: bold;">Issued on: </span>' . date('l jS M Y') . '</p>
                                    </div>

                                    <div style="display: inline-block;width: 49%;float: right; text-align: right;">
                                        <p style="margin: 10px 0 0 0;font-size: 14px;"><strong>From: </strong></p>
                                        <p style="margin: 10px 0 0 0;">' . SITE_NAME . '</p>
                                        <p style="margin: 3px 0 0 0;font-size: 12px;"><a href="' . SITE_URL . '">' . str_replace("https://", "", SITE_URL) . '</a></p>
                                    </div>
                                </div>

                                <div style="clear: both;"></div>

                                <div style="margin-top: 50px;" id="product-details">
                                    <table style="width: 100%;">
                                        <thead style="text-align: left;">
                                            <tr>
                                                <th style="border-bottom: 1px solid #e1e1e1; width: 40%; padding: 10px 0;">Product</th>
                                                <th style="border-bottom: 1px solid #e1e1e1; width: 20%; padding: 10px 0; text-align: right;">Quantity</th>
                                                <th style="border-bottom: 1px solid #e1e1e1; width: 20%; padding: 10px 0; text-align: right;">Unit Price</th>
                                                <th style="border-bottom: 1px solid #e1e1e1; width: 20%; padding: 10px 0; text-align: right;">Amount</th>
                                            </tr>
                                        </thead>

                                        <tbody style="font-size: 14px;">';

            $subtotal = 0;
            foreach ($product_quant_unit_arr as $key => $value)
            {
                $product_name = $value['product'];
                $quantity = $value['quantity'];
                $unit_price = $value['unit_price'];
                $amount = round(($quantity * $unit_price), 2);
                $subtotal = $subtotal + $amount;
                $str .= '<tr>
                                <td style="border-bottom: 1px solid #e1e1e1; width: 40%; padding: 10px 0;">' . $product_name . '</td>
                                <td style="border-bottom: 1px solid #e1e1e1; width: 20%; padding: 10px 0; text-align: right;">' . $quantity . '</td>
                                <td style="border-bottom: 1px solid #e1e1e1; width: 20%; padding: 10px 0; text-align: right;">' . $payment_currency . ' ' . $unit_price . '</td>
                                <td style="border-bottom: 1px solid #e1e1e1; width: 20%; padding: 10px 0; text-align: right;">' . $payment_currency . ' ' . $amount . '</td>
                            </tr>';
            }

            $str .= '</tbody>
                            </table>

                            <div style="float: right; display: inline-block; font-size: 14px; margin-top: 30px;">
                                <p style="margin: 10px;"><span style="width: 100px;display: inline-block;">Subtotal: </span> ' . $payment_currency . ' ' . $subtotal . '</p>
                                <p style="margin: 10px;"><span style="width: 100px;display: inline-block;">Discount: </span> ' . $payment_currency . ' ' . $discount_price . '</p>
                                <p style="margin: 10px; font-size: 16px; font-weight: bold;"><span style="width: 100px;display: inline-block;">Total: </span> ' . $payment_currency . ' ' . $grand_total_price . '</p>
                            </div>
                        </div>

                        <div style="clear: both;"></div>

                        <div style="text-align: center; font-size: 12px;color: #777; margin-top: 30px; padding-top: 30px; border-top: 1px solid #777;">
                            <p style="margin: 0;">For any queries, please contact us on <a href="mailto:' . SITE_EMAIL . '">' . SITE_EMAIL . '</a></p>
                            <p style="margin: 0; display: inline-block;">You can also follow us on:</p>&nbsp;
                            <a href="' . FACEBOOK_SOCIAL_LINK . '" title="' . SITE_NAME . '">Facebook</a>&nbsp;and&nbsp;
                            <a href="' . TWITTER_SOCIAL_LINK . '" title="' . SITE_NAME . '">Twitter</a>
                            </p>
                        </div>

                    </div>
                </body>';

            return $str;
        }

    }