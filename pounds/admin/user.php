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

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Users</h1>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">View All Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>User ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Role</th>
                      <th>Phone</th>
                      <th>Registration Date</th>
                      <th>Address</th>
                      <th>State</th>
                      <th>Action</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>User ID</th>
                      <th>Name</th>
                      <th>Email</th>
                      <th>Gender</th>
                      <th>Role</th>
                      <th>Phone</th>
                      <th>Registration Date</th>
                      <th>Address</th>
                      <th>State</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $auth_user->viewUsers();

                    ?>
                  </tbody>
                </table>
              </div>
            </div>
          </div>

        </div>
        <!-- /.container-fluid -->

      </div>
      <!-- End of Main Content -->
<?php
     include "includes/footer.php"; 

?>