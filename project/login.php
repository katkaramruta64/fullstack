<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

  <!-- FULL jQuery (NOT slim) -->
  <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>

<div class="container">
<div class="m-5 p-5 border rounded bg-light">
<h1 class="text-center mb-4">Login Form</h1>

<form id="loginForm">
  <div class="form-group">
    <label>Email</label>
    <input type="email" class="form-control" id="txtemail" name="txtemail">
  </div>

  <div class="form-group">
    <label>Password</label>
    <input type="password" class="form-control" id="txtpassword" name="txtpassword">
  </div>

  <button type="submit" id="btnLogin" class="btn btn-primary form-control">Login</button>
  <div id="msg-status" class="mt-3"></div>
</form>

<p class="mt-3">Not a member? <a href="signup.php">Signup now</a></p>
</div>
</div>

<script>
$(document).ready(function(){

  $("#loginForm").submit(function(e){
    e.preventDefault();

    let email = $("#txtemail").val().trim();
    let pass = $("#txtpassword").val().trim();

    if(email === '' || pass === ''){
      $("#msg-status").addClass("text-danger")
                      .html("All fields required");
      return;
    }

    $("#btnLogin").prop("disabled", true);

    $.ajax({
      type: "POST",
      url: "checkuserlogin.php",
      data: $(this).serialize(),
      success: function(response){

        let res = JSON.parse(response);

        if(res.status === "success"){
          $("#msg-status").removeClass("text-danger")
                          .addClass("text-success")
                          .html("Login successful! Redirecting...");

          setTimeout(function(){
            window.location.href = "dashboard.php";
          }, 1000);

        } else {
          $("#msg-status").removeClass("text-success")
                          .addClass("text-danger")
                          .html(res.message);
          $("#btnLogin").prop("disabled", false);
        }
      }
    });

  });

});
</script>

</body>
</html>
