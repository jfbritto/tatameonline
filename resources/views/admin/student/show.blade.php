@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')

        <h1>
            <i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Aluno
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/student"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</a></li>
            <li><a href="/admin/student/show/{{$student->id}}"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;{{$student->name}}</a></li>
        </ol>

@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-user-graduate"></i> &nbsp;&nbsp; {{$student->name}}</h3>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-md-6">
                <p><strong>Email:</strong> {{$student->email}}</p>
            </div>
        </div>

    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-file-contract"></i> &nbsp;&nbsp; Contrato</h3>

        <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="{{ route('admin.student.contract', ['student' => $student->id]) }}" class="btn btn-primary" title="Abrir contratos"><i class="fas fa-sign-in-alt fa-lg"></i></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">

        <div class="box-body table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Data de assinatura</th>
                        <th class="hidden-xs">Período (mêses)</th>
                        <th>Mensalidade</th>
                        <th class="hidden-xs">Dia vencimento</th>
                        <th class="hidden-xs">Fat. Pagas</th>
                        <th class="hidden-xs">Fat. Abertas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="listaContrato"></tbody>
            </table>
        </div>

    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-graduation-cap"></i> &nbsp;&nbsp; Graduação</h3>

        <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="{{ route('admin.student.graduation', ['student' => $student->id]) }}" class="btn btn-primary" title="Abrir graduações"><i class="fas fa-sign-in-alt fa-lg"></i></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">

        <div class="box-body table-responsive">
            <table class="table table-hover">
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

<input type="hidden" id="idStudent" value="{{$student->id}}">

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table class="table table-hover">
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

<div class="modal fade" id="modal-invoices">
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
                    <div class="box-body table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Vencimento</th>
                                    <th>Valor</th>
                                    <th>Situação</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody id="listInvoices"></tbody>
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
                        <table class="table table-hover">
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

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/student/showStudent.js')}}"></script>
@stop
