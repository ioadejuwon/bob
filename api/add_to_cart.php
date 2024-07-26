<?php
include_once '../inc/config.php';
include_once "../inc/drc.php";

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $price = $data['price'];
    $product_id = $data['product_id'];
    $cart_id = $data['cart_id'];

    $stmt = $conn->prepare("INSERT INTO bob_cart (cart_id, productid, price) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $cart_id, $product_id, $price);

    if ($stmt->execute()) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => $stmt->error]);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'No data received']);
}
