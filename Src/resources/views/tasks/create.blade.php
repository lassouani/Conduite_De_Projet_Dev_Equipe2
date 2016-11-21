@extends('layouts.app')

@section('content')

<style>
    .table-fixed thead {
        width: 97%;
    }
    .table-fixed tbody {
        height: 200px;
        overflow-y: auto;
        width: 100%;
    }
    .table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th {
        display: block;
    }
    .table-fixed tbody td, .table-fixed thead > tr> th {
        float: left;
        border-bottom-width: 0;
    }
</style>

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
        <div class="col-md-6">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <i class=""></i> User stories
                </div>
                <!-- /.panel-heading -->
                <div class="panel-body">


                 
                    <div class="row">

                       
                        <table class="table table-hover">
                            <thead>
                                <tr class="bg-success">
                                    <th>#US</th>
                                    <th>Description</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $i = 0;
                                foreach ($other_sprints as $sprint) {

                                    foreach ($sprint->userstories as $user_story) {
                                        ++$i;
                                        ?>  
                                        <tr>
                                            <th scope="row"><?php echo $i; ?></th>      
                                            <td ><?php echo $user_story->description; ?></td>
                                        </tr>
                                        <?php
                                    }
                                }
                                ?>  
                            </tbody>
                        </table>

                    </div>





                </div>

            </div>
        </div>
        <div class="col-md-6">
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
                        <div class="form-group{{ $errors->has('effort') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Effort : </label>

                            <div class="col-md-6">
                                <input type="number" min="0" class="form-control" 
                                       name="effort" value="{{ old('effort') }}">

                                @if ($errors->has('effort'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('effort') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('priority') ? ' has-error' : '' }}">
                            <label class="col-md-4 control-label">Priority : </label>

                            <div class="col-md-6">
                                <input type="number" min="0" class="form-control" 
                                       name="priority" value="{{ old('priority') }}">

                                @if ($errors->has('priority'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('priority') 
                                        }}</strong>
                                </span>
                                @endif
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
                            <div class="col-md-11">

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
