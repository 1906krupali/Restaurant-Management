<?php
// session_start();
include 'session.php';
include_once 'config.php';
include_once 'User.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in first.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}
// Prevent browser from caching the page
// header("Cache-Control: no-store, no-cache, must-revalidate, max-age=0");
// header("Cache-Control: post-check=0, pre-check=0", false);
// header("Pragma: no-cache");

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user_details = $user->getUserDetails($_SESSION['user_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            height: 100vh;
            /* background-image: url(images/hero_1.jpeg);  */
            
        }
        .profile-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 500px;
           height: 500px;
           margin-top: 30px;

        }

        .profile-container img {
            border-radius: 50%;
            margin-bottom: 15px;
            margin-left: 32%;
          
        }
        .profile-container h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
            
        }
        .profile-container p {
            font-size: 16px;
            color: #555;
            margin: 5px 0;
        }
        .profile-container .right{
            margin-left: 60%;
            margin-top: -28%;
        }
        .profile-container .buttons {
            margin-top: 10%;
            display: flex;
            justify-content: space-around;
        }
        .profile-container a {
            padding: 10px 20px;
            background-color: #007BFF;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .profile-container a:hover {
            background-color: #0056b3;
            color: black;
        }
        .profile-container .back-button {
            background-color: #6c757d;
        }
        .profile-container .back-button:hover {
            background-color: #5a6268;
        }
        .profile-container .update-button {
            background-color: #28a745;
        }
        .profile-container .update-button:hover {
            background-color: #218838;
        }
    </style>
    <link rel="stylesheet" href="css/animate.css">
	<link rel="stylesheet" href="css/icomoon.css">
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/flexslider.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/" href="./images/tasty.png">
	<script src="js/modernizr-2.6.2.min.js"></script>
	
</head>
<body>
		
    <div class="profile-container">
        <img src="<?php echo htmlspecialchars($user_details['profile_pic']); ?>" alt="Profile Picture" width="150" height="150">
        <h1><?php echo htmlspecialchars($user_details['name']); ?></h1>
        <div class="left">
        <p><strong>Email:</strong> <?php echo htmlspecialchars($user_details['email']); ?></p>
        <p><strong>Address:</strong> <?php echo htmlspecialchars($user_details['address']); ?></p>
        <p><strong>Date of Birth:</strong> <?php echo htmlspecialchars($user_details['dob']); ?></p>
        <p><strong>Phone:</strong> <?php echo htmlspecialchars($user_details['phone']); ?></p>
        </div>
        <div class="right">
        <p><strong>Marital Status:</strong> <?php echo htmlspecialchars($user_details['marital_status']); ?></p>
        <p><strong>Gender:</strong> <?php echo htmlspecialchars($user_details['gender']); ?></p>
        <p><strong>Hobbies:</strong> <?php echo htmlspecialchars($user_details['hobbies']); ?></p>
        </div>
        <div class="buttons">
            <a href="home.php" class="back-button">Back</a>
            <a href="update_profile.php" class="update-button">Update</a>
            <a href="logout.php">Logout</a>
        </div>
    </div>
    
</body>
</html>
