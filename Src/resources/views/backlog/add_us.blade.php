@extends('layouts.app')

@section('content')
@if (session('status_not_modified'))
<div class="alert alert-danger">
    {{ session('status_not_modified') }}
</div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><center><h1>Add User-Story</h1></center></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" 
                          action="{{ url('/backlog/backlog_list') }}">
                        {!! csrf_field() !!}


                        <div class="form-group{{ $errors->has('us_description') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Description : </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" name="us_description" value="{{ old('us_description') }}">

                                @if ($errors->has('us_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('us_description') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group{{ $errors->has('us_effort') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Effort : </label>

                            <div class="col-md-6">
                                <input type="number" min="0" class="form-control" 
                                       name="us_effort" value="{{ old('us_effort',"1")}}">

                                @if ($errors->has('us_effort'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('us_effort') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('us_prio') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Priority : </label>

                            <div class="col-md-6">
                                <input type="number" min="0" class="form-control" 
                                       name="us_prio" value="{{ old('us_prio',1) }}">

                                @if ($errors->has('us_prio'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('us_prio') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <center> <button type="submit" class="btn btn-primary">
                                        Add
                                    </button></center>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
