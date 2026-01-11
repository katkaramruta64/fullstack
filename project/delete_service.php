<?php
$con = mysqli_connect("localhost", "root", "", "projectdb");

if(isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // SQL to delete a record based on ID
    $query = "DELETE FROM services WHERE id = '$id'";
    
    if(mysqli_query($con, $query)) {
        // Redirect back to the service list after successful deletion
        header("Location: view_services.php?msg=deleted");
        exit();
    } else {
        echo "Error deleting record: " . mysqli_error($con);
    }
}
?>
