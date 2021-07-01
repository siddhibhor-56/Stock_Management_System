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
include('update_order_db.php'); 
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
            Something went Wrong!!!
          </div>";
    }
?>


<div class="container">
  <h3>Update Order Details</h3><br>
  <form class="form-horizontal" method="post" action="manage_order.php">
  <input type="hidden" name="id" value="<?php echo $id; ?>">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus-circle"></i>Update Order Details</h6>
    </div>
  
    <br>
    
    <div class="form-group">
      <label class="control-label col-sm-4" for="editorderDate">Order Date:</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" value="<?php echo $date; ?>" name="editorderDate" id="editorderDate" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="editclientName">Client Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $clientname; ?>" name="editclientName" id="editclientName" placeholder="Client Name" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="editclientContact">Client Contact:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $clientcontact; ?>" name="editclientContact" id="editclientContact" placeholder="Client Contact" required>
      </div>
    </div>

	<div class="form-group">
      <label class="control-label col-sm-4" for="editaddress">Address:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $address; ?>" name="editaddress" id="editaddress" placeholder="Client Address" required>
      </div>
    </div><br>

    

<!-- row started -->
<div class="row">

    <div class="col-md-6">
        <div class="form-group">
                <label for="brandname" class="col-sm-4 control-label">Brand Name</label>
                  <select class="col-sm-10 form-control" id="editbrandname" name="editbrandname">
				      	    <option value="">~~SELECT~~</option>
                    <?php
                    $fetch="SELECT * FROM `brands`";
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
			<label for="editquantity" class="col-sm-4 control-label">Quantity</label>
				<div class="col-sm-10">
				    <input type="text" value="<?php echo $quantity; ?>" class="form-control" id="editquantity" name="editquantity" required/>
				</div>
		</div> 

		<div class="form-group">
			<label for="editpaid" class="col-sm-4 control-label">Amount Paid</label>
				<div class="col-sm-10">
				    <input type="text" value="<?php echo $paid; ?>" class="form-control" id="editpaid" name="editpaid" required/>
				</div>
		</div> 

		<div class="form-group">
			<label for="editpaymentType" class="col-sm-4 control-label">Payment Type</label>
				<div class="col-sm-10">
				    <select class="form-control" name="editpaymentType" id="editpaymentType" required>
				      	<option value="">~~SELECT~~</option>
				      	<option value="Cheque">Cheque</option>
				      	<option value="Cash">Cash</option>
				      	<option value="Credit_Card">Credit Card</option>
				    </select>
				</div>
		</div>

    </div>
    <!-- div col-md-6 close -->

    <div class="col-md-6">
	<div class="form-group">
                <label for="editproductname" class="col-sm-4 control-label">Product Name</label>
                  <select class="col-sm-10 form-control" id="editproductname" name="editproductname">
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

		<div class="form-group">
			<label for="edittotal" class="col-sm-4 control-label">Total Amount</label>
				<div class="col-sm-10">
				    <input type="text" value="<?php echo $total; ?>" class="form-control" id="edittotal" name="edittotal" required />
				</div>
		</div>

		<div class="form-group">
			<label for="editdue" class="col-sm-4 control-label">Due Amount</label>
				<div class="col-sm-10">
				    <input type="text" value="<?php echo $due; ?>" class="form-control" id="editdue" name="editdue" />
				</div>
		</div>

		<div class="form-group">
			<label for="editpaymentStatus" class="col-sm-4 control-label">Payment Status</label>
				<div class="col-sm-10">
				    <select class="form-control" name="editpaymentStatus" id="editpaymentStatus">
				      	<option value="">~~SELECT~~</option>
				      	<option value="Full_Payment">Full Payment</option>
				      	<option value="Advance_Payment">Advance Payment</option>
				      	<option value="No_Payment">No Payment</option>
				    </select>
				</div>
		</div>
	</div>
              <!-- div col-md-6 -->
</div><br>
<!-- row close -->

    <!-- Buttons -->
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a type="submit" href="manage_order.php" name="back" class="btn btn-primary">Back</a>
      </div>
    </div>
    <!-- Buttons -->

  </form>
  </div>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>