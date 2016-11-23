@extends('layouts.app')

@section('content')

 <div class="container"> 

  <h3>#US{{$UserStory->us}} : {{$UserStory->description}} </h3>
 <h3> Task {{$task}} </h3>

  
 <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Add a Task</h1></div>
                  <div class="panel-body">

                        <form class="form-horizontal" role="form" method="POST" 
                          action="{{ url('/task/add/') }}">
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
                            <label class="col-md-4 control-label">Assigned developer<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <select name="assigned_developer">
                                    
                                </select>
                            </div>
                        </div>


                        
                        <div class="form-group">
                            <span class="text-muted col-xs-12"><em>Fields with : <span class="required">*</span>
                                    are mandatory </em></span>
                        </div> 
<hr>
                        <div class="form-group">
                            <div class="col-md-11">

                                <button type="submit" class="btn btn-primary pull-right">
                                    <input type="hidden" name="usid" value={{$UserStory->id}}>
                                    <input type="hidden" name="us1" value={{$UserStory->us}}>

                                    Add
                                </button>

                                 <a href="{{ url('projects/backlog/'.$UserStory->id_project) }}"> <input type="button" class="btn btn-default pull-left" 
                                                                                             name="contribute"value="Back"/></a>
                               
                            </div>

                        </div>

                    </form>

                  </div> 
                 </div>
              </div>
         </div>
  </div>                    

</div>
@endsection
