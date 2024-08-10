<?php
include_once '../inc/config.php'; // Include your database configuration
include_once '../inc/randno.php';
include_once '../inc/drc.php';
include_once '../inc/env.php';

header('Content-Type: application/json'); // Ensure the content type is JSON

$response = []; // Initialize response array

// Enable error reporting for debugging
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $order_id = $orderID;
        // Retrieve the posted data
        $firstName = $_POST['firstName'];
        $lastName = $_POST['lastName'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $country = $_POST['country'];
        $state = $_POST['state'];
        $city = $_POST['city'];
        $street = $_POST['street'];
        $notes = $_POST['notes'];
        $subtotal = $_POST['subtotal'];
        $shipping = $_POST['shipping'];
        $total = $_POST['total'];
        
        // Decode the items JSON and add debugging
        $items_json = $_POST['items'];
        error_log("Raw items data: " . $items_json);
        $items = json_decode($items_json, true);
        error_log("Decoded items array: " . print_r($items, true));

        // Check if items is an array
        if (!is_array($items) || empty($items)) {
            throw new Exception("Invalid or empty items data.");
        }

        // Start a transaction
        $conn->begin_transaction();


        // Insert order details
        $insert_order = "INSERT INTO bob_orders (order_id, first_name, last_name, email, phone, country, state, city, street, notes, subtotal, shipping, total, status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'Pending')";
        $stmt = $conn->prepare($insert_order);
        if (!$stmt) {
            throw new Exception("Order preparation failed: " . $conn->error);
        }
        $stmt->bind_param("ssssssssssddd", $order_id, $firstName, $lastName, $email, $phone, $country, $state, $city, $street, $notes, $subtotal, $shipping, $total);
        $stmt->execute();
        if ($stmt->error) {
            throw new Exception("Order execution failed: " . $stmt->error);
        }
        $stmt->close();


        // Insert order items
        foreach ($items as $item) {
            if (!isset($item['product_id']) || !isset($item['name']) || !isset($item['quantity']) || !isset($item['price'])) {
                throw new Exception("Invalid item data: " . print_r($item, true));
            }
            $insert_item = "INSERT INTO bob_order_items (order_id, product_id, product_name, quantity, price) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($insert_item);
            if (!$stmt) {
                throw new Exception("Item preparation failed: " . $conn->error);
            }
            $stmt->bind_param("sssid", $order_id, $item['product_id'], $item['name'], $item['quantity'], $item['price']);
            $stmt->execute();
            if ($stmt->error) {
                throw new Exception("Item execution failed: " . $stmt->error);
            }
            $stmt->close();
        }

        // If everything is successful, commit the transaction
        $conn->commit();

        // Prepare Flutterwave payment request
        $request = [
            "tx_ref" => $order_id, // Unique transaction reference
            "amount" => $total,
            "currency" => "NGN",
            // "redirect_url" => "http://localhost:8888/bob/inc/confirm_payment.php",
            "redirect_url" => CONFIRM_PAY,
            "payment_options" => "card, banktransfer, ussd",
            "meta" => [
                "order_id" => $order_id,
                "consumer_mac" =>"92a3-912ba-1192a",
                "price" => $total,
                "name" => $firstName. ' ' . $lastName,
                "firstname" => $firstName
            ],
            "customer" => [
                "email" => $email,
                "phone_number" => $phone,
                "name" => $firstName . ' ' . $lastName,
            ],
            "customizations" => [
                "title" => "Build With Bob",
                "description" => "Payment for items in cart",
                "logo" => ADMIN_URL."assets/img/icon.png",
            ],
        ];

        // Send payment to Flutterwave for processing
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => 'https://api.flutterwave.com/v3/payments',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($request),
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer '. SECRET_KEY, // Replace with your Flutterwave secret key
                'Content-Type: application/json'
            ],
        ]);

        $response = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new Exception('Curl error: ' . curl_error($curl));
        }
        curl_close($curl);

        $res = json_decode($response);

        if ($res->status === 'success') {
            // Return payment link to the front-end
            echo json_encode([
                'status' => 'success',
                'payment_link' => $res->data->link
            ]);
        } else {
            throw new Exception("Payment initialization failed: " . $res->message);
        }
    } catch (Exception $e) {
        // Rollback the transaction if there's an error
        $conn->rollback();
        error_log($e->getMessage());
        echo json_encode([
            'status' => 'error',
            'message' => $e->getMessage()
        ]);
    }
} else {
    echo json_encode([
        'status' => 'error',
        'message' => 'Invalid request method'
    ]);
}

$conn->close();
