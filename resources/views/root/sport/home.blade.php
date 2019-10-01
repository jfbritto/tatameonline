@extends('adminlte::page')

@section('title', 'Esportes')

@section('content_header')

        <h1>
            <i class="fas fa-futbol"></i>&nbsp;&nbsp;Esportes
        </h1>
        <ol class="breadcrumb">
            <li><a href="/root"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/root/sport"><i class="fas fa-futbol"></i>&nbsp;&nbsp;Esportes</a></li>
        </ol>

@stop

@section('content')
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-futbol"></i></h3>

            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" data-toggle="modal" data-target="#modal-sport" class="btn btn-success" title="Adicionar esporte"><i class="fas fa-plus fa-lg"></i></i></a>
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

    <div class="modal fade" id="modal-sport">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-futbol"></i>&nbsp;&nbsp;Cadastrar esporte</h4>
            </div>
            <div class="modal-body">
                <form id="formAddSport">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-futbol"></i></span>
                                <input type="text" class="form-control" placeholder="Nome do esporte" id="name" autofocus>
                            </div>
                    
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button form="formAddSport" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Root/sport/homeSport.js')}}"></script>
@stop