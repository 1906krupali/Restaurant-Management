<?php
session_start();
include 'config.php'; 
include 'User.php';

$database = new Database();
$conn = $database->getConnection();

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['place_order'])) {
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $method = $_POST['method'];
    $address_type = $_POST['address_type'];
    // $flat = $_POST['flat'];
    $street = $_POST['street'];
    $city = $_POST['city'];
    // $country = $_POST['country'];
    $pin_code = $_POST['pin_code'];
    $cart = $_SESSION['cart'];
    $grandTotal = 0;

    foreach ($cart as $item) {
        $grandTotal += $item['price'] * $item['quantity'];
    }

    $query = "INSERT INTO orders (name, number, email, method, address_type,  street, city, pin_code, grand_total) 
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($query);

    if ($stmt === false) {
        die("Error preparing the query: " . $conn->error);
    }

    $stmt->bind_param("ssssssssi", $name, $number, $email, $method, $address_type,  $street, $city, $pin_code, $grandTotal);

    if ($stmt->execute()) {
        $order_id = $conn->insert_id;

  
        foreach ($cart as $item) {
            $product = $item['product'];
            $price = $item['price'];
            $quantity = $item['quantity'];
            $image = $item['image'];

            $item_query = "INSERT INTO order_items (order_id, product, price, quantity, image) 
                           VALUES (?, ?, ?, ?, ?)";
            $item_stmt = $conn->prepare($item_query);

            if ($item_stmt === false) {
                die("Error preparing the item query: " . $conn->error);
            }

            $item_stmt->bind_param("isdis", $order_id, $product, $price, $quantity, $image);
            $item_stmt->execute();
        }

    
        $_SESSION['cart'] = [];

        header('Location: order_success.php');
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}
?>
