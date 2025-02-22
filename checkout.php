<!DOCTYPE HTML>
<html lang="en">
<head>
<meta charset="utf-8">
<title>Checkout</title>
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/icomoon.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="stylesheet" href="css/style.css">
<link rel="icon" type="image/" href="./images/tasty.png">
<script src="js/modernizr-2.6.2.min.js"></script>
<style>
    .container {
        display: flex;
        justify-content: space-between;
        padding: 15px;
    }

    .form-container, .item-container {
        width: 45%;
    }

    .form-inner {
        display: flex;
        flex-wrap: wrap;
        border: 1px solid white;
        padding: 10px;
    }

    .form-inner .box {
        width: 48%;
        margin-right: 4%;
    }

    .form-inner .box:nth-child(2n) {
        margin-right: 0;
    }

    .input {
        width: 100%;
        padding: 5px;
        margin: 2px 0;
        height: 35px;
        box-sizing: border-box;
    }

    .btn {
        background-color: red;
        color: white;
        padding: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%;
        margin-top: 10px;
    }

    span {
        color: red;
    }

    h1, h3 {
        color: aliceblue;
        text-align: center;
    }

    select, input {
        color: black;
    }

    .btn:hover {
        color: azure;
    }

    button {
        color: aliceblue;
        background-color: red;
        border-radius: 5px;
        margin-top: 10px;
    }

    .item-container {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(150px, 1fr));
    gap: 10px;
}

    .cart-item {
        border: 1px solid white;
        text-align: center;
        padding: 5px;
        margin: 10px auto;
    }

    .cart-item img {
        max-width: 80%;
        height: 80px;
    }

    .cart-item button {
        margin-top: -8%;
    }

    .grand-total {
    color: aliceblue;
    font-size: 1.2em;
    text-align: right;
    grid-column: 1 / -1; 
    padding: 10px;
    margin-right: 15%;
    /* border-radius: 15%; */
    
}
</style>
</head>
<body>
<a href="cart.php" class="btn btn-primary" style="width:5%; margin-left:10px;">Back</a>
<h1>Checkout</h1>
<?php
include 'session.php';

if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

$grandTotal = 0;

if (count($_SESSION['cart']) > 0) {
    foreach ($_SESSION['cart'] as $item) {
        $totalPrice = $item['price'] * $item['quantity'];
        $grandTotal += $totalPrice;
    }

    echo "
    <div class='container'>
        <div class='form-container'>
            <form action='process_checkout.php' method='post'>
                <div class='form-inner'>
                    <div class='box'>
                       <label>Name <span>*</span></label>
                       <input type='text' name='name' required maxlength='50' placeholder='Enter your name' class='input'>
                    </div>
                    <div class='box'>
                       <label>Mobile Number <span>*</span></label>
                       <input type='phone' name='number' required maxlength='10' placeholder='Enter your number' class='input' min='10'>
                    </div>
                    <div class='box'>
                       <label>Email <span>*</span></label>
                       <input type='email' name='email' required maxlength='50' placeholder='Enter your email' class='input'>
                    </div>
                    <div class='box'>
                       <label>Payment Method <span>*</span></label>
                       <select name='method' class='input' required>
                          <option value='cash on delivery'>Cash on Delivery</option>
                       </select>
                    </div>
                    
                    <div class='box'>
                       <label>Address Type <span>*</span></label>
                       <select name='address_type' class='input' required> 
                          <option value='home'>Home</option>
                          <option value='office'>Office</option>
                       </select>
                    </div>
                  
                    <div class='box'>
                       <label>Address Line <span>*</span></label>
                       <input type='text' name='street' required maxlength='50' placeholder='e.g.street name' class='input'>
                    </div>
                    <div class='box'>
                       <label>City Name <span>*</span></label>
                       <input type='text' name='city' required maxlength='50' placeholder='Enter your city' class='input'>
                    </div>
                    
                    <div class='box'>
                       <label>Pin Code <span>*</span></label>
                       <input type='number' name='pin_code' required maxlength='6' placeholder='e.g. 123456' class='input' min='0' max='999999'>
                    </div>
                    
                    <input type='hidden' name='grand_total' value='{$grandTotal}'>
                    <input type='submit' value='Place Order' name='place_order' class='btn'>
                </div>
            </form>
        </div>
        <div class='item-container'>
    ";

    foreach ($_SESSION['cart'] as $item) {
        $totalPrice = $item['price'] * $item['quantity'];
        echo "
            <div class='cart-item'>
                <img src='{$item['image']}' alt='{$item['product']}'>
                <h3>{$item['product']}</h3>
                <p>Price: &#8377;  {$item['price']}<br>Quantity: {$item['quantity']}</p>
                <button>Total: &#8377;  {$totalPrice}</button>
            </div>
        ";
    }

   
     echo "
        <div class='grand-total'>
            <button>Grand Total: &#8377;  {$grandTotal}</button>
           
        </div>
        </div>
    </div>
    ";

   
} else {
    echo "<p>Your cart is empty.</p>";
}
?>
</body>
</html>
