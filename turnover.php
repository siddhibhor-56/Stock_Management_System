<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['userId'])) {
header('Location: index.php');
}

?>

<?php
include('includes/header.php'); 
include('includes/navbar.php');
include('includes/config.php');
?>

  <!-- Content Wrapper -->
  <div id="content-wrapper" class="d-flex flex-column">
    <!-- Main Content -->
    <div id="content">

      <!-- Begin Page Content -->
      <div class="container-fluid">

        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
          <h1 class="h3 mb-0 text-gray-800"></h1>
        </div>

        <!-- Content Row -->
    <div class="row">

    <div class="col-xl-2 mb-4"></div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-primary text-uppercase mb-1"><center>Total Earning</center></div>
                    <center>
                    <div class="h1 mb-0 font-weight-bold text-gray-1000">
                    <?php
                  $fetch = "SELECT SUM(`paid`) as total FROM `place_order`";
                  $query_run = mysqli_query($con,$fetch);
                  while($row = mysqli_fetch_assoc($query_run))
                  {
                    $total = $row['total'];
                  }
                  if($total){
                    $rs = ' INR';
                    echo $total.$rs;
                  }
                  else
                  {
                    echo 0;
                  }
                ?>
                    </div></center>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-info text-uppercase mb-1"><center>Amount Invested</center></div>
                    <center>
                    <div class="h1 mb-0 font-weight-bold text-gray-1000">
                    <?php
                  $fetch = "SELECT SUM(`total`) as total FROM `stock`";
                  $query_run = mysqli_query($con,$fetch);
                  while($row = mysqli_fetch_assoc($query_run))
                  {
                    $total = $row['total'];
                  }
                  if($total){
                    $rs = ' INR';
                    echo $total.$rs;
                  }
                  else
                  {
                    echo 'Rs. 0';
                  }
                ?>
                    </div></center>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>
        <!-- row end -->

        <div class="row">

    <div class="col-xl-2 mb-4"></div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-success text-uppercase mb-1"><center>Profit</center></div>
                    <center>
                    <div class="h1 mb-0 font-weight-bold text-gray-1000">
                    <?php
                  $fetch = "SELECT SUM(`paid`) as total FROM `place_order`";
                  $query_run = mysqli_query($con,$fetch);
                  while($row = mysqli_fetch_assoc($query_run))
                  {
                    $total = $row['total'];
                  }

                  $fetch1 = "SELECT SUM(`total`) as total FROM `stock`";
                  $query_run1 = mysqli_query($con,$fetch1);
                  while($row = mysqli_fetch_assoc($query_run1))
                  {
                    $total1 = $row['total'];
                  }

                  if($total >= $total1){
                    $profit = $total-$total1;
                    $rs = ' INR';
                    echo $profit.$rs;
                  }
                  else
                  {
                    $rs = '0 INR';
                    echo $rs;
                  }
                ?>
                    </div></center>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <!-- Pending Requests Card Example -->
          <div class="col-xl-4 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
              <div class="card-body">
                <div class="row no-gutters align-items-center">
                  <div class="col mr-2">
                    <div class="text-lg font-weight-bold text-warning text-uppercase mb-1"><center>Loss</center></div>
                    <center>
                    <div class="h1 mb-0 font-weight-bold text-gray-1000">
                    <?php
                  $fetch = "SELECT SUM(`paid`) as total FROM `place_order`";
                  $query_run = mysqli_query($con,$fetch);
                  while($row = mysqli_fetch_assoc($query_run))
                  {
                    $total = $row['total'];
                  }

                  $fetch1 = "SELECT SUM(`total`) as total FROM `stock`";
                  $query_run1 = mysqli_query($con,$fetch1);
                  while($row = mysqli_fetch_assoc($query_run1))
                  {
                    $total1 = $row['total'];
                  }

                  if($total1 >= $total){
                    $loss = $total1-$total;
                    $rs = ' INR';
                    echo $loss.$rs;
                  }
                  else
                  {
                    $rs = '0 INR';
                    echo $rs;
                  }
                ?>
                    </div></center>
                  </div>
                </div>
              </div>
            </div>
          </div>

        </div>

    </div>
      <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

  </div>
  <!-- End of Content Wrapper -->


<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
  <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
      <div class="modal-footer">
        <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
        <a class="btn btn-primary" href="logout.php">Logout</a>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap core JavaScript-->
<script src="vendor/jquery/jquery.min.js"></script>
<script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

<!-- Core plugin JavaScript-->
<script src="vendor/jquery-easing/jquery.easing.min.js"></script>

<!-- Custom scripts for all pages-->
<script src="js/admin-2.min.js"></script>

<!-- Page level plugins -->
<script src="vendor/chart.js/Chart.min.js"></script>

<!-- Page level custom scripts -->
<script src="js/demo/chart-area-demo.js"></script>
<script src="js/demo/chart-pie-demo.js"></script>
