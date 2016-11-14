
@extends('layouts.app')

@section('content')

<style>

</style>

<div class="container">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="/home"><i class="fa fa-home fa-fw"></i>Home </a></li>
                <li><a href="/home"><i class=""></i>My Projects<span class="badge">{{$MyProjects}} </span></a></li>
                <li class="active"><a href="{{url('projects/contribution')}}"><i class=""></i>My Contribution <span class="badge">{{$contributed_projects->total()}} </span></a></li>
                <li><a href="{{url('all/projects')}}"><i class=""></i>All Projects<span class="badge">{{$AllProjects}} </span></a></li>
            </ul>
        </div>


        <div class="col-md-10">




            @unless($contributed_projects->count())
            </br> </br> </br> 
            <div class="panel panel-warning">
                <div class="panel-heading">Panel with panel-warning class</div>
                <div class="panel-body">You have no contribution
                </div>
            </div>

            @else
            </br> </br>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            My Contibution


                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table class="table table-hover">
                                <thead>

                                <div class="container-fluid">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="pull-left">
                                                <span> Show </span>
                                                <select class="selectpicker" data-width="150px" data-style="btn-info">
                                                    <option>5</option>
                                                    <!-- <option>20</option>
                                                    <option>50</option>-->
                                                </select>
                                                <span> entries </span>   
                                            </div>
                                        </div>

                                        <div class="col-md-4 col-xs-6">


                                        </div>

                                        <div class="col-md-5">
                                            <div class="pull-right">
                                                <div class="col-lg-14">
                                                    <div class="input-group">
                                                        <form enctype="multipart/form-data" role="search" action="{{ url('search/redirect/contribution') }}"> 

                                                            <span class="input-group-btn">

                                                                <button type="submit" class="btn btn-default">Go!</button>

                                                            </span>

                                                            <input type="text" name="search" class="form-control" value="{{ old('search') }}" placeholder="Search my contribution...">

                                                        </form>
                                                    </div><!-- /input-group -->
                                                </div><!-- /.col-lg-6 -->
                                            </div> </br> 
                                        </div></br> </br>
                                    </div>
                                </div>
                                <tr class="bg-success">
                                    <th>Project Name</th>
                                    <th>Link</th>
                                    <th>Creation Date</th>
                                    <th>Last Update</th>
                                    <th>Action</th>
                                </tr>
                                </thead>

                                <tbody>

                                    @foreach($contributed_projects as $MyProject)
                                    <tr class="odd gradeX">
                                        <td>{{ $MyProject->name }}</td>
                                        <td><a href="{{ $MyProject->link }}"> Link to the dépot</td>
                                        <td>{{ $MyProject->created_at }}</td>
                                        <td>{{ $MyProject->updated_at }}</td>
                                        <td class="center">

                                            <div class="btn-group pull-right" role="group" >
                                                <form action="{{ url('projects/description/'.$MyProject->id) }}" method="post"> {!! csrf_field() !!} 
                                                    <a> <input type="submit" class="btn btn-success" name="show" value="Show"/> </a>
                                                </form>


                                            </div>  
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        <!-- /.panel-body -->
                        <div class="pull-right">


                            {{ $contributed_projects->links() }}

                        </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


            @endunless  




        </div>


    </div>





</div>



</div>



@endsection

