<!DOCTYPE html>
<html>
<head>
  <title>Signup</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>

</head>
<body>

<div class="container">
<div class="m-5 p-5 border rounded bg-light">
<h1 class="text-center mb-4" >Sign up Form</h1>


<!-- <form method="post" action="newuser.php"> -->
  <form method="post" id="signupform">
    <div class="form-group">
    <label for="exampleInputEmail1">Email address</label>
    <input type="email" name="txtemail" class="form-control" id="txtemail" aria-describedby="emailHelp" onkeyup="document.getElementById('emailErr').innerHTML=''">
    <label class="text-danger " id="emailErr"></label>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="txtpassword" class="form-control" id="txtpassword" onkeyup="document.getElementById('passwordErr').innerHTML=''">
    <label class="text-danger " id="passwordErr"></label>
  </div>
  <div class="form-group">
    <label for="exampleInputPassword1">Password</label>
    <input type="password" name="txtconfirmpassword" class="form-control" id="txtconfirmpassword" onkeyup="document.getElementById('confirmpasswordErr').innerHTML=''">
    <label class="text-danger " id="confirmpasswordErr"></label>
  </div>
  <button type="submit" id="btnSubmit" class="btn btn-primary form-control">Register</button>
  <div id="msg-status"></div>
</form>
  <p>Login already? <a href="login.php">Login now</a></p>
  </div>

  </div>
</body>
</html>

<!-- ajax code script -->
<script>
$(document).ready(function () {

  $("#btnSubmit").click(function (e) {
    e.preventDefault();

    let email = $('#txtemail').val().trim();
    let pass = $('#txtpassword').val().trim();
    let cpass = $('#txtconfirmpassword').val().trim();

    if(email === ''){
      $("#emailErr").text("Please provide Email");
      return;
    }

    if(pass === ''){
      $("#passwordErr").text("Please provide Password");
      return;
    }

    if(cpass === ''){
      $("#confirmpasswordErr").text("Please provide Confirm Password");
      return;
    }

    if(pass !== cpass){
      $("#confirmpasswordErr").text("Passwords do not match");
      return;
    }

    let data = new FormData($('#signupform')[0]);

    $("#btnSubmit").prop("disabled", true);

    $.ajax({
      type: "POST",
      url: "newuser.php",
      data: data,
      processData: false,
      contentType: false,
      success: function(response) {

          console.log(response);

          let res;
          try {
              res = JSON.parse(response);
          } catch (e) {
              $("#msg-status").addClass("text-danger")
                              .html("Invalid server response");
              $("#btnSubmit").prop("disabled", false);
              return;
          }

          if (res.status === "success") {

              $("#msg-status").removeClass("text-danger")
                              .addClass("text-success")
                              .html("Registered successfully! Redirecting...");

              // ⏳ small delay so user sees message
              setTimeout(function () {
                  window.location.href = "login.php";
              }, 1500);

          } else {

              $("#msg-status").removeClass("text-success")
                              .addClass("text-danger")
                              .html(res.message);

              $("#btnSubmit").prop("disabled", false);
          }
      },
      error: function(){
        $("#msg-status").addClass("text-danger")
                        .html("Server error!");
        $("#btnSubmit").prop("disabled", false);
      }
    });

  });

});
</script>
