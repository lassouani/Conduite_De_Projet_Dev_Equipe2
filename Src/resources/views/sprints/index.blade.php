@extends('layouts.app')
@section('content')


<script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.js"></script>

@if(isset($message))
<div class="col-md-10 col-md-offset-1">
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <center> <strong>Success! </strong>  {{$message}}</center>
    </div>
</div>
@endif

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <center><h1><b>Sprints</b></h1></center>
                </div>

                <div class="panel-body">




                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <a href="{{ url('sprints/create/'.$id) }}">
                                    <input type="button" class="btn btn-sm btn-primary btn-create pull-right" name="Create"value="Create new Sprint"/>
                                </a>
                            </div>
                        </div>
                        <form method="post" action="{{url('projects/showSprint')}}">
                            {!! csrf_field() !!}
                            <p>choix du sprint :</p>
                            <select name="sprint_choice">
                              @foreach($sprints as $sprint)
                                  <option value="{{$sprint->id}}">{{$sprint->sprint_number}}</option>  
                              @endforeach 
                            </select>
                            <input type="submit" value="Go"/>


                        </form>


                    </div>  
 

<!--=============================================================================-->

</br> </br>
  

    <div class="col-sm-3">
         <div class="panel panel-default">
              <div class="panel-heading">TODO</div>
                 <div class="panel-body">
@unless($KanBanTODO->count())


@else
    <div id="accordion1" class="panel-group">

              @foreach($KanBanTODO as $todo)

              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a href="#{{$todo->id}}" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">Task{{$todo->task_number}}</a>
                  </h4>
                </div>
                <div class="panel-collapse collapse" id="{{$todo->id}}">
                  <div class="panel-body">
                    <b>Description :</b> {{$todo->description}} <br/>
                    <b>UserStory : </b>{{$todo->us}} <br/>
                    <b>Effort : </b>{{$todo->effort}} <br/>
                    <b>Created at : </b>{{$todo->created_at}} <br/>
                    <a href="{{ url('task/status/'.$todo->id) }}"><input type="button" class="btn btn-sm btn-primary btn-create pull-right" 
                                                                   name="Create"value="ON DOING"/></a>
                  </div>
                </div>
              </div>
           @endforeach
              

    </div>
@endunless    
     <span>Task(s) {{$KanBanTODO->count()}} </span>
             </div>

          

       </div>
    </div>

<!--******************************-->


    <div class="col-sm-3">
        <div class="panel panel-default">
              <div class="panel-heading">ON DOING</div>
                 <div class="panel-body">
  
@unless($KanBanONDOING->count())


@else
  <div id="accordion1" class="panel-group">

                
          @foreach($KanBanONDOING as $ondoing)
                <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a href="#{{$ondoing->id}}" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">Task{{$ondoing->task_number}}</a>
                  </h4>
                </div>
                <div class="panel-collapse collapse" id="{{$ondoing->id}}">
                  <div class="panel-body">
                    <b>Description :</b> {{$ondoing->description}} <br/>
                    <b>UserStory : </b>{{$ondoing->effort}} <br/>
                    <b>Effort : </b>{{$ondoing->us}} <br/>
                    <b>Created at : </b>{{$ondoing->created_at}} <br/>
                    <a href="{{ url('task/status/'.$ondoing->id) }}"><input type="button" class="btn btn-sm btn-primary btn-create pull-right" 
                                                                   name="Create"value="TESTING"/></a>
                  </div>
                </div>
              </div>
          @endforeach      

   </div>
 @endunless  
    <span>Task(s) {{$KanBanONDOING->count()}} </span>
         </div>

        </div>
     </div>

<!--**********************************-->


  <div class="col-sm-3">
    <div class="panel panel-info">
              <div class="panel-heading">TESTING</div>
                 <div class="panel-body">
@unless($kanbanTESTING->count())


@else

<div id="accordion1" class="panel-group">

              
          @foreach($kanbanTESTING as $testing)
              <div class="panel panel-primary">
                <div class="panel-heading">
                  <h4 class="panel-title">
                    <a href="#{{$testing->id}}" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">Task{{$testing->task_number}}</a>
                  </h4>
                </div>
                <div class="panel-collapse collapse" id="{{$testing->id}}">
                  <div class="panel-body">
                    <b> Description : </b>{{$testing->description}} <br/>
                    <b>UserStory : </b>{{$testing->effort}} <br/>
                    <b>Effort : </b>{{$testing->us}}<br/>
                    <b>Created at : </b>{{$testing->created_at}} <br/>
                    <a href="{{ url('task/status/'.$testing->id) }}"><input type="button" class="btn btn-sm btn-success btn-create pull-right" 
                                                                            name="Create"value="DONE"/></a>
                  </div>
                </div>
              </div>
          @endforeach
              

</div>
@endunless
      <span> Task(s) {{$kanbanTESTING->count()}} </span>
      </div>
     </div>
  </div>

<!--*************************************-->




  <div class="col-sm-3">

    <div class="panel panel-success">
              <div class="panel-heading">DONE</div>
                 <div class="panel-body">
@unless($kanbanDONE->count())

@else
  <div id="accordion1" class="panel-group">

                
          @foreach($kanbanDONE as $done)
                <div class="panel panel-success">
                  <div class="panel-heading">
                    <h4 class="panel-title">
                      <a href="#{{$done->id}}" data-parent="#accordion" data-toggle="collapse" class="accordion-toggle collapsed">Task{{$done->task_number}}</a>
                    </h4>
                  </div>
                  <div class="panel-collapse collapse" id="{{$done->id}}">
                    <div class="panel-body">
                      <b>Description : </b>{{$done->description}} <br/>
                      <b>Effort : </b>{{$done->effort}} <br/>
                      <b>User Story : </b>{{$done->us}}
                      <b>Created at : </b>{{$done->created_at}}
                    </div>
                  </div>
                </div>
          @endforeach
  </div>
 @endunless 
    <span>Task(s) {{$kanbanDONE->count()}} </span>
        </div>
     </div>
   </div>

 
<!--========================================================================================-->


    </div>


   <div id="container-burndown" style="max-width: 510px; height: 400px;"></div>


 <?php  
$actualArray = array(0, 1, 1,1,4);

$idealArray = range(0, 10, 1);
$idealXArray = array();
foreach ($idealArray as $value){
    $value = trim($value);
    $idealXArray[] = 'Day '.$value;
}  ?>





   

<script src="https://code.jquery.com/jquery-3.1.0.js"></script>
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
      categories: <?php echo json_encode($idealXArray);?>
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
      
      data: <?php echo json_encode(array_reverse($idealArray));?>
    }, {
      name: 'Actual Burn',
      color: 'rgba(0,120,200,0.75)',
      marker: {
        radius: 6
      },
      data: <?php echo json_encode($actualArray);?>
    }]
  });
    });
</script>




 @endsection