<?php
require('includes/config.php');

$update=false;
$edit_state=false;
$insert=false;
$delete = false;
$error=false;
$brandname='';
$brandstatus='';
$brandactive='';
$id=0;

if(isset($_POST['addbrand']))
{
    $brandname = mysqli_real_escape_string($con,$_POST['brandname']);
    $brandstatus = mysqli_real_escape_string($con,$_POST['brandstatus']);
    $query = "INSERT INTO brands (brand_name,brand_active,brand_status) VALUES('$brandname','$brandstatus',1)";  
    $query_run = mysqli_query($con, $query);  
    $insert=true;
}



//updation
if (isset($_GET['edit']))
{
  // Fetch record
    $id = $_GET['edit'];
    $edit_state=true;
    $fetch=mysqli_query($con,"SELECT brand_name, brand_status FROM `brands` WHERE brand_id=$id");
    $result=mysqli_fetch_array($fetch);
    $brandname = $result['brand_name'];
    $brandstatus = $result['brand_status'];
    // $brandactive = $result['brand_active'];

}
if (isset($_POST['update'])) 
{
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $brandname = mysqli_real_escape_string($con,$_POST['brandname']);
    $brandstatus = mysqli_real_escape_string($con,$_POST['editbrandstatus']);

        $query = "UPDATE `brands` SET brand_name='$brandname', brand_active='$brandstatus' WHERE brand_id=$id";  
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
  $sql = "DELETE FROM `brands` WHERE brand_id=$sno";
  $result = mysqli_query($con, $sql);
}