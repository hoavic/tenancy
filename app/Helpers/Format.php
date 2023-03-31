<?php

/**
 * Number Format helper
 *
 */
function hFormat($number, $decimal = 0)
{

    if (!is_numeric($number)) {
        return $number;
    }

    return number_format($number, $decimal, ',','.');
    
}

function hCurrency($number, $currency = ' đ')
{
    return hFormat($number) . $currency;
}