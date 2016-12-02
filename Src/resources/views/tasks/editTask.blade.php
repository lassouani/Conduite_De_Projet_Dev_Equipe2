@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Edit a task</h1></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST"
                          action="{{ url('tasks/update') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('task_description') ? '
has-error' : '' }}">
                            <label class="col-md-4 control-label">task description<span
                                    class="required">*</span> </label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="10" class="form-control"
                                          name="task_description" maxlength="500">{{ old('task_description',$EditTask->description) }}</textarea>

                                @if ($errors->has('task_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('task_description')
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>


                        <div class="form-group{{ $errors->has('task_effort') ? '
has-error' : '' }}">
                            <label class="col-md-4 control-label">Effort<span
                                    class="required">*</span> </label>

                            <div class="col-md-6">
                                <input type="number" class="form-control" min="0"
                                       name="task_effort" value="{{ old('task_effort',$EditTask->effort) }}">

                                @if ($errors->has('task_effort'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('task_effort')
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <label class="col-md-4 control-label">Assigned developer<span
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <select name="assigned_developer">
                                    <?php
                                    foreach ($user as $key => $value) {
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
                            <div class="col-md-6 col-md-offset-4">
                                 <input type="hidden" name="id" value={{$EditTask->id}}>

                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
