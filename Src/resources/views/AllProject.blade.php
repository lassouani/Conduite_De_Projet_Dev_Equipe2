
@extends('layouts.app')

@section('content')



<div class="container">


   

<div class="container">
       <h2>Result of the research of <mark style="background:yellow;">{{$search}} </mark></h2>
        
       
  <div class="pull-right">
    
     <div class="container-fluid">
          <div class="row">
               <div class="col-md-20">
                  <div class="well well-sm">
                    <div class="form-group">
                       <form enctype="multipart/form-data" role="search" action="{{ url('search/redirect/all') }}"> 
                           <div class="input-group input-group-md">
                              <div class="icon-addon addon-md">
                                  <input type="text" name="search-all" class="form-control" value={{$search}} placeholder="Search for...">
                              </div>
                              <span class="input-group-btn">
                                 <button type="submit" class="btn btn-default">Search!</button>
                              </span>
                            </div>
                        </form>   
                    </div>
                  </div>
                </div>
          </div>    
       </div>  
    </div> 

  
  
  



    
  </div>





  <h3>{{$ResultSearcheProject->total()}} resulat(s) found</h3>
    <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                           Result of the research
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
                            
                                 @if(isset($message) && $ResultSearcheProject->total()==0)
                                    <div class="col-md-12 col-xs-6 bg-danger">
                                        {{$message}}
                                     </div>   
                                  @endif    
                        </div>

                        <div class="col-md-4">
                                <div class="pull-right">
                                       <div class="col-lg-14">
                                            <div class="input-group">
                                               
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
                                
                                @foreach($ResultSearcheProject as $AllProject)
                                        <tr class="odd gradeX">
                                            <td>{{ $AllProject->name }}</td>
                                           <td><a href={{ $AllProject->link }}> Link to the dépot</td>
                                            <td>{{ $AllProject->created_at }}</td>
                                            <td>{{ $AllProject->updated_at }}</td>
                                            <td class="center">
                                               <a href="#"> <input type="button" class="btn btn-success" name="show"value="Show"/></a>
                                            </td>
                                        </tr>
                                  
                                   @endforeach

                                </tbody>
                            </table>
                            
                        </div>
                        <!-- /.panel-body -->
                            <div class="pull-right">
                                

                                 {{ $ResultSearcheProject->links()}}

                            </div>
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->


</div>
 



@endsection

