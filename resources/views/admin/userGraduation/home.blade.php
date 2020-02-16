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
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" class="btn btn-success" title="Adicionar graduação" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Esporte</th>
                        <th>Graduação</th>
                        <th class="hidden-xs">Data início</th>
                        <th class="hidden-xs">Data fim</th>
                        <th>Situação</th>
                        <th title="Horas necessárias">Hrs. neces</th>
                        <th title="Horas completadas">Hrs. comp.</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <!-- MODAIS -->
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
                                <select class="form-control" name="sports" id="sports" required></select>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group" style="width:100%">
                                <label for="idGraduation">Graduação</label>
                                <select class="form-control" name="idGraduation" id="idGraduation" required></select>
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
                <h4 class="modal-title"><i class="fas fa-user-check"></i>&nbsp;&nbsp;Presenças</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Dia aula</th>
                                        <th>Professor</th>
                                        <th>Hora aula</th>
                                        <th>Data/Hora presença</th>
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

    <div class="modal fade" id="modal-graduate">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Graduar aluno</h4>
            </div>
            <div class="modal-body">
                <form id="formAddUserNewGraduation">
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group" style="width:100%">
                                <label for="sports">Graduação atual:</label>
                                <font id="desc_graduacao"></font>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group" style="width:100%">
                                <label for="sports">Esporte:</label>
                                <font id="desc_sport"></font>
                            </div>

                        </div>
                        <hr>
                        <div class="col-sm-12">

                            <div class="input-group" style="width:100%">
                                <label for="idGraduation">Graduar para</label>
                                <select class="form-control" name="idNewGraduation" id="idNewGraduation" required></select>
                            </div>

                        </div>


                        <input type="hidden" id="idOldUserGraduation" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button form="formAddUserNewGraduation" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-start">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-clock"></i>&nbsp;&nbsp;Start de horas</h4>
            </div>
            <div class="modal-body">
                <form id="formAddStart">
                    <div class="row">
                        <div class="col-sm-12">

                            <p>* Informe quando o aluno iniciou nessa graduação.</p>
                            <p>* Informe quantas horas de aula nessa graduação este aluno já possúi.</p>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group" style="width:100%">
                                <label for="startDate2">Data de início</label>
                                <input type="date" class="form-control" name="startDate2" id="startDate2">
                            </div>
                        </div>
                        <div class="col-sm-6">

                            <div class="input-group" style="width:100%">
                                <label for="time">Horas</label>
                                <input type="number" min="1" class="form-control" name="time" id="time" required>
                            </div>
                        </div>


                        <input type="hidden" id="idUserGraduationStart" value="">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button form="formAddStart" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <input type="hidden" id="idAcademy" value="{{auth()->user()->academy->id}}">
@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/graduation/homeUserGraduation.js')}}"></script>
@stop
