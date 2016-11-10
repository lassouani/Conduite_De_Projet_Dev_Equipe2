@extends('layouts.app')

@section('content')


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Edit a project</h1></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" 
                          action="{{ url('projects/update') }}">
                        {!! csrf_field() !!}

                        <div class="form-group{{ $errors->has('project_name') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Project name<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" 
                                       name="project_name" value="{{ old('project_name',$EditProject->name)}} ">

                                @if ($errors->has('project_name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('project_name') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('project_description') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Project description<span 
                                    class="required">*</span> </label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="10" class="form-control"
                                          name="project_description" maxlength="500">{{ old('project_description',$EditProject->description) }}</textarea>

                                @if ($errors->has('project_description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('project_description') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('link_to_url') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Project link<span 
                                    class="required">*</span> </label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" 
                                       name="link_to_url" value="{{ old('link_to_url',$EditProject->link) }}">

                                @if ($errors->has('link_to_url'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('link_to_url') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('technical_solutions') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Technical solutions for the project</label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="10" class="form-control"
                                          name="technical_solutions" maxlength="500">{{ old('technical_solutions',$EditProject->technical_solutions) }}</textarea>

                                @if ($errors->has('technical_solutions'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('technical_solutions') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('project_hierarchy') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Project hierarchy</label>

                            <div class="col-md-6">
                                <input type="text" class="form-control" 
                                       name="project_hierarchy" value="{{ old('project_hierarchy',$EditProject->project_hierarchy) }}">

                                @if ($errors->has('project_hierarchy'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('project_hierarchy') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <div class="form-group">
                            <span class="text-muted col-xs-12"><em>Fields with : <span class="required">*</span>
                                    are mandatory </em></span>
                        </div> 

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                 <input type="hidden" name="id" value={{$EditProject->id}}>

                                <button type="submit" class="btn btn-primary">
                                    Edit
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
