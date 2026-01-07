<?php
$con = mysqli_connect("localhost","root","","userdemo");

if(mysqli_connect_errno()){
    die("DB connection failed: ".mysqli_connect_error());
}

if(isset($_POST['email']) && isset($_POST['password'])){

    $email = $_POST['email'];
    $pass = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if($pass != $confirm){
        die("Passwords do not match");
    }

    // hash password (GOOD PRACTICE)
    $hash = password_hash($pass, PASSWORD_DEFAULT);

    $query = "INSERT INTO user (username,password) VALUES ('$email','$hash')";

    if(mysqli_query($con,$query)){
        header("Location: login.php");
        exit();
    }else{
        echo "Error: ".mysqli_error($con);
    }
}
mysqli_close($con);
?>
