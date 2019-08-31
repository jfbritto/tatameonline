@extends('adminlte::page')

@section('title', 'Esportes')

@section('content_header')

        <h1>
            Esportes &nbsp;&nbsp;<i class="fas fa-futbol"></i>
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/root"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="#"><i class="fas fa-futbol"></i>&nbsp;&nbsp;Esportes</a></li>
            <!-- <li class="active">Data tables</li> -->
        </ol>

@stop

@section('content')
    
    <div class="box">
        <div class="box-header">
            
            <div class="box-tools">
            <div class="input-group input-group-sm hidden-xs" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" class="btn btn-danger" title="Gerar pdf"><i class="fas fa-file-pdf fa-lg"></i></a>
                    <a href="{{ route('root.sport.create') }}" class="btn btn-success" title="Adicionar academia"><i class="fas fa-plus fa-lg"></i></i></a>
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
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Root/listSport.js')}}"></script>
@stop