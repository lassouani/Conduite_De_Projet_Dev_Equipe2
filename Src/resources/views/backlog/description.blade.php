@extends('layouts.app')
@section('content')



<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">
  				  	<a href="{{ url('home') }}"><input type="button" class=" btn btn-info" name="return" value="Return"/></a><br>
                	<center><h1><b>Project Description</b></h1><center>
                </div>

                <div class="panel-body">

		<div class="col-sm-2" style="background-color:default;">
			<div class="btn-group-vertical">
			  	<a href="{{ url('projects/kanban') }}"><input type="button" class=" btn btn-default" name="kanban" value="KanBan"/></a><br><br>
			  	<a href="{{ url('projects/backlog') }}"><input type="button" class=" btn btn-default" name="backlog" value="Backlog"/></a><br><br>
			  	<a href="{{ url('projects/sprints') }}"><input type="button" class=" btn btn-default" name="sprints" value="Sprints"/></a><br><br><br><br>

			   	
			</div>
		</div>

		<div class="col-sm-8" style="background-color:default">

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
                                        $i==1;
                                        <tr class="odd gradeX">
                                            <td>$i++;</td>
                                            
                                            <td class="center">
                                               
                                                <form action="{{ url('projects/description/'.$MyProject->id) }}" method="post"> {!! csrf_field() !!} <input type="submit" class="btn btn-success" name="show"value="Show"/></form>
                                                <a href="#"> <input type="button" class="btn btn-danger" name="delete"value="Delete"/></a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
   
		</div>
			<div class="col-sm-2" style="background-color:default">
			</div>
	

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
