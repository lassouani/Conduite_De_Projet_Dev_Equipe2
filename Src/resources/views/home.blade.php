
@extends('layouts.app')

@section('content')



<div class="container">



<div class="container">
  <h2>Projects</h2>
        <div class="pull-right">
            <a href="#"> <input type="button" class="btn btn-sm btn-primary btn-create" name="Create"value="Create New"/></a>
        </div>

  <ul class="nav nav-pills">
    <li class="active"><a data-toggle="pill" href="#home">My Projects <span class="badge badge-info">{{$MyProjects->total()}} </span></a></li>
    <li><a data-toggle="pill" href="#menu1">Menu 1</a></li>
    <li><a data-toggle="pill" href="#menu2">Menu 2</a></li>
    <li><a data-toggle="pill" href="#menu3">Menu 3</a></li>
  </ul>  <hr>
  
  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">

      <h3></h3>



           
              
          @unless($MyProjects->count() )

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
                           My Projects
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
                                
                                    @foreach($MyProjects as $MyProject)
                                        <tr class="odd gradeX">
                                            <td>{{ $MyProject->name }}</td>
                                            <td><a href={{ $MyProject->link }}> Link to the dépot</td>
                                            <td>{{ $MyProject->created_at }}</td>
                                            <td>{{ $MyProject->updated_at }}</td>
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
                                

                                    {{ $MyProjects->links() }}

                            </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->

          
          @endunless  

      
    

    </div>



    <div id="menu1" class="tab-pane fade">
      <h3>Menu 1</h3>
      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
                            
    </div>
    <div id="menu2" class="tab-pane fade">
      <h3>Menu 2</h3>
      <p>Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium, totam rem aperiam.</p>
    </div>
    <div id="menu3" class="tab-pane fade">
      <h3>Menu 3</h3>
      <p>Eaque ipsa quae ab illo inventore veritatis et quasi architecto beatae vitae dicta sunt explicabo.</p>
    </div>
  </div>
</div>

</div>  



@endsection

