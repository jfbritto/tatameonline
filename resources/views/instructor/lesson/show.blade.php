@extends('adminlte::page')

@section('title', 'Aulas')

@section('content_header')

        <h1>
            <i class="fas fa-users"></i>&nbsp;&nbsp; Aula
        </h1>
        <ol class="breadcrumb">
            <li><a href="/instructor"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/instructor/lesson"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</a></li>
            <li><a href="/instructor/lesson/show/{{$lesson->id}}"><i class="fas fa-users"></i>&nbsp;&nbsp;Aula</a></li>
        </ol>

@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-users"></i>&nbsp;&nbsp;{{$sport_name[$lesson->idSport]}}</h3>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-md-4">
                <p><strong>Professor:</strong> {{$instructor->name}}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Dia:</strong> {{$week_day[$lesson->weekDay]}}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Hora:</strong> {{$lesson->hour}}</p>
            </div>
        </div>

    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</h3>
        <div class="box-tools">

        </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista"></tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

<input type="hidden" id="idLesson" value="{{$lesson->id}}">

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Instructor/lesson/showLesson.js')}}"></script>
@stop
