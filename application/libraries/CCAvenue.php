<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class CCAvenue
    {

        public function __construct()
        {
            $this->ci = & get_instance();
            $this->ci->load->database();
            $this->ci->load->model('Common_model');
        }

        public function crypto()
        {

            function encrypt($plainText, $key)
            {
                $secretKey = hextobin(md5($key));
                $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
                $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
                $blockSize = mcrypt_get_block_size(MCRYPT_RIJNDAEL_128, 'cbc');
                $plainPad = pkcs5_pad($plainText, $blockSize);
                if (mcrypt_generic_init($openMode, $secretKey, $initVector) != -1)
                {
                    $encryptedText = mcrypt_generic($openMode, $plainPad);
                    mcrypt_generic_deinit($openMode);
                }
                return bin2hex($encryptedText);
            }

            function decrypt($encryptedText, $key)
            {
                $secretKey = hextobin(md5($key));
                $initVector = pack("C*", 0x00, 0x01, 0x02, 0x03, 0x04, 0x05, 0x06, 0x07, 0x08, 0x09, 0x0a, 0x0b, 0x0c, 0x0d, 0x0e, 0x0f);
                $encryptedText = hextobin($encryptedText);
                $openMode = mcrypt_module_open(MCRYPT_RIJNDAEL_128, '', 'cbc', '');
                mcrypt_generic_init($openMode, $secretKey, $initVector);
                $decryptedText = mdecrypt_generic($openMode, $encryptedText);
                $decryptedText = rtrim($decryptedText, "\0");
                mcrypt_generic_deinit($openMode);
                return $decryptedText;
            }

            //*********** Padding Function *********************

            function pkcs5_pad($plainText, $blockSize)
            {
                $pad = $blockSize - (strlen($plainText) % $blockSize);
                return $plainText . str_repeat(chr($pad), $pad);
            }

            //********** Hexadecimal to Binary function for php 4.0 version ********

            function hextobin($hexString)
            {
                $length = strlen($hexString);
                $binString = "";
                $count = 0;
                while ($count < $length)
                {
                    $subString = substr($hexString, $count, 2);
                    $packedString = pack("H*", $subString);
                    if ($count == 0)
                    {
                        $binString = $packedString;
                    }
                    else
                    {
                        $binString.=$packedString;
                    }

                    $count+=2;
                }
                return $binString;
            }

        }

        public function responseHandler($post_array)
        {
            // including the crypto function
            $this->crypto();

            $workingKey = PAYMENT_GATEWAY_ENCRYPTION_KEY;  //Working Key should be provided here.
            $encResponse = $post_array["encResp"];   //This is the response sent by the CCAvenue Server
            $rcvdString = decrypt($encResponse, $workingKey);  //Crypto Decryption used as per the specified working key.
            $order_status = "";
            $decryptValues = explode('&', $rcvdString);
            $dataSize = sizeof($decryptValues);
            echo "<center>";

            for ($i = 0; $i < $dataSize; $i++)
            {
                $information = explode('=', $decryptValues[$i]);
                if ($i == 3)
                    $order_status = $information[1];
            }

            if ($order_status === "Success")
            {
                echo "<br>Thank you for shopping with us. Your credit card has been charged and your transaction is successful. We will be shipping your order to you soon.";
            }
            else if ($order_status === "Aborted")
            {
                echo "<br>Thank you for shopping with us.We will keep you posted regarding the status of your order through e-mail";
            }
            else if ($order_status === "Failure")
            {
                echo "<br>Thank you for shopping with us.However,the transaction has been declined.";
            }
            else
            {
                echo "<br>Security Error. Illegal access detected";
            }

            echo "<br><br>";

            echo "<table cellspacing=4 cellpadding=4>";
            for ($i = 0; $i < $dataSize; $i++)
            {
                $information = explode('=', $decryptValues[$i]);
                echo '<tr><td>' . $information[0] . '</td><td>' . $information[1] . '</td></tr>';
            }

            echo "</table><br>";
            echo "</center>";
        }

        public function requestHandler($post_array)
        {
            // including the crypto function
            $this->crypto();

//            prd($post_array);

            $merchant_data = '';
            $working_key = PAYMENT_GATEWAY_ENCRYPTION_KEY; //Shared by CCAVENUES
            $access_code = PAYMENT_GATEWAY_ACCESS_CODE; //Shared by CCAVENUES

            foreach ($post_array as $key => $value)
            {
                $merchant_data.=$key . '=' . $value . '&';
            }

            $encrypted_data = encrypt($merchant_data, $working_key); // Method for encrypting the data.

            echo '<form method="post" name="redirect" action="' . PAYMENT_GATEWAY_BASE_URL . '/transaction/transaction.do?command=initiateTransaction">';
            echo "<input type='hidden' name='encRequest' value='$encrypted_data'>";
            echo "<input type='hidden' name='access_code' value='$access_code'>";
            echo '</form>';
            echo '<script language="javascript">document.redirect.submit();</script>';
        }

    }
    