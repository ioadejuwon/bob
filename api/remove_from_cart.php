<?php
include_once '../inc/config.php';
include_once "../inc/drc.php";

$data = json_decode(file_get_contents('php://input'), true);

if ($data) {
    $product_id = $data['product_id'];
    $cart_id = $data['cart_id'];

    $stmt = $conn->prepare("DELETE FROM bob_cart WHERE cart_id = ? AND productid = ?");
    $stmt->bind_param("ss", $cart_id, $product_id);

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
?>
