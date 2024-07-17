<?php
$unique_id = $_SESSION['unique_id'];

$footeryear = date("Y");
define('FOOTERYEAR', $footeryear);
// Check if the site is running locally or on a hosting site
if ($_SERVER['HTTP_HOST'] == 'localhost:8888') {
    // Local environment
    define('BASE_URL', 'http://localhost:8888/bob/');
    
    
    define('LOGIN', BASE_URL.'login.php');
    define('SIGNUP', BASE_URL.'signup.php');
    define('SHOP', BASE_URL.'shop/index/php');
    define('CREATE_COURSE', BASE_URL.'account/create.php');
    define('CATEGORIES', BASE_URL.'account/categories.php');
    define('MY_COURSES', BASE_URL.'account/courses.php');
    define('PROFILE', BASE_URL.'account/profile.php');
    define('BOOKMARK', BASE_URL.'account/bookmarks.php');
    define('LOGOUT', BASE_URL.'logout.php?id='.$unique_id);
} else {
    // Hosting environment
    define('BASE_URL', 'https://bobthebuilder.shop/');
    // pages
    define('LOGIN', BASE_URL.'login');
    define('SIGNUP', BASE_URL.'signup');
    define('DASHBOARD', BASE_URL.'account/dashboard');
    define('CREATE_COURSE', BASE_URL.'account/create');
    define('CATEGORIES', BASE_URL.'account/categories');
    define('MY_COURSES', BASE_URL.'account/courses');
    define('PROFILE', BASE_URL.'account/profile');
    define('BOOKMARK', BASE_URL.'account/bookmarks');
    define('LOGOUT', BASE_URL.'logout.php?id='.$unique_id);

}


$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://'; // Get the protocol (http or https)
$host = $_SERVER['HTTP_HOST']; // Get the host (domain name)
$uri = $_SERVER['REQUEST_URI']; // Get the current request URI
$current_url = $protocol . $host . $uri; // Combine the protocol, host, and URI to get the full URL
// echo "Current URL: $current_url"; // Output the current URL
$t = $pagetitle;

