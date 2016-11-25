@extends('layouts.app')

@section('content')

<!--
@if (session('status_not_modified'))
<div class="alert alert-danger">
    {{ session('status_not_modified') }}
</div>
@endif
@if (count($errors) > 0)
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif -->
<style type="text/css">
#reset,#SelectedUserStory{
    display: none;
}
</style>
    
    
   <script src="{{asset('/js/bootstrap-datepicker.min.js')}}"></script>

<button id="schowidus" class="btn btn-primary btn-sm pull-right">
                                    Reset
                                </button>

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading"><h1>Add a Sprint</h1></div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" 
                          action="{{ url('/sprints/register') }}">
                           {!! csrf_field() !!}



                        <div class="form-group{{ $errors->has('sprint_number') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Sprint number<span 
                                    class="required">*</span></label>

                            <div class="col-md-6">
                                <input type="number"  min="1" class="form-control" 
                                       name="sprint_number" disabled value="{{$sprint+1}}">

                                @if ($errors->has('sprint_number'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('sprint_number') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('date_start') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">Starting date<span 
                                    class="required">*</span> </label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="date_start" value="{{ old('date_start')}}">

                                @if ($errors->has('date_start'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date_start') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>



                        <!--**************************************-->



   




                         <!--**************************************-->

                         <div class="form-group{{ $errors->has('date_end') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">End date<span 
                                    class="required">*</span> </label>

                            <div class="col-md-6">
                                <input type="date" class="form-control" name="date_end" value="{{ old('date_end')}}">

                                @if ($errors->has('date_end'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('date_end') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                         <div class="form-group{{ $errors->has('user_stories') ? ' 
has-error' : '' }}">
                            <label class="col-md-4 control-label">User Stories<span 
                                    class="required">*</span> </label>

                                  @unless($UserStorys->count())
                                  <div class="col-md-6">
                                   <font color="red">You have to create User Story first
                                   <a  href="{{ url('/us/create/'.$projectID) }}"><input type="button" class="btn btn-sm btn-primary btn-create pull-right" 
                                                                            name="Create"value="Add New US"/></a>
 
                                </div>
                                   @else
                            <div class="col-md-3">



                                 <select class="form-control " id="userStory" multiple title="Choose one of the following...">
                                     @foreach($UserStorys as $UserStory)
                                        <option data-us="{{$UserStory->id}}">User Story{{$UserStory->us}}</option>
                                     @endforeach
                                </select>

                                      <label for="sel1">Choose the user Storie for this Sprint:</label>
                            
                                @if ($errors->has('user_stories'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('user_stories') 
                                        }}</strong>
                                </span>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <textarea rows="4" cols="10" class="form-control" id="Selectedus"
                                          name="userstory" maxlength="500" disabled>{{ old('userstory') }}</textarea>

                                           <textarea rows="4" cols="10" class="form-control" id="SelectedUserStory"
                                          name="SelectedUserStory" maxlength="500" disabled></textarea>
                              </br>
                            <button id="reset" class="btn btn-primary btn-sm pull-right">
                                    Reset
                                </button>
                            </div>
                           @endunless   
                                         
                        </div>

                        <div class="form-group">
                            <span class="text-muted col-xs-12" id"ici"><em>Fields with : <span class="required">*</span>
                                    are mandatory </em></span>
                        </div> 

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                               
                               @if($UserStorys->count() !=0) 
                                <button type="submit" class="btn btn-primary">
                                     <input type="hidden" name="idP" value={{$projectID}}>
                                      <input type="hidden" name="sprintnumber" value={{$sprint+1}}>
                                     
                                    Add
                                </button>
                               @endif 
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

 <div id='retour'></div>


<script src="https://code.jquery.com/jquery-3.1.0.js"></script>

<script>
$(document).ready(function(){ 
$('#userStory').change(function () {
    v =  $("#userStory option:selected").val();
    t =  $("#userStory option:selected").data('us'); // recupere le data-us
     
    
    
     userstory =$('#SelectedUserStory').text();

    if(  userstory != ''){
         userstory =$('#SelectedUserStory').text()+','+t;
         $('#SelectedUserStory').html(userstory);
    }else{
       $('#SelectedUserStory').html(t);        
    }
    selected =$('#Selectedus').text();

    if(  selected != ''){
         selected =$('#Selectedus').text()+','+v;
         $('#Selectedus').html(selected);
    }else{
       $('#Selectedus').html(v);
     
           
    }
    if($('#Selectedus').text() != ''){ $("#reset").fadeIn(800); }
 
})
.trigger('change');
 
})
</script>



<script>
$(document).ready(function(){
$( "#reset" ).on('click',function( event ) {

   $('#Selectedus').html('');
    $('#SelectedUserStory').html('');
    $(this).fadeOut( 1000 );
    //$('#SelectedUserStory').fadeIn(500);

 event.preventDefault();

  
});
}); 
</script>


<script>
$(document).ready(function(){
$( "#schowidus" ).on('click',function( event ) {

   $('#SelectedUserStory').slideToggle();

 event.preventDefault();

  
});
}); 
</script>

@endsection
