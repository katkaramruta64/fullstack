<html>
  <head>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
</head>
<body>
<div class="container">
  <div class="m-5 p-5 border rounded bg-light">
    <h1 class="text-center mb-4">Add New Service</h1>

    <form id="addServiceForm" enctype="multipart/form-data">

      <div class="form-group">
        <label>Service Name</label>
        <input type="text" name="txtservicename" class="form-control" required>
      </div>

      <div class="form-group">
        <label>Description</label>
        <textarea name="txtdescription" class="form-control"></textarea>
      </div>

      <div class="form-group">
        <label>Service Image</label>
        <input type="file" name="txtimage" class="form-control-file">
      </div>

      <button type="submit" id="btnAdd" class="btn btn-success form-control mt-3">
        Add Service
      </button>

      <div id="msg-status" class="mt-3"></div>
    </form>
  </div>
</div>
</body>
</html>
<script>
$(document).ready(function(){

  $("#addServiceForm").submit(function(e){
    e.preventDefault();

    let formData = new FormData(this);

    $("#btnAdd").prop("disabled", true);

    $.ajax({
      url: "add_service.php",
      type: "POST",
      data: formData,
      processData: false,
      contentType: false,
      success: function(response){

        let res = JSON.parse(response);

        if(res.status === "success"){
          $("#msg-status")
            .removeClass("text-danger")
            .addClass("text-success")
            .html("Service added successfully!");

          $("#addServiceForm")[0].reset();
        } else {
          $("#msg-status")
            .removeClass("text-success")
            .addClass("text-danger")
            .html(res.message);
        }

        $("#btnAdd").prop("disabled", false);
      },
      error: function(){
        $("#msg-status")
          .addClass("text-danger")
          .html("Server error!");
        $("#btnAdd").prop("disabled", false);
      }
    });

  });

});
</script>
