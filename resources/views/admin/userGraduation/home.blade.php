@extends('adminlte::page')

@section('title', 'Graduações')

@section('content_header')

        <h1>
            <i class="fas fa-graduation-cap"></i> &nbsp;&nbsp; Graduações
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/student"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</a></li>
            <li><a href="/admin/student/show/{{$student->id}}"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;{{$student->name}}</a></li>
            <li><a href="/admin/student/contract/{{$student->id}}"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Graduações</a></li>
        </ol>

@stop

@section('content')
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-graduation-cap"></i> &nbsp;&nbsp; Graduações</h3>

            <div class="box-tools">
            <div class="input-group input-group-sm hidden-xs" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" class="btn btn-success" title="Adicionar graduação" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive no-padding">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Esporte</th>
                        <th>Graduação</th>
                        <th>Data início</th>
                        <th>Data fim</th>
                        <th>Situação</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Adicionar graduação</h4>
            </div>
            <div class="modal-body">
                <form id="formAddUserGraduation">
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group" style="width:100%">
                                <label for="sports">Esporte</label>
                                <select class="form-control" name="sports" id="sports"></select>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group" style="width:100%">
                                <label for="idGraduation">Graduação</label>
                                <select class="form-control" name="idGraduation" id="idGraduation"></select>
                            </div>

                        </div>

                    
                        <input type="hidden" id="idUser" value="{{$student->id}}">
                        <input type="hidden" id="startDate" value="{{date('Y-m-d')}}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button form="formAddUserGraduation" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-presences">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-file-contract"></i>&nbsp;&nbsp;Faturas</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive no-padding">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Vencimento</th>
                                        <th>Valor</th>
                                        <th>Situação</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="listPresences"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/graduation/homeUserGraduation.js')}}"></script>
@stop