<?php 
include "includes/header.php"; 
include "includes/inner-header.php";

?>

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-2 text-gray-800">Shop Orders</h1>
          <p class="mb-4"></p>


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">View All Orders</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th>Request Date</th>
                      <th>Order ID</th>
                      <th>Cart ID</th>
                      <th>User</th>
                      <th>Phone</th>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Order Price</th>
                      <th>Status</th>
                      
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <<th>Request Date</th>
                      <th>Order ID</th>
                      <th>Cart ID</th>
                      <th>User</th>
                      <th>Phone</th>
                      <th>Product</th>
                      <th>Quantity</th>
                      <th>Price</th>
                      <th>Order Price</th>
                      <th>Status</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    <?php
                    $auth_user->viewBooking();

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