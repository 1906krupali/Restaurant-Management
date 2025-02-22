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
							<li class="has-dropdown">
								<a href="gallery.php">Gallery</a>
								<ul class="dropdown">
									<li><a href="cold_drink.php">Cold Drinks</a></li>
									<li><a href="food.php">Food</a></li>
									<li><a href="coffee.php">Coffees</a></li>
								</ul>
							</li>
							<li><a href="reservation.php">Reservation</a></li>
							<li class="active"><a href="about.php">About</a></li>
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
							<h1>About <em>our</em> Restaurant</h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div id="fh5co-about" class="fh5co-section">
		<div class="container">
			<div class="row">
				<div class="col-md-6 col-md-pull-4 img-wrap animate-box" data-animate-effect="fadeInLeft">
					<img src="images/hero_1.jpeg" alt="Free"style="margin-left:30%;">
				</div>
				<div class="col-md-5 col-md-push-1 animate-box">
					<div class="section-heading">
						<h2>The Restaurant</h2>
						<p><strong>Our Story:</strong></p>
						<p>Founded in 1995, Tasty was born out of a passion for creating a space where people could enjoy fresh, flavorful dishes made with locally sourced ingredients. What started as a small family-run venture has now grown into a culinary hub, celebrated for its commitment to quality and community.</p>

						<p><strong>Our Mission:</strong></p>
						<p>At Tasty, our mission is to offer an unforgettable dining experience by combining exceptional service, a welcoming atmosphere, and meals crafted with the finest ingredients. We are committed to sustainability and support local farmers to bring the freshest produce to your table.</p>

						
					</div>
				</div>
			</div>
		</div>
	</div>

	<div id="fh5co-about" class="fh5co-section">
		<div class="container"style="margin-top:-20%;">
			<div class="row">
				<div class="col-md-6 col-md-pull-4 img-wrap animate-box" data-animate-effect="fadeInLeft">
					<img src="images/cappuccino.jpg" alt="Free" style="margin-left:30%; margin-top:15%;">
					
				</div>
				<div class="col-md-5 col-md-push-1 animate-box" >
					<div class="section-heading">
						
						<p><strong>Our Cuisine:</strong></p>
						<p>Our menu is a tribute to the rich culinary traditions of [Cuisine Type], infused with a modern twist. Our chefs carefully curate each dish, from our signature [Dish Name] to our freshly baked [Item], offering a delightful balance of flavors and textures that cater to every palate.</p>

						<p><strong>Our Chefs/Team:</strong></p>
						<p>Our executive chef, [Chef Name], brings over 20 years of experience in the culinary world, having worked in renowned kitchens around the globe. His expertise and creativity are reflected in every dish, ensuring an exquisite dining experience.</p>

						<p><strong>Community and Values:</strong></p>
						<p>Tasty isn't just a restaurant—it's a community. We believe in giving back by supporting local causes, hosting community events, and creating a space where everyone feels at home.</p>

						<p><strong>Looking Ahead:</strong></p>
						<p>As we continue to grow, our goal is to expand our menu offerings, explore new culinary trends, and continue to create a space where people can celebrate, connect, and enjoy great food.</p>
						<p><a href="#" class="btn btn-primary btn-outline">Our History</a></p>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div id="fh5co-featured-testimony" class="fh5co-section">
		<div class="container" style="margin-top:-20%;">
			<div class="row">
				<div class="col-md-12 fh5co-heading">
					<h2>Testimony</h2>
					<div class="row">
						<div class="col-md-6">
							<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Reiciendis ab debitis sit itaque totam, a maiores nihil, nulla magnam porro minima officiis! Doloribus aliquam voluptates corporis et tempora consequuntur ipsam, itaque, nesciunt similique commodi omnis.</p>
						</div>
					</div>
				</div>

				<div class="col-md-5 animate-box img-to-responsive" style="margin-top:-10%;">
						<img src="images/person_1.jpg" alt="">
				</div>
				<div class="col-md-7 animate-box">
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
					<p><a href="mailto:info@yourdomainname.com" class="btn btn-primary btn-outline">Contact Us</a></p>
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

