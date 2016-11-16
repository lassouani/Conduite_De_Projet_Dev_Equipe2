@extends('layouts.app')

@section('content')

<style>
tr {
width: 100%;
display: inline-table;
}

table{
 height:40px; 
}
tbody{
  overflow-y: scroll;
  height: 150px;
  width: 90%;
  position: absolute;
}
</style>


<div class="container">
    <div class="row">


        <div class="container-fluid">

            <div class="row">

                <div class="col-sm-6">
                    <!-- /.col-lg-8 -->
                    <div class="col-lg-13">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <i class="fa fa-bell fa-fw"></i> {{$notifications->count()}} Notification(s)
                            </div>
                            <!-- /.panel-heading -->
                            <div class="panel-body">
                                <div class="list-group">
                                    @unless($notifications->count())
                                    <a class="list-group-item">
                                        <i class=""></i> No Notification
                                        <span class="pull-right text-muted small"><em></em>
                                        </span>
                                    </a>

                                    @else
                                    @foreach($notifications as $notification)    
                                    <a href="{{ url('notification/description/'.$notification->idProject.'/'.$notification->idUser) }}" class="list-group-item">
                                        <i class="fa fa-comment fa-fw"></i> <i> <b>{{$notification->usersName}}</b>, sent a request contribution for, 
                                            <b> {{$notification->name}}   </b>  </i>  
                                        <span class="pull-right text-muted small"><em>{{$notification->notificationTime}}</em>
                                        </span>

                                    </a>
                                    @endforeach

                                    @endunless

                                </div>
                                <!-- /.list-group -->

                            </div>
                            <!-- /.panel-body -->
                            <div class="pull-right">


                                {{ $notifications->links() }}

                            </div>
                        </div>

                    </div>
                </div>


                <div class="col-sm-6">

                    @if(isset($ShowNotifs))
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <i class=""></i> Contribution description
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">

                            <b>Project Name :</b> {{$ShowNotifs->name}}  </br>
                            <b>Creted at    :</b> {{$ShowNotifs->created_at}} </br>
                            <b>Description  :</b> {{$ShowNotifs->description}} </br> <hr>

                            <b>Contributor  :</b> {{$ShowNotifs->usersName}} </br>
                            <b>Project of {{$ShowNotifs->usersName}} :</b> {{$ProjectOfContributors->count()}} Projects
                                    <table class="table table-striped">
                                                <thead>
                                                  <tr>
                                                    <th>N°</th>
                                                    <th>Project Name</th>
                                                   
                                                  </tr>
                                                </thead>
                                                <tbody > <?php $i=0;  ?>
                                                     @foreach($ProjectOfContributors as $ProjectOfContributor)
                                                  <tr> <?php $i++;  ?> 
                                                    <td>{{$i}}</td>
                                                    <td>{{$ProjectOfContributor->name }}</td>
                                                   
                                                  </tr>
                                                     @endforeach 
                                                </tbody>
                                    </table> 
                                             






                                
                           
                             </br></br>
                             </br>
                             </br></br>
                             </br>
                             </br></br>
                             
                             


                            <b>Contact      :</b> {{$ShowNotifs->email}}   <a href="mailto:{{$ShowNotifs->email}}">Contact him</a></br> 

                            <div class="btn-group pull-right" role="group" >
                                <a href="{{ url('notification/destroy/'.$ShowNotifs->id) }}"> <input type="button" class="btn btn-danger " name="contribute"value="Refuse"/></a>
                                <a href="{{ url('notification/accept/'.$ShowNotifs->id) }}"> <input type="button" class="btn btn-success" name="contribute"value="Accept"/></a>
                            </div>

                        </div>
                    </div>
                    @endif


                </div>


            </div> 
        </div>      












    </div>


    @endsection