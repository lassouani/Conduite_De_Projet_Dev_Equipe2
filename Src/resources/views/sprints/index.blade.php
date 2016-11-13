@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        @if(isset($message))
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-success">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <center> <strong>Success! </strong>  {{$message}}</center>
            </div>
        </div>
        @endif  


        @if(isset($confirm))
        @if($confirm==1)
        <div class="col-md-10 col-md-offset-1">
            <div class="alert alert-danger">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <center> <strong>Warning! </strong>  Owner of project have to accept your contribution request to access to the actions</center>
            </div>
        </div>
        @endif
        @endif

    </div>
</div>          


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <center><h1><b>Sprints</b></h1></center>
                </div>

                <div class="panel-body">

                    <div class="col-sm-2" style="background-color:default;">
                        <div class="btn-group-vertical">

                            <form method="post" action="{{url('projects/showSprint')}}">
                                {!! csrf_field() !!}
                                <p>choix du sprint :</p>
                                <select name="sprint_choice">

                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                </select>
                                <input type="submit" value="Go"/>


                            </form>


                        </div>
                    </div>




                </div>
                <div>
                    <table class="table table-hover">
                        <h2>KanBan</h2>
                        <thead>
                            <tr class="bg-success">
                                <th>#US</th>
                                <th>Todo</th>
                                <th>On going</th>
                                <th>Testing</th>
                                <th>Done</th>
                            </tr>
                        </thead>


                        <tbody>


                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
