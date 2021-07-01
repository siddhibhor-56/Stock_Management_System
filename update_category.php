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
include('category_db.php'); 
?>

<?php
if($update) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Category Details upadated successfully!
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
  <h2>Update Category Details</h2>
  <form class="form-horizontal" method="post" action="category.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <label class="control-label col-sm-2" for="categoryname">Brand Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $categoryname; ?>" name="categoryname" id="categoryname" placeholder="Enter Category Name" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="categorystatus">Category Status:</label>
      <div class="col-sm-10">          
      <select class="form-control" id="editcategorystatus" name="editcategorystatus">
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