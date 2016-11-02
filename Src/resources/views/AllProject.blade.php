
@extends('layouts.app')

@section('content')



<div class="container">



<div class="container">
  <h2>Projects</h2>
      

  <ul class="nav nav-pills">
    <li ><a href="{{ url('/home') }}">My Projects <span class="badge badge-info">{{$MyProjects}} </span></a></li>
    <li><a href="{{ url('/project/contribution') }}">My Contribution</a></li>
    <li class="active"><a  href="{{ url('/all/project') }}">All Projects <span class="badge badge-info">{{$AllProjects->total()}} </span> </a></li>
   <!-- <li><a href="{{ url('/home') }}">Menu 3</a></li>-->
  </ul>  <hr>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">

      <h3></h3>



           
              
          @unless($AllProjects->count() )

                <div class="panel panel-warning">
                  <div class="panel-heading">Panel with panel-warning class</div>
                  <div class="panel-body">There are no project yet !
                     <a href="#"><input type="button" class="btn btn-sm btn-primary btn-create pull-right" name="Create"value="Create New"/></a>
                  </div>
                </div>
       
           @else

                   <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           All Projects
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                   
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-3">
                              <div class="pull-left">
                                        <span> Show </span>
                                            <select class="selectpicker" data-width="150px" data-style="btn-info">
                                                 <option>10</option>
                                                 <!-- <option>20</option>
                                                 <option>50</option>-->
                                             </select>
                                        <span> entries </span>   
                                    </div>
                        </div>

                        <div class="col-md-5 col-xs-6">
                            
                                 @if(isset($message))
                                  <div class="col-md-12 col-xs-6 bg-danger">
                                      {{$message}}
                                   </div>   
                                  @endif    
                        </div>

                        <div class="col-md-4">
                                <div class="pull-right">
                                       <div class="col-lg-14">
                                            <div class="input-group">
                                                <form enctype="multipart/form-data" role="search" action="{{ url('search/redirect') }}"> 
                                                     
                                                  <span class="input-group-btn">
                                                    
                                                    <a href="{{ url('/home') }}"> <input type="button" class="btn btn-default" name="Reset"value="Reset"/></a>
                                                    <button type="submit" class="btn btn-default">Go!</button>
                                                   
                                                  </span>
                                                  
                                                         <input type="text" name="search" class="form-control" value="{{ old('search') }}" placeholder="Search for...">
                          
                                              </form>
                                            </div><!-- /input-group -->
                                        </div><!-- /.col-lg-6 -->
                                    </div> </br> 
                        </div></br> </br>
                    </div>
                </div>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>Link</th>
                                        <th>Creation Date</th>
                                        <th>Last Update</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                
                                    @foreach($AllProjects as $AllProject)
                                        <tr class="odd gradeX">
                                            <td>{{ $AllProject->name }}</td>
                                            <td><a href={{ $AllProject->link }}> Link to the dépot</td>
                                            <td>{{ $AllProject->created_at }}</td>
                                            <td>{{ $AllProject->updated_at }}</td>
                                            <td class="center">
                                               <a href="#"> <input type="button" class="btn btn-success" name="Reset"value="Show"/></a>
                                               <a href="#"> <input type="button" class="btn btn-danger" name="Go"value="Delete"/></a>
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                            
                        </div>
                        <!-- /.panel-body -->
                            <div class="pull-right">
                                

                                    {{ $AllProjects->links() }}

                            </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

          
          @endunless  

      
    

    </div>



    
  </div>
</div>

</div>  



@endsection

