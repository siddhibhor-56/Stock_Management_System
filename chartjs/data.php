<?php
//header
header('Content-Type: application/json');

//database
define('DB_HOST', 'localhost');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', "");
define('DB_NAME', 'stock_management_1');

$mysqli = new mysqli(DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);

if(!$mysqli){
	die("Connection failed:" . $mysqli->error);
}
//query to get data from table
$query = sprintf("SELECT stock_value , main_category FROM add_stock ORDER BY addstock_id");
 
$result = $mysqli->query($query);

$data = array();
foreach ($result as $row) {
	$data[] = $row;
}

$result->close();

$mysqli->close();

print json_encode($data);
?>
