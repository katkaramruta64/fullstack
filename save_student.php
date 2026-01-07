<?php
session_start();
$con = mysqli_connect("localhost","root","","userdemo");

if(mysqli_connect_errno()){
    die("DB connection failed: ".mysqli_connect_error());
}

$name   = $_POST['name'];
$email  = $_POST['email'];
$phone  = $_POST['phone'];
$gender = $_POST['gender'];
$year   = $_POST['year'];
$addr   = $_POST['address'];

$subjects = implode(",", $_POST['subject']);   // store as CSV

// Upload image
$img = $_FILES['photo']['name'];
$path = "img/".$img;
move_uploaded_file($_FILES['photo']['tmp_name'], $path);

$query = "INSERT INTO students
(name,email,phone,gender,year,subjects,address,image)
VALUES
('$name','$email','$phone','$gender','$year','$subjects','$addr','$img')";

if(mysqli_query($con,$query)){

    $_SESSION['alert_message'] = "Student data saved successfully";
    $_SESSION['alert_type'] = "success"; // success | danger | warning | info

    header("Location: dashboard.php");
    exit();

}else{
    $_SESSION['alert_message'] = "Error: ".mysqli_error($con);
    $_SESSION['alert_type'] = "danger";

    header("Location: dashboard.php");
    exit();
}
?>
