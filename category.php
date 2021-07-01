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
if($insert) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Category Added scuccessfully!
          </div>";
    }
?>
<?php
if($delete) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Category Deleted scuccessfully!
          </div>";
    }
?>
<?php
if($update) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            Category Details upadated successfully!
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
      <form action="category.php" method="POST">

        <div class="modal-body">

            <div class="form-group">
                <label> Category Name </label>
                <input type="text"  name="categoryname" class="form-control" placeholder="Enter Category Name" required>
            </div>
            <div class="form-group">
                <label>Category Status</label>
                <select class="form-control" id="categorystatus" name="categorystatus">
				      	    <option value="">~~SELECT~~</option>
				      	    <option value="1">Available</option>
				      	    <option value="2">Not Available</option>
				          </select>
            </div>
        
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" name="addcategory" class="btn btn-primary">Add</button>
        </div>
      </form>

    </div>
  </div>
</div>


<div class="container-fluid">
<h3>Category Details</h3><br>
<!-- DataTales Example -->
<div class="card shadow mb-4">
  <div class="card-header py-3">
  <div class="d-sm-flex align-items-center justify-content-between">
        <h5 class="m-0 font-weight-bold text-primary">Categories</h5>
          <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addadminprofile">
              Add Category
          </button>
    </div>
  </div>

  <div class="card-body">

    <div class="table-responsive">

      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Category Status </th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>ID</th>
            <th>Category Name</th>
            <th>Category Status </th>
            <th>Edit</th>
            <th>Delete</th>
          </tr>
        </tfoot>
        <tbody>
     
          <?php
          $fetch="SELECT * FROM `categories`";
          $result=mysqli_query($con,$fetch);


          while($row=mysqli_fetch_assoc($result))
          { 

            ?>
          <tr>
            <td><?php echo $row['categories_id'] ?> </td>
            <td><?php echo $row['categories_name'] ?></td>
            <td><?php 
                      $stat = $row['categories_active'];
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
                    <a class="btn btn-info" href="update_category.php?edit=<?php echo $row['categories_id'];?>">Edit</a>
                    </h6>
                  </div>
                </form>
            </td>
            <td>
               <form action="" method="post"> 
                <a class="btn btn-danger" href="<?php $_SERVER['PHP_SELF']?>?delete=<?php echo $row['categories_id']; ?>">Delete</a>
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