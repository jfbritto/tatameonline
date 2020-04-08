@extends('adminlte::page')

@section('title', 'Aulas')

@section('content_header')

        <h1>
            <i class="fas fa-users"></i> &nbsp;&nbsp; Aulas
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="#"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</a></li>
        </ol>

@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-users"></i> &nbsp;&nbsp;Aulas</h3>

            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" data-toggle="modal" data-target="#modal-lesson" class="btn btn-success" title="Adicionar aula"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover table-condensed datatable-table" id="lessons-table">
                <thead>
                    <tr>
                        <th>Esporte</th>
                        <th class="hidden-xs">Professor</th>
                        <th>Dia</th>
                        <th>Hora</th>
                        <th class="hidden-xs">Alunos</th>
                        <th style="width:80px"></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="modal fade" id="modal-lesson">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-users"></i>&nbsp;&nbsp;Cadastrar aula</h4>
            </div>
            <div class="modal-body">
                <form id="formAddLesson">
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                <!-- <input type="text" class="form-control" required placeholder="Nome do professor" name="teacher" id="teacher" autofocus> -->
                                <select class="form-control" required name="teacher" id="teacher">
                                    <option value=""> -- Selecione -- </option>
                                    @foreach($instructors as $instructor)
                                        <option value="{{$instructor->id}}"> {{$instructor->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
                                <select class="form-control" required name="weekDay" id="weekDay">
                                    <option value=""> -- Selecione -- </option>
                                    <option value="1">Segunda</option>
                                    <option value="2">Terça</option>
                                    <option value="3">Quarta</option>
                                    <option value="4">Quinta</option>
                                    <option value="5">Sexta</option>
                                    <option value="6">Sábado</option>
                                    <option value="7">Domingo</option>
                                </select>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-clock"></i></span>
                                <input type="time" class="form-control" required placeholder="Hora da aula" name="hour" id="hour">
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-futbol"></i></span>
                                <select class="form-control" name="idSport" id="idSport" required>
                                    <option value=""> -- Selecione -- </option>
                                    @foreach($sports as $sport)
                                        <option value="{{$sport->id}}"> {{$sport->name}} </option>
                                    @endforeach
                                </select>
                            </div>

                        </div>
                    </div>
                    <input type="hidden" id="idAcademy" name="idAcademy" value="{{auth()->user()->academy->id}}">
                </form>
            </div>
            <div class="modal-footer">
                <button form="formAddLesson" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/lesson/homeLesson.js')}}"></script>
@stop
