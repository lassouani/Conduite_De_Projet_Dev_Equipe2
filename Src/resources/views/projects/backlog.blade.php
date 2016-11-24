@extends('layouts.app')

@section('content')

<style>
    

/**********************/
 
/*********************************/


</style>


@if(isset($status))
<div class="col-md-10 col-md-offset-1">
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <center> <strong>Success! </strong>  {{$status}}</center>
    </div>
</div>
@endif

<div class="container">

    
 <div class="row">
      <div class="col-sm-4"> <h2>Project Name  : {{$Project->name}}</h2></div>

          <div class="col-sm-12">
            <button type="button" class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">Traçability</button>
                
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

                <div class="panel-heading"> <b>BackLog</b>
                    @if($UserStorys->total())
                    <a  href="{{ url('/us/create/'.$Project->id) }}"><input type="button" class="btn btn-sm btn-primary btn-create pull-right" 
                                                                            name="Create"value="Add New US"/></a>
                    @endif
                </div>


                <div class="panel-body">


                    @unless($UserStorys->total())
                    <div class="panel panel-warning">
                        <div class="panel-heading">Panel with panel-warning class</div>
                        <div class="panel-body">The Backlog is not created
                            <a  href="{{ url('/us/create/'.$Project->id) }}">
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
                                                <form enctype="multipart/form-data" role="search" action=""> 
                                                    <span class="input-group-btn">


                                                    </span>
                                                    <div class="btn-group">
                                                        <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">Search User Story<span class="caret"></span></button>
                                                        <ul class="dropdown-menu scrollable-menu" role="menu">
                                                            @for ($i=1;$i<=$UserStorys->total();$i++)
                                                            <li><a href="#">US{{$i}}</a></li>
                                                            @endfor




                                                        </ul>
                                                    </div>
                                                </form>
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                    </div> </br> 
                                </div></br> </br>
                            </div>
                        </div>

                        <thead>
                            <tr class="bg-success">
                                <th>#US</th>
                                <th>Description</th>
                                <th>Effort</th>
                                <th>Priority</th>
                                <th>Sprint</th>
                                <th>Action</th>
                            </tr>
                        </thead>


                        <tbody>
                            @foreach($UserStorys as $UserStory)
                            <tr>
                                <th>US{{$UserStory->us}}</th>
                                <td class="col-xs-7">{{$UserStory->description}}</td>
                                <td>{{$UserStory->effort}}</td>
                                <td>{{$UserStory->priority}}</td>
                                <td>{{$UserStory->id_sprint}}</td>

                                <td class="col-xs-3">
                                    <div class="row">

                                        <div class="col-md-4">
                                           <!-- <a href="{{ url('show/'.$UserStory->id) }}"> <input type="submit" class="btn btn-success pull-left" name="show" value="Show"/> </a>-->
                                            <a href="{{ url('task/'.$UserStory->id) }}"> <input type="submit" class="btn btn-success pull-left" name="show" value="Show task"/> </a>
                                        </div>
                                        <div class="col-md-6">
                                            <a href="{{ url('us/edit/'.$UserStory->id) }}"> <input type="submit" class="btn btn-warning pull-right" name="edit" value="Edit"/> </a>
                                        </div>
                                    </div>


                                </td> 

                            </tr>
                            @endforeach

                        </tbody>
                    </table>



                </div>
                <div class="pull-right">


                    {{ $UserStorys->links() }}

                </div>

                @endunless
            </div>
            @if($UserStorys->total())
            <h3>{{$UserStorys->total()}} User Storie(s).</h3>
            @endif

        </div>
    </div>
</div>
</div>





<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog" tabindex="-1" aria-hidden="true" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Traceability matrix</h4>
        </div>
        <div class="modal-body">



        <div class="container">

                    

                <div class="row">
                     <div class="col-sm-9">
                                <table class="table">
                                        <thead>
                                          <tr class="bg-success">
                                            <th class="col-xs-1">#US</th>
                                            <th class="col-xs-7">Commit</th>
                                            
                                          </tr>
                                        </thead>
                                        <tbody>
                                             @unless($UserStorys->total())
                                                    <p> No User Story </p>
                                            @else
                                                @foreach($UserStorys as $UserStory)
                                          <tr>
                                            <td class="col-xs-1">US{{$UserStory->us}}</td>
                                            <td class="col-xs-7">{{$UserStory->tracability}}</td>
                                            
                                          </tr>
                                                @endforeach
                                        </tbody>
                                            @endunless
                                        
                                </table>
                     </div>
                </div>


         </div>
          


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>

</div>



@endsection
