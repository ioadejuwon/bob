<?php
$user_id = $_SESSION['user_id'];

$footeryear = date("Y");
define('FOOTERYEAR', $footeryear);

// Check if the site is running locally or on a hosting site
if ($_SERVER['HTTP_HOST'] == 'localhost:8888') {
    // Local environment
    define('BASE_URL', 'http://localhost:8888/bob/');
    define('ADMIN_URL', 'http://localhost:8888/bob/admin/');


} else {
    // Hosting environment
    define('BASE_URL', 'https://bobthebuilder.shop/');
    define('ADMIN_URL', 'https://admin.buildwithbob.shop/');
    // pages
}

    
    
define('SHOP', BASE_URL.'shop');
define('PRODUCT_DETAIILS', BASE_URL.'product');
define('SIGNUP', ADMIN_URL.'signup');
define('CART', BASE_URL.'cart');
define('CHECKOUT', BASE_URL.'checkout');

define('ADMIN_LOGIN', ADMIN_URL.'login');
define('DASHBOARD', ADMIN_URL);
define('ADD_PRODUCT', ADMIN_URL.'create');
define('CATEGORIES', ADMIN_URL.'categories');
define('PRODUCTS', ADMIN_URL.'products');
define('PROFILE', ADMIN_URL.'profile');
define('ADD_IMAGE', ADMIN_URL.'add_image');
define('EDIT_PRODUCT', ADMIN_URL.'editproduct');
define('EDIT_THUMBNAIL', ADMIN_URL.'editthumbnail');
define('EDIT_IMAGES', ADMIN_URL.'editimages');


define('LOGOUT', BASE_URL.'logout?id='.$user_id); // Logout Link


$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://'; // Get the protocol (http or https)
$host = $_SERVER['HTTP_HOST']; // Get the host (domain name)
$uri = $_SERVER['REQUEST_URI']; // Get the current request URI
$current_url = $protocol . $host . $uri; // Combine the protocol, host, and URI to get the full URL
// echo "Current URL: $current_url"; // Output the current URL
$t = $pagetitle;

