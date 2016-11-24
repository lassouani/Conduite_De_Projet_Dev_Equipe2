@extends('layouts.app')

@section('content')

<div class="container">

    
 <div class="row">
      <div class="col-sm-4"> <h2>User Story  :</h2></div>

          <div class="col-sm-12">
            
                
                <div class="col-sm-10">
                         
                </div>
          </div>
</div>

    <div class="row">
    <div>   
       

         </br>
              

      </div>

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading"> <b>Tasks</b>
                   <a  href="{{ url('show/'.$id_us) }}"><input type="button" class="btn btn-sm btn-primary btn-create pull-right" 
                                                                            name="Create"value="Add New task"/></a>
                </div>


                <div class="panel-body">

                  @unless($tasks->count())
                   
                    <div class="panel panel-warning">
                        <div class="panel-heading">Panel with panel-warning class</div>
                        <div class="panel-body">The Backlog is not created
                            <a  href="">
                                <input type="button" class="btn btn-sm btn-primary btn-create pull-right" name="Create"value="Create Backlog"/>
                            </a>
                        </div>
                    </div>

                    
                   @else
                    <table class="table table-hover">


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3"></div>
                                <div class="col-md-5 col-xs-6"></div>
                                <div class="col-md-4">
                                    <div class="pull-right">
                                        <div class="col-lg-14">
                                            <div class="input-group">
                                                
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                    </div> </br> 
                                </div></br> </br>
                            </div>
                        </div>

                        <thead>
                            <tr class="bg-success">
                                <th>Description</th>
                                <th>Effort</th>
                                <th>Priority</th>
                                <th>Action</th>
                                <th>State</th>
                            </tr>
                        </thead>


                        <tbody>
                             @foreach($tasks as $task)
                            <tr>
                                <th class="col-xs-7">{{$task->description}}</th>
                                <td >{{$task->effort}}</td>
                                <td>{{$task->priority}}</td>
                                <td>{{$task->state}}</td>

                                <td class="col-xs-2">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <a href=""> <input type="submit" class="btn btn-warning pull-right" name="edit" value="Edit"/> </a>
                                        </div>
                                    </div>


                                </td> 

                            </tr>
                            
                           @endforeach
                        </tbody>
                    </table>



                </div>
                <div class="pull-right">

                    {{ $tasks->links() }}
                 
                </div>

               
                 @endunless  


            </div>
            @if($tasks->total())
            <h3>{{$tasks->total()}} Task(s).</h3>
            @endif
            

        </div>
    </div>
</div>
</div>










@endsection
