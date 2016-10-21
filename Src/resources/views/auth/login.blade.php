@extends('layouts.app1')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Login</div>
                 <div style="float:right; font-size: 80%; position: relative; top:-30px"><a class="btn btn-link"  data-toggle="tooltip" title="Reset your password" href="{{ url('/password/reset') }}">
                                    Forgot Your Password?
                                </a></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label">Password</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">

                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox"  data-toggle="tooltip" title="Remember me" name="remember"> Remember Me
                                    </label>
                                </div>
                                              </br>
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>

                            </div>
                        </div>

                        <div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
                             <div class="form-group">
                                <div class="col-md-10 col-md-offset-0">
                                    
                                 <div >
                                                        Don't have an account! 
                                    <a class="btn btn-link" data-toggle="tooltip" title="Sign In" href="{{ url('/register') }}">
                                       Sign Up Here
                                    </a>
                                 </div>   
                                </div>
                            </div>
                         </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
