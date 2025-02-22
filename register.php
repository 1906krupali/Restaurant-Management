<?php
 session_start();
?>
<!DOCTYPE HTML>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Tasty</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Free HTML5 Website Template by freehtml5.co" />
	<meta name="keywords" content="free" />
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
	<link rel="icon" type="image/" href="./images/tasty.png">
	<link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/style.css">
	<script src="js/modernizr-2.6.2.min.js"></script>

	<style>
		#marital_status {
			display: block;
			padding: 5px;
			height: 39px;
			width: 220px;
			font-size: 16px;
			padding-bottom: 5px;
			margin-top: 11%;
			margin-left: 10%;
			border: 1px solid white;
			background-color: rgb(53, 50, 50);
			color: white;
			border-radius: 7px;
		}

		select, option {
			color: white;
			background-color: black;
		}

		#name, #email, #phone, #address, #dob, #profile_pic, #password {
			display: block;
			padding: 5px;
			height: 39px;
			width: 220px;
			font-size: 16px;
			padding-bottom: 5px;
			margin-top: 11%;
			margin-left: 10%;
			border: 1px solid white;
			background-color: rgb(53, 50, 50);
			color: white;
			border-radius: 7px;
		}

		.hobbies {
			margin-left: 5px;
			color: white;
			padding: 10px;
		}

		.gender {
			margin-top: 2%;
			margin-left: 8%;
			color: white;
		}

		.profile_pic {
			border: 1px solid white;
			color: white;
		}

		img {
			border-radius: 50%;
			margin-top: 80px;
		}

		
		p {
			color: white;
		}

		.data {
			display: flex;
			margin-top: -5%;
		}

		.btn {
			height: 35px;
			width: 80%;
			outline: none;
			border: none;
			border-radius: 5px;
			font-size: 16px;
			font-weight: 600;
			color: rgba(1, 12, 14, 0.945);
			margin-bottom: 20px;
			background-color: #803D3B;
        }
        form{
            background-color:black;
            width:500px;
            height:550px;
            margin-top:20%;
            margin-left:25%;
            border:2px solid white;
            border-radius:5px;
        }
        .data .right{
            margin-left:4%;
            margin-top:3px;
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
							<li><a href="order_online.php">Order Online</a></li>
							
							<li class="active"><a href="register.php">Register</a></li>
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
								<form action="register_record.php" method="POST" enctype="multipart/form-data" style="margin-top:15%;">
									<h2>Register</h2>
									<input type="hidden" name="id">
									<div class="data">
										<div class="left">
											<input type="text" placeholder="Name" id="name" class="name" name="name" required>
											<input type="email" placeholder="Email" id="email" class="email" name="email" required>
											<input type="password" name="password" id="password" class="password" placeholder="Password" minlength="5" maxlength="10" required>
											<input type="text" placeholder="Address" id="address" class="address" name="address" required>
											<div class="hobbies" required>
												<label>Hobbies :--</label><br>
												<input type="checkbox" name="hobbies[]" value="Reading" id="hobby1" style="margin-left:2%;">
												<label for="hobby1">Reading</label>
												<input type="checkbox" name="hobbies[]" value="Traveling" id="hobby2">
												<label for="hobby2">Traveling</label><br>
												<input type="checkbox" name="hobbies[]" value="Cooking" id="hobby3">
												<label for="hobby3">Cooking</label>
												<input type="checkbox" name="hobbies[]" value="Dancing" id="hobby4">
												<label for="hobby4">Dancing</label>
											</div>
										</div>
										<div class="right">
											<input type="datetime-local" id="dob" name="dob" class="dob" style="color:white;" required>
											<input type="file" id="profile_pic" name="profile_pic" class="profile_pic" required>
											<input type="tel" id="phone" name="phone" placeholder="Mobile number" maxlength="10" class="phone" required>
											<select name="marital_status" id="marital_status" class="marital_status" required>
												<option value="">Marital Status</option>
												<option value="single">Single</option>
												<option value="married">Married</option>
												<option value="divorced">Divorced</option>
											</select>
											<div class="gender" required>
												<label> Gender :--</label><br>
												<input type="radio" name="gender" value="male" id="male" required>
												<label for="male">Male</label>
												<input type="radio" name="gender" value="female" id="female">
												<label for="female">Female</label>
											</div>
										</div>
									</div>
									<div class="btns">
										<input type="submit" class="btn" name="submit" value="Register">
									</div>
									<p>Already have an account ? <a href="login.php">Login</a></p>
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
	<script src="js/jquery.min.js"></script>
	<script src="js/jquery.easing.1.3.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.stellar.min.js"></script>
	<script src="js/jquery.flexslider-min.js"></script>
	<script src="js/main.js"></script>
</body>
</html>
