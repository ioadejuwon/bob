<?php
include_once '../inc/config.php';
include_once "../inc/drc.php";
include_once '../inc/randno.php';

// Handle form data
$producttitle = $_POST['producttitle'];
$user_id = $_POST['user_id'];
$qty = $_POST['qty'];
$productcategory = $_POST['productcategory'];
$price = $_POST['price'];
$discount_price = $_POST['discount_price'];
$productdescription = $_POST['productdescription'];

// SQL query to insert form data into the database
$sql = "INSERT INTO products (producttitle, user_id, qty, productcategory, price, discount_price, productdescription)
VALUES ('$producttitle', '$user_id', '$qty', '$productcategory', '$price', '$discount_price', '$productdescription')";

if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id; // Get the last inserted ID for linking images

  // Handle file uploads
  if (!empty($_FILES['file']['name'][0])) {
    $uploadDir = 'products/';
    foreach ($_FILES['file']['name'] as $key => $name) {
      $targetFile = $uploadDir . basename($name);
      if (move_uploaded_file($_FILES['file']['tmp_name'][$key], $targetFile)) {
        $sql = "INSERT INTO product_images (product_id, image_path) VALUES ('$last_id', '$targetFile')";
        if ($conn->query($sql) !== TRUE) {
          echo "Error: " . $sql . "<br>" . $conn->error;
        }
      } else {
        echo "Error uploading file: " . $name;
      }
    }
  }
  
  echo "Product and images uploaded successfully.";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
