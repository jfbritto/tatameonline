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
                    <a href="#" data-toggle="modal" data-target="#modal-graduation" class="btn btn-success" title="Adicionar graduação"><i class="fas fa-plus fa-lg"></i></i></a>
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

    <div class="modal fade" id="modal-graduation">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Cadastrar graduação</h4>
            </div>
            <div class="modal-body">
                <form id="formAddGraduation">
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-graduation-cap"></i></span>
                                <input required type="text" class="form-control" placeholder="Nome da graduação" id="name" autofocus>
                            </div>
                    
                        </div>
                    </div>    
                    <br>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-futbol"></i></span>
                                <select required class="form-control" id="idSport"></select>
                            </div>
                    
                        </div>
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-clock"></i></span>
                                <input required type="number" class="form-control" placeholder="Horas de aula para graduar" id="hours">
                            </div>
                    
                        </div>
                    </div>

                    <input type="hidden" id="idAcademy" value="{{auth()->user()->academy->id}}">
                    <input type="hidden" id="startDate" value="{{date('Y-m-d')}}">
                    
                </form>
            </div>
            <div class="modal-footer">
                <button form="formAddGraduation" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/graduation/homeGraduation.js')}}"></script>
@stop