@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')

        <h1>
            <i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Alunos
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/student"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</a></li>
        </ol>

@stop

@section('content')
    
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Alunos</h3>

            <div class="box-tools">
            <div class="input-group input-group-sm hidden-xs" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="{{ route('admin.student.create') }}" class="btn btn-success" title="Adicionar aluno"><i class="fas fa-plus fa-lg"></i></i></a>
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
                        <th class="hidden-xs">Email</th>
                        <th class="hidden-xs">Aulas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <input type="hidden" id="idAcademy" value="{{auth()->user()->academy->id}}">

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/student/homeStudent.js')}}"></script>
@stop