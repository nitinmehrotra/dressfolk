<?php

    if (!defined('BASEPATH'))
        exit('No direct script access allowed');

    class ShippingCalculatorNew
    {

        public function __construct()
        {
            
        }

        public function calculateShippingCharge($cart_subtotal_in_inr, $weight_in_gms, $country = "IN")
        {
            $shipping_charge = 0;
            if ($country != "IN")
            {
                // international shipping
                $shipping_charge = INTERNATIONAL_SHIPPING_CHARGE_BASE;
                if ($cart_subtotal_in_inr < MIN_PRICE_FOR_SHIPPING)
                {
                    if ($weight_in_gms < 500)
                    {
                        $divide_parts = $weight_in_gms / 500;
                        $divide_parts = round($divide_parts);
                        if ($divide_parts >= 1)
                        {
                            $divide_parts_rest = $divide_parts - 1;
                            $shipping_charge = INTERNATIONAL_SHIPPING_CHARGE_BASE + ($divide_parts_rest * INTERNATIONAL_SHIPPING_CHARGE_ADDITIONAL);
                        }
                        else
                        {
                            $shipping_charge = INTERNATIONAL_SHIPPING_CHARGE_BASE;
                        }
                    }
                    else
                    {
                        $shipping_charge = INTERNATIONAL_SHIPPING_CHARGE_BASE;
                    }
                }
            }
            else
            {
                // national shipping
                $shipping_charge = 0;
                if ($cart_subtotal_in_inr < MIN_PRICE_FOR_SHIPPING)
                {
                    if ($weight_in_gms < 500)
                    {
                        $divide_parts = $weight_in_gms / 500;
                        $divide_parts = round($divide_parts);
                        if ($divide_parts >= 1)
                        {
                            $divide_parts_rest = $divide_parts - 1;
                            $shipping_charge = MIN_SHIPPING_CHARGE + ($divide_parts_rest * MIN_SHIPPING_CHARGE_PLUS_ADDITIONAL);
                        }
                        else
                        {
                            $shipping_charge = MIN_SHIPPING_CHARGE;
                        }
                    }
                    else
                    {
                        $shipping_charge = MIN_SHIPPING_CHARGE;
                    }
                }
            }

            $one_dollar_price = convertCurrency("USD", "INR", "1");
            if ($shipping_charge < $one_dollar_price && $shipping_charge != 0)
            {
                $shipping_charge = $one_dollar_price;
            }

            $shipping_charge = round($shipping_charge, 2);

            return $shipping_charge;
        }

    }