@extends('layouts.app')

@section('content')

@if(isset($status))
<div class="col-md-10 col-md-offset-1">
    <div class="alert alert-success">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
        <center> <strong>Success! </strong>  {{$status}}<center>
                </div>
                </div>
                @endif 

                <div class="container">
                     <h3> Add #US{{$US}}</h3>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading"></div>-->


                                <div class="panel-body">



                                    <div class="modal-body">


                                        <form class="form-horizontal" role="form" method="POST" 
                                              action="{{ url('/backlog/add/us') }}">
                                            {!! csrf_field() !!}


                                            <div class="form-group{{ $errors->has('us_description') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">User Story description<span 
                                                        class="required">*</span> </label>

                                                <div class="col-md-6">
                                                    <textarea rows="4" cols="10" class="form-control"
                                                              name="us_description" maxlength="500">{{ old('us_description') }}</textarea>
                                                  <small class="form-text text-muted">Exemple: En tant que membre je souhaite ajouter/supprimer un projet afin de le gérer.</small>
                                                    @if ($errors->has('us_description'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('us_description') 
                                                            }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group{{ $errors->has('us_effort') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">Effort : </label>

                                                <div class="col-md-6">
                                                    <input type="number" min="0" class="form-control" 
                                                           name="us_effort" value="{{ old('us_effort') }}">

                                                    @if ($errors->has('us_effort'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('us_effort') 
                                                            }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="form-group{{ $errors->has('us_prio') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">Priority : </label>

                                                <div class="col-md-6">
                                                    <input type="number" min="0" class="form-control" 
                                                           name="us_prio" value="{{ old('us_prio') }}">

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
                                                    <center> <button type="submit" class="btn btn-primary pull-right">
                                                            <input type="hidden" name="id" value={{$id}}>
                                                            Add
                                                        </button></center>
                                                </div>
                                            </div>
                                        </form>



                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">

                                        <a href="{{ url('projects/backlog/'.$id) }}"> <input type="button" class="btn btn-default pull-left" 
                                                                                             name="contribute"value="Back"/></a>


                                        <button type="button" class="btn btn-default"
                                                data-dismiss="modal" >
                                            Close
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                </div>
                </div>
                </div>


                <!-- Modal Body -->

                @endsection
