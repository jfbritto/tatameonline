@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')

        <h1>
            <i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Alunos
        </h1>
        <ol class="breadcrumb">
            <li><a href="/instructor"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/instructor/student"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</a></li>
        </ol>

@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Alunos</h3>

            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right"></div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover table-condensed datatable-table" id="students-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th class="hidden-xs">Email</th>
                        <th class="hidden-xs">Status</th>
                        <th class="hidden-xs">Aulas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <input type="hidden" id="idAcademy" name="idAcademy" value="{{auth()->user()->academy->id}}">
@stop

@section('adminlte_js')
    <script src="{{asset('/js/Instructor/student/homeStudent.js')}}"></script>
@stop
