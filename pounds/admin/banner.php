<?php 
include "includes/header.php"; 
include "includes/inner-header.php";
//include "config/config";

if(isset($_POST["register"])){

$image1= "";

if ($_FILES["image1"] != null){
$target_dir = "images/";
$target_file = $target_dir ."slide_1.png";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["register"])) {
    $check = getimagesize($_FILES["image1"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink ($target_file);
}
// Check file size
if ($_FILES["image1"]["size"] > 500000) {
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   $error = "Uploads not successful";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image1"]["tmp_name"], "../".$target_file)) {
        $image1 = $target_file;
       
    } else {
       
    }
}
}

if ($_FILES["image2"] != null){
$target_dir = "images/";
$target_file = $target_dir . "slide_2.png";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["register"])) {
    $check = getimagesize($_FILES["image2"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink($target_file);
}
// Check file size
if ($_FILES["image2"]["size"] > 500000) {
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   $error = "Uploads not successful";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image2"]["tmp_name"], "../".$target_file)) {
        $image2 = $target_file;
       
    } else {
       
    }
}
}

if ($_FILES["image3"] != null){
$target_dir = "images/";
$target_file = $target_dir . "slide_3.png";
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["register"])) {
    $check = getimagesize($_FILES["image3"]["tmp_name"]);
    if($check !== false) {
        $uploadOk = 1;
    } else {
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    unlink($target_file);
}
// Check file size
if ($_FILES["image3"]["size"] > 500000) {
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
&& $imageFileType != "gif" ) {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
   $error = "Uploads not successful";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["image3"]["tmp_name"], "../".$target_file)) {
        $image3 = $target_file;
       
    } else {
       
    }
}
}

if ($image1 != null){
    ?>
<script>
  alert("New Banners Added");
  window.location.replace("dashboard.php");
</script>
<?php
  }else
  {?>
<script>
  alert("Operation unsuccessful");
  window.location.replace("banner.php");
</script>
<?php
}





 
}

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Add Banners</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
<form action="#" method="post" enctype="multipart/form-data">
<div class="form-group">
<input type="file" name="image1" id="image1" required>
</div>
<div class="form-group">
<input type="file" name="image2" id="image2" required>
</div>
<div class="form-group">
<input type="file" name="image3" id="image3" required>
</div>
<hr>
<button type="submit" name="register" value="register">Add Banners</button>
</form>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
      <script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
<?php
     include "includes/footer.php"; 

?>