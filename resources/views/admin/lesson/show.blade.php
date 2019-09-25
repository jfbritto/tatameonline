@extends('adminlte::page')

@section('title', 'Aulas')

@section('content_header')

        <h1>
            Aula &nbsp;&nbsp;<i class="fas fa-users"></i>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/lesson"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</a></li>
            <li><a href="/admin/lesson/show/{{$lesson->id}}"><i class="fas fa-users"></i>&nbsp;&nbsp;Aula</a></li>
        </ol>

@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-users"></i>&nbsp;&nbsp;{{$sport_name[$lesson->idSport]}}</h3>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-md-4">
                <p><strong>Professor:</strong> {{$lesson->teacher}}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Dia:</strong> {{$week_day[$lesson->weekDay]}}</p>
            </div>
            <div class="col-md-4">
                <p><strong>Hora:</strong> {{$lesson->hour}}</p>
            </div>
        </div>

    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</h3>
        <div class="box-tools">
        <div class="input-group input-group-sm" style="width: 150px; text-align: right">
            <div class="input-group-btn">
                <a href="#" class="btn btn-success" title="Adicionar usuário" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus fa-lg"></i></i></a>
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
            <h4 class="modal-title"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Matricular aluno</h4>
        </div>
        <div class="modal-body">
            <form id="formAddAlun">
                <div class="row">
                    <div class="col-sm-12">

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-user-graduate"></i></span>
                            <select class="form-control" name="idUser" id="idUser"></select>
                        </div>

                    </div>
                    <input type="hidden" id="idAcademy" value="{{$academy->id}}">
                    <input type="hidden" id="idLesson" value="{{$lesson->id}}">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button form="formAddAlun" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Matricular</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/lesson/showLesson.js')}}"></script>
@stop