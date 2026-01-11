<!DOCTYPE html>
<html>
<head>
  <title>Edit Service</title>
  <link rel="stylesheet" href="cdn.jsdelivr.net">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

</head>
<body>
<div class="container mt-5">
  <?php
    $con = mysqli_connect("localhost","root","","projectdb");
    $id = $_GET['id'];
    $query = "SELECT * FROM services WHERE id = '$id'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_assoc($result);
  ?>
  <div class="m-5 p-5 border rounded bg-light">
    <h1 class="text-center mb-4">Edit Service</h1>

    <form method="post" action="update_service.php" enctype="multipart/form-data">
      <!-- Hidden field to keep track of which service we are editing -->
      <input type="hidden" name="txtid" value="<?php echo $row['id']; ?>">

      <div class="form-group">
        <label>Service Name</label>
        <input type="text" name="txtservicename" class="form-control" 
               value="<?php echo $row['servicename']; ?>" required>
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="txtdescription" class="form-control" rows="3"><?php echo $row['servicedisc']; ?></textarea>
      </div>

      <div class="form-group">
        <label>Current Image</label><br>
        <img src="saveduserimage/<?php echo $row['serviceimage']; ?>" width="100" class="mb-2 border">
        <br>
        <label>Change Image (Optional)</label>
        <input type="file" name="txtimage" class="form-control-file">
      </div>

      <button type="submit" class="btn btn-primary form-control mt-3">Update Service</button>
    </form>
    
    <div class="text-center mt-3">
      <a href="view_services.php">Cancel and Go Back</a>
    </div>
  </div>
</div>
</body>
</html>
