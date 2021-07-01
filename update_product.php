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
if($update) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Product Details upadated successfully!
          </div>";
    }
?>
<?php
if($error) #if true
    {
        echo "<div class='alert alert-danger' role='alert'>
            Something went Wrong!!!
          </div>";
    }
?>

<div class="container">
  <h2>Update Product Details</h2>
  <form class="form-horizontal" method="post" action="product.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <label class="control-label col-sm-2" for="productname">Product Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $productname; ?>" name="productname" id="productname" placeholder="Enter Product Name" required>
      </div>
    </div>

    <!-- <div class="form-group">
      <label class="control-label col-sm-2" for="quantity">Quantity:</label>
      <div class="col-sm-10">          
        <input type="text" value="<?php echo $productquantity; ?>" class="form-control" id="quantity" placeholder="Quantity" name="quantity" required>
      </div>
    </div> -->
    <div class="form-group">
      <label class="control-label col-sm-2" for="rate">Rate:</label>
      <div class="col-sm-10">
        <input type="text" value="<?php echo $rate; ?>" class="form-control" id="rate" placeholder="Rate" name="rate" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="brandname">Brand Name:</label>
      <div class="col-sm-10">
          <select class="form-control" id="editbrandname" name="editbrandname">
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
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="productstatus">Status:</label>
      <div class="col-sm-10">
          <select class="form-control" id="editproductstatus" name="editproductstatus">
				      <option value="">~~SELECT~~</option>
				      <option value="1">Available</option>
				      <option value="2">Not Available</option>
				  </select>
      </div>
    </div>
    
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a type="submit" href="category.php" name="back" class="btn btn-primary">Back</a>
      </div>
    </div>
  </form>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>