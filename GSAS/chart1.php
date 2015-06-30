<?php
include("headers.php");
include("container.php");
getheader();
 
 
 if($_SESSION['user_id']=='')
header ('location:index.php');
?>
		<script type="text/javascript" src="chart/script3.js"></script>
		<script type="text/javascript">
		$(document).ready(function() {
			var options = {
	            chart: {
	                renderTo: 'container',
	                type: 'bar'
	            },
	            title: {
	                text: 'Chart Builder',
	                x: -20 //center
	            },
	            subtitle: {
	                text: '',
	                x: -20
	            },
	            xAxis: {
	                categories: []
	            },
	            yAxis: {
	                min: 0,
	                title: {
	                    text: 'x'
	                },
	                labels: {
	                    overflow: 'justify'
	                }
	            },
	            tooltip: {
	                formatter: function() {
	                        return '<b>'+ this.series.name +'</b><br/>'+
	                        this.x +': '+ this.y;
	                }
	            },
	            legend: {
	                layout: 'horizontal',
	                align: 'right',
	                verticalAlign: 'top',
	                x: -10,
	                y: 100,
	                borderWidth: 0
	            }, 
	            plotOptions: {
	                bar: {
	                    dataLabels: {
	                        enabled: true
	                    }
	                }
	            },
	            series: []
	        }
	        
	        $.getJSON("chart/data.php", function(json) {
				options.xAxis.categories = json[0]['data'];
	        	options.series[0] = json[1];
	        	options.series[1] = json[2];
	 options.series[2] = json[3];
		        chart = new Highcharts.Chart(options);
	        });
	    });
		</script>
	    <script src="chart/script1.js"></script>
        <script src="chart/script2.js"></script>
	</head>
	<body>
	

	 <div class="panel panel-primary" style="margin-top:-20px; border-radius:0px;">

      <div class="panel-body" >
	  <br><br><br>
  
<br><br>
		<div id="container" style=" height: 300px; margin: 2 auto"></div>

</div>
</div>
	</body>
	
<?php
 
include('footer.php');
?>