@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">

                    <center><h1><b>Sprints</b></h1></center>
                </div>

                <div class="panel-body">




                    <div class="container">
                        <div class="row">
                            <div class="col-md-9">
                                <a href="{{ url('sprints/create/'.$id) }}">
                                    <input type="button" class="btn btn-sm btn-primary btn-create pull-right" name="Create"value="Create new Sprint"/>
                                </a>
                            </div>
                        </div>
                        <form method="post" action="{{url('projects/showSprint')}}">
                            {!! csrf_field() !!}
                            <p>choix du sprint :</p>
                            <select name="sprint_choice">
                                <?php
                                foreach ($sprints as $key => $value) {
                                    ?>  
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>      
                                    <?php
                                }
                                ?>
                            </select>
                            <input type="submit" value="Go"/>


                        </form>


                    </div>



                    <div>
                        <h2>Tasks</h2>
                        <div class="container">
                            <div class="row">
                                <div class="col-md-9">
                                    <a href="{{ url('task/create/'.$id) }}"><input type="button" class="btn btn-sm btn-primary btn-create pull-right" name="Create"value="Create new task"/></a>
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

                                    <tr>
                                        <th scope="row">All</th>
                                        <td>T1,T5,T7,T8</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <th scope="row">US#12</th>
                                        <td>T2,T3,T4</td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
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
