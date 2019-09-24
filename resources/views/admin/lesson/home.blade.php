@extends('adminlte::page')

@section('title', 'Aulas')

@section('content_header')

        <h1>
            Aulas &nbsp;&nbsp;<i class="fas fa-users"></i>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="#"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</a></li>
        </ol>

@stop

@section('content')
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Aulas</h3>

            <div class="box-tools">
            <div class="input-group input-group-sm hidden-xs" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="{{ route('admin.lesson.create') }}" class="btn btn-success" title="Adicionar aula"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Professor</th>
                        <th>Dia</th>
                        <th>Hora</th>
                        <th>Esporte</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <input type="hidden" id="idAcademy" value="{{auth()->user()->academy->id}}">

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/lesson/homeLesson.js')}}"></script>
@stop