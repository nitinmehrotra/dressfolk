<?php

    if ($_SERVER["HTTP_HOST"] == "www.dressfolk.com" || $_SERVER["HTTP_HOST"] == "dressfolk.com")
    {
        define("SITE_BASE_URL", "http://dressfolk.com/");    // When running on server    
        define("FACEBOOK_APP_ID", "");
        define("FACEBOOK_SECRET_ID", "");
        define('RAZORPAY_KEY', '');
        define('RAZORPAY_SECRET', '');

        // redirect to HTTPS 
//        if ($_SERVER['HTTPS'] != "on")
//        {
//            $redirect = "https://" . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
//            header("Location:$redirect");
//        }

        $host = '';
        $username = '';
        $database = '';
        $password = '';
        $db_debug = FALSE;
    }
    elseif ($_SERVER["REMOTE_ADDR"] == "127.0.0.1")
    {
        define("SITE_BASE_URL", "http://localhost/work/svn/threadcrafts/");    // When running locally
        define("FACEBOOK_APP_ID", "");
        define("FACEBOOK_SECRET_ID", "");
        define('RAZORPAY_KEY', '');
        define('RAZORPAY_SECRET', '');

        $host = 'localhost';
        $username = 'root';
        $database = 'dressfolk';
        $password = '';
        $db_debug = TRUE;
    }

    define('DB_HOST', $host);
    define('DB_USER', $username);
    define('DB_PASS', $password);
    define('DB_NAME', $database);
    define('DB_DEBUG', $db_debug);

    define('IS_LIVE', FALSE);

    if (IS_LIVE == TRUE)
    {
        $paypal_form_url = 'https://www.paypal.com/cgi-bin/webscr';
    }
    else
    {
        $paypal_form_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr';
    }

    define('PAYMENT_GATEWAY_MERCHANT_ID', '');
    define('PAYMENT_GATEWAY_ACCESS_CODE', '');
    define('PAYMENT_GATEWAY_ENCRYPTION_KEY', '');

    $payment_gateway_base_url = "https://secure.ccavenue.com";
    define('PAYMENT_GATEWAY_BASE_URL', $payment_gateway_base_url);
    define("PAYPAL_FORM_URL", $paypal_form_url);
    define("PAYPAL_EMAIL", "dressfolk@gmail.com");

    define("TWITTER_DATA_WIDGET_ID", "1234567890");
    define("FACEBOOK_CALLBACK_URL", SITE_BASE_URL . "index/loginWithFacebook");

    define("SITE_NAME", "Dressfolk");
    define("SITE_TAGLINE", "Some tagline for dressfolk");
    define("SITE_TITLE", SITE_NAME . " | " . SITE_TAGLINE);
    define("SITE_EMAIL", "support@dressfolk.com");
    define("SITE_EMAIL_GMAIL", "dressfolk@gmail.com");
    define("SITE_CONTACT_NUMBER", "+91-9876543210");
    define("SITE_URL", "http://dressfolk.com");
//    define("SITE_BASE_URL", dirname($_SERVER['PHP_SELF']));
    define("SITE_HOST_URL", "http://" . $_SERVER['HTTP_HOST']);
    define("SITE_HTTP_URL", "http://" . $_SERVER['HTTP_HOST'] . SITE_BASE_URL);

    define("SEO_KEYWORDS", "designer, sarees, lehenga, turban, bangles, accessories, ethnic, thread, crafts, bridal, wedding, handicraft, party, authentic, embroidery, leading, dealers");
    define("SEO_DESCRIPTION", "We are the leading dealers, exporters and suppliers of Designer, Bandhej, Bridal, Embroidered, Handwork, Party-wear & Printed Sarees, Ethnic Jodhpur Men's/Women's Wear and Accessories, Turbans, Rajasthani Ethnic Turbans.");

    define("ADMIN_TIMEOUT_TIME", 1800);
    define("SELLER_TIMEOUT_TIME", 1800);
    define("USER_TIMEOUT_TIME", 3600);
    define("USER_IP", $_SERVER["REMOTE_ADDR"]);
    define("USER_AGENT", $_SERVER["HTTP_USER_AGENT"]);

    define("USE_SALT", "mySaltKey");
    define("DEFAULT_CURRENCY", "INR");
    define("DEFAULT_CURRENCY_SYMBOL", "₹");

    define('CSS_PATH', SITE_BASE_URL . 'assets/front/css');
    define('JS_PATH', SITE_BASE_URL . 'assets/front/js');
    define('IMAGES_PATH', SITE_BASE_URL . 'assets/front/images');
    define("ADMIN_ASSETS_PATH", SITE_BASE_URL . "assets/admin/assets");

    define("USER_IMG_WIDTH", 300);
    define("USER_IMG_HEIGHT", 300);
    define("USER_IMG_PATH", SITE_BASE_URL . "/resources/user-images");

    define("SELLER_COVER_IMG_WIDTH", 1100);
    define("SELLER_COVER_IMG_HEIGHT", 360);
    define("SELLER_COVER_IMG_PATH", SITE_BASE_URL . "/resources/seller-cover-images");

    define("SELLER_LOGO_IMG_WIDTH", 400);
    define("SELLER_LOGO_IMG_HEIGHT", 400);
    define("SELLER_LOGO_PATH", "resources/seller-logos");

    $doc_type_array = array('pan card', 'aadhar card', 'electricity bill', 'address proof', 'drivers licence', 'passport', 'ration card');
    define("SELLER_DOC_TYPE_ARRAY", json_encode($doc_type_array));
    define("SELLER_DOC_PATH", "resources/seller-docs");

    define("DISQUS_SHORTNAME", "threadcrafts");
    define("FACEBOOK_SOCIAL_LINK", "https://www.facebook.com/ThreadCraftsIn");
    define("TWITTER_SOCIAL_LINK", "https://twitter.com/ThreadCrafts");
    define("GOOGLE_PLUS_SOCIAL_LINK", "https://www.google.com/+ThreadCraftsJodhpur");
    define("ANDROID_APP_URL", "#");
    define("NO_PRODUCT_IMG_PATH", IMAGES_PATH . "/no-image.png");

    define("PRODUCT_IMG_WIDTH_SMALL", 300);
    define("PRODUCT_IMG_HEIGHT_SMALL", NULL);
    define("PRODUCT_IMG_WIDTH_LARGE", 700);
    define("PRODUCT_IMG_HEIGHT_LARGE", NULL);
    define("PRODUCT_IMG_PATH_LARGE", "resources/product-images");
    define("PRODUCT_IMG_PATH_SMALL", "resources/product-images/small");

    define("PRODUCT_DESC_MIN_LENGTH", 300);

    define("MIN_PRODUCT_IMAGES", 3);
    define("MAX_PRODUCT_IMAGES", 5);

    define("SHIPPING_PARTNER", "gati");
    define("SHIPPING_CODE", "GATI");

    define("TAX_PROFIT_MARGIN_PERCENT", 20);
    define("TAX_PAYPAL_PERCENT", 5);

    define("VAT_TAX_PERCENT", 10.67);
    define("SERVICE_TAX_PERCENT", 14);
    define("PAYMENT_PROCESSING_TAX_PERCENT", 3.5);
    define("CONVENIENCE_FEE_PERCENT", 2);
    