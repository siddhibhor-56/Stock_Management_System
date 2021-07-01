<?php

// Inialize session
session_start();

// Check, if username session is NOT set then this page will jump to login page
if (!isset($_SESSION['userId'])) {
header('Location: index.php');
}

?>

<?php 

require_once 'includes/core.php';

// remove all session variables
session_unset(); 

// destroy the session 
session_destroy(); 

header('location: http://localhost/stock_mgmnt/admin/admin/index.php');

?>