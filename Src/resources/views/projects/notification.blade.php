@extends('layouts.app')

@section('content')


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
                                            <i class=""></i> No Notifivation
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

                                                Project Name : {{$ShowNotifs->name}}  </br>
                                                Creted at    : {{$ShowNotifs->created_at}} </br>
                                                Description  : {{$ShowNotifs->description}} </br> <hr>

                                                Contributor  : {{$ShowNotifs->usersName}} </br>
                                                Contact      : {{$ShowNotifs->email}}   <a href="mailto:{{$ShowNotifs->email}}">Contact him</a></br> 

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