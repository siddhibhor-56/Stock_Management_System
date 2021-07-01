<?php
require('includes/config.php');

$update=false;
$edit_state=false;
$insert=false;
$delete = false;
$error=false;
$username='';
$email='';
$password='';
$id=0;

if(isset($_POST['adduser']))
{
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = md5(mysqli_real_escape_string($con,$_POST['password']));
    $query = "INSERT INTO users (username,email,passwd) VALUES('$username','$email','$password')";  
    $query_run = mysqli_query($con, $query);  
    $insert=true;
}



//updation
if (isset($_GET['edit']))
{
  // Fetch record
    $id = $_GET['edit'];
    $edit_state=true;
    $fetch=mysqli_query($con,"SELECT * FROM `users` WHERE user_id=$id");
    $result=mysqli_fetch_array($fetch);
    $username = $result['username'];
    $email = $result['email'];
    $password = $result['password'];

}
if (isset($_POST['update'])) 
{
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $username = mysqli_real_escape_string($con,$_POST['username']);
    $email = mysqli_real_escape_string($con,$_POST['email']);
    $password = mysqli_real_escape_string($con,$_POST['password']);
    

        $query = "UPDATE `users` SET username='$username', email='$email',password='$password' WHERE user_id=$id";  
        $query_run = mysqli_query($con, $query);
            
            if($query_run)
            {
                $update=true;
            }
            else 
            {
                $error=true;  
            }
        }
        else 
        {
            // $error=true; 
        }
          
    


//delete
if(isset($_GET['delete']))
{
  $sno = $_GET['delete'];
  $delete=true;
  $sql = "DELETE FROM `users` WHERE user_id=$sno";
  $result = mysqli_query($con, $sql);
}
?>

