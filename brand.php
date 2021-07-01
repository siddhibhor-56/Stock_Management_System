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
include('brand_db.php');
?>
<?php
if($insert) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Brand Added scuccessfully!
          </div>";
    }
?>
<?php
if($delete) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Brand deleted scuccessfully!
          </div>";
    }
?>
<?php
if($update) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Brand Details upadated successfully!
          </div>";
    }
?>


<div class="modal fade" id="addadminprofile" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Add Brand</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="brand.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Brand Name </label>
                <input type="text"  name="brandname" class="form-control" placeholder="Enter Brand Name" required>
            </div>
            <div class="form-group">
                <label>Brand Status</label>
                  <select class="form-control" id="brandstatus" name="brandstatus">
				      	    <option value="">~~SELECT~~</option>
				      	    <option value="1">Available</option>
				      	    <option value="2">Not Available</option>
				          </select>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="addbrand" class="btn btn-primary">Add</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h3>Brand Details</h3><br>

<div class="row">
<!-- total brands card -->
    <div class="col-xl-3 col-md-6 mb-5">
      <div class="card border-left-success shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-success text-uppercase mb-2">Total Registered Brands</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
                      <?php
                          $fetch = "SELECT brand_id FROM brands ORDER BY brand_id";
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
      <div class="card border-left-info shadow h-100 py-2">
        <div class="card-body">
          <div class="row no-gutters align-items-center">
            <div class="col mr-2">
              <div class="text-xs font-weight-bold text-info text-uppercase mb-2">Active Brands</div>
              <div class="h4 mb-0 font-weight-bold text-gray-800">
                      <?php
                          $fetch = "SELECT brand_id FROM brands WHERE brand_active=1 AND brand_status=1 ORDER BY brand_id";
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
        <h5 class="m-0 font-weight-bold text-primary">Brands</h5>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Brand
          </button>
    </div>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Brand Name</th>
            <th>Brand Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Brand Name</th>
            <th>Brand Status</th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </tfoot>
        <tbody>
     
          <?php
          $fetch="SELECT * FROM `brands`";
          $result=mysqli_query($con,$fetch);


          while($row=mysqli_fetch_assoc($result))
          { 

            ?>
          <tr>
            
            <td><?php echo $row['brand_id'] ?> </td>
            <td><?php echo $row['brand_name'] ?></td>
            <td><?php 
                      $stat = $row['brand_active'];
                      if ($stat == 1) {
                        echo "Available";
                      }
                      else{
                        echo "Not Available";
                      }
                      ?></td>
            <td>
                <form action="" method="post">
                    <a class="btn btn-info" href="update_brand.php?edit=<?php echo $row['brand_id'];?>">Edit</a>
                    </h6>
                  </div>
                </form>
            </td>
            <td>
               <form action="" method="post"> 
                <a class="btn btn-danger" href="<?php $_SERVER['PHP_SELF']?>?delete=<?php echo $row['brand_id']; ?>">Delete</a>
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