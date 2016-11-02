@extends('layouts.app2')
@section('content')
<div class="container"
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="{{ url('/home') }}">HOME</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="{{ url('/profile') }}">PROFILE</a></li>
	        <li><a href="#services">LOG OUT</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<div class="col-sm-12" style="background-color:lavender;">
		<div class="col-sm-4" style="background-color:lavender;">
			<div class="btn-group-vertical">
			  	<a href="{{ url('/kanban') }}" class=" btn btn-info" role="button">KanBan</a><br>
			   	<a href="{{ url('/backlog') }}" class="btn btn-info" role="button">Backlog</a><br>
			    <a href="{{ url('/sprint') }}" class="btn btn-info" role="button">Sprint</a><br>
			</div>
		</div>
		<div class="col-sm-4" style="background-color:lavender">
			<div class="panel panel-default">
		      <div class="panel-heading">***project->name</div>
		     <p><b>Proprietaire :</b>[variable qui contien le nom du prop]</p>
		     <p><b>Description :</b>[variable qui contien la description]</p>
		    </div>
		<button type="button" class="btn-success">Contribuer?</button>
		</div>
			<div class="col-sm-4" style="background-color:lavender">
			</div>
	</div>
</div>