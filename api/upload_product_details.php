<?php
include_once '../inc/config.php';
include_once "../inc/drc.php";
include_once '../inc/randno.php';

$response = [];

if (empty($_POST['producttitle']) || empty($_POST['productdescription']) || empty($_POST['price'])) {
    $response = ['success' => false, 'message' => 'Please, fill all required fields.'];
} else {
    $producttitle = htmlspecialchars($_POST['producttitle']);
    $user_id = $_POST['user_id'];
    $qty = $_POST['qty'];
    $productcategory = $_POST['productcategory'];
    $price = (int)$_POST['price'];
    $discount_price = isset($_POST['discount_price']) ? (int)$_POST['discount_price'] : 0;
    $productdescription = htmlspecialchars($_POST['productdescription']);
    $shortdescription = htmlspecialchars($_POST['shortdescription']);
    $product_id = $productID;

    // Insert form data into the products table
    $insertFormDataQuery = "INSERT INTO products (productid, producttitle, user_id, qty, productcategory, price, discount_price, productdescription, shortdescription) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $insertFormDataQuery);
    mysqli_stmt_bind_param($stmt, "sssisssss", $product_id, $producttitle, $user_id, $qty, $productcategory, $price, $discount_price, $productdescription, $shortdescription);

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        $response = ['success' => true, 'product_id' => $product_id];
    } else {
        $response = ['success' => false, 'message' => 'Database error: ' . mysqli_stmt_error($stmt)];
    }
}

echo json_encode($response);
?>
