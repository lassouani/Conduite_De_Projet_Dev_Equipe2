@extends('layouts.app')
@section('content')





<div class="container">
    <div class="row">
        @if(isset($message))
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <center> <strong>Success! </strong>  {{$message}}</center>
            </div>
        </div>
        @endif  


        @if(isset($confirm))
        @if($confirm==1)
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <center> <strong>Warning! </strong>  Owner of project have to accept your contribution request to access to the actions</center>
            </div>
        </div>
        @endif
        @endif

    </div>
</div>          



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <center><h1><b>Project Description</b></h1></center>
                </div>

                <div class="panel-body">

                    <div class="col-sm-2" style="background-color:default;">
                        <div class="btn-group-vertical">

                            @if($Project->id_user == Auth::user()->id)
                            <a href="{{ url('projects/backlog/'.$Project->id) }}" class="btn btn-primary">BackLog</a>
                            <a href="{{ url('projects/sprints/'.$Project->id) }}" class="btn btn-primary">Sprint</a>


                            @elseif(isset($confirm))
                            @if($confirm==1)
                            <a href="" class="btn btn-primary disabled">BackLog</a>
                            <a href="" class="btn btn-primary disabled">Sprint</a>
                            @elseif($confirm==0)

                            <a href="{{ url('projects/backlog/'.$Project->id) }}" class="btn btn-primary">BackLog</a> 
                            <a href="{{ url('projects/sprints/'.$Project->id) }}" class="btn btn-primary">Sprint</a>
                            @endif
                            @endif  

                        </div>
                    </div>



                    <div class="col-sm-8" style="background-color:default">

                        <p><h3><b> Project name  : </b> {{ $Project->name }} </h3></p>
                        <p><h3><b> Owner		    : </b> {{ $User['name'] }}</h3></p>
                        <p><h3><b> Description   : </b> {{ $Project->description }} </h3></p>
                        <p><h3><b> Link          : </b> <a href={{ $Project->link }}> {{ $Project->link }} </h3></p> 

                        <br>

                        <a href="{{url('all/projects')}}"> <input type="button" class="btn btn-default pull-left" 
                                                                  name="contribute"value="All Projects"/></a>

                        @if(isset($contribution))
                        @if($contribution==1)
                        <div class="btn-group pull-right" role="group" >
                            <a href="{{ url('contribution/remove/'.$Project->id) }}"> <input type="button" class="btn btn-danger " name="contribute"value="Remove contribution"/></a>
                            <a href="#"> <input type="button" class="btn btn-success  disabled" name="contribute"value="Contribute ?"/></a>
                        </div>
                        @else	

                        @if($Project->id_user != Auth::user()->id)
                        <a href="{{ url('contribution/send/'.$Project->id) }}"> <input type="button" class="btn btn-success pull-right" name="contribute"value="Contribute ?"/></a>
                        @else
                        <a href="{{ url('project/edit/'.$Project->id) }}"> <input type="button" class="btn btn-warning pull-right" name="contribute"value="Edit"/></a>
                        @endif
                        @endif
                        @endif
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
