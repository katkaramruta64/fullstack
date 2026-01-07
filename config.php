<?php
session_start();

$con = mysqli_connect("localhost","root","","userdemo");

if(mysqli_connect_errno()){
    die("DB connection failed: ".mysqli_connect_error());
}

$email = $_POST['email'];
$pass = $_POST['password'];

$query = "SELECT * FROM user WHERE username='$email'";
$result = mysqli_query($con,$query);

$user = mysqli_fetch_assoc($result);

if($user && password_verify($pass, $user['password'])){
    
    $_SESSION['user'] = $user['username'];

    header("Location: dashboard.php");
    exit();

}else{
    echo "Invalid email or password";
}
?>
