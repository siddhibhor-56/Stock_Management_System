<?php
require('includes/config.php');

$update=false;
$edit_state=false;
$insert=false;
$delete = false;
$error=false;
$productname='';
$productquantity='';
$productstatus='';
$id=0;

if(isset($_POST['addproduct']))
{
    $productname = mysqli_real_escape_string($con,$_POST['productname']);
    $brandname = mysqli_real_escape_string($con,$_POST['brandname']);
    $productstatus = mysqli_real_escape_string($con,$_POST['productstatus']);
    $rate = mysqli_real_escape_string($con,$_POST['rate']);
    $query = "INSERT INTO product (product_name,brand_id,rate,active,product_status) VALUES('$productname','$brandname','$rate','$productstatus',1)";  
    $query_run = mysqli_query($con, $query);  
    $insert=true;
}



//updation
if (isset($_GET['edit']))
{
  // Fetch record
    $id = $_GET['edit'];
    $edit_state=true;
    $fetch=mysqli_query($con,"SELECT * FROM `product` WHERE product_id=$id");
    $result=mysqli_fetch_array($fetch);
    $productname = $result['product_name'];
    $brandname = $result['brand_id'];
    $rate = $result['rate'];
    $productstatus = $result['product_status']; 

}
if (isset($_POST['update'])) 
{
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $productname = mysqli_real_escape_string($con,$_POST['productname']);
    $brandname = mysqli_real_escape_string($con,$_POST['editbrandname']);
    $rate = mysqli_real_escape_string($con,$_POST['rate']);
    $productstatus = mysqli_real_escape_string($con,$_POST['editproductstatus']);
    

        $query = "UPDATE `product` SET product_name='$productname',brand_id='$brandname',rate='$rate',active='$productstatus',product_status=1 WHERE product_id=$id";  
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
  $sql = "DELETE FROM `product` WHERE product_id=$sno";
  $result = mysqli_query($con, $sql);
}
?>

