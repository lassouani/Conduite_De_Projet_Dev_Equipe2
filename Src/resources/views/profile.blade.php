@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"><b>My Account</b></div>
                     <div class="panel-body">

                        <div class="row">
                            <div class="col-md-10 col-md-offset-1">
                                <img src="/uploads/avatars/{{ $user->avatar }}" style="width:150px; height:150px; float:left; border-radius:50%; margin-right:25px;">
                                <h2>{{ $user->name }} 's Profile</h2>
                                
                                <form enctype="multipart/form-data" action="/profile" method="POST">
                                    
                                    <label class="custom-file" >Update Profile Image
                                          <input type="file" id="file"  name="avatar"class="custom-file-input">
                                          <span class="custom-file-control"></span>
                                    </label>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="pull-right btn btn-sm btn-primary">
                                    
                                </form>
                            </div>
                        </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>


<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading"></div>

                <div class="panel-body">
                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
