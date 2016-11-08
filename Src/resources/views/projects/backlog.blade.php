@extends('layouts.app')

@section('content')



<div class="container">
    <div class="row">

        <h2>Project Name  : {{$Project->name}}</h2> </br>
         

        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                <div class="panel-heading"> <b>BackLog</b></div>

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
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <tr>
                                          <th scope="row">1</th>
                                          <td>Mark</td>
                                          <td>Otto</td>
                                          <td>1</td>
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
