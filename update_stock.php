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
if($update) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Stock Details upadated successfully!
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
  <h2>Update Stock Details</h2>
  <form class="form-horizontal" method="post" action="stock.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="form-group">
      <label class="control-label col-sm-2" for="brandname">Brand Name:</label>
      <div class="col-sm-10">
          <select class="form-control" id="editbrandname" name="editbrandname" required>
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
      <label class="control-label col-sm-2" for="productname">Product Name:</label>
      <div class="col-sm-10">
          <select class="form-control" id="editproductname" name="editproductname" required>
				      <option value="">~~SELECT~~</option>
                      <?php
                    $fetch="SELECT * FROM `product`";
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
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="stockvalue">Stock Value:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $stockvalue; ?>" name="editstockvalue" id="editstockvalue" placeholder="Stock Value" required>
      </div>
    </div>

    <!-- <div class="form-group">
      <label class="control-label col-sm-2" for="stockprice">Stock Price:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $stockprice; ?>" name="editstockprice" id="editstockprice" placeholder="Stock Price" required>
      </div>
    </div> -->
    
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a type="submit" href="stock.php" name="back" class="btn btn-primary">Back</a>
      </div>
    </div>
  </form>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>