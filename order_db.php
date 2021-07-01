<?php
require('includes/config.php');

$update=false;
$edit_state=false;
$insert=false;
$delete = false;
$error=false;
$errororder=false;
$orderupdate=false;
$productname='';
$productquantity='';
$productstatus='';
$id=0;

if(isset($_POST['addorder']))
{
    $orderDate = mysqli_real_escape_string($con,$_POST['orderDate']);
    $clientName = mysqli_real_escape_string($con,$_POST['clientName']);
    $clientContact = mysqli_real_escape_string($con,$_POST['clientContact']);
    $address = mysqli_real_escape_string($con,$_POST['address']);
    $brandname = mysqli_real_escape_string($con,$_POST['brandname']);
    $quantity = mysqli_real_escape_string($con,$_POST['quantity']);
    $paid = mysqli_real_escape_string($con,$_POST['paid']);
    $paymentType = mysqli_real_escape_string($con,$_POST['paymentType']);
    $productname = mysqli_real_escape_string($con,$_POST['productname']);
    $total = mysqli_real_escape_string($con,$_POST['total']);
    $due = mysqli_real_escape_string($con,$_POST['due']);
    $paymentStatus = mysqli_real_escape_string($con,$_POST['paymentStatus']);
    $order_status = 'Pending';
    
        $order = "INSERT INTO place_order (order_date,client_name,client_contact,brand,product,quantity,client_address,total_amount,paid,due,payment_type,payment_status,order_status)  VALUES('$orderDate','$clientName','$clientContact','$brandname','$productname','$quantity','$address','$total','$paid','$due','$paymentType','$paymentStatus','$order_status') ";  
        $query_run = mysqli_query($con, $order);
        if($query_run)
            {
                $insert=true;
            }
            else 
            {
                $error=true;  
            } 

}



//updation
if (isset($_GET['edit']))
{
  // Fetch record
  $id = $_GET['edit'];
  $edit_state=true;
  $fetch=mysqli_query($con,"SELECT * FROM `place_order` WHERE order_id=$id");
  $result=mysqli_fetch_array($fetch);
  $orderDate = mysqli_real_escape_string($con,$_POST['orderDate']);
    $clientName = mysqli_real_escape_string($con,$_POST['clientName']);
    $clientContact = mysqli_real_escape_string($con,$_POST['clientContact']);
    $address = mysqli_real_escape_string($con,$_POST['address']);
    $brandname = mysqli_real_escape_string($con,$_POST['brandname']);
    $quantity = mysqli_real_escape_string($con,$_POST['quantity']);
    $paid = mysqli_real_escape_string($con,$_POST['paid']);
    $paymentType = mysqli_real_escape_string($con,$_POST['paymentType']);
    $productname = mysqli_real_escape_string($con,$_POST['productname']);
    $total = mysqli_real_escape_string($con,$_POST['total']);
    $due = mysqli_real_escape_string($con,$_POST['due']);
    $paymentStatus = mysqli_real_escape_string($con,$_POST['paymentStatus']);
    // $order_status = 'Pending';

}
if (isset($_POST['update'])) 
{
    $id = mysqli_real_escape_string($con,$_POST['id']);
    $date = mysqli_real_escape_string($con,$_POST['editorderDate']);
    $clientname = mysqli_real_escape_string($con,$_POST['editclientName']);
    $clientcontact = mysqli_real_escape_string($con,$_POST['editclientContact']);
    $address = mysqli_real_escape_string($con,$_POST['editaddress']);
    $brandname = mysqli_real_escape_string($con,$_POST['editbrandname']);
    $productname = mysqli_real_escape_string($con,$_POST['editproductname']);
    $quantity = mysqli_real_escape_string($con,$_POST['editquantity']);
    $total = mysqli_real_escape_string($con,$_POST['edittotal']);
    $paid = mysqli_real_escape_string($con,$_POST['editpaid']);
    $due = mysqli_real_escape_string($con,$_POST['editdue']);
    $paymenttype = mysqli_real_escape_string($con,$_POST['editpaymentType']);
    $paymentstatus = mysqli_real_escape_string($con,$_POST['editpaymentStatus']);
    

    $query = "UPDATE `place_order` SET order_date='$date', client_name='$clientname',client_contact='$clientcontact',brand='$brandname',product=$productname,quantity=$quantity,client_address=$address,total_amount=$total,paid=$paid,due=$due,payment_type=$paymenttype,payment_status=$paymentstatus WHERE order_id=$id";  
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
          
    

//Update order status
if (isset($_GET['updatestatus']))
{
  // Fetch record
    $id = $_GET['updatestatus'];
    $edit_state=true;
    $fetch=mysqli_query($con,"SELECT * FROM `place_order` WHERE order_id=$id");
    $result=mysqli_fetch_array($fetch);
    $current_status = $result['order_status'];

}

if(isset($_POST['orderstatus']))
{
    $orderid = mysqli_real_escape_string($con,$_POST['id']);
    $status = mysqli_real_escape_string($con,$_POST['changestatus']);
    $query = "UPDATE `place_order` SET order_status='$status'WHERE order_id=$orderid";
    $query_run = mysqli_query($con, $query);
    if ($query_run) {
      $orderupdate=true;
    }
    else
    {
        $errororder=true;
    }

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

