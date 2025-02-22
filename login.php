<?php
 session_start();
 include_once 'config.php';
 include_once 'User.php';

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
<!DOCTYPE html>
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
	<link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet">

	<link href="https://fonts.googleapis.com/css?family=Cormorant+Garamond:300,300i,400,400i,500,600i,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
	<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.8.1/font/bootstrap-icons.min.css" rel="stylesheet"> -->
	<link rel="icon" type="image/" href="./images/tasty.png">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/style.css">
	<link rel="stylesheet" href="css/login.css">
	<script src="js/modernizr-2.6.2.min.js"></script>
	
	<!-- <script>
		function togglePassword() {
			var passwordField = document.getElementById("password");
			var toggleIcon = document.getElementById("togglePasswordIcon");

			if (passwordField.type === "password") {
				passwordField.type = "text";
				toggleIcon.classList.remove("bi-eye");
				toggleIcon.classList.add("bi-eye-slash");
			} else {
				passwordField.type = "password";
				toggleIcon.classList.remove("bi-eye-slash");
				toggleIcon.classList.add("bi-eye");
			}
		}
	</script> -->
	<script>
    function togglePassword() {
        var passwordField = document.getElementById("password");
        var toggleIcon = document.getElementById("togglePasswordIcon");

        if (passwordField.type === "password") {
            passwordField.type = "text";
            toggleIcon.classList.remove("bi-eye");
            toggleIcon.classList.add("bi-eye-slash");
        } else {
            passwordField.type = "password";
            toggleIcon.classList.remove("bi-eye-slash");
            toggleIcon.classList.add("bi-eye");
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
					<div id="fh5co-logo"><a href="index.php">Tasty<span>.</span></a></div>
				</div>
				<div class="col-xs-12 text-center menu-1 menu-wrap">
					<ul>
						<li><a href="index.php">Home</a></li>
						<li><a href="menu.php">Menu</a></li>
						<li class="has-dropdown">
							<a href="gallery.php">Gallery</a>
							<ul class="dropdown">
								<li><a href="#">Cold Drinks</a></li>
								<li><a href="#">Food</a></li>
								<li><a href="#">Coffees</a></li>
							</ul>
						</li>
						<li><a href="reservation.php">Reservation</a></li>
						<li><a href="about.php">About</a></li>
						<li><a href="contact.php">Contact</a></li>
						<li><a href="order_online.php">Order Online</a></li>
						<li><a href="cart.php"><i class="bi bi-cart" style="font-size: 1.5rem;"></i></a></li>
						<li class="has-dropdown">
							<a href="user_profile.php" style="background-color: red; color:aliceblue; padding: 10px; border-radius: 5px; text-decoration: none;">
								<i class="bi bi-person-circle" style="font-size: 1.5rem;"></i>
								<?php echo $user_name; ?>
							</a>
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
							<form action="login_user.php" method="post">
								<h2>Login</h2>
								<label>Email</label>
								<input type="email" name="email" placeholder="xyz@gmail.com" required><br>
								<label>Password</label>
									<div class="password-wrapper" style="position: relative; width: 100%;">
										<input type="password" name="password" id="password" placeholder="Password" required>
										<span onclick="togglePassword()" style="cursor: pointer; position: absolute; right: 25px; top: 50%; transform: translateY(-50%);">
											<i class="bi bi-eye" id="togglePasswordIcon"></i>
										</span>
									</div>
								<br>
								<input type="submit" class="btn" name="submit" value="Login" style="width:40%;color:black;">
								<p>Don't have an account? <a href="register.php">Register</a></p>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>
	<?php include 'footer.php'; ?>
	</div>
	<div class="gototop js-top">
		<a href="#" class="js-gotop"><i class="icon-arrow-up22"></i></a>
	</div>
	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Stellar -->
	<script src="js/jquery.stellar.min.js"></script>
	<!-- Flexslider -->
	<script src="js/jquery.flexslider-min.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>
	</body>
</html>
