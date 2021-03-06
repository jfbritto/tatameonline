@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')

        <h1>
            <i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Aluno
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/instructor"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/instructor/student"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</a></li>
            <li><a href="/instructor/student/show/{{$student->id}}"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;{{$student->name}}</a></li>
        </ol>

@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-user-graduate"></i> &nbsp;&nbsp; {{$student->name}}</h3>
    </div>
    <div class="box-body">
        <hr>
        <div class="row">
            <div class="col-md-3 col-sm-6" title="Email">
                <p><strong><i class="fas fa-at"></i></strong> &nbsp; {{$student->email}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Tel">
                <p><strong><i class="fas fa-phone"></i></strong> &nbsp; {{$student->phone}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="CPF">
                <p><strong><i class="fas fa-address-card"></i></strong> &nbsp; {{$student->cpf}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Nascimento">
                <p><strong><i class="fas fa-birthday-cake"></i></strong> &nbsp; {{date("d/m/Y", strtotime($student->birth))}}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 col-sm-6" title="Responsável">
                <p><strong><i class="fas fa-user-friends"></i></strong> &nbsp; {{$student->responsible}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Tel. Responsável">
                <p><strong><i class="fas fa-phone"></i></strong> &nbsp; {{$student->phoneResponsible}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Cep">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$student->zipCode}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Cidade">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$student->city}}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 col-sm-6" title="Bairro">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$student->neighborhood}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Endereço">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$student->address}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Número">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$student->number}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Complemento">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$student->complement}}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-12 col-sm-12" title="Observação">
                <p><strong><i class="fas fa-align-justify"></i></strong> &nbsp; {{$student->observation}}</p>
            </div>
        </div>
        <hr>

    </div>
</div>


<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-graduation-cap"></i> &nbsp;&nbsp; Graduação</h3>

        <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right"></div>
        </div>
    </div>
    <div class="box-body">

        <div class="box-body table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Esporte</th>
                        <th>Graduação</th>
                        <th class="hidden-xs">Data início</th>
                        <th class="hidden-xs">Data fim</th>
                        <th class="hidden-xs">Situação</th>
                        <th class="hidden-xs" title="Horas necessárias">Hrs. neces</th>
                        <th class="hidden-xs" title="Horas completadas">Hrs. comp.</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="listGraduations"></tbody>
            </table>
        </div>

    </div>
</div>

<input type="hidden" id="idUser" value="{{auth()->user()->id}}">
<input type="hidden" id="idStudent" value="{{$student->id}}">

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Esporte</th>
                    <th class="hidden-xs">Professor</th>
                    <th>Dia</th>
                    <th>Hora</th>
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista"></tbody>
        </table>
    </div>
    <!-- /.box-body -->
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

<div id="box-modal-edit-invoice"></div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Instructor/student/showStudent.js')}}"></script>
@stop
