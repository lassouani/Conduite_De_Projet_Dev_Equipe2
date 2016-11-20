<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ URL::asset('css/font-awesome.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">

        <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
            <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
        <![endif]-->



        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Styles -->
        <link href="{{ URL::asset('css/app.css') }}" rel="stylesheet">
    </head>

    <body>


        <div class="container">
            <div class="row">
                <div class="container">
                    <div class="jumbotron">
                        <h1>Project Management tool</h1>
                        <p class="lead">Manage your scrum projects</p>
                        <p><a class="btn btn-lg btn-success" href="{{ url('/login')}}" role="button">Sign up</a></p>
                    </div>
                </div>
                <center>
                    <h2>Want to see a project ? Search below in our public projects</h2>
                </center>

                <div class="col-md-12">


                    @unless($public_projects->count())
                    </br> </br> </br>
                    <div class="panel panel-warning">
                        <div class="panel-heading">Panel with panel-warning class</div>
                        <div class="panel-body">There are no project yet !
                        </div>
                    </div>

                    @else
                    </br> </br>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <center> 
                                        <h3>Public projects</h3>
                                    </center>
                                </div>
                                <!-- /.panel-heading -->
                                <div class="panel-body">
                                    <table class="table table-hover">
                                        <thead>

                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-md-3">

                                                </div>

                                                <div class="col-md-4 col-xs-6">

                                                </div>

                                                <div class="col-md-5">
                                                    <div class="pull-right">
                                                        <div class="col-lg-16">
                                                            <div class="input-group">
                                                                <form enctype="multipart/form-data" role="search" action="{{ url('search/public/project') }}"> 

                                                                    <span class="input-group-btn">


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

                                            @foreach($public_projects as $public_project)
                                            <tr class="odd gradeX">
                                                <td>{{ $public_project->name }}</td>
                                                <td><a href="{{ $public_project->link }}"> Link to the dépot</td>
                                                <td>{{ $public_project->created_at }}</td>
                                                <td>{{ $public_project->updated_at }}</td>
                                                <td class="center">

                                                    <div class="btn-group pull-right" role="group" >
                                                        <form action="{{ url('public/projects/description/'.$public_project->id) }}" method="post"> {!! csrf_field() !!} 
                                                            <a> <input type="submit" class="btn btn-success" name="show" value="Show"/> </a>
                                                        </form>


                                                    </div>  
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>

                                </div>
                                <div class="pull-right">
                                    {{ $public_projects->links() }}
                                </div>
                            </div>
                        </div>
                    </div>
                    @endunless  




                </div>


            </div>





        </div>

















































        <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
        <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
