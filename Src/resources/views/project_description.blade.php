@extends('layouts.app1')
@section('content')
<div class="container"
	<nav class="navbar navbar-default navbar-fixed-top">
	  <div class="container">
	    <div class="navbar-header">
	      <a class="navbar-brand" href="#myPage">Logo</a>
	    </div>
	    <div class="collapse navbar-collapse" id="myNavbar">
	      <ul class="nav navbar-nav navbar-right">
	        <li><a href="#about">PROFILE</a></li>
	        <li><a href="#services">LOG OUT</a></li>
	      </ul>
	    </div>
	  </div>
	</nav>
	<div class="col-sm-12" style="background-color:lavender;">
		<div class="col-sm-4" style="background-color:lavender;">
			<div class="btn-group-vertical">
			  <button type="button" class="btn btn-info">KAN BAN<span class="badge">7</span></button>
			  <button type="button" class="btn btn-info">BACKLOG</button>
			  <button type="button" class="btn btn-info">SPRINTS</button>
			</div>
		</div>
		<div class="col-sm-4" style="background-color:lavender">
			<div class="panel panel-default">
		      <div class="panel-heading">PROJECT NAME</div>
		     <p><b>Proprietaire :</b>[variable qui contien le nom du prop]</p>
		     <p><b>Description :</b>[variable qui contien la description]</p>
		    </div>
		<button type="button" class="btn-success">COntribuer?</button>
		</div>
			<div class="col-sm-4" style="background-color:lavender">
			</div>
	</div>
</div>