$(document).ready(function(){
	$.ajax({
	url:"http://localhost/stock_mgmnt/admin/admin/chartjs/data.php",
	method: "GET",
	success: function(data) {
		console.log(data);
		var stock = [];
		var stock_value =[];

		for(var i in data) {
			stock.push("stock" + data[i].main_category);
			stock_value.push(data[i].stock_value); 
		}

		var chartdata ={
			labels: stock,
			datasets : [
			{
				label: 'stock value',
				backgroundColor:'rgba(20,20,20,0.75)',
				borderColor: 'rgba(20,20,20,0.75)',
				hoverBackgroundColor: 'rgba(2,2,22,1)',
				hoverBorderColor: 'rgba(2,2,22,1)',
				data:stock_value
			}
		]
	};

		var ctx = $("#mycanvas");

		var barGraph = new Chart(ctx, {
			type: 'radar',
			data: chartdata
		});
	},
	error: function(data) {
		console.log(data);
	}

	});
}); 