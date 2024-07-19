<?php
include_once '../inc/config.php';
include_once "../inc/drc.php";
include_once '../inc/randno.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if ($_POST['producttitle'] == '' || $_POST['productdescription'] == '' || $_POST['price'] == '' || empty($_FILES['file']['name'][0])) {
        $error = 'Please fill all required inputs';
    } else {
        // Process form data
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
            $last_id = $conn->insert_id;
            mysqli_stmt_close($stmt);
            
            // Handle file uploads
            foreach ($_FILES['file']['tmp_name'] as $key => $tmpName) {
                $uploadDir = 'products/';
                $filename = $_FILES['file']['name'][$key];
                $fileTmpName = $_FILES['file']['tmp_name'][$key];
                $fileActualExt = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
                $newFileName = uniqid('', true) . '.' . $fileActualExt;
                $targetFile = $uploadDir . $newFileName;
                
                if (move_uploaded_file($fileTmpName, $targetFile)) {
                    $insertImageQuery = "INSERT INTO product_images (product_id, image_path) VALUES (?, ?)";
                    $stmt = mysqli_prepare($conn, $insertImageQuery);
                    mysqli_stmt_bind_param($stmt, "is", $last_id, $targetFile);
                    
                    if (!mysqli_stmt_execute($stmt)) {
                        echo "Error: " . mysqli_stmt_error($stmt);
                    }
                    mysqli_stmt_close($stmt);
                } else {
                    echo "Error uploading file: " . $filename;
                }
            }
            echo "Product and images uploaded successfully.";
        } else {
            echo "Error: " . mysqli_stmt_error($stmt);
        }
    }
}
$conn->close();
?>
