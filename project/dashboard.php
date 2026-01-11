<?php
session_start();
// 1. Prevent Caching
header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1
header("Pragma: no-cache"); // HTTP 1.0
header("Expires: 0"); // Proxies

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
  <title>Dashboard</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<header>
    <!-- <a href="logout.php" class="btn btn-primary justify-content-end">Logout</a> -->
     <nav class="navbar navbar-expand-lg navbar-light bg-light sticky-top">
        <img src="projectimg.jpg" alt="projectimg.jpg" height="50px" width="50px">
    <a class="navbar-brand ml-5" href="#">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
    <ul class="navbar-nav ml-auto my-2 my-lg-0 navbar-nav-scroll" style="max-height: 100px;">
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Services
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="dashboard.php?page=addservices">Add Services</a></li>
          <li><a class="dropdown-item" href="dashboard.php?page=services">Service List</a></li>
        </ul>
      </li>
            <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">
          Products
        </a>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
        </ul>
      </li>
    </ul>      
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
<div class="container mt-4">

<?php
  if(isset($_GET['page'])){

    $page = $_GET['page'];

    if($page == 'addservices'){
        include 'addservicesform.php';
    }
    elseif($page == 'services'){
        include 'view_services.php';
    }
    else{
        echo "<h4>Page not found</h4>";
    }

  } else {
      echo "<h3>Welcome to Dashboard</h3>";
  }
?>

</div>

</body>
</html>
