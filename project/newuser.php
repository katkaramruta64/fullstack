<?php
session_start();

$con = mysqli_connect("localhost","root","","projectdb");

if(mysqli_connect_errno()){
    echo json_encode(["status"=>"error","message"=>"DB connection failed"]);
    exit;
}

if(isset($_POST['txtemail'], $_POST['txtpassword'], $_POST['txtconfirmpassword'])){

    $email = trim($_POST['txtemail']);
    $pass = $_POST['txtpassword'];
    $confirm = $_POST['txtconfirmpassword'];

    if($pass !== $confirm){
        echo json_encode(["status"=>"error","message"=>"Passwords do not match"]);
        exit;
    }

    // Check email exists
    $check = $con->prepare("SELECT id FROM users WHERE email=?");
    $check->bind_param("s",$email);
    $check->execute();
    $check->store_result();

    if($check->num_rows > 0){
        echo json_encode(["status"=>"error","message"=>"Email already registered"]);
        exit;
    }

    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $stmt = $con->prepare("INSERT INTO users (email,password) VALUES (?,?)");
    $stmt->bind_param("ss",$email,$hash);

    if($stmt->execute()){
        echo json_encode(["status"=>"success"]);
    } else {
        echo json_encode(["status"=>"error","message"=>"Registration failed"]);
    }
}

mysqli_close($con);
?>
