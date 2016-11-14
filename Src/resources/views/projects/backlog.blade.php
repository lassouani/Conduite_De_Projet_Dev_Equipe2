@extends('layouts.app')

@section('content')

<style>
.scrollable-menu {
    height: auto;
    max-height: 200px;
    overflow-x: hidden;
}
</style>

@if(isset($status))
<div class="col-md-10 col-md-offset-1">
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <center> <strong>Success! </strong>  {{$status}}<center>
                </div>
                </div>
                @endif

                <div class="container">
                    <div class="row">

                        <h2>Project Name  : {{$Project->name}}</h2> </br>


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
                                            <a  href="{{ url('/us/create/'.$Project->id) }}"><input type="button" class="btn btn-sm btn-primary btn-create pull-right" name="Create"value="Create Backlog"/></a>
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
                                                                            @foreach ($UserStorys as $UserStory)
                                                                                 <li><a href="#">US{{$UserStory->us}}</a></li>
                                                                            @endforeach
                                                                           
                                                                            
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
                                                <th>Action</th>
                                            </tr>
                                        </thead>


                                        <tbody>
                                            @foreach($UserStorys as $UserStory)
                                            <tr>
                                                <th scope="row">US{{$UserStory->us}}</th>
                                                <td>{{$UserStory->description}}</td>
                                                <td>{{$UserStory->effort}}</td>
                                                <td>{{$UserStory->priority}}</td>

                                                <td>
                                                    <div class="btn-group" role="group" >
                                                        <a href=""> <input type="submit" class="btn btn-success" name="edit" value="Show"/> </a>
                                                        <a href="{{ url('us/edit/'.$UserStory->id) }}"> <input type="submit" class="btn btn-success" name="edit" value="Edit"/> </a>
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





                @endsection
