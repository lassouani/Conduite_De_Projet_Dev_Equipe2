
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-2">
            <ul class="nav nav-pills nav-stacked">
                <li><a href="/home"><i class="fa fa-home fa-fw"></i>Home</a></li>
                <li><a href="/home"><i class="fa fa-list-alt fa-fw"></i>My Projects</a></li>
                <li><a href="{{url('projects/contribution')}}"><i class="fa fa-tasks fa-fw"></i>My Contribution</a></li>
                <li><a href="{{url('all/projects')}}"><i class="fa fa-bar-chart-o fa-fw"></i>All Projects</a></li>
              <!--  <li><a href="http://www.jquery2dotnet.com"><i class="fa fa-table fa-fw"></i>Table</a></li>
                <li><a href="http://www.jquery2dotnet.com"><i class="fa fa-tasks fa-fw"></i>Forms</a></li>
                <li><a href="http://www.jquery2dotnet.com"><i class="fa fa-calendar fa-fw"></i>Calender</a></li>
                <li><a href="http://www.jquery2dotnet.com"><i class="fa fa-book fa-fw"></i>Library</a></li>
                <li><a href="http://www.jquery2dotnet.com"><i class="fa fa-pencil fa-fw"></i>Applications</a></li>
                <li><a href="http://www.jquery2dotnet.com"><i class="fa fa-cogs fa-fw"></i>Settings</a></li>-->
            </ul>
        </div>


        <div class="col-md-10">

            @if(isset($My))

            <div class="well well-sm">
                <div class="form-group">
                    <form enctype="multipart/form-data" role="search" action="{{ url('search/redirect') }}"> 
                        <div class="input-group input-group-md">
                            <div class="icon-addon addon-md">
                                <input type="text" name="search" class="form-control" value={{$search}} placeholder="Search for...">
                            </div>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">Search!</button>
                            </span>
                        </div>
                    </form>   
                </div>
            </div>              
            @elseif(isset($All))

            <div class="well well-sm">
                <div class="form-group">
                    <form enctype="multipart/form-data" role="search" action="{{ url('search/redirect/all') }}"> 
                        <div class="input-group input-group-md">
                            <div class="icon-addon addon-md">
                                <input type="text" name="search" class="form-control" value={{$search}} placeholder="Search for...">
                            </div>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">Search!</button>
                            </span>
                        </div>
                    </form>   
                </div>
            </div>

            @elseif(isset($contribute))
            <div class="well well-sm">
                <div class="form-group">
                    <form enctype="multipart/form-data" role="search" action="{{ url('search/redirect/all') }}"> 
                        <div class="input-group input-group-md">
                            <div class="icon-addon addon-md">
                                <input type="text" name="search" class="form-control" value={{$search}} placeholder="Search for...">
                            </div>
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">Search!</button>
                            </span>
                        </div>
                    </form>   
                </div>
            </div>
            @endif              






            @unless($Projects->count())
            <h3>{{$Projects->total()}} result(s) found.</h3>


            @else

            <h3>{{$Projects->total()}} result(s) found</h3>
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            Projects

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
                                                    <option>10</option>
                                                    <!-- <option>20</option>
                                                    <option>50</option>-->
                                                </select>
                                                <span> entries </span>   
                                            </div>
                                        </div>

                                        <div class="col-md-5 col-xs-6">


                                        </div>

                                        <div class="col-md-4">
                                            <div class="pull-right">
                                                <div class="col-lg-14">
                                                    <div class="input-group">
                                                        <form enctype="multipart/form-data" role="search" action="{{ url('search/redirect') }}"> 

                                                            <span class="input-group-btn">

                                                                <a href="{{ url('/home') }}"> <input type="button" class="btn btn-default" name="Reset"value="Reset"/></a>
                                                                <button type="submit" class="btn btn-default">Go!</button>

                                                            </span>

                                                            <input type="text" name="search" class="form-control" value="{{ old('search') }}" placeholder="Search my project...">

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

                                    @foreach($Projects as $Project)
                                    <tr class="odd gradeX">
                                        <td>{{ $Project->name }}</td>
                                        <td><a href={{ $Project->link }}> Link to the dépot</td>
                                        <td>{{ $Project->created_at }}</td>
                                        <td>{{ $Project->updated_at }}</td>
                                        <td class="center">

                                            <div class="row">
                                                      <div class="col-md-4">
                                                <form action="{{ url('projects/description/'.$Project->id) }}" method="post"> {!! csrf_field() !!} 
                                                    <a> <input type="submit" class="btn btn-success" name="show" value="Show"/> </a>
                                                </form>
                                                 </div>
                                                     <div class="col-md-7">
                                                @if(isset($My))
                                                <form action="{{ url('projects/destroy/'.$Project->id) }}" method="post"> {!! csrf_field() !!}
                                                    <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
                                                </form>
                                                @endif
                                            </div> 
                                            </div> 
                                        </td>
                                    </tr>
                                    @endforeach

                                </tbody>
                            </table>

                        </div>
                        <!-- /.panel-body -->
                        <div class="pull-right">


                            {{ $Projects->links() }}

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

