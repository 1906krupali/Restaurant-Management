<?php
session_start();
include_once 'config.php';
include_once 'User.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please log in first.');</script>";
    echo "<script>window.location.href = 'login.php';</script>";
    exit;
}

$database = new Database();
$db = $database->getConnection();

$user = new User($db);
$user_details = $user->getUserDetails($_SESSION['user_id']);
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $address = htmlspecialchars(strip_tags($_POST['address']));
    $dob = date('Y-m-d', strtotime($_POST['dob']));
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $marital_status = htmlspecialchars(strip_tags($_POST['marital_status']));
    $gender = htmlspecialchars(strip_tags($_POST['gender']));
    $hobbies = htmlspecialchars(strip_tags($_POST['hobbies']));

    $profile_pic = '';
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

        $check = getimagesize($_FILES["profile_pic"]["tmp_name"]);
        if ($check !== false) {
            
            if (!file_exists($target_file)) {
                
                if ($_FILES["profile_pic"]["size"] <= 5000000) {
                    
                    if (in_array($imageFileType, ['jpg', 'png', 'jpeg', 'gif'])) {
                        
                        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
                            $profile_pic = $target_file; 
                        } else {
                            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
                        }
                    } else {
                        echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.');</script>";
                    }
                } else {
                    echo "<script>alert('Sorry, your file is too large.');</script>";
                }
            } else {
                echo "<script>alert('Sorry, file already exists.');</script>";
            }
        } else {
            echo "<script>alert('File is not an image.');</script>";
        }
    }
    $user->updateUserDetails($_SESSION['user_id'], $name, $email, $address, $dob, $phone, $marital_status, $gender, $hobbies, $profile_pic);
    echo "<script>alert('Profile updated successfully.');</script>";
    echo "<script>window.location.href = 'user_profile.php';</script>";
    exit;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Profile</title>
    <style>
        body  
        {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center; 
            align-items: center; 
            height: 100vh;
        }
        .update-container {
            background-color: #fff;
            padding: 10px;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 600px;
            text-align: center;
            color: black;
        }
        .update-container h1 {
            font-size: 24px;
            color: #333;
        }
        .update-container form {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
        }
        .update-container .input-group {
            width: 48%; 
            margin-bottom: 10px;
        }
        .update-container input[type="text"],
        .update-container input[type="email"],
        .update-container input[type="datetime-local"],
        .update-container input[type="tel"],
        .update-container textarea {
            width: 80%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .update-container select{
            width: 90%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .update-container input[type="file"] {
            width: 80%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
        }
        .update-container button {
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            align-items: center;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }
        .update-container button:hover {
            background-color: #218838;
        }
        .update-container img {
            margin-bottom: 10px;
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
    
     
	<link rel="stylesheet" href="css/style.css">
    <link rel="icon" type="image/" href="./images/tasty.png">
	<!-- <script src="js/modernizr-2.6.2.min.js"></script> -->
</head>
<body>
<!-- <button><a href="user_profile.php"></a>Back</button> -->
    <div class="update-container">
        <h1>Update Profile</h1>
        <form method="POST" enctype="multipart/form-data">

        
            <div class="input-group">
                <img src="<?php echo htmlspecialchars($user_details['profile_pic']); ?>" alt="Profile Picture" height="100px" width="100px">
                <input type="file" name="profile_pic" accept="image/*">
            </div>

         
            <div class="input-group" style="margin-top:20%;">
                <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($user_details['name']); ?>" required>
            </div>
            <div class="input-group">
                <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($user_details['email']); ?>" required>
            </div>
            <div class="input-group">
                <input type="text" name="address" placeholder="Address" value="<?php echo htmlspecialchars($user_details['address']); ?>" required>
            </div>
            <div class="input-group">
                <input type="datetime-local" name="dob" placeholder="Date of Birth" value="<?php echo htmlspecialchars($user_details['dob']); ?>" required>
            </div>

          
            <div class="input-group">
                <input type="tel" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($user_details['phone']); ?>" required>
            </div>
            <div class="input-group">
                <select name="marital_status" required>
                    <option value="Single" <?php echo $user_details['marital_status'] == 'Single' ? 'selected' : ''; ?>>Single</option>
                    <option value="Married" <?php echo $user_details['marital_status'] == 'Married' ? 'selected' : ''; ?>>Married</option>
                    <option value="Divorced" <?php echo $user_details['marital_status'] == 'Divorced' ? 'selected' : ''; ?>>Divorced</option>
                  
                </select>
            </div>
            <div class="input-group">
                <select name="gender" required>
                    <option value="Male" <?php echo $user_details['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                    <option value="Female" <?php echo $user_details['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
                </select>
            </div>
            <div class="input-group">
                <textarea name="hobbies" placeholder="Hobbies"><?php echo htmlspecialchars($user_details['hobbies']); ?></textarea>
            </div>
            

            <button type="submit">Update</button>
        </form>
    </div>

</body>
</html>
