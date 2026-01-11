<!DOCTYPE html>
<html>
<head>
  <title>Service List</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
  <div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Available Services</h2>
    <a href="dashboard.php?page=addservices" class="btn btn-primary">Add New Service</a>
  </div>

  <table class="table table-bordered table-striped">
    <thead class="thead-dark">
      <tr>
        <th>Image</th>
        <th>Service Name</th>
        <th>Description</th>
        <th>Action</th>
      </tr>
    </thead>
    <tbody>
      <?php
        $con = mysqli_connect("localhost","root","","projectdb");

        if(mysqli_connect_errno()){
            die("DB connection failed: ".mysqli_connect_error());
        }

        // Fetch services from database
        $query = "SELECT * FROM services";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>
                  <td style="width: 150px;">
                    <!-- Display image from your saved folder -->
                    <img src="saveduserimage/<?php echo $row['serviceimage']; ?>" 
                         alt="service" 
                         class="img-thumbnail" 
                         style="height: 100px; width: 100%; object-fit: cover;">
                  </td>
                  <td><?php echo $row['servicename']; ?></td>
                  <td><?php echo $row['servicedisc']; ?></td>
                    <!-- Inside the while loop of your view_services.php table -->
                    <td>
                    <a href="edit_service.php?id=<?php echo $row['id']; ?>" class="btn btn-sm btn-info">Edit</a>
                    
                    <!-- Delete link with confirmation -->
                    <a href="delete_service.php?id=<?php echo $row['id']; ?>" 
                        class="btn btn-sm btn-danger" 
                        onclick="return confirm('Are you sure you want to delete this service?')">
                        Delete
                    </a>
                    </td>

                </tr>
                <?php
            }
        } else {
            echo "<tr><td colspan='4' class='text-center'>No services found</td></tr>";
        }
      ?>
    </tbody>
  </table>
  
  <div class="text-center mt-3">
    <a href="dashboard.php">Back to Dashboard</a>
  </div>
</div>

</body>
</html>
