@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">

        <h2>Project Name  : {{$Project->name}}</h2> </br>
         

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading"> <b>BackLog</b></div>

 <button class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#myModalHorizontal"> Add new US </button>

            <!-- Modal -->
            <div class="modal fade" id="myModalHorizontal" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            
                            <h4 class="modal-title" id="myModalLabel">
                                Add a new User Story
                            </h4>
                        </div>
                        
                        <!-- Modal Body -->
                        <div class="modal-body">
                            
                            <form class="form-horizontal" role="form" method="POST" 
                          action="{{ url('/backlog/update') }}">
                        {!! csrf_field() !!}


                       <div class="form-group{{ $errors->has('us_description') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">User Story description<span 
                                    class="required">*</span> </label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="10" class="form-control"
                                          name="us_description" maxlength="500"></textarea>

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
                                       name="us_effort" value="{{ old('us_effort') }}">

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
                            <label class="col-md-4 control-label">Priorité : </label>

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
                               <center> <button type="submit" class="btn btn-primary">
                                    Add
                                </button></center>
                            </div>
                        </div>
                    </form>
          
                            
                            
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal" >
                                        Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

                <div class="panel-body">
                  
               
                    <table class="table table-hover">


                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-3"></div>
                                    <div class="col-md-5 col-xs-6"></div>
                                        <div class="col-md-4">
                                            <div class="pull-right">
                                                <div class="col-lg-14">
                                                    <div class="input-group">
                                                        <form enctype="multipart/form-data" role="search" action=""> 
                                                                <span class="input-group-btn">
                                                                    <a href=""> <input type="button" class="btn btn-default" name="Reset"value="Reset"/></a>
                                                                    <button type="submit" class="btn btn-default">Go!</button>
                                                                </span>
                                                                    <input type="text" name="search" class="form-control" value="{{ old('search') }}" placeholder="Search US#">
                                                        </form>
                                                    </div><!-- /input-group -->
                                                </div><!-- /.col-lg-6 -->
                                            </div> </br> 
                                        </div></br> </br>
                                </div>
                            </div>

                                      <thead>
                                        <tr class="bg-success">
                                          <th>US#</th>
                                          <th>Description</th>
                                          <th>Effort</th>
                                          <th>Priorité</th>
                                          <th>Actio</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th scope="row">1</th>
                                          <td>Mark</td>
                                          <td>Otto</td>
                                          <td>1</td>

                                          <td><button class="btn btn-success pull-center"  data-toggle="modalEdit" data-target="#myModalHorizontal1"> edit </button>
                                             <!-- Modal de modification -->
            <div class="modal fade" id="myModalHorizontal1" tabindex="-1" role="dialog" 
                 aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <!-- Modal Header -->
                        <div class="modal-header">
                            
                            <h4 class="modal-title" id="myModalLabel">
                                Edit User Story : 
                            </h4>
                        </div>
                        
                        <!-- Modal Body -->
                        <div class="modal-body">
                            
                            <form class="form-horizontal" role="form" method="POST" 
                          action="{{ url('/backlog/update') }}">
                        {!! csrf_field() !!}


                       <div class="form-group{{ $errors->has('us_description') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">User Story description<span 
                                    class="required">*</span> </label>

                            <div class="col-md-6">
                                <textarea rows="4" cols="10" class="form-control"
                                          name="us_description" maxlength="500"></textarea>

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
                                       name="us_effort" value="{{ old('us_effort') }}">

                                @if ($errors->has('us_effort'))
                                <span class="help-block">
                                    <span></span>trong>{{ $errors->first('us_effort') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('us_prio') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Priorité : </label>

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
                               <center> <button type="submit" class="btn btn-primary">
                                    Add
                                </button></center>
                            </div>
                        </div>
                    </form>
          
                            
                            
                        </div>
                        
                        <!-- Modal Footer -->
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modalEdit" >
                                        Close
                            </button>
                        </div>
                    </div>
                </div>
            </div>

                                          </td>
                                        </tr>
                                        <tr>
                                          <th scope="row">2</th>
                                          <td>Jacob</td>
                                          <td>Thornton</td>
                                          <td>1</td>
                                        </tr>
                                        
                                      </tbody>
                                </table>



                </div>
            
                </div>
            </div>
        </div>
    </div>
</div>





@endsection
