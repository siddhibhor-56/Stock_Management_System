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
include('order_db.php');
?>
<?php
if($insert) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Order Added scuccessfully!
          </div>";
    }
?>
<?php
if($delete) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Order Deleted scuccessfully!
          </div>";
    }
?>
<?php
if($update) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Order Details upadated successfully!
          </div>";
    }
?>
<?php
if($error) #if true
    {
        echo "<div class='alert alert-danger' role='alert'>
            Order Details not upadated!
          </div>";
    }
?>


<div class="container-fluid">
<h3>Order Details</h3><br>

<div class="row">
<!-- total brands card -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Total Orders</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
                      <?php
                          $fetch = "SELECT order_id FROM place_order ORDER BY order_id";
                          $query_run = mysqli_query($con,$fetch);
                          $row = mysqli_num_rows($query_run);
                          echo "$row";
                      ?>
              </div>
            </div>
            <!-- <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div> -->
          </div>
        </div>
      </div>
    </div>

<!-- total active brands card -->
<div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Stock Delivered</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
              <?php
                  $fetch = "SELECT SUM(`quantity`) as total FROM `place_order` WHERE order_status='Delivered'";
                  $query_run = mysqli_query($con,$fetch);
                  while($row = mysqli_fetch_assoc($query_run))
                  {
                    $total = $row['total'];
                  }
                  if($total){
                    echo $total;
                  }
                  else
                  {
                    echo 0;
                  }

                ?>
              </div>
            </div>
            <!-- <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div> -->
          </div>
        </div>
      </div>
    </div>

    <!-- pending stock -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-primary shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-primary text-uppercase mb-2">Stock Pending for Delivery</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
              <?php
                  $fetch = "SELECT SUM(`quantity`) as total FROM `place_order` WHERE order_status='Pending'";
                  $query_run = mysqli_query($con,$fetch);
                  while($row = mysqli_fetch_assoc($query_run))
                  {
                    $total = $row['total'];
                  }
                  if($total){
                    echo $total;
                  }
                  else
                  {
                    echo 0;
                  }

                ?>
              </div>
            </div>
            <!-- <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div> -->
          </div>
        </div>
      </div>
    </div>

    <!-- earnings -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-warning shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-warning text-uppercase mb-2">Total Earning</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
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
              </div>
            </div>
            <!-- <div class="col-auto">
              <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
            </div> -->
          </div>
        </div>
      </div>
    </div>

</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit"></i> Manage Orders</h6>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Order Date</th>
            <th>Brand</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Client Name</th>
            <!-- <th>Contact</th> -->
            <th>Payment Status</th>
            <th>Order Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Order Date</th>
            <th>Brand</th>
            <th>Product</th>
            <th>Quantity</th>
            <th>Client Name</th>
            <!-- <th>Contact</th> -->
            <th>Payment Status</th>
            <th>Order Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </tfoot>
        <tbody>
     
          <?php
          $fetch="SELECT * FROM `place_order`";
          $result=mysqli_query($con,$fetch);
          while($row=mysqli_fetch_assoc($result))
          { 

            ?>
          <tr>
            <td><?php echo $row['order_id'] ?> </td>
            <td><?php echo $row['order_date'] ?></td>
            <td><?php echo $row['brand'] ?> </td>
            <td><?php echo $row['product'] ?></td>
            <td><?php echo $row['quantity'] ?></td>
            <td><?php echo $row['client_name'] ?></td>
            <!-- <td><?php echo $row['client_contact'] ?></td> -->
            <td><?php echo $row['payment_status'] ?></td>
            <td><?php echo $row['order_status'] ?>
              <a class="btn btn-success" href="order_status.php?updatestatus=<?php echo $row['order_id'] ?>">Change Status</button>
            </td>
            <td>
                <form action="" method="post">
                    <a class="btn btn-info" href="update_order.php?edit=<?php echo $row['order_id'];?>">Edit</a>
                    </h6>
                  </div>
                </form>
            </td>
            <td>
               <form action="" method="post"> 
                <a class="btn btn-danger" href="<?php $_SERVER['PHP_SELF']?>?delete=<?php echo $row['order_id']; ?>">Delete</a>
              </form>
            </td>
          </tr>
          <?php
         }
      

        ?>
        
        </tbody>
      </table>

    </div>
  </div>
</div>

</div>
<!-- /.container-fluid -->

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>