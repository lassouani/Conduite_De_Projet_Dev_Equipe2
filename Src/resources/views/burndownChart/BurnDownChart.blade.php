  

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


  <div class="container">
    <div class="row">
        <div class="col-sm-4">
             <br/>
          <b>Project Name : </b> {{$project->name}}
        </div>
        <div class="col-sm-8">
             <div  class="container" id="container-burndown" style="max-width: 800px; height: 500px;"></div>
        </div>
    </div>
</div>

			


            <div  class="container">
			<a href="#null" onclick="javascript:history.back();"> <input type="button" class="btn btn-default pull-left" 
                                                                                             name="contribute"value="Back"/></a>
            </div>

     </div>

<?php 
//$actualArray = array(0, 1, 1,1,4);

//$idealArray = range(0, 10, 1);
$idealXArray = array();
$idealMaxArray = array();

foreach ($userstorys as $value){
    //$value = trim($value);
    $idealXArray[] = 'Sprint'.$value->sprint_number;
    echo $value->sprint_number;
}

$x=0;
   $sommemax=0;
   //========================= travaille fait ===============
foreach($userstorys as $userstory){
     $sommemax=$sommemax+$userstory->effort;
}  
$actualArray[] = $sommemax; $idealMaxArray[] = $sommemax; $idealArray[] = $sommemax;

while($x < $userstorys->count()){
    $x++; $somme=0; 
   foreach($userstorys as $userstory){
        if($userstory->sprint_number == $x){
            if($userstory->tracability == null){
              //echo  $userstory->tracability;
               $somme=$somme+$userstory->effort;
            }
            
        }
   }
   if($somme !=0){
   $actualArray[] = $somme;
   $somme=0; 
   }

}
//===================================
$x=0;  $sommeideal=0; $arret=0;
while($x < $userstorys->count()){
    $x++; 
   foreach($userstorys as $userstory){
        if($userstory->sprint_number == $x){
              //echo  $userstory->tracability;
               $sommeideal=$sommeideal+$userstory->effort;         
        }
   }
   if($sommeideal==0 & $arret==0){
     //$idealArray[] = $sommeideal;$sommeideal=0; 
      $arret=1;
   }else{
   $idealArray[] = $sommeideal; //echo $sommeideal;
   $sommeideal=0; 
  }
    
}
//=====================================

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
      text: 'All Project User Story Summary',
      x: -10
    },
    xAxis: {
      categories: <?php echo json_encode($idealXArray);?>   // les numéro des sprints
    },
    yAxis: {
      title: {
        text: 'Remaining work (Effort)'
        
      },
             type: 'linear',
             max: <?php echo intval($sommemax);?> ,
             min:0,
             tickInterval :1
     
    },
    
    tooltip: {
      valueSuffix: ' Effort',
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
      
      data: <?php echo json_encode($idealArray);?>      // valeur théorique selon le nimbre de sprint
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
