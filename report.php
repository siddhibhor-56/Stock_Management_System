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
?>


<div class="container">
  <h3>Report</h3><br>
  <form class="form-horizontal" method="post" action="getreport.php" id="getOrderReportForm">

  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-check-circle"></i> Order Report</h6>
    </div>
  
    <br>
    <div class="form-group">
      <label class="control-label col-sm-4" for="startdate">Start Date:</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" name="startDate" id="startDate" placeholder="Start Date" required/>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-4" for="enddate">End Date:</label>
      <div class="col-sm-10">
        <input type="date" class="form-control" name="endDate" id="endDate" placeholder="End Date" required/>
      </div>
    </div><br>
    
    <!-- Buttons -->
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="generateReportBtn" class="btn btn-success" value="generate_report" id="generateReportBtn">Generate Report</button>
      </div>
    </div>
    <!-- Buttons -->

  </form>
</div>

<script src="js/report.js"></script>

<?php
include('includes/scripts.php');
include('includes/footer.php');
?>