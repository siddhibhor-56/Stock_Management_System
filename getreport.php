<?php 

require_once 'includes/core.php';

if($_POST) {

	$startDate = $_POST['startDate'];
	$s_date = new DateTime($startDate);
	$start_date= $s_date->format('Y-m-d');

	$endDate = $_POST['endDate'];
	$e_date = new DateTime($startDate);
	$end_date= $e_date->format('Y-m-d');

	$sql = "SELECT * FROM place_order WHERE order_date >= '$startDate' AND order_date <= '$endDate' and order_status = 'Delivered'";
	$query = $con->query($sql);

	$table = '
	<table border="1" cellspacing="0" cellpadding="0" style="width:100%;">
		<tr>
			<th>Order Date</th>
			<th>Client Name</th>
			<th>Contact</th>
			<th>Grand Total</th>
		</tr>

		<tr>';
		$totalAmount = 0;
		while ($result=$query->fetch_assoc()) {
			$table .= '<tr>
				<td><center>'.$result['order_date'].'</center></td>
				<td><center>'.$result['client_name'].'</center></td>
				<td><center>'.$result['client_contact'].'</center></td>
				<td><center>'.$result['total_amount'].'</center></td>
			</tr>';	
			$totalAmount += $result['total_amount'];
		}
		$table .= '
		</tr>

		<tr>
			<td colspan="3"><center>Total Amount</center></td>
			<td><center>'.$totalAmount.'</center></td>
		</tr>
	</table>
	';	

	echo $table;

}

?>