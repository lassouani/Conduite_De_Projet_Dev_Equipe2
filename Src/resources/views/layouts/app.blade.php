<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="{{ URL::asset('css/font-awesome.css') }}" rel="stylesheet">
        <link rel="stylesheet" href="{{ URL::asset('css/bootstrap.min.css') }}">
        <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
         <link href="{{asset('/css/bootstrap-datepicker3.standalone.min.css')}}" rel="stylesheet">

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

        <!-- Scripts -->
        <script>
            window.Laravel = <?php
echo json_encode([
    'csrfToken' => csrf_token(),
]);
?>
        </script>
    </head>
    <body>
        <div id="app">
            <nav class="navbar navbar-default navbar-static-top">
                <div class="container">
                    <div class="navbar-header">

                        <!-- Collapsed Hamburger -->
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                            <span class="sr-only">Toggle Navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>

                        

                        <!-- Branding Image -->
                         @if (Auth::guest())
                        <a class="navbar-brand" href="{{ url('/') }}">
                            Home
                        </a>
                        @else
                        <a class="navbar-brand" href="{{ url('/home') }}">
                              @if($querrys=App\ContributionModel::GetCount())
                               
                              @endif
                          
                            Home
                        </a>
                        @endif
                    </div>

                    <div class="collapse navbar-collapse" id="app-navbar-collapse">
                        <!-- Left Side Of Navbar -->
                        <ul class="nav navbar-nav">
                            &nbsp;
                        </ul>

                        <!-- Right Side Of Navbar -->
                        <ul class="nav navbar-nav navbar-right">
                            <!-- Authentication Links -->
                            @if (Auth::guest())
                            <li><a href="{{ url('/login') }}">Login</a></li>
                            <li><a href="{{ url('/register') }}">Register</a></li>
                            
                            @else
                        
                            <!-- /.dropdown -->
                                <li class="dropdown contenu-blanc-avec-scroll">
                                    <a class="dropdown-toggle count-info" data-toggle="dropdown" href="#">
                                        <i class="fa fa-bell"></i>  <span class="label label-primary">{{$querrys->total()}}</span>
                                    </a>
                                    <ul class="dropdown-menu dropdown-alerts">
                                       @foreach($querrys as $querry)
                                    <li>
                                        <a >
                                           <div>
                                                <i class="fa fa-upload fa-fw"></i> <b>{{$querry->usersName}} </b>sent you a contribution request
                                                
                                                <span class="pull-right text-muted small">{{$querry->notificationTime}}</span>
                                            </div>
                                        </a>
                                    </li>
                                <li class="divider"></li>
                                @endforeach
                                        <li>
                                            <div class="text-center link-block">
                                                @if($querrys->total() > 0)
                                                <a href="{{url('notifications/project')}}">
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                </a>
                                                @else
                                                
                                                    <strong>See All Alerts</strong>
                                                    <i class="fa fa-angle-right"></i>
                                                
                                                @endif

                                            </div>
                                        </li>
                                    </ul>
                                 </li>


                            <li class="dropdown">


                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="position:relative; padding-left:50px;">

                                    <img src="/uploads/avatars/{{ Auth::user()->avatar }}" style="width:32px; height:32px; position:absolute; top:10px; left:10px; border-radius:50%">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu" role="menu">
                                    <li>
                                        <a href="{{ url('/profile') }}"><i class="fa fa-fw fa-user"></i> Profile</a>
                                    </li>

                                    <li>
                                        <a href="#"><i class="fa fa-fw fa-gear"></i> Settings</a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ url('/logout') }}"
                                           onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();" >
                                            Logout
                                        </a>

                                        <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                            @endif
                        </ul>
                    </div>
                </div>
            </nav>


            <!--========================================================================================= -->

            @if(session('success'))

            <div class='container'>
                <div class="alert alert-success">
                    {{session('success')}}
                </div>
            </div>

            @endif

            @if(session('error'))

            <div class='container'>
                <div class="alert alert-danger">
                    {{session('error')}}
                </div>
            </div>

            @endif


            <!--===============================================================================================-->



            @yield('content')
        </div>

        <!-- Scripts -->
        <script src="{{ URL::asset('js/app.js') }}"></script>
         <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="../../assets/js/vendor/jquery.min.js"><\/script>')</script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- Just to make our placeholder images work. Don't actually copy the next line! -->
    <script src="../../assets/js/vendor/holder.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
    </body>
</html>
