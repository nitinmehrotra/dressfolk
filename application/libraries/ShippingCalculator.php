<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class ShippingCalculator
    {

        // Defaults
        var $weight = 1;
        var $weight_unit = "lb";
        var $size_length = 4;
        var $size_width = 8;
        var $size_height = 2;
        var $size_unit = "in";
        var $debug = false; // Change to true to see XML sent and recieved 
        // Config (you can either set these here or send them in a config array when creating an instance of the class)
        var $services;
        var $sender_zipcode = "342001";
        var $sender_state = "";
        var $sender_country = "IN";
        var $fedex_account = "510087062";
        var $fedex_meter = "118606179";
        var $key = "MObKh1bVH5xxGMKx";
        var $password = "Testradsoft123";
        //added array of services on 28 june

        public $services_fedex = array(
            'INTERNATIONALPRIORITY' => 'Priority',
            'INTERNATIONALECONOMY' => 'Economy',
            'FEDEX2DAY' => '2 Day',
            'FEDEXEXPRESSSAVER' => 'Express Saver',
            'FEDEXGROUND' => 'Ground'
        );
        // Results
        var $rates;

        public function __construct($config = NULL)
        {
            $this->ci = & get_instance();
            $this->ci->load->database();
            $this->ci->load->model('Common_model');

            if ($config)
            {
                foreach ($config as $k => $v)
                    $this->$k = $v;
            }
        }

        //function to get service code array 
        public function serviceCodes()
        {
            return array_flip(array_merge($this->services_usps, $this->services_fedex));
        }

//         Calculate FedEX
        public function calculate_fedex($weightInLB, $to_zip, $to_state, $to_country, $code = "FEDEXGROUND")
        {
            $url = "https://gatewaybeta.fedex.com/GatewayDC";
            $data = '<?xml version="1.0" encoding="UTF-8" ?>
<FDXRateRequest xmlns:api="http://www.fedex.com/fsmapi" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:noNamespaceSchemaLocation="FDXRateRequest.xsd">
	<RequestHeader>
		<CustomerTransactionIdentifier>Express Rate</CustomerTransactionIdentifier>
		<AccountNumber>' . $this->fedex_account . '</AccountNumber>
		<MeterNumber>' . $this->fedex_meter . '</MeterNumber>
		<CarrierCode>' . (in_array($code, array('FEDEXGROUND', 'GROUNDHOMEDELIVERY')) ? 'FDXG' : 'FDXE') . '</CarrierCode>
	</RequestHeader>
	<DropoffType>REGULARPICKUP</DropoffType>
	<Service>' . $code . '</Service>
	<Packaging>YOURPACKAGING</Packaging>
	<WeightUnits>LBS</WeightUnits>
	<Weight>' . number_format($weightInLB) . '</Weight>
	<OriginAddress>
		<StateOrProvinceCode>' . $this->sender_state . '</StateOrProvinceCode>
		<PostalCode>' . $this->sender_zipcode . '</PostalCode>

		<CountryCode>' . $this->sender_country . '</CountryCode>
	</OriginAddress>
	<DestinationAddress>
		<StateOrProvinceCode>' . $to_state . '</StateOrProvinceCode>
		<PostalCode>' . $to_zip . '</PostalCode>
		<CountryCode>' . $to_country . '</CountryCode>
	</DestinationAddress>
	<Payment>
		<PayorType>SENDER</PayorType>
	</Payment>
	<PackageCount>1</PackageCount>
</FDXRateRequest>';

            // Curl
            $results = $this->curl($url, $data);

            //echo "<hr>"; prn(htmlentities($data));
            //echo "<hr>"; prn(htmlentities($results));
            // Debug
            if ($this->debug == true)
            {
                //echo "<pre>";
                print "<xmp>" . $data . "</xmp><br />";
                //	echo "<pre>";
                print "<xmp>" . $results . "</xmp><br />";
            }

            preg_match('/<NetCharge>(.*?)<\/NetCharge>/', $results, $rate);

            if (empty($rate[1]))
            {
                preg_match('/<Message>(.*?)<\/Message>/', $results, $error);
                return $error[1];
            }


            return @(float) $rate[1];
        }

        // Curl
        public function curl($url, $data = NULL)
        {
            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_HEADER, 0);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            if ($data)
            {
                curl_setopt($ch, CURLOPT_POST, 1);
                curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            }
            curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
            $contents = curl_exec($ch);

            return $contents;

            curl_close($ch);
        }

        // Convert Weight
        function convert_weight($weight, $old_unit = "gram", $new_unit = "lb")
        {
            $units['oz'] = 1;
            $units['lb'] = 0.0625;
            $units['gram'] = 28.3495231;
            $units['kg'] = 0.0283495231;

            // Convert to Ounces (if not already)
            if ($old_unit != "oz")
                $weight = $weight / $units[$old_unit];

            // Convert to New Unit
            $weight = $weight * $units[$new_unit];

            // Minimum Weight
            if ($weight < .1)
                $weight = .1;

            // Return New Weight
            return round($weight, 2);
        }

        // Convert Size
        function convert_size($size, $old_unit, $new_unit)
        {
            $units['in'] = 1;
            $units['cm'] = 2.54;
            $units['feet'] = 0.083333;

            // Convert to Inches (if not already)
            if ($old_unit != "in")
                $size = $size / $units[$old_unit];

            // Convert to New Unit
            $size = $size * $units[$new_unit];

            // Minimum Size
            if ($size < .1)
                $size = .1;

            // Return New Size
            return round($size, 2);
        }

        // Set Value
        function set_value($k, $v)
        {
            $this->$k = $v;
        }

    }