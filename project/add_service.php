<?php
session_start();

if(!isset($_SESSION['user'])){
    echo json_encode(["status"=>"error","message"=>"Unauthorized"]);
    exit;
}

$con = mysqli_connect("localhost","root","","projectdb");

if(mysqli_connect_errno()){
    echo json_encode(["status"=>"error","message"=>"DB connection failed"]);
    exit;
}

$name = $_POST['txtservicename'] ?? '';
$desc = $_POST['txtdescription'] ?? '';

if($name == ''){
    echo json_encode(["status"=>"error","message"=>"Service name required"]);
    exit;
}

// Image upload
$imgName = '';
if(!empty($_FILES['txtimage']['name'])){
    $imgName = time().'_'.$_FILES['txtimage']['name'];
    $path = "saveduserimage/".$imgName;
    move_uploaded_file($_FILES['txtimage']['tmp_name'], $path);
}

$stmt = $con->prepare(
  "INSERT INTO services (servicename, servicedisc, serviceimage)
   VALUES (?,?,?)"
);
$stmt->bind_param("sss", $name, $desc, $imgName);

if($stmt->execute()){
    echo json_encode(["status"=>"success"]);
} else {
    echo json_encode(["status"=>"error","message"=>"Insert failed"]);
}
