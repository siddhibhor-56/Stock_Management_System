<?php

$fetch = "SELECT brandname, count(*) as number FROM stock GROUP BY brandname";
$result  =mysqli_query($con,$fetch);

// $fetch = "SELECT productname, count(*) as product FROM place_order GROUP BY productname";
// $sub_category  =mysqli_query($con,$fetch);
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
          ['Main Category', 'Number'],  
          <?php  
          while($row = mysqli_fetch_array($result))  
          {  
               echo "['".$row["brandname"]."', ".$row["number"]."],";  
          }  
          ?>  
     ]);  
    var options = {  
          title: '',  
          is3D:true,  
          pieHole: 0.4  
         };  
    var chart = new google.visualization.PieChart(document.getElementById('piechart'));  
    chart.draw(data, options);  
   }  
   </script>  
</head>
<body>

</body>
</html>

