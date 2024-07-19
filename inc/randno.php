<?php

include_once "config.php";




$n=10; //File renaming unique
$k=7; //User ID for new accounts 
$j=3; //Category ID for product categories
$l=3; //Product ID for products




function getName($n) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
 
    for ($i = 0; $i < $n; $i++) {
        $index = rand(0, strlen($characters) - 1);
        $randomString .= $characters[$index];
    }
 
    return $randomString;
}

$uid = getName($n);

$user_id = getName($k);
$categoryID = "cat-".getName($j).'-'.getName($j);
$productID = "prod-".getName($l).'-'.getName($l);
$imgID = "img-".getName($l);
