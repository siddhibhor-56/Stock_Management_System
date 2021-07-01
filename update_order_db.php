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


//updation
if (isset($_GET['edit']))
{
  // Fetch record
    $id = $_GET['edit'];
    $edit_state=true;
    $fetch=mysqli_query($con,"SELECT * FROM `place_order` WHERE order_id=$id");
    $result=mysqli_fetch_array($fetch);
    $date = $result['order_date'];
    $clientname = $result['client_name'];
    $clientcontact = $result['client_contact'];
    $address = $result['client_address'];
    $brandname = $result['brand'];
    $productname = $result['product'];
    $quantity = $result['quantity'];
    $total = $result['total_amount'];
    $paid = $result['paid'];
    $due = $result['due'];
    $paymenttype = $result['payment_type'];
    $paymentstatus = $result['payment_status'];

}
if (isset($_POST['update'])) 
{
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $orderDate = mysqli_real_escape_string($con,$_POST['editorderDate']);
    $clientName = mysqli_real_escape_string($con,$_POST['editclientName']);
    $clientContact = mysqli_real_escape_string($con,$_POST['editclientContact']);
    $address = mysqli_real_escape_string($con,$_POST['editaddress']);
    $brandname = mysqli_real_escape_string($con,$_POST['editbrandname']);
    $quantity = mysqli_real_escape_string($con,$_POST['editquantity']);
    $paid = mysqli_real_escape_string($con,$_POST['editpaid']);
    $paymentType = mysqli_real_escape_string($con,$_POST['editpaymentType']);
    $productname = mysqli_real_escape_string($con,$_POST['editproductname']);
    $total = mysqli_real_escape_string($con,$_POST['edittotal']);
    $due = mysqli_real_escape_string($con,$_POST['editdue']);
    $paymentStatus = mysqli_real_escape_string($con,$_POST['editpaymentStatus']);
    $orderstatus = 'Pending';
    
        $query = "UPDATE `place_order` SET order_date='$orderDate', client_name='$clientName',client_contact='$clientContact',brand='$brandname',product='$productname',quantity='$quantity',client_address='$address',total_amount='$total',paid='$paid',due='$due',payment_type='$paymentType',payment_status='$paymentStatus',order_status='$orderstatus' WHERE order_id=$id";  
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
  $sql = "DELETE FROM `place_order` WHERE order_id=$sno";
  $result = mysqli_query($con, $sql);
}
?>

