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
include('stock_db.php');
?>
<?php
if($insert) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Stock Added successfully!
          </div>";
    }
?>
<?php
if($delete) #if true
    {
        echo "<div class='alert alert-danger' role='alert'>
            Stock Deleted successfully!
          </div>";
    }
?>
<?php
if($update) #if true
    {
        echo "<div class='alert alert-primary' role='alert'>
            Stock Details upadated successfully!
          </div>";
    }
?>




<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Stock</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="stock.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label>Brand Name</label>
                  <select class="form-control" id="brandname" name="brandname">
				      	    <option value="">~~SELECT~~</option>
                    <?php
                    $fetch="SELECT * FROM `brands` WHERE brand_active=1 AND brand_status=1";
                    $result=mysqli_query($con,$fetch);
                   if($result)
                   {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $brandname=$row['brand_name'];
                      echo "<option>$brandname<br></option>";
                    }
                   }

                  ?>
				          </select>
            </div>

            <div class="form-group">
                <label>Product Name</label>
                  <select class="form-control" id="productname" name="productname">
				      	    <option value="">~~SELECT~~</option>
                    <?php
                    $fetch="SELECT * FROM `product` WHERE active=1 AND product_status=1";
                    $result=mysqli_query($con,$fetch);
                   if($result)
                   {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $productname=$row['product_name'];
                      echo "<option>$productname<br></option>";
                    }
                   }
                  ?>
				          </select>
            </div>

            <div class="form-group">
                <label>Quantity(Units or KG)</label>
                <input type="text"  name="stockvalue" class="form-control" placeholder="Quantity" required>
            </div>

            <!-- <div class="form-group">
                <label>Price(Per Valur or KG)</label>
                <input type="text"  name="stockprice" class="form-control" placeholder="Price" required>
            </div> -->
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="addstock" class="btn btn-primary">Add</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h3>Stock Details</h3><br>

<div class="row">
<!-- total brands card -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Total Stock</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
              <?php
                  $fetch = "SELECT SUM(`stock_value`) as total FROM `stock`";
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

<!-- total active brands card -->
<div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Amunt Invested</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
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
  <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Stock</h5>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Stock
          </button>
    </div>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Brand</th>
            <th>Product</th>
            <th>Quantity</th>
            <!-- <th>Price</th> -->
            <th>Total Amount</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
          <th>ID</th>
            <th>Brand</th>
            <th>Product</th>
            <th>Quantity</th>
            <!-- <th>Price</th> -->
            <th>Total Amount</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </tfoot>
        <tbody>
     
          <?php
          $fetch="SELECT * FROM `stock`";
          $result=mysqli_query($con,$fetch);


          while($row=mysqli_fetch_assoc($result))
          { 

            ?>
          <tr>
            <td><?php echo $row['stock_id'] ?> </td>
            <td><?php echo $row['brandname'] ?></td>
            <td><?php echo $row['productname'] ?></td>
            <td><?php echo $row['stock_value'] ?></td>
            <td><?php echo $row['total'] ?></td>
            
            <td>
                <form action="" method="post">
                    <a class="btn btn-info" href="update_stock.php?edit=<?php echo $row['stock_id'];?>">Edit</a>
                    </h6>
                  </div>
                </form>
            </td>
            <td>
               <form action="" method="post"> 
                <a class="btn btn-danger" href="<?php $_SERVER['PHP_SELF']?>?delete=<?php echo $row['stock_id']; ?>">Delete</a>
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