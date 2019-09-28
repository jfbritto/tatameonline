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
            <div class="input-group input-group-sm hidden-xs" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="{{ route('admin.student.contract', ['student' => $student->id]) }}" class="btn btn-primary" title="Abrir contratos"><i class="fas fa-sign-in-alt fa-lg"></i></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">


    </div>
</div>

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-graduation-cap"></i> &nbsp;&nbsp; Graduação</h3>
        
        <div class="box-tools">
            <div class="input-group input-group-sm hidden-xs" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="{{ route('admin.student.graduation', ['student' => $student->id]) }}" class="btn btn-primary" title="Abrir graduações"><i class="fas fa-sign-in-alt fa-lg"></i></i></a>
                </div>
            </div>
        </div>
    </div>
    <div class="box-body">


    </div>
</div>

<input type="hidden" id="idStudent" value="{{$student->id}}">

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive no-padding">
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

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/student/showStudent.js')}}"></script>
@stop