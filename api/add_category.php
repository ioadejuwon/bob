<?php


include_once '../inc/config.php';
include_once "../inc/drc.php";

include_once '../inc/randno.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['categoryname'])) {
    $category_name = mysqli_real_escape_string($conn, $_POST['categoryname']); // Get the category name from the form
    $category_id = $categoryID;

    $sqlcategories = mysqli_query($conn, "SELECT * FROM bob_categories WHERE categoryName = '{$category_name}'");
    $count_row = mysqli_num_rows($sqlcategories);

    if ($count_row > 0) {
        echo json_encode(['status' => 'error', 'message' => 'Category already exists!']);
    } else {
        $sql = "INSERT INTO bob_categories (categoryid, categoryName) VALUES ('$category_id', '$category_name')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(['status' => 'success', 'message' => 'Category created successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Error: ' . $conn->error]);
        }
    }

    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request!']);
}