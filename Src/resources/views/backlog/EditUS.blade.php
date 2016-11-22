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
                    <h3> Edit #US{{$UserStoryEdit->us}}</h3>
                    <div class="row">
                        <div class="col-md-10 col-md-offset-1">
                            <div class="panel panel-default">
                                <!-- <div class="panel-heading"></div>-->


                                <div class="panel-body">



                                    <div class="modal-body">


                                        <form class="form-horizontal" role="form" method="POST" 
                                              action="{{ url('/us/update') }}">
                                            {!! csrf_field() !!}
                                                




                                            <div class="form-group{{ $errors->has('us_description') ? ' has-error' : '' }}">
                                                <label class="col-md-4 control-label">User Story description<span 
                                                        class="required">*</span> </label>

                                                <div class="col-md-6">
                                                    <textarea rows="4" cols="10" class="form-control" name="us_description" maxlength="500">{{ old('us_description',$UserStoryEdit->description) }} </textarea>
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
                                                           name="us_effort" value="{{ old('us_effort',$UserStoryEdit->effort) }}">

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
                                                           name="us_prio" value="{{ old('us_prio',$UserStoryEdit->priority) }}">

                                                    @if ($errors->has('us_prio'))
                                                    <span class="help-block">
                                                        <strong>{{ $errors->first('us_prio') 
                                                            }}</strong>
                                                    </span>
                                                    @endif
                                                </div>
                                            </div>

                                           <hr>

                                                <div class="form-group{{ $errors->has('tracability') ? ' has-error' : '' }}">
                                                    <label class="col-md-4 control-label">traçability : </label>

                                                    <div class="col-md-6">
                                                        <input type="text" min="0" class="form-control" id="tracability" 
                                                               name="tracability" value="{{ old('tracability',$UserStoryEdit->tracability) }}">

                                                        @if ($errors->has('tracability'))
                                                        <span class="help-block">
                                                            <strong>{{ $errors->first('tracability') 
                                                                }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                </div>
                                                  
                                            </div>
                                              </br>
                                            <div class="form-group">
                                                <div class="col-md-6 col-md-offset-4">
                                                    <center> <button type="submit" class="btn btn-primary pull-right">
                                                            <input type="hidden" name="id" value={{$UserStoryEdit->id}}>
                                                            <input type="hidden" name="us" value={{$UserStoryEdit->us}}>
                                                            Edit
                                                        </button></center>
                                                </div>
                                            </div>
                                        </form>



                                    </div>

                                    <!-- Modal Footer -->
                                    <div class="modal-footer">

                                        <a href="{{ url('projects/backlog/'.$UserStoryEdit->id_project) }}"> <input type="button" class="btn btn-default pull-left" 
                                                                                             name="contribute"value="Backlog"/></a>


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


     <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
    <script>
$(document).ready(function(){
    $('#tracability').focus( function(){
        var tr =$(this).val();
        alert(tr);
    });

    
)};
    </script> -->



@endsection
