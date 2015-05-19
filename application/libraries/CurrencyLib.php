<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class CurrencyLib
    {
//      If you change anywhere here, do not forget to also change in the CurrencyHook.php under hooks folder
        function __construct()
        {
            $this->CI = & get_instance();
            $this->CI->load->helper('cookie');
            $this->cookieExpireTime = 60 * 60 * 24;
        }

        function checkIfCurrencyCookieExists($preferredCurrency = NULL)
        {
            if ($preferredCurrency == NULL)
                $preferredCurrency = DEFAULT_CURRENCY;

            if (!$this->CI->input->cookie("user_currency"))
            {
                $this->setCurrency($preferredCurrency);
            }
        }

        function setCurrency($currency_value = NULL)
        {
            if ($currency_value == NULL)
                $currency_value = DEFAULT_CURRENCY;

            $cookie = array(
                'name' => 'user_currency',
                'value' => $currency_value,
                'expire' => $this->cookieExpireTime
            );

            $this->CI->input->set_cookie($cookie);
        }

        function setAllCurrencyConversionPrices()
        {
            $to_Currency = DEFAULT_CURRENCY;
            $amount = "1";

            $toUSD = convertCurrency($to_Currency, "USD", $amount);
            $toGBP = convertCurrency($to_Currency, "GBP", $amount);
            $toEUR = convertCurrency($to_Currency, "EUR", $amount);

            $conversionArray = array(
                "toUSD" => $toUSD,
                "toGBP" => $toGBP,
                "toEUR" => $toEUR,
                "toINR" => $amount,
            );

            $cookie = array(
                'name' => 'price_conversion',
                'value' => json_encode($conversionArray),
                'expire' => $this->cookieExpireTime
            );

            $this->CI->input->set_cookie($cookie);
        }

        function checkIfPriceConversionExists()
        {
            if (!$this->CI->input->cookie("price_conversion") && $this->CI->input->cookie("user_currency"))
            {
                $this->setAllCurrencyConversionPrices();
            }
        }

    }

    