<?php
require('includes/config.php');

$insert=false;
$delete = false;
$error=false;
$insert=false;
$emailstock_error=false;
$errororder=false;
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


?>
