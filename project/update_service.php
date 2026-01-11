<?php
$con = mysqli_connect("localhost","root","","projectdb");

$id           = $_POST['txtid'];
$name         = $_POST['txtservicename'];
$description  = $_POST['txtdescription'];
$new_img      = $_FILES['txtimage']['name'];

if($new_img != "") {
    // If a new image is uploaded, use it
    $path = "saveduserimage/".$new_img;
    move_uploaded_file($_FILES['txtimage']['tmp_name'], $path);
    $update_image = $new_img;
} else {
    // If no new image, keep the existing one (hidden or fetched)
    $res = mysqli_query($con, "SELECT serviceimage FROM services WHERE id='$id'");
    $row = mysqli_fetch_assoc($res);
    $update_image = $row['serviceimage'];
}

$query = "UPDATE services SET 
          servicename = '$name', 
          servicedisc = '$description', 
          serviceimage = '$update_image' 
          WHERE id = '$id'";

if(mysqli_query($con, $query)) {
    header("Location: view_services.php?status=updated");
} else {
    echo "Update failed: " . mysqli_error($con);
}
?>
