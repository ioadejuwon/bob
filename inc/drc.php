<?php
$user_id = $_SESSION['user_id'];

$footeryear = date("Y");
define('FOOTERYEAR', $footeryear);

// Check if the site is running locally or on a hosting site
if ($_SERVER['HTTP_HOST'] == 'localhost:8888') {
    // Local environment
    define('BASE_URL', 'http://localhost:8888/bob/');
    define('ADMIN_URL', 'http://localhost:8888/bob/admin/');
    
    
    
    define('SIGNUP', BASE_URL.'signup.php');
    define('SHOP', BASE_URL.'shop/index.php');

    define('ADMIN_LOGIN', ADMIN_URL.'login.php');
    define('DASHBOARD', ADMIN_URL.'dashboard.php');
    define('ADD_PRODUCT', ADMIN_URL.'create.php');
    define('CATEGORIES', ADMIN_URL.'categories.php');
    define('PRODUCTS', ADMIN_URL.'products.php');
    define('PROFILE', ADMIN_URL.'profile.php');
    define('ADD_IMAGE', ADMIN_URL.'add_image.php');

    define('LOGOUT', BASE_URL.'logout.php?id='.$user_id); // Logout Link

} else {
    // Hosting environment
    define('BASE_URL', 'https://bobthebuilder.shop/');
    define('ADMIN_URL', 'https://admin.buildwithbob.shop/');
    // pages

    define('SIGNUP', BASE_URL.'signup');
    define('SHOP', BASE_URL.'shop');

    define('ADMIN_LOGIN', ADMIN_URL.'login');
    define('DASHBOARD', ADMIN_URL.'dashboard');
    define('ADD_PRODUCT', ADMIN_URL.'create');
    define('CATEGORIES', ADMIN_URL.'categories');
    define('PRODUCTS', ADMIN_URL.'products');
    define('PROFILE', ADMIN_URL.'profile');
    define('ADD_IMAGE', ADMIN_URL.'add_image');

    define('LOGOUT', BASE_URL.'logout.php?id='.$user_id); // Logout Link
}


$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://'; // Get the protocol (http or https)
$host = $_SERVER['HTTP_HOST']; // Get the host (domain name)
$uri = $_SERVER['REQUEST_URI']; // Get the current request URI
$current_url = $protocol . $host . $uri; // Combine the protocol, host, and URI to get the full URL
// echo "Current URL: $current_url"; // Output the current URL
$t = $pagetitle;

