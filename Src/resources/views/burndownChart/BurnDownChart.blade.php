  

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
<!-- jQuery -->
<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>
<script src="https://code.highcharts.com/highcharts.js"></script>

<title>Burndown charts</title>


</head>
<body>

	<div  class="container">

		<div><div><h3> Burndown charts with highcharts</h3></div>

			<div  class="container" id="container-burndown" style="max-width: 510px; height: 400px;"></div>


            <div  class="container">
			<a href="#null" onclick="javascript:history.back();"> <input type="button" class="btn btn-default pull-left" 
                                                                                             name="contribute"value="Back"/></a>
            </div>

     </div>

<?php 
$actualArray = array(0, 1, 1,1,4);

$idealArray = range(0, 10, 1);
$idealXArray = array();
foreach ($idealArray as $value){
    $value = trim($value);
    $idealXArray[] = 'Day '.$value;
}
 ?>


<script>
jQuery(document).ready(function() {
var doc = $(document);
$('#container-burndown').highcharts({
    title: {
      text: 'Burndown Chart of Project',
      x: -10 //center
    },
    scrollbar: {
                barBackgroundColor: 'gray',
                barBorderRadius: 7,
                barBorderWidth: 0,
                buttonBackgroundColor: 'gray',
                buttonBorderWidth: 0,
                buttonBorderRadius: 7,
                trackBackgroundColor: 'none',
                trackBorderWidth: 1,
                trackBorderRadius: 8,
                trackBorderColor: '#CCC'
            },
    colors: ['blue', 'red'],
    plotOptions: {
      line: {
        lineWidth: 3
      },
      tooltip: {
        hideDelay: 200
      }
    },
    subtitle: {
      text: 'All Project Team Summary',
      x: -10
    },
    xAxis: {
      categories: <?php echo json_encode($idealXArray);?>   // les numéro des sprints
    },
    yAxis: {
      title: {
        text: 'Remaining work (days)'
        
      },
             type: 'linear',
             max:10,
             min:0,
             tickInterval :1
     
    },
    
    tooltip: {
      valueSuffix: ' day',
      crosshairs: true,
      shared: true
    },
    legend: {
     layout: 'horizontal',
      align: 'center',
      verticalAlign: 'bottom',
      borderWidth: 0
    },
    series: [{
      name: 'Ideal Burn',
      color: 'rgba(255,0,0,0.25)',
      lineWidth: 2,
      
      data: <?php echo json_encode(array_reverse($idealArray));?>      // valeur théorique selon le nimbre de sprint
    }, {
      name: 'Actual Burn',
      color: 'rgba(0,120,200,0.75)',
      marker: {
        radius: 6
      },
      data: <?php echo json_encode($actualArray);?>    //valeur réel
    }]
  });
    });
</script>
