<?php

$fetch = "SELECT product,quantity FROM place_order ORDER BY order_id";
$result  =mysqli_query($con,$fetch);

?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://www.gstatic.com/charts/loader.js"></script>
  <script>
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      // Define the chart to be drawn.
      var data = google.visualization.arrayToDataTable([  
          ['Product', 'Quantity'],  
          <?php  
          while($row = mysqli_fetch_array($result))  
          {  
               echo "['".$row["product"]."', ".$row["quantity"]."],";  
          }  
          ?>  
     ]);  
    var options = {  
          title: '',  
          is3D:true,  
          pieHole: 0.4  
         };  
    var chart = new google.visualization.BarChart(document.getElementById('barchart'));  
    chart.draw(data, options);  
   }  
   </script>  
</head>
<body>

</body>
</html>

