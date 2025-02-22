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
	<link rel="icon" type="image/" href="./images/tasty.png">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/modernizr-2.6.2.min.js"></script>
	<style>
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
							<li class="has-dropdown active">
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
							<li><a href="order_online.php">Order Online</a></li>
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
							<h1>See <em>Our</em> Foods</h1>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	
	<div id="fh5co-gallery" class="fh5co-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 fh5co-heading animate-box">
					<h2 style="margin-top:-8%;">Our Foods</h2>
				</div>
				
				<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap" style="margin-top:-15%;" >
					<div class="fh5co-item animate-box">
						<img src="images/bake patato.jpg" class="img-responsive" alt="Free" style="height:200px; width:300px;" >
						<h3>Bake Potato Pizza</h3>
						<span class="fh5co-price">&#8377;  95<sup>.50</sup></span>
						<p>This baked potato pizza is topped with thinly shaved potato slices, crumbled bacon, slices of red onion, cheddar cheese, and pickled jalapeños and then garnished with dollops of sour cream and diced chives.</p>
					</div>
					<div class="fh5co-item animate-box">
						<img src="images/veg-manchurain.jpg" class="img-responsive" alt="Free"style="height:200px; width:300px;">
						<h3>Veg Manchurian</h3>
						<span class="fh5co-price">&#8377;  150<sup>.50</sup></span>
						<p>Veg Manchurian consists of crispy vegetable dumplings coated in a tangy, spicy sauce made with soy sauce, garlic, and ginger. This Indo-Chinese dish is a delightful fusion of flavors and textures, perfect as an appetizer or main course.</p>
					</div>
					
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap"style="margin-top:-20%;">
					<div class="fh5co-item margin_top animate-box">
						<img src="images/gallery_3.jpeg" class="img-responsive" alt="Free"style="height:200px; width:300px;" >
						<h3>Burger & French Fries</h3>
						<span class="fh5co-price">&#8377;  120<sup>.00</sup></span>
						<p>A juicy burger with a perfectly seared patty, melted cheese, crisp lettuce, and ripe tomatoes, sandwiched between a soft, toasted bun. Served alongside golden, crispy French fries seasoned to perfection for a delightful crunch.</p>
					</div>
					<div class="fh5co-item animate-box">
						<img src="images/hakka-noodles.jpg" class="img-responsive" alt="Free"style="height:200px; width:300px;">
						<h3>Hakka Noodles</h3>
						<span class="fh5co-price">&#8377;  80<sup>.50</sup></span>
						<p>Hakka Noodles are stir-fried to perfection with fresh vegetables, aromatic garlic, and soy sauce, delivering a delightful mix of flavors and textures.</p>
					</div>
					
				</div>
				<div class="clearfix visible-sm-block visible-xs-block"></div>
				<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap"style="margin-top:-15%;">
					<div class="fh5co-item animate-box">
						<img src="images/italian-mushroom.jpg" class="img-responsive" alt="Free"style="height:200px; width:300px;">
						<h3>Italian Sauce Mushroom</h3>
						<span class="fh5co-price">&#8377;  90<sup>.99</sup></span>
						<p>
						Italian Sauce Mushroom features tender mushrooms sautéed in a rich, savory tomato sauce infused with garlic, herbs, and a splash of white wine. This flavorful dish is perfect as a pasta topping or a hearty side.</p>
					</div>
					<div class="fh5co-item margin_top animate-box"style="margin-top:-8%;">
						<img src="images/garlic-pizza.jpg" class="img-responsive" alt="Free"style="height:200px; width:300px;">
						<h3> Garlic Pizza</h3>
						<span class="fh5co-price">&#8377;  99<sup>.50</sup></span>
						<p>Garlic Pizza boasts a golden, crispy crust topped with a generous layer of melted mozzarella, a tangy tomato sauce, and a hint of Italian herbs. Simple yet delicious, it's a classic favorite for any pizza lover.</p>
					</div>
				</div>
				<div class="col-md-3 col-sm-6 col-xs-6 col-xxs-12 fh5co-item-wrap"style="margin-top:-20%;">
					<div class="fh5co-item margin_top animate-box">
						<img src="images/chees-pizza.jpg" class="img-responsive" alt="Free"style="height:200px; width:300px;">
						<h3> Chees Pizza</h3>
						<span class="fh5co-price">&#8377;  120<sup>.50</sup></span>
						<p>Cheese Pizza boasts a golden, crispy crust topped with a generous layer of melted mozzarella, a tangy tomato sauce, and a hint of Italian herbs. Simple yet delicious, it's a classic favorite for any pizza lover.</p>
					</div>
					<div class="fh5co-item margin_top animate-box"style="margin-top:-2%;">
						<img src="images/white_pizza.jpg" class="img-responsive" alt="Free"style="height:200px; width:300px;">
						<h3> White Pizza</h3>
						<span class="fh5co-price">&#8377;  100<sup>.50</sup></span>
						<p>Cheese Pizza boasts a golden, crispy crust topped with a generous layer of melted mozzarella, a tangy tomato sauce, and a hint of Italian herbs. Simple yet delicious, it's a classic favorite for any pizza lover.</p>
					</div>
				</div>
				
				
			</div>
		</div>
	</div>

	<div id="fh5co-featured-testimony" class="fh5co-section">
		<div class="container">
			<div class="row">
				<div class="col-md-12 fh5co-heading animate-box" style="margin-top:-20%;">
					<h2>Testimony</h2>
					<div class="row">
						<div class="col-md-6">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ab debitis sit itaque totam, a maiores nihil, nulla magnam porro minima officiis! Doloribus aliquam voluptates corporis et tempora consequuntur ipsam, itaque, nesciunt similique commodi omnis.</p>
						</div>
					</div>
				</div>

				<div class="col-md-5 animate-box img-to-responsive animate-box" data-animate-effect="fadeInLeft" style="margin-top:-15%;">
						<img src="images/person_1.jpg" alt="">
				</div>
				<div class="col-md-7 animate-box" data-animate-effect="fadeInRight" style="margin-top:-10%;">
					<blockquote>
						<p> &ldquo; Quantum ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ab debitis sit itaque totam, a maiores nihil, nulla magnam porro minima officiis! Doloribus aliquam voluptates corporis et tempora consequuntur ipsam. &rdquo;</p>
						<p class="author"><cite>&mdash; Jane Smith</cite></p>
					</blockquote>
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
					<p><a href="mailto:krupali1906@gmail.com" class="btn btn-primary btn-outline">Contact Us</a></p>
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
	<script src="js/zoomerang.js"></script>
	<script src="js/main.js"></script>

	<script>
		Zoomerang
      .config({
        maxHeight: 600,
        maxWidth: 900,
        bgColor: '#000',
        bgOpacity: .85
      })
      .listen('[data-trigger="zoomerang"]')
	</script>

	</body>
</html>

