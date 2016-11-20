@extends('layouts.app')
@section('content')





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
                            <a href="{{ url('projects/backlog/'.$Project->id) }}" class="btn btn-primary">BackLog</a> 
                            <a href="{{ url('projects/sprints/'.$Project->id) }}" class="btn btn-primary">Sprint</a>
                        </div>
                    </div>



                    <div class="col-sm-8" style="background-color:default">

                        <p><h3><b> Project name  : </b> {{ $Project->name }} </h3></p>
                        <p><h3><b> Owner		    : </b> {{ $Project->user->name }}</h3></p>
                        <p><h3><b> Description   : </b> {{ $Project->description }} </h3></p>
                        <p><h3><b> Link          : </b> <a href="{{ $Project->link }}"> {{ $Project->link }} </h3></p> 

                        <br>

                        <a href="{{url('/')}}"> <input type="button" class="btn btn-default pull-left" 
                                                       name="contribute"value="All public projects"/></a>


                        <a href="{{ url('contribution/send/'.$Project->id) }}"> <input type="button" class="btn btn-success pull-right" name="contribute"value="Contribute ?"/></a>

                    </div>


                </div>
            </div>
        </div>
    </div>
</div>
@endsection
