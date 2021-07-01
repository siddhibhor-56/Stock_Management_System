<?php
require('includes/config.php');

$update=false;
$edit_state=false;
$insert=false;
$delete = false;
$error=false;
$categoryname='';
$categorystatus='';
$categoryactive='';
$id=0;

if(isset($_POST['addcategory']))
{
    $categoryname = mysqli_real_escape_string($con,$_POST['categoryname']);
    $categorystatus = mysqli_real_escape_string($con,$_POST['categorystatus']);
    $query = "INSERT INTO categories (categories_name,categories_active,categories_status) VALUES('$categoryname','$categorystatus',1)";  
    $query_run = mysqli_query($con, $query);  
    $insert=true;
}



//updation
if (isset($_GET['edit']))
{
  // Fetch record
    $id = $_GET['edit'];
    $edit_state=true;
    $fetch=mysqli_query($con,"SELECT * FROM `categories` WHERE categories_id=$id");
    $result=mysqli_fetch_array($fetch);
    $categoryname = $result['categories_name'];
    $categorystatus = $result['categories_status'];
    // $categoryactive = $result['categories_active'];

}
if (isset($_POST['update'])) 
{
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $categoryname = mysqli_real_escape_string($con,$_POST['categoryname']);
    $categorystatus = mysqli_real_escape_string($con,$_POST['editcategorystatus']);

        $query = "UPDATE `categories` SET categories_name='$categoryname', categories_active='$categorystatus' WHERE categories_id=$id";  
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
  $sql = "DELETE FROM `categories` WHERE categories_id=$sno";
  $result = mysqli_query($con, $sql);
}