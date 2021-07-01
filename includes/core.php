<?php 

session_start();

require_once 'config.php';

// echo $_SESSION['userId'];

if(!$_SESSION['userId']) {
	header('location: http://localhost/stock_mgmnt/admin/admin/index.php');	
} 
?>