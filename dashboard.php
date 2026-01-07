<?php
session_start();

if(!isset($_SESSION['user'])){
    header("Location: login.php");
    exit();
}

if(isset($_SESSION['alert_message'])) {
    $type = $_SESSION['alert_type'];
    $msg  = $_SESSION['alert_message'];

    echo "
    <div class='alert alert-$type' role='alert'>
        $msg
    </div>";

    // clear after showing once
    unset($_SESSION['alert_message']);
    unset($_SESSION['alert_type']);
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Faculty Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
</head>
<body>
<header>
    <!-- <a href="logout.php" class="btn btn-primary justify-content-end">Logout</a> -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Faculty Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      
        <!-- Right-aligned logout form/button -->
        <ul class="navbar-nav ml-auto">
            <li class="nav-item">
                <!-- Replace with your actual logout form action/link -->
                <a href="logout.php" class="btn btn-outline-danger"  role="button">Logout</a>
            </li>
        </ul>
    </div>
</nav>
</header>  

<div class="container">  
<h2>Student Entry Form</h2>

<form method="post" action="save_student.php" enctype="multipart/form-data" class="form-group">

<label>Name</label>
<input type="text" name="name" required><br><br>

<label>Email</label>
<input type="email" name="email" required><br><br>

<label>Phone</label>
<input type="number" name="phone" required><br><br>

<label>Gender</label>
<input type="radio" name="gender" value="Male"> Male
<input type="radio" name="gender" value="Female"> Female
<br><br>

<label>Select Year</label>
<select name="year">
  <option>FY</option>
  <option>SY</option>
  <option>TY</option>
</select><br><br>

<label>Subjects</label>
<input type="checkbox" name="subject[]" value="Physics"> Physics
<input type="checkbox" name="subject[]" value="Chemistry"> Chemistry
<input type="checkbox" name="subject[]" value="Maths"> Maths
<br><br>

<label>Address</label>
<textarea name="address"></textarea><br><br>

<label>Upload Image</label>
<input type="file" name="photo"><br><br>

<input type="submit" name="submit" value="Save Student" class="btn btn-outline-primary">

</form>
</div>
</body>
</html>
