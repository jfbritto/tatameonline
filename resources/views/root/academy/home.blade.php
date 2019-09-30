@extends('adminlte::page')

@section('title', 'Academias')

@section('content_header')

        <h1>
            <i class="fas fa-briefcase"></i>&nbsp;&nbsp;Academias
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/root/academy"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Academias</a></li>
        </ol>

@stop

@section('content')
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-briefcase"></i></h3>
            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="{{ route('root.academy.create') }}" class="btn btn-success" title="Adicionar academia"><i class="fas fa-plus fa-lg"></i></i></a>
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
                        <th class="hidden-xs">Tel</th>
                        <th class="hidden-xs">Responsável</th>
                        <th class="hidden-xs">Tel. Responsável</th>
                        <th class="hidden-xs">Token</th>
                        <th class="hidden-xs">Status</th>
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
    <script src="{{asset('/js/Root/academy/homeAcademy.js')}}"></script>
@stop