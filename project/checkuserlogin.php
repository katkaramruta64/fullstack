<?php
session_start();

$con = mysqli_connect("localhost","root","","projectdb");

if(mysqli_connect_errno()){
    echo json_encode(["status"=>"error","message"=>"DB error"]);
    exit;
}

$email = $_POST['txtemail'] ?? '';
$pass  = $_POST['txtpassword'] ?? '';

$stmt = $con->prepare("SELECT email, password FROM users WHERE email=?");
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

if($user && password_verify($pass, $user['password'])){

    $_SESSION['user'] = $user['email'];
    echo json_encode(["status"=>"success"]);

} else {
    echo json_encode(["status"=>"error","message"=>"Invalid email or password"]);
}
