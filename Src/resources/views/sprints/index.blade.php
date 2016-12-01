@extends('layouts.app')
@section('content')

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



    <?php
$now   = time();
$date2 = strtotime('2012-08-14 16:01:05');
 
function dateDiff($date1, $date2){
    $diff = abs($date1 - $date2); // abs pour avoir la valeur absolute, ainsi éviter d'avoir une différence négative
    $retour = array();
 
    $tmp = $diff;
    $retour['second'] = $tmp % 60;
 
    $tmp = floor( ($tmp - $retour['second']) /60 );
    $retour['minute'] = $tmp % 60;
 
    $tmp = floor( ($tmp - $retour['minute'])/60 );
    $retour['hour'] = $tmp % 24;
 
    $tmp = floor( ($tmp - $retour['hour'])  /24 );
    $retour['day'] = $tmp;
 
    return $retour;
}
 
// Test de la fonction
//print_r( dateDiff($now, $date2) );
?>
    @endsection
