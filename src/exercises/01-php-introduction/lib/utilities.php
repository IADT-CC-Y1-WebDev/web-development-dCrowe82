<?php

function truncate($text, $length) {
    $res = "";
    for ($i = 0; $i < $length; $i++) {
        $res .= $text[$i];
    }
    return $res;
}

function formatPrice($price) {
    $price = round($price, 2);
    return "€$price";
}

function getCurrentYear() {
    return date("Y");
}

?>