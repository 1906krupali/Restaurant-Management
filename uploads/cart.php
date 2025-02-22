<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Cart</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,600i,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
<link rel="icon" type="image/" href="./images/tasty.png">
<link rel="stylesheet" href="css/icomoon.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/modernizr-2.6.2.min.js"></script>

<style>
    .container {
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        border: 2px solid #ccc; 
        padding: 10px;
        position: relative; 
    }
    .cart-item {
        padding: 10px;
        margin: 10px;
        width: 300px;
        height: 400px;
        text-align: center;
        color: #ccc;
        border: 1px solid #ccc;
    }
    .cart-item img {
        width: 80%;
        height: 40%;
    }
    h1, h3 {
        color: #ccc;
        text-align: center;
        font-weight: bold;
    }
    
    button {
        color: white;
        background-color: red;
        border-radius: 7px;
        padding: 5px;
        margin: 5px;
        border: none;
    }
    a {
        margin: 10px;
    }
    .cart-actions {
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .cart-actions input {
        width: 50px;
        color: white;
        background-color: red;
        text-align: center;
        border: none;
    }
    .icon-btn {
        background-color: transparent;
        border: none;
        color: white;
        padding: 0;
        font-size: 1.5em;
        cursor: pointer;
    }
    .quantity-btn {
        font-size: 1.5em;
        color: white;
        background-color: transparent;
        border: none;
        cursor: pointer;
        padding: 5px;
    }
    
    .cross-btn {
        position: absolute;
        top: -30px;
        right: -20px;
        /* left: -30px; */
        background-color: transparent;
        border: none;
        color: white;
        font-size: 2em;
        cursor: pointer;
        padding: 2px;
        /* height: 2%; */
    }
    i{
        background-color:black;
        border-radius: 55%;
        
    }
    
		::-webkit-scrollbar{
		width: 5px;
		}
		::-webkit-scrollbar-thumb{
			--webkit-border-radius:20px;
			border-radius: 20px;
			height: 40px;
			margin-bottom: 30px;
			margin-top: 30px;
			background-color: var(--pink-color);
			position: relative;
		}
		::-webkit-scrollbar-track{
			background-color: transparent;
			--webkit-border-radius:20px;
			border-radius: 20px;
			height: 40px;
			margin-bottom: 30px;
			margin-top: 30px;
			margin-right:10px;
			margin-left: 10px;  
		}
	
</style>

</head>

<body>
<a href="order_online1.php" class="btn btn-primary">Back</a>

<h1>Your Cart</h1>
<div class="container">
    <form method="post" id="clear-form">
        <button type="submit" name="clear" class="cross-btn">
            <i class="bi bi-x-circle"></i>
        </button>
    </form>
    <?php
    include 'session.php';
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_GET['product']) && isset($_GET['price']) && isset($_GET['image']) && isset($_GET['quantity'])) {
        $product = htmlspecialchars($_GET['product']);
        $price = htmlspecialchars($_GET['price']);
        $image = htmlspecialchars($_GET['image']);
        $quantity = htmlspecialchars($_GET['quantity']);
        $item = [
            'product' => $product,
            'price' => $price,
            'image' => $image,
            'quantity' => $quantity
        ];
        $_SESSION['cart'][] = $item;

        header("Location: " . strtok($_SERVER["REQUEST_URI"], '?'));
        exit();
    }

    if (isset($_POST['delete'])) {
        $index = $_POST['delete'];
        array_splice($_SESSION['cart'], $index, 1);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_POST['update'])) {
        $index = $_POST['update'];
        $new_quantity = htmlspecialchars($_POST['quantity']);
        if ($new_quantity < 1) {
            array_splice($_SESSION['cart'], $index, 1); 
        } else {
            $_SESSION['cart'][$index]['quantity'] = $new_quantity;
        }
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    if (isset($_POST['clear'])) {
        $_SESSION['cart'] = []; 
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    }

    $grandTotal = 0;
    if (count($_SESSION['cart']) > 0) {
        foreach ($_SESSION['cart'] as $index => $item) {
            $totalPrice = $item['price'] * $item['quantity'];
            $grandTotal += $totalPrice;
            echo "
            <div class='cart-item'>
                <img src='{$item['image']}' alt='{$item['product']}'>
                <h3>{$item['product']}</h3>
                <p>Price: &#8377;  {$item['price']}
                <br>Quantity: {$item['quantity']}</p>
                <button style='margin-top:-5%;'>Total: &#8377;  " . ($item['price'] * $item['quantity']) . "</button>
                <div class='cart-actions'>               
                    <form method='post' style='display:inline;'>
                        <button type='submit' name='update' value='{$index}' class='quantity-btn' onclick='this.form.quantity.stepDown()'>
                           -
                        </button>
                        <input type='number' name='quantity' value='{$item['quantity']}' min='1'>
                        <button type='submit' name='update' value='{$index}' class='quantity-btn' onclick='this.form.quantity.stepUp()'>
                            +
                        </button>
                    </form>
                </div>
            </div>
            ";
        }
        echo "
        <div style='width: 100%; text-align: center;'>
            <h3>Grand Total: &#8377;  {$grandTotal}</h3>
            <a href='checkout.php'><button>Checkout</button></a>
        </div>
        ";
    } else {
        echo "<p>No items in the cart.</p>";
    }
    ?>
</div>
</body>
</html>
