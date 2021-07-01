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
include('product_db.php');
?>
<?php
if($insert) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Product Added scuccessfully!
          </div>";
    }
?>
<?php
if($delete) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Product Deleted scuccessfully!
          </div>";
    }
?>
<?php
if($update) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Product Details upadated successfully!
          </div>";
    }
?>




<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="product.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label>Product Name</label>
                <input type="text"  name="productname" class="form-control" placeholder="Enter Product Name" required>
            </div>
            <!-- <div class="form-group">
                <label>Quantity</label>
                <input type="text"  name="quantity" class="form-control" placeholder="Quantity" required>
            </div> -->
            <div class="form-group">
                <label>Rate</label>
                <input type="text"  name="rate" class="form-control" placeholder="Rate" required>
            </div>
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
                <label>Status</label>
                <select class="form-control" id="productstatus" name="productstatus">
				          <option value="">~~SELECT~~</option>
				          <option value="1">Available</option>
				          <option value="2">Not Available</option>
				        </select>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="addproduct" class="btn btn-primary">Add</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h3>Product Details</h3><br>

<div class="row">
<!-- total brands card -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Total Registered Products</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
                      <?php
                          $fetch = "SELECT product_id FROM product ORDER BY product_id";
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
              <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Active Products</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
                      <?php
                          $fetch = "SELECT product_id FROM product WHERE active=1 AND product_status=1 ORDER BY product_id";
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
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
    <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Product</h5>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Product
          </button>
    </div>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Brand</th>
            <!-- <th>Quantity</th> -->
            <th>Rate</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Brand</th>
            <!-- <th>Quantity</th> -->
            <th>Rate</th>
            <th>Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </tfoot>
        <tbody>
     
          <?php
          $fetch="SELECT * FROM `product`";
          $result=mysqli_query($con,$fetch);


          while($row=mysqli_fetch_assoc($result))
          { 

            ?>
          <tr>
            <td><?php echo $row['product_id'] ?> </td>
            <td><?php echo $row['product_name'] ?></td>
            <td><?php echo $row['brand_id'] ?></td>
            <td><?php echo $row['rate'] ?></td>
            <td><?php 
                      $stat = $row['active'];
                      if ($stat == 1) {
                        echo "Available";
                      }
                      else{
                        echo "Not Available";
                      }
                ?>
            </td>
            <td>
                <form action="" method="post">
                    <a class="btn btn-info" href="update_product.php?edit=<?php echo $row['product_id'];?>">Edit</a>
                    </h6>
                  </div>
                </form>
            </td>
            <td>
               <form action="" method="post"> 
                <a class="btn btn-danger" href="<?php $_SERVER['PHP_SELF']?>?delete=<?php echo $row['product_id']; ?>">Delete</a>
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