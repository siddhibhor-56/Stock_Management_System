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
include('user_db.php'); 
?>

<?php
if($update) #if true
    {
        echo "<div class='alert alert-success' role='alert'>
            User Details upadated successfully!
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
  <h2>Update User Details</h2>
  <form class="form-horizontal" method="post" action="user.php" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?php echo $id; ?>">
    <div class="form-group">
      <label class="control-label col-sm-2" for="username">User Name:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" value="<?php echo $username; ?>" name="username" id="username" placeholder="Enter User Name" required>
      </div>
    </div>

    <div class="form-group">
      <label class="control-label col-sm-2" for="email">Email:</label>
      <div class="col-sm-10">          
        <input type="email" value="<?php echo $email; ?>" class="form-control" id="email" placeholder="Email" name="email" required>
      </div>
    </div>
    <div class="form-group">
      <label class="control-label col-sm-2" for="password">Password:</label>
      <div class="col-sm-10">
        <input type="text" value="<?php echo $password; ?>" class="form-control" id="password" placeholder="Password" name="password" required>
      </div>
    </div>
    
    <div class="form-group">        
      <div class="col-sm-offset-2 col-sm-10">
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a type="submit" href="user.php" name="back" class="btn btn-primary">Back</a>
      </div>
    </div>
  </form>
</div>


<?php
include('includes/scripts.php');
include('includes/footer.php');
?>