<?php
if ( isset($_POST)) {
session_start();
$con = mysqli_connect("localhost","root","","userdemo");

if(mysqli_connect_errno()){
    die("DB connection failed: ".mysqli_connect_error());
}

$name   = $_POST['name'];
$email  = $_POST['email'];
$phone  = $_POST['phone'];
$msg    = $_POST['msg'];


$query = "INSERT INTO conntact_info (email, name, contact, massage) VALUES ('$email', '$name', '$phone', '$msg')";


if(mysqli_query($con,$query)){
    echo json_encode(array('status' => 'success'));

}else{
    echo json_encode(array('status' => 'error'));
}
}
?>




