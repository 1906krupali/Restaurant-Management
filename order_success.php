<?php
session_start();
include 'config.php'; 
include 'User.php';

$database = new Database();
$conn = $database->getConnection();

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

   
    $orderQuery = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($orderQuery);
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $orderResult = $stmt->get_result();
    $order = $orderResult->fetch_assoc();
    $stmt->close();

    $itemsQuery = "SELECT * FROM order_items WHERE order_id = ?";
    $stmt = $conn->prepare($itemsQuery);
    if (!$stmt) {
        die('Prepare failed: ' . $conn->error);
    }
    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $itemsResult = $stmt->get_result();
    $stmt->close();
} else {
    header("Location: cart.php");
    exit;
}
?>
