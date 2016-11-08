@extends('layouts.app')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<center><h1><b>Backlog</b></h1><center>
                </div>

                <div class="panel-body">

		<div class="col-sm-2" style="background-color:default;">
			<div class="btn-group-vertical">
			  	<a href="{{ url('projects/kanban') }}"><input type="button" class=" btn btn-default" name="kanban" value="KanBan"/></a><br><br>
			  	<a href="{{ url('projects/sprints') }}"><input type="button" class=" btn btn-default" name="sprints" value="Sprints"/></a><br><br><br><br>

			   	
			</div>
		</div>
                <div class="col-lg-12">
                    <div class="row">

                        <div class="panel panel-default">
                                    <div class="col-sm-8" style="background-color:default;">

                            	 <table  class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>

                                   
                                        <tr>
                                            <th>US #</th>
                                            <th>Description</th>
                                            <th>Effort</th>
                                            <th>Priority</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>

                                        <tbody>

                                            <tr class="odd gradeX">
                                                <td>#1</td>
                                                <td>bla bla bla bla </td>
                                                <td>3</td>
                                                <td>2</td>
                                                <td class="center">
                                                   
                                                <div class="btn-group pull-right" role="group" >
                                                    <form action="#" method="post"> {!! csrf_field() !!} 
                                                       <a> <input type="submit" class="btn btn-success" name="show" value="Show"/> </a>
                                                    </form>

                                                    <form action="#" method="post"> {!! csrf_field() !!}
                                                     <input type="submit" class="btn btn-danger" name="delete" value="Delete"/>
                                                   </form>
                                                </div>  
                                                </td>
                                            </tr>
                                     

                                        </tbody>
                                    </table>
                                </div>

                        </div>
                    </div>
                </div>


                <!-- Button trigger modal -->
            <button class="btn btn-primary btn-lg"  data-toggle="modal" data-target="#myModalHorizontal">
                Add new US
            </button>

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
                            
                            <form class="form-horizontal" role="form" >
                              <div class="form-group">
                                <label  class="col-sm-2 control-label"
                                          for="inputEmail3">US number : </label>
                                <div class="col-sm-10">
                                    <input type="number" id="myForm" class="form-control" 
                                     />
                                </div>
                              </div>
                              <div class="form-group">
                                <label class="col-sm-2 control-label"
                                      for="inputPassword3" >Password</label>
                                <div class="col-sm-10">
                                    <input type="password" class="form-control"
                                        id="inputPassword3" placeholder="Password"/>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <div class="checkbox">
                                  </div>
                                </div>
                              </div>
                              <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-10">
                                  <button type="submit" action ="#" class="btn btn-default">Add</button>
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

               
            		</div>
            			<div class="col-sm-2" style="background-color:default">
            			</div>
            	

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
