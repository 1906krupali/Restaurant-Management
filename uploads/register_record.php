<?php
session_start();
include_once 'config.php';
include_once 'User.php';

$database = new Database();
$db = $database->getConnection();

$user = new User($db);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = htmlspecialchars(strip_tags($_POST['name']));
    $email = htmlspecialchars(strip_tags($_POST['email']));
    $password = htmlspecialchars(strip_tags($_POST['password']));
    $address = htmlspecialchars(strip_tags($_POST['address']));
    $dob = htmlspecialchars(strip_tags($_POST['dob']));
    $phone = htmlspecialchars(strip_tags($_POST['phone']));
    $marital_status = htmlspecialchars(strip_tags($_POST['marital_status']));
    $gender = htmlspecialchars(strip_tags($_POST['gender']));
    $hobbies = htmlspecialchars(strip_tags(implode(', ', $_POST['hobbies'])));

    $profile_pic = "";
    if (isset($_FILES['profile_pic']) && $_FILES['profile_pic']['error'] == 0) {
        $target_dir = "uploads/";
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0755, true);
        }

        $target_file = $target_dir . basename($_FILES["profile_pic"]["name"]);
        if (move_uploaded_file($_FILES["profile_pic"]["tmp_name"], $target_file)) {
            $profile_pic = $target_file;
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.');</script>";
        }
    }

    if ($user->register($name, $email, $password, $address, $dob, $phone, $marital_status, $gender, $hobbies, $profile_pic)) {
        echo "<script>alert('Registration successful.');</script>";
        echo "<script>window.location.href = 'login.php';</script>";
    } else {
        echo "<script>alert('Email already exists.');</script>";
        echo "<script>window.location.href = 'register.php';</script>";
    }
}
?>
