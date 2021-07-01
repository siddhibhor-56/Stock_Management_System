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
include('add_order_db.php');
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
if($emailstock_error) #if true
    {
        echo "<div class='alert alert-danger' role='alert'>
            Email did not match!
          </div>";
    }
?>
<?php
if($errororder) #if true
    {
        echo "<div class='alert alert-danger' role='alert'>
            Not Updated, try again!
          </div>";
    }
?>


<div class="container">
  <h3>Add Order Details</h3><br>
  <form class="form-horizontal" method="post" action="add_order.php">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-plus-circle"></i>Add Order</h6>
    </div>
  
    <br>
    <div class="form-group">
      <label class="control-label col-sm-4" for="orderDate">Order Date:</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" name="orderDate" id="orderDate" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="clientName">Client Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="clientName" id="clientName" placeholder="Client Name" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="clientContact">Client Contact:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="clientContact" id="clientContact" placeholder="Client Contact" required>
      </div>
    </div>

	<div class="form-group">
      <label class="control-label col-sm-4" for="address">Address:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="address" id="address" placeholder="Client Address" required>
      </div>
    </div><br>

<!-- row started -->
<div class="row">

    <div class="col-md-6">
        <div class="form-group">
                <label for="brandname" class="col-sm-4 control-label">Brand Name</label>
                <div class="col-sm-10">
                  <select class="form-control" id="brandname" name="brandname" required>
				      	    <option selected disabled>--SELECT--</option>
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
			<label for="quantity" class="col-sm-4 control-label">Quantity</label>
				<div class="col-sm-10">
				    <input type="text" class="form-control" id="quantity" name="quantity" placeholder="Quantity" required/>
				</div>
		</div> 

		<div class="form-group">
			<label for="paid" class="col-sm-4 control-label">Amount Paid</label>
				<div class="col-sm-10">
				    <input type="text" class="form-control" id="paid" name="paid" placeholder="Paid Amount"  required />
				</div>
		</div> 

		<div class="form-group">
			<label for="clientContact" class="col-sm-4 control-label">Payment Type</label>
				<div class="col-sm-10">
				    <select class="form-control" name="paymentType" id="paymentType" required> 
				      	<option selected disabled>--SELECT--</option>
				      	<option value="Cheque">Cheque</option>
				      	<option value="Cash">Cash</option>
				      	<option value="Credit_Card">Credit Card</option>
				    </select>
				</div>
		</div>
    <!-- <div class="form-group">
      <label for="clientContact" class="col-sm-4 control-label">Online Payment Id</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" id="onlinepaymentid" name="onlinepaymentid" placeholder="Online Id" value="N/A" required />
        </div>
    </div> -->

    </div>
    <!-- div col-md-6 close -->

    <div class="col-md-6">
	     <div class="form-group">
                <label for="productname" class="col-sm-4 control-label">Product Name</label>
                <div class="col-sm-10">
                  <select class="form-control" id="productname" name="productname" required>
				      	    <option selected disabled>--SELECT--</option>
                    <?php
                    $fetch="SELECT * FROM `stock`";
                    $result=mysqli_query($con,$fetch);
                   if($result)
                   {
                    while ($row = mysqli_fetch_assoc($result)) {
                      $productname=$row['productname'];
                      echo "<option>$productname<br></option>";
                    }
                   }
                  ?>
				          </select>
                </div>
            </div>

		<div class="form-group">
			<label for="total" class="col-sm-4 control-label">Total Amount</label>
				<div class="col-sm-10">
				    <input type="text" class="form-control" id="total" name="total" required />
				</div>
		</div>

		<div class="form-group">
			<label for="due" class="col-sm-4 control-label">Due Amount</label>
				<div class="col-sm-10">
				    <input type="text" class="form-control" id="due" name="due" placeholder="Due Amount" required />
				</div>
		</div>

		<div class="form-group">
			<label for="clientContact" class="col-sm-4 control-label">Payment Status</label>
				<div class="col-sm-10">
				    <select class="form-control" name="paymentStatus" id="paymentStatus" required>
				      	<option selected disabled>--SELECT--</option>
				      	<option value="Full_Payment">Full Payment</option>
				      	<option value="Advance_Payment">Advance Payment</option>
				      	<option value="No_Payment">No Payment</option>
				    </select>
				</div>
		</div>
    <!-- <div class="form-group">
      <label for="due" class="col-sm-4 control-label">Email</label>
        <div class="col-sm-10">
            <input type="text" placeholder="Enter Your Email" class="form-control" id="email" name="email" required />
        </div>
    </div> -->
	</div>
              <!-- div col-md-6 -->
</div><br>
<!-- row close -->

    <!-- Buttons -->
    <center>
	<div class="form-group submitButtonFooter">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-success" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."><i class="fas fa-plus-circle"></i> Add Row</button>
			<button type="submit" name="addorder" id="addorder" class="btn btn-primary"><i class="fas fa-check-circle"></i> Add Order</button>
			<button type="reset" class="btn btn-danger" onclick="resetOrderForm()"><i class="fas fa-eraser"></i> Reset</button>
		</div>
	</div>
	</center>
    <!-- Buttons -->

  </form>
  </div>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>