<?php
require('includes/config.php');

$update=false;
$edit_state=false;
$insert=false;
$delete = false;
$error=false;
$brandname='';
$productname='';
$stockvalue='';
$totalamount='';
$rate='';
// $categoryactive='';
$id=0;

if(isset($_POST['addstock']))
{
    $brandname = mysqli_real_escape_string($con,$_POST['brandname']);
    $productname = mysqli_real_escape_string($con,$_POST['productname']);
    $stockvalue = mysqli_real_escape_string($con,$_POST['stockvalue']);

    // $rate = "SELECT rate FROM product WHERE product_name='$productname'";
    // // $totalamount = $stockvalue * $rate;
    // echo $rate;

    $rate = "SELECT rate FROM product WHERE product_name='$productname'";
    $rate_run = mysqli_query($con, $rate);
    while($row = mysqli_fetch_assoc($rate_run)){
            $totalrate = $row['rate'];
            // echo $totalrate;
                   
        $totalamount = $stockvalue * $totalrate;

    $query = "INSERT INTO stock (brandname,productname,stock_value,total) VALUES('$brandname','$productname','$stockvalue','$totalamount')";  
    $query_run = mysqli_query($con, $query);  
    $insert=true;
    }
}



//updation
if (isset($_GET['edit']))
{
  // Fetch record
    $id = $_GET['edit'];
    $edit_state=true;
    $fetch=mysqli_query($con,"SELECT * FROM `stock` WHERE stock_id=$id");
    $result=mysqli_fetch_array($fetch);
    $brandname = $result['brandname'];
    $productname = $result['productname'];
    $stockvalue = $result['stock_value'];

}
if (isset($_POST['update'])) 
{
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $brandname = mysqli_real_escape_string($con,$_POST['editbrandname']);
    $productname = mysqli_real_escape_string($con,$_POST['editproductname']);
    $stockvalue = mysqli_real_escape_string($con,$_POST['editstockvalue']);
    
    $rate = "SELECT rate FROM product WHERE product_name='$productname'";
    $rate_run = mysqli_query($con, $rate);
    while($row = mysqli_fetch_assoc($rate_run)){
            $totalrate = $row['rate'];
            // echo $totalrate;
                   
        $totalamount = $stockvalue * $totalrate;

        $query = "UPDATE `stock` SET brandname='$brandname', productname='$productname', stock_value='$stockvalue', total='$totalamount' WHERE stock_id=$id";  
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
  $sql = "DELETE FROM `stock` WHERE stock_id=$sno";
  $result = mysqli_query($con, $sql);
}