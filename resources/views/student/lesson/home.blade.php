@extends('adminlte::page')

@section('title', 'Aulas')

@section('content_header')

        <h1>
            Aulas
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="#"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</a></li>
            <!-- <li class="active">Data tables</li> -->
        </ol>

@stop

@section('content')
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Aulas</h3>

            <div class="box-tools">
            <div class="input-group input-group-sm hidden-xs" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" class="btn btn-danger" title="Gerar pdf"><i class="fas fa-file-pdf fa-lg"></i></a>
                    <a href="#" class="btn btn-success" title="Adicionar aula"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
            <tbody><tr>
                <th>Nome</th>
                <th>Nascimento</th>
                <th>Status</th>
            </tr>
            <tr>
                <td>John Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-success">Approved</span></td>
            </tr>
            <tr>
                <td>Alexander Pierce</td>
                <td>11-7-2014</td>
                <td><span class="label label-warning">Pending</span></td>
            </tr>
            <tr>
                <td>Bob Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-primary">Approved</span></td>
            </tr>
            <tr>
                <td>Mike Doe</td>
                <td>11-7-2014</td>
                <td><span class="label label-danger">Denied</span></td>
            </tr>
            </tbody></table>
        </div>
        <!-- /.box-body -->
    </div>

@stop