<?php

    function getGoogleAdCode()
    {
        $str = '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
                        <!-- Threadcrafts main site -->
                        <ins class="adsbygoogle"
                             style="display:block"
                             data-ad-client="ca-pub-7594968339633253"
                             data-ad-slot="9552075722"
                             data-ad-format="auto"></ins>
                        <script>
                        (adsbygoogle = window.adsbygoogle || []).push({});
                    </script>';
        return $str;
    }

    function getFinalPriceForCheckout($subtotal, $discount_percent = '0', $shipping_charge = '0', $vat_percent = VAT_TAX_PERCENT)
    {
        $output = $subtotal;
        if ($discount_percent != '0')
        {
            $output = $subtotal - ($subtotal * ($discount_percent / 100));
        }
        $output = $output + $shipping_charge;
        $output = $output + ($output * ($vat_percent / 100));
        return $output;
    }

    function getSellerDisplayName($seller_fullname, $seller_company_name)
    {
        if (empty($seller_company_name))
        {
            return stripslashes($seller_fullname);
        }
        else
        {
            return stripslashes($seller_company_name);
        }
    }

    function changeSellerCover($seller_id)
    {
        require_once APPPATH . '/models/common_model.php';
        $model = new Common_model();

        // get the extension of the image
        $ext = getFileExtension($_FILES['cover_img']['name']);
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

        list($img_width, $img_height, $img_type, $img_attr) = getimagesize($_FILES["cover_img"]['tmp_name']);

        // if a valid image
        if (in_array(strtolower($ext), $allowed_ext) && $img_width == SELLER_COVER_IMG_WIDTH && $img_height == SELLER_COVER_IMG_HEIGHT)
        {
            // unlink the previous image
            $seller_record = $model->fetchSelectedData('seller_cover_image', TABLE_SELLER, array('seller_id' => $seller_id));
            if (!empty($seller_record[0]['seller_cover_image']))
            {
                @unlink($seller_record[0]['seller_cover_image']);
            }

            // get a random image name
            $fileName = getUniqueCoverImageName($ext);
            // upload the image
            uploadImage($_FILES['cover_img']['tmp_name'], $fileName, SELLER_COVER_IMG_PATH, SELLER_COVER_IMG_WIDTH, SELLER_COVER_IMG_HEIGHT);

            // update into the database
            $cover_image_name = SELLER_COVER_IMG_PATH . '/' . $fileName;
            $model->updateData(TABLE_SELLER, array('seller_cover_image' => $cover_image_name), array('seller_id' => $seller_id));
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function changeSellerLogo($seller_id)
    {
        require_once APPPATH . '/models/common_model.php';
        $model = new Common_model();

        // get the extension of the image
        $ext = getFileExtension($_FILES['logo_img']['name']);
        $allowed_ext = array('jpg', 'jpeg', 'png', 'gif');

        list($img_width, $img_height, $img_type, $img_attr) = getimagesize($_FILES["logo_img"]['tmp_name']);

        // if a valid image
        if (in_array(strtolower($ext), $allowed_ext) && $img_width == SELLER_COVER_IMG_WIDTH && $img_height == SELLER_COVER_IMG_HEIGHT)
        {
            // unlink the previous image
            $seller_record = $model->fetchSelectedData('seller_logo_image', TABLE_SELLER, array('seller_id' => $seller_id));
            if (!empty($seller_record[0]['seller_logo_image']))
            {
                @unlink($seller_record[0]['seller_logo_image']);
            }

            // get a random image name
            $fileName = getUniqueSellerLogoImageName($ext);
            // upload the image
            uploadImage($_FILES['logo_img']['tmp_name'], $fileName, SELLER_LOGO_PATH, SELLER_LOGO_IMG_WIDTH, SELLER_LOGO_IMG_HEIGHT);

            // update into the database
            $logo_image_name = SELLER_LOGO_PATH . '/' . $fileName;
            $model->updateData(TABLE_SELLER, array('seller_logo_image' => $logo_image_name), array('seller_id' => $seller_id));
            return TRUE;
        }
        else
        {
            return FALSE;
        }
    }

    function getUniqueContactRequestId($id, $string_length = 8)
    {
        require_once APPPATH . '/models/common_model.php';
        $model = new Common_model();
        $random_number = getRandomNumberLength($id . time(), $string_length);
        $is_exists = $model->is_exists('wc_id', TABLE_WEBSITE_CONTACT, array('wc_request_id' => $random_number));
        if (!empty($is_exists))
        {
            $random_number = getUniqueContactRequestId($id, $string_length);
        }

        return $random_number;
    }

    function getUniqueOrderId($id, $string_length = 6)
    {
        require_once APPPATH . '/models/common_model.php';
        $model = new Common_model();
        $random_number = 'TCO' . getRandomNumberLength($id . time(), $string_length);
        $is_exists = $model->is_exists('sod_id', TABLE_SHIPPING_ORDER_DETAILS, array('sod_order_id' => $random_number));
        if (!empty($is_exists))
        {
            $random_number = getUniqueOrderId($id, $string_length);
        }

        return $random_number;
    }

    function getUniqueSellerDocumentName($ext, $string_length = 15)
    {
        require_once APPPATH . '/models/common_model.php';
        $model = new Common_model();
        $random_number = getRandomNumberLength(time(), $string_length) . '.' . $ext;
        $doc_path = SELLER_DOC_PATH . '/' . $random_number;
        $is_exists = $model->is_exists('sdc_id', TABLE_SELLER_DOCUMENTS, array('sdc_document_path' => $doc_path));
        if (!empty($is_exists))
        {
            $random_number = getUniqueSellerDocumentName($ext, $string_length);
        }

        return $random_number;
    }

    function getUniqueSellerLogoImageName($ext, $string_length = 15)
    {
        require_once APPPATH . '/models/common_model.php';
        $model = new Common_model();
        $random_number = getRandomNumberLength(time(), $string_length) . '.' . $ext;
        $image_name = SELLER_LOGO_PATH . '/' . $random_number;
        $is_exists = $model->is_exists('seller_id', TABLE_SELLER, array('seller_logo_image' => $image_name));
        if (!empty($is_exists))
        {
            $random_number = getUniqueSellerLogoImageName($ext, $string_length);
        }

        return $random_number;
    }

    function getUniqueSellerCoverImageName($ext, $string_length = 15)
    {
        require_once APPPATH . '/models/common_model.php';
        $model = new Common_model();
        $random_number = getRandomNumberLength(time(), $string_length) . '.' . $ext;
        $image_name = SELLER_COVER_IMG_PATH . '/' . $random_number;
        $is_exists = $model->is_exists('seller_id', TABLE_SELLER, array('seller_cover_image' => $image_name));
        if (!empty($is_exists))
        {
            $random_number = getUniqueSellerCoverImageName($string_length);
        }

        return $random_number;
    }

    function isValidImageExt($ext)
    {
        $valid_ext_Arr = array('jpg', 'jpeg', 'png', 'gif');
        $returnValue = TRUE;
        if (!in_array(strtolower($ext), $valid_ext_Arr))
        {
            $returnValue = FALSE;
        }

        return $returnValue;
    }

    function getOrderStatusText($status)
    {
        if ($status == '0')
        {
            $text = 'New';
        }
        elseif ($status == '1')
        {
            $text = 'Dispatched';
        }
        elseif ($status == '2')
        {
            $text = 'Delivered';
        }
        elseif ($status == '3')
        {
            $text = 'Cancelled';
        }
        elseif ($status == '4')
        {
            $text = 'Rejected';
        }

        return $text;
    }

    function getWebsiteContactStatusText($status)
    {
        if ($status == '0')
        {
            $text = 'Rejected';
        }
        elseif ($status == '1')
        {
            $text = 'Resolved';
        }
        elseif ($status == '2')
        {
            $text = 'Open';
        }
        elseif ($status == '3')
        {
            $text = 'Pending';
        }

        return $text;
    }

    function getSellerStatusText($seller_status)
    {
        if ($seller_status == '0')
        {
            $text = 'Deactivated';
        }
        elseif ($seller_status == '1')
        {
            $text = 'Activated';
        }
        elseif ($seller_status == '2')
        {
            $text = 'Waiting for activation';
        }
        elseif ($seller_status == '3')
        {
            $text = 'Rejected';
        }

        return $text;
    }

    function getSellerDocumentStatusText($code)
    {
        if ($code == '0')
        {
            $text = 'Rejected';
        }
        elseif ($code == '1')
        {
            $text = 'Approved';
        }
        elseif ($code == '2')
        {
            $text = 'Under review';
        }

        return $text;
    }

    function getProductStatusText($product_status)
    {
        if ($product_status == '0')
        {
            $text = 'Deactivated';
        }
        elseif ($product_status == '1')
        {
            $text = 'Approved';
        }
        elseif ($product_status == '2')
        {
            $text = 'Waiting for review';
        }
        elseif ($product_status == '3')
        {
            $text = 'Incomplete details';
        }
        elseif ($product_status == '4')
        {
            $text = 'Rejected';
        }

        return $text;
    }

    function addProfitPercentToPrice($actual_price, $profit_percent, $shipping_charge)
    {
        $seller_price = $actual_price + $shipping_charge;
        $add_profit_percent = $seller_price + ($seller_price * ($profit_percent / 100));
        $add_service_tax = $add_profit_percent + ($add_profit_percent * (SERVICE_TAX_PERCENT / 100));
        $add_payment_tax = $add_service_tax + ($add_service_tax * (PAYMENT_PROCESSING_TAX_PERCENT / 100));
        $add_convenience_tax = $add_payment_tax + ($add_payment_tax * (CONVENIENCE_FEE_PERCENT / 100));

        $output = $add_convenience_tax;
        return round($output, 2);
    }

    function getUniqueProductURLKey($product_title, $suffix = NULL)
    {
        require_once APPPATH . '/models/common_model.php';
        $model = new Common_model();
        $product_title = str_replace(' ', '-', urldecode($product_title));
        $is_exists = $model->is_exists('product_code', TABLE_PRODUCTS, array('product_code' => $product_title));
        if (!empty($is_exists))
        {
            $suffix = '-' . getRandomNumberLength($product_title, 2);
            $product_title = getUniqueProductURLKey($product_title, $suffix);
        }

        return strtolower($product_title);
    }

    function goBack($steps = '1')
    {
        if (getClientBrowserName() == 'Google Chrome')
        {
            return 'javascript:history.back(-' . $steps . ')';
        }
        else
        {
            return 'javascript:history.go(-' . $steps . ');';
        }
    }

    function getUniqueProductCode($string_length = 6)
    {
        require_once APPPATH . '/models/common_model.php';
        $model = new Common_model();
        $random_number = getRandomNumberLength(time(), $string_length);
        $is_exists = $model->is_exists('product_code', TABLE_PRODUCTS, array('product_code' => $random_number));
        if (!empty($is_exists))
        {
            $random_number = getUniqueProductCode($string_length);
        }

        return $random_number;
    }

    function sendMail($to_email, $subject, $message, $from_email = SITE_EMAIL, $from_name = SITE_NAME_DISPLAY)
    {
        if (USER_IP != '127.0.0.1')
        {
            require_once APPPATH . '/models/email_model.php';
            $email_model = new Email_model();
            $email_model->sendMail($to_email, $subject, $message, $from_email, $from_name);
        }
    }

    function parse_address_google($address)
    {
        $url = 'http://maps.googleapis.com/maps/api/geocode/json?sensor=false&address=' . urlencode($address);
        $results = json_decode(file_get_contents($url), 1);
//        die('<pre>' . print_r($results, true));
        $parts = array(
            'address' => array('street_number', 'route'),
            'city' => array('locality'),
            'state' => array('administrative_area_level_1'),
            'country' => array('country'),
            'zip' => array('postal_code'),
        );
        if (!empty($results['results'][0]['address_components']))
        {
            $ac = $results['results'][0]['address_components'];
            foreach ($parts as $need => &$types)
            {
                foreach ($ac as &$a)
                {
                    if (in_array($a['types'][0], $types))
                    {
                        $address_out[$need] = $a['long_name'];
                    }
                    elseif (empty($address_out[$need]))
                    {
                        $address_out[$need] = '';
                    }
                }
            }
        }
        else
        {
            echo 'empty results';
        }

//        prd($address_out);
        return $address_out;
    }

    function generateUniqueKeyEverytime($str = NULL)
    {
        return md5(uniqid(USE_SALT . time() . $str, true));
    }

    function uploadImage($fileTmpname, $destFilename, $base_path, $width, $height = NULL)
    {
        require_once APPPATH . '/libraries/SimpleImage.php';
        $img = new SimpleImage();
        $img->load($fileTmpname);

        if ($height == NULL || empty($height))
        {
            $img->resizeToWidth($width);
        }
        else
        {
            $img->resize($width, $height);
        }

        //save image
        $path = $base_path . "/" . $destFilename;
        $img->save($path);
    }

    function getNWordsFromString($text, $numberOfWords = 20)
    {
        if ($text != null)
        {
            $textArray = explode(" ", $text);
            if (count($textArray) > $numberOfWords)
            {
                return implode(" ", array_slice($textArray, 0, $numberOfWords)) . "...";
            }
            return $text;
        }
        return "";
    }

    function getBlogHeaderImage($blog_id)
    {
        $fileName = getEncryptedString($blog_id) . ".jpg";
        if (is_file(BLOG_IMG_PATH . "/" . $fileName))
        {
            return getUrl(BLOG_IMG_PATH . "/" . $fileName) . "?" . time();
        }
        else
        {
            return NO_PRODUCT_IMG_PATH . "?" . time();
        }
    }

    function getAddedCurrentCurrencySymbolWithPrice($amount)
    {
        return getCurrencySymbol(getCurrentCurrency()) . $amount;
    }

    function getCurrentCurrency()
    {
        if (isset($_COOKIE["user_currency"]))
        {
            $currency = $_COOKIE["user_currency"];
        }
        else
        {
            $currency = DEFAULT_CURRENCY;
        }
        return $currency;
    }

    function getProductUrl($product_id)
    {
        require_once APPPATH . '/models/custom_model.php';
        $custom_model = new Custom_model();
        $product_fields = "product_id, cc_name, pc_name, gc_name, product_url_key";
        $whereCondArr = array("product_id" => $product_id);
        $record = $custom_model->getAllProductsDetails($product_id, $product_fields, 'pd_id', 'pi_id', $whereCondArr);

        $path = "products/view/" . rawurlencode($record["gc_name"]) . "/" . rawurlencode($record["pc_name"]) . "/" . rawurlencode($record["cc_name"]) . "/" . rawurlencode($record["product_url_key"]);
        $url = (base_url($path));
        return ($url);
    }

    function calculateTax($actualAmount, $tax = TAX_PROFIT_MARGIN_PERCENT)
    {
        $result = $actualAmount * ($tax / 100);
        return $result;
    }

    function getImage($image_path_filename)
    {
        if (is_file($image_path_filename))
        {
            $output = base_url($image_path_filename);
        }
        else
        {
            $output = NO_PRODUCT_IMG_PATH;
        }
        return $output;
    }

    function getProductImages($product_img_array)
    {
        if (!is_array($product_img_array))
        {
            $product_img_array = json_decode($product_img_array);
        }

        $output = array();
        if (!empty($product_img_array))
        {
            foreach ($product_img_array as $key => $value)
            {
                if (is_file(PRODUCT_IMG_PATH_LARGE . "/" . $value))
                {
                    $color = $key;
                    $url = getUrl(PRODUCT_IMG_PATH_LARGE . "/" . $value) . "?" . time();
                }
                else
                {
                    $color = 'NA';
                    $url = NO_PRODUCT_IMG_PATH . "?" . time();
                }
                $output[] = array('color' => $color, 'url' => $url);
            }
        }
        else
        {
            $color = 'NA';
            $url = NO_PRODUCT_IMG_PATH . "?" . time();
            $output[] = array('color' => $color, 'url' => $url);
        }

        return $output;
    }

    function displayProductPrice($amount, $tax_percent = TAX_PROFIT_MARGIN_PERCENT)
    {
        if ($tax_percent == FALSE)
            $tax_percent = '1';

        $price = getProductPrice($amount, FALSE, FALSE, TRUE, $tax_percent);
        $priceWithTax = $price;

        if ($tax_percent != '1')
            $priceWithTax = round((calculateTax($price, $tax_percent) + $price), 2);

        if (isset($_COOKIE["user_currency"]))
        {
            $currency = getCurrencySymbol($_COOKIE["user_currency"]);
        }
        else
        {
            $currency = getCurrencySymbol(DEFAULT_CURRENCY);
        }
        return $currency . $priceWithTax;
    }

    function getProductPrice($amount, $showCurrency = FALSE, $calculateTax = FALSE, $convertCurrency = TRUE, $tax_percent = TAX_PROFIT_MARGIN_PERCENT)
    {
        $from_Currency = DEFAULT_CURRENCY;
        $to_Currency = DEFAULT_CURRENCY;
        $multiplyPrice = "1";

        if ($convertCurrency == TRUE)
        {
            if (isset($_COOKIE["user_currency"]))
            {
                $to_Currency = $_COOKIE["user_currency"];
            }

            if ($from_Currency != $to_Currency)
            {
                if (isset($_COOKIE["price_conversion"]))
                {
                    $price_conversion = (array) json_decode($_COOKIE["price_conversion"]);
                    $multiplyPrice = $price_conversion["to" . $to_Currency];
                }
            }
        }

        $finalAmount = round(($multiplyPrice * $amount), 2);

        if ($calculateTax == TRUE)
            $finalAmount = calculateTax($finalAmount, $tax_percent) + $finalAmount;

        if ($showCurrency == TRUE)
            $finalAmount = getCurrencySymbol($to_Currency) . $finalAmount;

        return $finalAmount;
    }

    function getCurrencySymbol($currency = DEFAULT_CURRENCY)
    {
        $symbol = "₹";
        switch ($currency)
        {
            case "INR":
                $symbol = "₹";
                break;
            case "USD":
                $symbol = "$";
                break;
            case "GBP":
                $symbol = "£";
                break;
            case "EUR":
                $symbol = "€";
                break;
        }
        return $symbol;
    }

    function convertCurrency($from_Currency, $to_Currency, $amount)
    {
        if ($from_Currency == "EUR")
            $from_Currency = "EUR";

        if ($to_Currency == "EUR")
            $to_Currency = "EUR";

        if ($from_Currency != $to_Currency)
        {
            $amount = urlencode($amount);
            $from_Currency = urlencode($from_Currency);
            $to_Currency = urlencode($to_Currency);
            $get = file_get_contents("https://www.google.com/finance/converter?a=$amount&from=$from_Currency&to=$to_Currency");
            $get = explode("<span class=bld>", $get);
            $get = explode("</span>", $get[1]);
            $converted_amount = preg_replace("/[^0-9\.]/", null, $get[0]);
            return $converted_amount;
        }
        else
        {
            return $amount;
        }
    }

    function getFileExtension($file_name)
    {
        $exploded_name = explode(".", $file_name);
        $count_of_Array = count($exploded_name);
        $extension = $exploded_name[$count_of_Array - 1];
        return $extension;
    }

    function getShareWithFacebookLinkPopup($link)
    {
        $href = '<script>
            function fbs_click() 
            {
            u=location.href;t=document.title;window.open("http://www.facebook.com/sharer.php?u="+encodeURIComponent(u)+"&t="+encodeURIComponent(t),"sharer","toolbar=0,status=0,width=626,height=436");
            return false;
            }
            </script>
            <a rel="nofollow" href="http://www.facebook.com/share.php?u=<;url>" onclick="return fbs_click()" target="_blank">' . $link . '</a>';

        return $href;
    }

    function getBrowserType()
    {
        $useragent = $_SERVER['HTTP_USER_AGENT'];
        if (preg_match('/android|avantgo|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i', $useragent) || preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|e\-|e\/|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(di|rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|xda(\-|2|g)|yas\-|your|zeto|zte\-/i', substr($useragent, 0, 4)))
            $returnValue = 'mobile';
        else
            $returnValue = 'desktop';

        return $returnValue;
    }

    function pr($var)
    {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
    }

    function prd($var)
    {
        echo '<pre>';
        print_r($var);
        echo '</pre>';
        die;
    }

    function gcm($var)
    {
        if (is_object($var))
            $var = get_class($var);
        echo '<pre>';
        prn(get_class_methods($var));
        echo '</pre>';
    }

    function getActivationKey($string)
    {
        $key = md5($string);
        return $key;
    }

    function getClientBrowserName($u_agent = NULL)
    {
        if ($u_agent == NULL)
            $u_agent = $_SERVER['HTTP_USER_AGENT'];
        $ub = '';
        if (preg_match('/MSIE/i', $u_agent))
        {
            $ub = "Internet Explorer";
        }
        elseif (preg_match('/Firefox/i', $u_agent))
        {
            $ub = "Mozilla Firefox";
        }
        elseif (preg_match('/Chrome/i', $u_agent))
        {
            $ub = "Google Chrome";
        }
        elseif (preg_match('/Safari/i', $u_agent))
        {
            $ub = "Apple Safari";
        }
        elseif (preg_match('/Flock/i', $u_agent))
        {
            $ub = "Flock";
        }
        elseif (preg_match('/Opera/i', $u_agent))
        {
            $ub = "Opera";
        }
        elseif (preg_match('/Netscape/i', $u_agent))
        {
            $ub = "Netscape";
        }

        return $ub;
    }

    function getClientOS($user_agent = NULL)
    {
        if ($user_agent == NULL)
            $user_agent = $_SERVER['HTTP_USER_AGENT'];

        $os_platform = "Unknown OS Platform";

        $os_array = array(
            '/windows nt 6.2/i' => 'Windows 8',
            '/windows nt 6.1/i' => 'Windows 7',
            '/windows nt 6.0/i' => 'Windows Vista',
            '/windows nt 5.2/i' => 'Windows Server 2003/XP x64',
            '/windows nt 5.1/i' => 'Windows XP',
            '/windows xp/i' => 'Windows XP',
            '/windows nt 5.0/i' => 'Windows 2000',
            '/windows me/i' => 'Windows ME',
            '/win98/i' => 'Windows 98',
            '/win95/i' => 'Windows 95',
            '/win16/i' => 'Windows 3.11',
            '/macintosh|mac os x/i' => 'Mac OS X',
            '/mac_powerpc/i' => 'Mac OS 9',
            '/linux/i' => 'Linux',
            '/ubuntu/i' => 'Ubuntu',
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        foreach ($os_array as $regex => $value)
        {

            if (preg_match($regex, $user_agent))
            {
                $os_platform = $value;
            }
        }

        return $os_platform;
    }

    function isMobileDevice()
    {
        $aMobileUA = array(
            '/iphone/i' => 'iPhone',
            '/ipod/i' => 'iPod',
            '/ipad/i' => 'iPad',
            '/android/i' => 'Android',
            '/blackberry/i' => 'BlackBerry',
            '/webos/i' => 'Mobile'
        );

        //Return true if Mobile User Agent is detected
        foreach ($aMobileUA as $sMobileKey => $sMobileOS)
        {
            if (preg_match($sMobileKey, $_SERVER['HTTP_USER_AGENT']))
            {
                return true;
            }
        }
        //Otherwise return false..  
        return false;
    }

    //    This is a function to get current page url
    function curPageURL()
    {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]))
        {
            if ($_SERVER["HTTPS"] == "on")
            {
                $pageURL .= "s";
            }
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80")
        {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        }
        else
        {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }
        return $pageURL;
    }

    function getUrl($value)
    {
        if (preg_match("/http/", $value))
            $url = $value;
        else
//            $url = SITE_BASE_URL . "/" . $value;
            $url = SITE_BASE_URL . $value;
        return $url;
    }

    function getAdminUrl($value = "")
    {
        $url = SITE_BASE_URL . "/admin/" . $value;
        return $url;
    }

    createCaptcha();

    function createCaptcha()
    {
        $arr = array(
            array("3 + 5" => "8"),
            array("7 - 2" => "5"),
            array("4 + 6" => "10"),
            array("9 - 7" => "2"),
        );

        $count = count($arr) - 1;
        $rand_num = rand("0", $count);

        foreach ($arr[$rand_num] as $key => $value)
        {
            define("CAPTCHA_QUESTION", $key);
            define("CAPTCHA_ANSWER", $value);
        }
    }

    function getEncryptedString($value, $action = "encode")
    {
        if ($action == "encode")
        {
            return base64_encode($value . USE_SALT);
        }
        else
        {
            $str = base64_decode($value);
            $new_str = str_replace(USE_SALT, "", $str);
            return $new_str;
        }
    }

    function getRandomNumberLength($str, $length = "8")
    {
        return str_replace('.', '-', substr(uniqid(md5($str . time()), true), -$length));
    }

    function getTimeAgo($time)
    {
        $etime = time() - $time;

        if ($etime < 1)
        {
//            return '0 seconds';
            return 'Just now';
        }

        $a = array(12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );

        foreach ($a as $secs => $str)
        {
            $d = $etime / $secs;
            if ($d >= 1)
            {
                $r = round($d);
                return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }

    function getFacebookUserImageSource($facebook_id, $type = NULL, $width = NULL, $height = NULL)
    {
        $src = "https://graph.facebook.com/$facebook_id/picture?type=large";

        if ($type != NULL)
            $src = "https://graph.facebook.com/$facebook_id/picture?type=$type";

        if ($width != NULL)
        {
            $src = "https://graph.facebook.com/$facebook_id/picture?width=$width";
            if ($height != NULL)
                $src = "https://graph.facebook.com/$facebook_id/picture?width=$width&height=$height";
        }
        return $src;
    }

    function getShareWithPinterest($url, $img_src, $description)
    {
        $str = "http://pinterest.com/pin/create/button/?url=" . rawurlencode($url) . "&media=" . rawurlencode($img_src) . "&description=" . rawurlencode($description);
        return $str;
    }

    function getShareWithGooglePlus($url)
    {
        $str = "https://plus.google.com/share?url=" . rawurlencode($url);
        return $str;
    }

    function getShareWithFacebook($url)
    {
        $str = "https://www.facebook.com/sharer/sharer.php?u=" . rawurlencode($url);
        return $str;
    }

    function getShareWithTwitter($status)
    {
        $str = "http://twitter.com/home?status=" . rawurlencode($status);
        return $str;
    }

    function httpCaching()
    {
// seconds, minutes, hours, days
        $expires = 60 * 60 * 5 * 1;
        header("Pragma: public");
        header("Cache-Control: maxage=" . $expires);
        header('Expires: ' . gmdate('D, d M Y H:i:s', time() + $expires) . ' GMT');
    }

// calling HTTP caching function
//    httpCaching();