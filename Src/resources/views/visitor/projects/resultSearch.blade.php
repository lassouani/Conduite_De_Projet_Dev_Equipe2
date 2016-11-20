@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10">

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

                                        </div>

                                        <div class="col-md-5 col-xs-6">
                                        </div>

                                        <div class="col-md-4">
                                            <div class="pull-right">
                                                <div class="col-lg-14">
                                                    <div class="input-group">
                                                        <form enctype="multipart/form-data" role="search" action="{{ url('search/public/project') }}"> 

                                                            <span class="input-group-btn">
                                                                <button type="submit" class="btn btn-default">Go!</button>
                                                            </span>
                                                            <input type="text" name="search" class="form-control" value="{{ old('search') }}" placeholder="Search my project...">

                                                        </form>
                                                    </div>
                                                </div>
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
                                        <td><a href="{{ $Project->link }}"> Link to the dépot</td>
                                        <td>{{ $Project->created_at }}</td>
                                        <td>{{ $Project->updated_at }}</td>
                                        <td class="center">

                                            <div class="btn-group pull-right" role="group" >
                                                <form action="{{ url('public/projects/description/'.$Project->id) }}" method="post"> {!! csrf_field() !!} 
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
                            {{ $Projects->links() }}
                        </div>
                    </div>
                </div>
            </div>


            @endunless 



        </div>


    </div>





</div>



</div>



@endsection

