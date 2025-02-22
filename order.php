<?php
include 'config.php'; 
include 'User.php';
include 'session.php';

$database = new Database();
$conn = $database->getConnection();  

if (!$conn) {
    die("Database connection failed.");
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    try {
        foreach ($_SESSION['cart'] as $item) {
            $quantity = $item['quantity'];
            $price = floatval($item['price']); 
            $product_name = isset($item['product_name']) ? $item['product_name'] : null;
            $image = isset($item['image']) ? $item['image'] : null;

            if ($product_name === null) {
                throw new Exception("Product name is missing for one of the items.");
            }

            $itemQuery = "INSERT INTO order_items (order_id, product_name, quantity, price, image) 
                          VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($itemQuery);

            if (!$stmt) {
                throw new Exception("Prepare failed: " . $conn->error);
            }

            $stmt->bind_param("isids", $order_id, $product_name, $quantity, $price, $image);

            if (!$stmt->execute()) {
                throw new Exception("Execute failed: " . $stmt->error);
            }

            $stmt->close();
        }

        $_SESSION['cart'] = [];  

        header("Location: order_success.php?order_id=$order_id");
        exit;

    } catch (Exception $e) {
        die("Order items insertion failed: " . $e->getMessage());
    }
} else {
    header("Location: checkout.php");
    exit;
}
?>