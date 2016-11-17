@extends('layouts.app')

@section('content')
@if (session('status_not_modified'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif
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
                <div class="panel-heading"><h1>Add a task</h1></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" 
                          action="{{ url('/task/register/'.$project_id) }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('task_description') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Task description<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" 
                                       name="task_description" value="{{ old('task_description')}} ">

                                @if ($errors->has('task_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('task_description') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Effort<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <select name="effort">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Priority<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <select name="priority">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-4 control-label">Task state<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <select name="task_state">
                                    <option value="TODO">TODO</option>
                                    <option value="ON GOING">ON GOING</option>
                                    <option value="TESTING">TESTING</option>
                                    <option value="DONE">DONE</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Assigned developer<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <select name="assigned_developer">
                                    <?php
                                    foreach ($users as $key => $value) {
                                        ?>  
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>      
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Assigned sprint<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <select name="id_sprint">
                                    <?php
                                    foreach ($sprints as $key => $value) {
                                        ?>  
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>      
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Assigned user story<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <select name="id_user_story">
                                    <?php
                                    foreach ($user_stories as $key => $value) {
                                        ?>  
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>      
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <span class="text-muted col-xs-12"><em>Fields with : <span class="required">*</span>
                                    are mandatory </em></span>
                        </div> 

                        <div class="form-group">
                            <div class="col-md-6">

                                <button type="submit" class="btn btn-primary pull-right">
                                    Add
                                </button>
                                <a href="{{ url('/home') }}"><input type="button" class="btn btn-default pull-left" name="Create"value="My projects"/></a>
                            </div>





                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
