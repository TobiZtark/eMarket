<?php 
include "includes/header.php"; 
include "includes/inner-header.php";

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Shop Items</h1>
          <p class="mb-4"></p>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">Item Inventory</h6>
              <a style="text-align: right;" target="_blank" href="edituser.php">Add New Item</a>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>New Price</th>
                      <th>Old Price</th>
                      <th>Category</th>
                      <th>Tags</th>
                      <th>Description</th>
                      <th>Featured</th>
                      <th>Image 1</th>
                      <th>Image 2</th>
                      <th>Image 3</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                      <th>ID</th>
                      <th>Name</th>
                      <th>New Price</th>
                      <th>Old Price</th>
                      <th>Category</th>
                      <th>Tags</th>
                      <th>Description</th>
                      <th>Featured</th>
                      <th>Image 1</th>
                      <th>Image 2</th>
                      <th>Action</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $auth_user->runPayment();

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