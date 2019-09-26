@extends('adminlte::page')

@section('title', 'Graduações')

@section('content_header')

        <h1>
            <i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Graduações
        </h1>
        <ol class="breadcrumb">
            <li><a href="/root"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/root/graduation"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Graduações</a></li>
        </ol>

@stop

@section('content')
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-graduation-cap"></i></h3>
            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="{{ route('root.graduation.create') }}" class="btn btn-success" title="Adicionar graduação"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Esporte</th>
                        <th>Horas de aula</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Root/graduation/homeGraduation.js')}}"></script>
@stop