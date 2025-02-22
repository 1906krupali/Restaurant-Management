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
        
        header('Location: home.php');
        exit();
       
    } else {
        echo "<script>
                alert('Login failed.');
                window.location.href = 'login.php';
              </script>";
    }
}
?>
