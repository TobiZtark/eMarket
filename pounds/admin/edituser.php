<?php 
include "includes/header.php"; 
include "includes/inner-header.php";
//include "config/config";

if(isset($_POST["register"])){

$name = $_POST["name"];
$n_price = $_POST["n_price"];
$o_price = $_POST["o_price"];
$category = $_POST["category"];
$tag = $_POST["tag"];
$description = $_POST["description"];
$featured = $_POST["featured"];
$image1= "";

if ($_FILES["image1"] != null){
$target_dir = "images/shop/".time();
$target_file = $target_dir . basename($_FILES["image1"]["name"]);
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
    $uploadOk = 0;
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
$target_dir = "images/shop/".time();
$target_file = $target_dir . basename($_FILES["image2"]["name"]);
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
    $uploadOk = 0;
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
$target_dir = "images/shop/".time();
$target_file = $target_dir . basename($_FILES["image3"]["name"]);
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
    $uploadOk = 0;
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
  $res = $auth_user->addItem($name,$n_price, $o_price, $category, $tag, $description, $featured, $image1, $image2, $image3);
   if($res){
    ?>
<script>
  alert("New Item Added");
  window.location.replace("payment.php");
</script>
<?php
  }else
  {?>
<script>
  alert("Operation unsuccessful");
  window.location.replace("edituser.php");
</script>
<?php
}

}



 
}

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Add New Item</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
<form action="#" method="post" enctype="multipart/form-data">
<div class="form-group">
<input type="text" class="form-control" placeholder="Enter Product Name" name="name" required>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="New Price in naira" name="n_price" required>
</div>
<div class="form-group">
<input type="number" class="form-control" placeholder="Old Price in naira" name="o_price" >
</div>
<div class="form-group">
<select name="category" class="form-control">
	<option >Select a Product Category</option>
  <option value="attires">Attires</option>
  <option value="shoes">Shoes</option>
  <option value="watches">Wrist Watches</option>
  <option value="fabrics">Fabrics</option>
  <option value="accessories">Accessories</option>
</select>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="Tags (One word description of product followed by a comma)" name="tag" required>
</div>
<div class="form-group">
<input type="text" class="form-control" placeholder="Product Description" name="description" required >
</div>
<div class="form-group">
<select name="featured" class="form-control" required>
  <option >Choose if product should be featured</option>
  <option value="1">Yes</option>
  <option value="0">No</option>     
</select>
</div>
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
<button type="submit" name="register" value="register">Add New Item</button>
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