<?php 
include "includes/header.php"; 
include "includes/inner-header.php";

if (isset($_POST["roleUpdate"])){
    $user = $_POST["user"];
    $pass = $_POST["pass"];
    $role = $_POST["role"];

    $res = $auth_user->updateRole($user,$pass,$role);
    if($res)
    {
      ?>
      <script>
        alert("Update Successful!");
      </script>
      <?php
    }
    else{
      ?>
      <script>
        alert("Update Not Successful");
      </script>
      <?php

    }

}

if (isset($_POST["centreUpdate"])){
    $centre = $_POST["centre"];

    $res = $auth_user->updateCentre($centre);
    if($res)
    {
      ?>
      <script>
        alert("Update Successful!");
      </script>
      <?php
    }
    else{
      ?>
      <script>
        alert("Update Not Successful");
      </script>
      <?php

    }

}

if (isset($_POST["createcentre"])){
    $name = $_POST["name"];
    $address = $_POST["address"];
    $country = $_POST["country"];

    $res = $auth_user->createCentre($name,$address,$country);
    if($res)
    {
      ?>
      <script>
        alert("Centre Created");
      </script>
      <?php
    }
    else{
      ?>
      <script>
        alert("Centre not successfully created");
      </script>
      <?php

    }

}


?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Support</h1>

          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-body">
              <div class="table-responsive">
                <iframe src="https://app.crisp.chat/initiate/login/" width="100%" height="600px" style="border:0px;"> </iframe>
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