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


<div class="container">
  <h3>Update Order Status</h3><br>
  <form class="form-horizontal" method="post" action="manage_order.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">

    <div class="form-group">
      <label class="control-label col-sm-2" for="orderid">Order ID:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" value="<?php echo $id; ?>" name="orderid" id="orderid" disabled required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="currentstatus">Current Status:</label>
      <div class="col-sm-5">
        <input type="text" class="form-control" value="<?php echo $current_status; ?>" name="currentstatus" id="currentstatus" disabled required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="changestatus">Change Status:</label>
      <div class="col-sm-5">          
      <select class="form-control" id="changestatus" name="changestatus">
				      <option value="">~~SELECT~~</option>
				      <option value="Pending">Pending</option>
				      <option value="Delivered">Delivered</option>
                      <option value="Cancelled">Cancelled</option>
				  </select>
      </div>
    </div>
    
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="orderstatus" class="btn btn-primary">Update</button>
        <a type="submit" href="manage_order.php" name="back" class="btn btn-primary">Back</a>
      </div>
    </div>
  </form>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>