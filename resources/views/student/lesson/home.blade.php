@extends('adminlte::page')

@section('title', 'Aulas')

@section('content_header')

        <h1>
            <i class="fas fa-users"></i>&nbsp;&nbsp;Aulas
        </h1>
        <ol class="breadcrumb">
            <li><a href="/student"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/student/lesson"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</a></li>
        </ol>

@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Esporte</th>
                        <th class="hidden-xs">Professor</th>
                        <th>Dia</th>
                        <th>Hora</th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <input type="hidden" id="idStudent" value="{{auth()->user()->id}}">

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Student/lesson/homeLesson.js')}}"></script>
@stop
