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
							<li><a href="about.php">About</a></li>
							<li class="active"><a href="contact.php">Contact</a></li>
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
							<h1>Get <em>in</em> Touch</h1>
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	
	<div id="fh5co-contact" class="fh5co-section animate-box">
		<div class="container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center fh5co-heading">
					<h2>Don't be shy, let's chat.</h2>
					<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Recusandae enim quae vitae cupiditate, sequi quam ea id dolor reiciendis consectetur repudiandae. Rem quam, repellendus veniam ipsa fuga maxime odio? Eaque!</p>
					<p><a href="mailto:krupali1906@gmail.com" class="btn btn-primary btn-outline">Contact Us</a></p>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-6 col-md-push-6 col-sm-6 col-sm-push-6">
					<form action="#" id="form-wrap">
						<div class="row form-group">
							<div class="col-md-12">
								<label for="name">Your Name</label>
								<input type="text" class="form-control" id="name">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="email">Your Email</label>
								<input type="text" class="form-control" id="email">
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<label for="message">Your Message</label>
								<textarea name="" id="message" cols="30" rows="10" class="form-control"></textarea>
							</div>
						</div>
						<div class="row form-group">
							<div class="col-md-12">
								<input type="submit" class="btn btn-primary btn-outline btn-lg" value="Submit Form">
							</div>
						</div>

					</form>
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

