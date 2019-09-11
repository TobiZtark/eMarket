<?php include"header.php";?>
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">			
		<div class="row">
			<ol class="breadcrumb">
				<li><a href="home.php"><i class='fa fa-home'></i> Dashboard </a></li>
				<li><a href="#"> Channel </a></li>
				<!--li class="active"></li-->
			</ol>
		</div><!--/.row-->
		<h1>Add Channel</h1>
		<?php
if($_POST["submit"] =="Submit")
{
$type = $_POST["advert_type"];
$adurl = $_POST["adurl"];
$timeframe = $_POST["timeframe"];
$ad_time = date('m/d/Y h:i:s');
if ($type == "image"){

if ($_FILES["fileToUpload"] != null){
$target_dir = "img/banner_ads/".time();
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
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
if ($_FILES["fileToUpload"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
        $filetoupload = $target_file;
       
    } else {
       
    }
}
}

if ($_FILES["fileToUpload2"] != null){
$target_dir = "img/side_ads/".time();
$target_file = $target_dir . basename($_FILES["fileToUpload2"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload2"]["tmp_name"]);
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
if ($_FILES["fileToUpload2"]["size"] > 500000) {
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
    if (move_uploaded_file($_FILES["fileToUpload2"]["tmp_name"], $target_file)) {
        $filetoupload2 = $target_file;
    } else {
        
    }
}
}

if ($filetoupload != null || $filetoupload2 != null) {
    
    } else {
       $error = "Uploads not successful";
    }
} else
{

if ($_FILES["fileToUpload3"] != null){
$target_dir = "img/audio/".time();
$target_file = $target_dir . basename($_FILES["fileToUpload3"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload3"]["tmp_name"]);
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
if ($_FILES["fileToUpload3"]["size"] > 500000) {
    $uploadOk = 0;
}
// Allow certain file formats
if($imageFileType != "wav" && $imageFileType != "mp3" && $imageFileType != "ogg") {
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    $error = "Uploads not successful";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["fileToUpload3"]["tmp_name"], $target_file)) {
        $filetoupload3 = $target_file;
    } else {
       $error = "Uploads not successful";
    }
}
}
}

if($filetoupload != null || $filetoupload2 != null || $filetoupload3 != null){
    
    $sql = "INSERT INTO advert (username, uid, type,description,timeframe, ad_time, audio, banner, side, status)
VALUES ('Admin','14', '$type','$ad_url','$timeframe', '$ad_time','$filetoupload3','$filetoupload','$filetoupload2', 'disapproved')";

if ($con->query($sql) === TRUE) {
    $error = "Advert Upload Successful";
    
} else {
    $error = "Advert Upload not successful";
}
    
$con->close();
    
    
}
}
		
		
		
		
		
		
		
		if(isset($error) && $error!='')
		{
		    if($error == "Advert Upload Successful"){
		   ?>
		<div class='alert alert-success'  id='errmsg'>
			<?php 
				echo $error;
			?>
		</div>
		<?php     
		    } else{
		?>
		<div class='alert alert-danger'  id='errmsg'>
			<?php 
				echo $error;
			?>
		</div>
		<?php	
		}
		}
		?>	
				
		<form class="form-horizontal" method="post" action="#" style="margin-top:60px;" enctype='multipart/form-data' >
			<div class="form-group">
				<div class="col-md-6">
					<label>Advert Type:</label>
					<select name="advert_type" class="form-control" required>
                    <option value="">Pick an advert type</option>
                    <option value="audio">audio</option>
                    <option value="image">image</option>
                    </select>
					<br>
					<label>Advert URL e.g http://myafricanfms.com:</label>
					<input type="url" class="form-control" name='adurl' required>
					<br>
					
						<label>TimeFrame:</label>
						 <select name="timeframe" class="form-control" required>
                            <option value="">Pick how long adverts should run</option>
                            <option value="6h">6 Hours</option>
                            <option value="12h">12 Hours</option>
                            <option value="1d">24 Hours</option>
                            <option value="2d">48 Hours</option>
                            <option value="1w">1 Week</option>
                            <option value="2w">2 Weeks</option>
                            <option value="1m">1 Month</option>
                        </select>
						<br>
						
						
						<label>Upload audio file (Max file size is 500KB):</label>
						 	<input type="file" name="fileToUpload3" value="choose file" class="form-control ">

						 <br>
						 
						 <label>Upload Banner file (Max file size is 500KB):</label>
						 	<input type="file" name="fileToUpload" value="choose file" class="form-control ">

						 <br>
						 
						 <label>Upload Sidebar file (Max file size is 500KB):</label>
						 	<input type="file" name="fileToUpload2" value="choose file" class="form-control ">

						 <br>
						     
					
				<div class="col-md-12">
					<br>
					<input type='submit' name='submit' value='Submit' class='btn btn-primary' >
				</div>
			</div>
		</form>
	<script src="js/jquery.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/datepicker.js"></script>
<script type="text/javascript">
$(document).ready(function(){
    $('#category_name').on('change',function(){
        var category_name = $(this).val();
        var category_id = $(this).val();
        if(category_name){
            $.ajax({
                type:'POST',
                url:'./ajaxData.php',
                data:'category_name='+category_name,
                success:function(html){
                    $('#subcategory').html(html);
                   
                }
            }); 
        }else{
            $('#subcategory').html('<option value="">Select country first</option>');
        }
    });
});
</script>

</body>
</html>
