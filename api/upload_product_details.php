<?php
include_once '../inc/config.php';
include_once "../inc/drc.php";
include_once '../inc/randno.php';

$producttitle = htmlspecialchars($_POST['producttitle']);
$user_id = $_POST['user_id'];
$qty = $_POST['qty'];
$productcategory = $_POST['productcategory'];
$price = (int)$_POST['price'];
$discount_price = (int)$_POST['discount_price'];
$productdescription = htmlspecialchars($_POST['productdescription']);
$product_id = $productID;

// Insert form data into the products table
$insertFormDataQuery = "INSERT INTO products (productid, producttitle, user_id, qty, productcategory, price, discount_price, productdescription) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = mysqli_prepare($conn, $insertFormDataQuery);
mysqli_stmt_bind_param($stmt, "sssissss", $product_id, $producttitle, $user_id, $qty, $productcategory, $price, $discount_price, $productdescription);

if (mysqli_stmt_execute($stmt)) {
    mysqli_stmt_close($stmt);
    echo json_encode(['success' => true, 'product_id' => $product_id]);
} else {
    echo json_encode(['success' => false, 'error' => mysqli_stmt_error($stmt)]);
}
?>
