<?php
include_once 'config.php';
include_once 'User.php';
include 'session.php';


$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $password = htmlspecialchars(strip_tags($_POST['password']));

    $user_data = $user->login($email, $password);

    if ($user_data) {
        $_SESSION['user_id'] = $user_data['id'];
        $_SESSION['user_name'] = $user_data['name'];
    }
}

$user_name = isset($_SESSION['user_name']) ? $_SESSION['user_name'] : 'Guest';


$cart_count = isset($_SESSION['cart']) ? count($_SESSION['cart']) : 0;
?>
<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>Tasty</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
<meta name="keywords" content="free website templates, free html5, free template, free bootstrap, free website template, html5, css3, mobile first, responsive" />
<meta name="author" content="freehtml5.co" />
<link rel="icon" type="image/" href="./images/tasty.png">
<meta property="og:title" content=""/>
<meta property="og:image" content=""/>
<meta property="og:url" content=""/>
<meta property="og:site_name" content=""/>
<meta property="og:description" content=""/>
<meta name="twitter:title" content="" />
<meta name="twitter:image" content="" />
<meta name="twitter:url" content="" />
<meta name="twitter:card" content="" />

<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,600i,700" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">
	
<link rel="stylesheet" href="css/animate.css">
<link rel="stylesheet" href="css/icomoon.css">
<link rel="stylesheet" href="css/bootstrap.css">
<link rel="stylesheet" href="css/flexslider.css">
<link rel="stylesheet" href="css/style.css">
<script src="js/modernizr-2.6.2.min.js"></script>
<style>
	h3, span {
		align-items: center;
		text-align: center;
	}
	button {
		margin-left: 25%;
	}
	.quantity-input {
		display: flex;
		align-items: center;
		justify-content: center;
		margin-top: -10%;
		margin-bottom: 5%;
	}
	.quantity-input input {
		width: 60px;
		height: 30px;
		text-align: center;
		color: black;
		font-weight: 600;
		font-size: 20px;
		
	}
	.quantity-input button {
		width: 30px;
		height: 30px;
		font-size: 20px;
		margin: 0 5px;
		display: flex;
		align-items: center;
		color: black;
		font-weight: 600;
		justify-content: center;
		padding: 0;
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

<script>
    function addToCart(product, price, image) {
        const quantity = document.getElementById(`quantity-${product}`).value;
        window.location.href = `cart.php?product=${product}&price=${price}&image=${image}&quantity=${quantity}`;
    }

    function increaseQuantity(product) {
        const input = document.getElementById(`quantity-${product}`);
        input.value = parseInt(input.value) + 1;
    }

    function decreaseQuantity(product) {
        const input = document.getElementById(`quantity-${product}`);
        if (parseInt(input.value) > 1) {
            input.value = parseInt(input.value) - 1;
        }
    }
   
</script>

</head>
<body>
<div class="fh5co-loader"></div>
<div id="page">
<nav class="fh5co-nav" role="navigation">
	<div class="container">
		<div class="row">
			<div class="col-xs-12 text-center logo-wrap">
				<div id="fh5co-logo"><a href="home.php">Tasty<span>.</span></a></div>
			</div>
			<div class="col-xs-12 text-center menu-1 menu-wrap">
				<ul>
					<li><a href="home.php">Home</a></li>
					<li><a href="menu.php">Menu</a></li>
					<li class="has-dropdown">
								<a href="gallery.php">Gallery</a>
								<ul class="dropdown">
									<li><a href="cold_drink.php">Cold Drinks</a></li>
									<li><a href="food.php">Food</a></li>
									<li><a href="coffee.php">Coffees</a></li>
								</ul>
							</li>
					<li><a href="reservation.php">Reservation</a></li>
					<li><a href="about.php">About</a></li>
					<li><a href="contact.php">Contact</a></li>
					<li class="active"><a href="order_online.php">Order Online</a></li>
					<li>
                        <a href="cart.php">
                            <i class="bi bi-cart" style="font-size: 1.5rem;"></i>
                            <span style="color: white; font-weight: bold;">
                                <sup>(<?php echo $cart_count; ?>)</sup>
                            </span>
                        </a>
                    </li>
                    <li class="has-dropdown" style="background-color: red; color:aliceblue; padding: 8px; border-radius: 5px; text-decoration: none;">
							<a href="user_profile.php" style="color:aliceblue">
							   <i class="bi bi-person-circle"></i>
							    <?php echo $user_name; ?>
							</a>
                            <ul class="dropdown">
							  <li><a href="logout.php" ><i class="bi bi-box-arrow-right"></i>&nbsp;Logout</a></li> 

                            </ul>
                        </li>
				</ul>
			</div>
		</div>
	</div>
</nav>

<header id="fh5co-header" class="fh5co-cover js-fullheight" role="banner" style="background-image: url(images/hero_1.jpeg);" data-stellar-background-ratio="0.5">
	<div class="overlay"></div>
	<div class="container">
		<div class="row">
			<div class="col-md-12 text-center">
				<div class="display-t js-fullheight">
					<div class="display-tc js-fullheight animate-box" data-animate-effect="fadeIn">
						<h1>See <em>Online </em> Orders</h1>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>

<div id="fh5co-featured-menu" class="fh5co-section">
	<div class="container">
		<div class="row">
			<div class="col-md-12 fh5co-heading animate-box" style="margin-top:-10%;">
				<h2>Menus</h2>
				<div class="row"></div>
			</div>
			
			<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap" style="margin-top:-10%; align-items:center;">
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%;height:380px;">
                    <img src="images/bake patato.jpg" class="img-responsive" alt="Bake Potato Pizza" style="height:150px; width:230px;">
                    <h3>Bake Potato Pizza</h3>
                    <span class="fh5co-price"> &#8377; 95<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Bake%20Potato%20Pizza')">-</button>
                        <input type="number" id="quantity-Bake%20Potato%20Pizza" value="1" min="1">
                      
                        <button onclick="increaseQuantity('Bake%20Potato%20Pizza')">+</button>
                    </div>
                    
                    <button class="btn btn-primary" onclick="addToCart('Bake%20Potato%20Pizza', 95.50, 'images/bake patato.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/veg-manchurain.jpg" class="img-responsive" alt="Veg Manchurian" style="height:150px; width:230px;">
                    <h3>Veg Manchurian</h3>
                    <span class="fh5co-price">&#8377;  110<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Veg%20Manchurian')">-</button>
                        <input type="number" id="quantity-Veg%20Manchurian" value="1" min="1">
                        <button onclick="increaseQuantity('Veg%20Manchurian')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Veg%20Manchurian', 150.50, 'images/veg-manchurain.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
            <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                <img src="images/mango.jpg" class="img-responsive" alt="Mango Juice" style="height:150px; width:230px;">
                <h3>Mango Juice</h3>
                <span class="fh5co-price">&#8377;  60<sup>.50</sup></span>
                <div class="quantity-input">
                    <button onclick="decreaseQuantity('Mango%20Juice')">-</button>
                    <input type="number" id="quantity-Mango%20Juice" value="1" min="1">
                    <button onclick="increaseQuantity('Mango%20Juice')">+</button>
                </div>
                <button class="btn btn-primary" onclick="addToCart('Mango%20Juice', 60.50, 'images/mango.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
            </div>
            <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                <img src="images/orange.jpg" class="img-responsive" alt="Orange Juice" style="height:150px; width:230px;">
                <h3>Orange Juice</h3>
                <span class="fh5co-price">&#8377;  50<sup>.50</sup></span>
                <div class="quantity-input">
                    <button onclick="decreaseQuantity('Orange%20Juice')">-</button>
                    <input type="number" id="quantity-Orange%20Juice" value="1" min="1">
                    <button onclick="increaseQuantity('Orange%20Juice')">+</button>
                </div>
                <button class="btn btn-primary" onclick="addToCart('Orange%20Juice', 50.50, 'images/orange.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
            </div>
            <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                <img src="images/cappuccino-1.jpg" class="img-responsive" alt="Cappuccino" style="height:150px; width:230px;">
                <h3>Cappuccino</h3>
                <span class="fh5co-price">&#8377;  120<sup>.50</sup></span>
                <div class="quantity-input">
                    <button onclick="decreaseQuantity('Cappuccino')">-</button>
                    <input type="number" id="quantity-Cappuccino" value="1" min="1">
                    <button onclick="increaseQuantity('Cappuccino')">+</button>
                </div>
                <button class="btn btn-primary" onclick="addToCart('Cappuccino', 120.50, 'images/cappuccino-1.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
            </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap" style="margin-top:-15%;">
                <div class="fh5co-item margin_top animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/gallery_3.jpeg" class="img-responsive" alt="Burger & French Fries" style="height:150px; width:230px;">
                    <h3>Burger & French Fries</h3>
                    <span class="fh5co-price">&#8377;  120<sup>.00</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Burger%20&%20French%20Fries')">-</button>
                        <input type="number" id="quantity-Burger%20&%20French%20Fries" value="1" min="1">
                        <button onclick="increaseQuantity('Burger%20&%20French%20Fries')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Burger%20&%20French%20Fries', 120.00, 'images/gallery_3.jpeg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/hakka-noodles.jpg" class="img-responsive" alt="Hakka Noodles" style="height:150px; width:230px;">
                    <h3>Hakka Noodles</h3>
                    <span class="fh5co-price">&#8377;  80<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Hakka%20Noodles')">-</button>
                        <input type="number" id="quantity-Hakka%20Noodles" value="1" min="1">
                        <button onclick="increaseQuantity('Hakka%20Noodles')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Hakka%20Noodles', 80.50, 'images/hakka-noodles.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                <img src="images/watermelon.jpg" class="img-responsive" alt="WaterMelon Juice" style="height:150px; width:230px;">
                <h3>WaterMelon Juice</h3>
                <span class="fh5co-price">&#8377;  30<sup>.50</sup></span>
                <div class="quantity-input">
                    <button onclick="decreaseQuantity('WaterMelon%20Juice')">-</button>
                    <input type="number" id="quantity-WaterMelon%20Juice" value="1" min="1">
                    <button onclick="increaseQuantity('WaterMelon%20Juice')">+</button>
                </div>
                <button class="btn btn-primary" onclick="addToCart('WaterMelon%20Juice', 30.50, 'images/watermelon.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
            </div>
            <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                <img src="images/Blueberry-Maple.jpg" class="img-responsive" alt="Blueberry Maple" style="height:150px; width:230px;">
                <h3>Blueberry Maple</h3>
                <span class="fh5co-price">&#8377;  45<sup>.50</sup></span>
                <div class="quantity-input">
                    <button onclick="decreaseQuantity('Blueberry%20Maple')">-</button>
                    <input type="number" id="quantity-Blueberry%20Maple" value="1" min="1">
                    <button onclick="increaseQuantity('Blueberry%20Maple')">+</button>
                </div>
                <button class="btn btn-primary" onclick="addToCart('Blueberry%20Maple', 45.50, 'images/Blueberry-Maple.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
            </div>
            <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                <img src="images/latte-art.jpg" class="img-responsive" alt="Latte Art" style="height:150px; width:230px;">
                <h3>Latte Art</h3>
                <span class="fh5co-price">&#8377;  140<sup>.50</sup></span>
                <div class="quantity-input">
                    <button onclick="decreaseQuantity('Latte%20Art')">-</button>
                    <input type="number" id="quantity-Latte%20Art" value="1" min="1">
                    <button onclick="increaseQuantity('Latte%20Art')">+</button>
                </div>
                <button class="btn btn-primary" onclick="addToCart('Latte%20Art', 140.50, 'images/latte-art.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
            </div>
            </div>
            <div class="clearfix visible-sm-block visible-xs-block"></div>
            <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap" style="margin-top:-10%;">
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/italian-mushroom.jpg" class="img-responsive" alt="Italian Sauce Mushroom" style="height:150px; width:230px;">
                    <h3>Italian Sauce Mushroom</h3>
                    <span class="fh5co-price">&#8377;  90<sup>.99</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Italian%20Sauce%20Mushroom')">-</button>
                        <input type="number" id="quantity-Italian%20Sauce%20Mushroom" value="1" min="1">
                        <button onclick="increaseQuantity('Italian%20Sauce%20Mushroom')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Italian%20Sauce%20Mushroom', 90.99, 'images/italian-mushroom.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/garlic-pizza.jpg" class="img-responsive" alt="Garlic Pizza" style="height:150px; width:230px;">
                    <h3>Garlic Pizza</h3>
                    <span class="fh5co-price">&#8377;  99<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Garlic%20Pizza')">-</button>
                        <input type="number" id="quantity-Garlic%20Pizza" value="1" min="1">
                        <button onclick="increaseQuantity('Garlic%20Pizza')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Garlic%20Pizza', 120.50, 'images/garlic-pizza.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                <img src="images/pineapple.jpg" class="img-responsive" alt="Pineapple Juice" style="height:150px; width:230px;">
                <h3>Pineapple Juice</h3>
                <span class="fh5co-price">&#8377;  40<sup>.50</sup></span>
                <div class="quantity-input">
                    <button onclick="decreaseQuantity('Pineapple%20Juice')">-</button>
                    <input type="number" id="quantity-Pineapple%20Juice" value="1" min="1">
                    <button onclick="increaseQuantity('Pineapple%20Juice')">+</button>
                </div>
                <button class="btn btn-primary" onclick="addToCart('Pineapple%20Juice', 40.50, 'images/pineapple.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
            </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/lemon.jpg" class="img-responsive" alt="Lemon Juice" style="height:150px; width:230px;">
                    <h3>Lemon Juice</h3>
                    <span class="fh5co-price">&#8377;  20<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Lemon%20Juice')">-</button>
                            <input type="number" id="quantity-Lemon%20Juice" value="1" min="1">
                        <button onclick="increaseQuantity('Lemon%20Juice')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Lemon%20Juice', 20.50, 'images/lemon.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/hot-coffee.jpg" class="img-responsive" alt="coffee" style="height:150px; width:230px;">
                    <h3>Hot Coffee</h3>
                    <span class="fh5co-price">&#8377;  50<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Hot%20Coffee')">-</button>
                        <input type="number" id="quantity-Hot%20Coffee" value="1" min="1">
                        <button onclick="increaseQuantity('Hot%20Coffee')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Hot%20Coffee', 50.50, 'images/hot-coffee.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
            </div>
            <div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap" style="margin-top:-15%;">
					
                <div class="fh5co-item margin_top animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/chees-pizza.jpg" class="img-responsive" alt="Chees Pizza" style="height:150px; width:230px;">
                    <h3>Chees Pizza</h3>
                    <span class="fh5co-price">&#8377;  120<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Chees%20Pizza')">-</button>
                        <input type="number" id="quantity-Chees%20Pizza" value="1" min="1">
                        <button onclick="increaseQuantity('Chees%20Pizza')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Chees%20Pizza', 120.50, 'images/chees-pizza.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/white_pizza.jpg" class="img-responsive" alt="White Pizza" style="height:150px; width:230px;">
                    <h3>White Pizza</h3>
                    <span class="fh5co-price">&#8377;  100<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('White%20Pizza')">-</button>
                        <input type="number" id="quantity-White%20Pizza" value="1" min="1">
                        <button onclick="increaseQuantity('White%20Pizza')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('White%20Pizza', 100.50, 'images/white_pizza.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/lychee-1.jpg" class="img-responsive" alt="Lychee Juice" style="height:150px; width:230px;">
                    <h3>Lychee Juice</h3>
                    <span class="fh5co-price">&#8377;  40<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Lychee%20Juice')">-</button>
                        <input type="number" id="quantity-Lychee%20Juice" value="1" min="1">
                        <button onclick="increaseQuantity('Lychee%20Juice')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Lychee%20Juice', 40.50, 'images/lychee-1.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/Cocktails.jpg" class="img-responsive" alt="Cocktails" style="height:150px; width:230px;">
                    <h3>Cocktails</h3>
                    <span class="fh5co-price">&#8377;  80<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Cocktails')">-</button>
                        <input type="number" id="quantity-Cocktails" value="1" min="1">
                        <button onclick="increaseQuantity('Cocktails')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Cocktails', 80.50, 'images/Cocktails.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
                <div class="fh5co-item animate-box" style="border: 2px solid #ccc; padding: 10px; margin-bottom:5%; height:380px;">
                    <img src="images/IcedCoffee.jpg" class="img-responsive" alt="coldcoffee" style="height:150px; width:230px;">
                    <h3>Cold Coffee</h3>
                    <span class="fh5co-price">&#8377;  100<sup>.50</sup></span>
                    <div class="quantity-input">
                        <button onclick="decreaseQuantity('Cold%20Coffee')">-</button>
                        <input type="number" id="quantity-Cold%20Coffee" value="1" min="1">
                        <button onclick="increaseQuantity('Cold%20Coffee')">+</button>
                    </div>
                    <button class="btn btn-primary" onclick="addToCart('Cold%20Coffee', 100.50, 'images/IcedCoffee.jpg')"><a href="order_online.php" style="color:white">Add To Cart</a></button>
                </div>
             </div>
        </div>
    </div>
</div>

<div id="fh5co-started" class="fh5co-section animate-box" style="background-image: url(images/hero_1.jpeg);" data-stellar-background-ratio="0.5">
    <div class="overlay"></div>
    <div class="container">
        <div class="row animate-box">
            <div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
                <h2>Book a Table</h2>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae enim quae vitae cupiditate, sequi quam ea id dolor reiciendis consectetur repudiandae. Rem quam, repellendus veniam ipsa fuga maxime odio? Eaque!</p>
                <p><a href="reservation.php" class="btn btn-primary btn-outline">Book Now</a></p>
            </div>
        </div>
    </div>
</div>
<?php
include 'footer.php';
?>
</div>

<div class="gototop js-top">
    <a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
</div>

<script src="js/jquery.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/jquery.flexslider-min.js"></script>
<script src="js/main.js"></script>

</body>
</html>
