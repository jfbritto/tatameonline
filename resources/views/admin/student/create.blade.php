@extends('adminlte::page')

@section('title', 'Aulas')

@section('content_header')

        <h1>
            Cadastrar aluno &nbsp;&nbsp;<i class="fas fa-user-graduate"></i>
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/student"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</a></li>
            <li><a href="/admin/student/create"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Cadastrar</a></li>
        </ol>

@stop

@section('content')
    
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Formulário de cadastro</h3>
    </div>
    <div class="box-body">
        
        <form id="formAddStudent">
            <div class="row">
                <div class="col-sm-6">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Nome do aluno" name="name" id="name">
                    </div>
            
                </div>
                <div class="col-sm-6">

                    <div class="input-group">
                        <span class="input-group-addon">@</span>
                        <input type="text" class="form-control" placeholder="Email do aluno" name="email" id="email">
                    </div>

                </div>
            </div>
            <input type="hidden" id="idAcademy" name="idAcademy" value="{{auth()->user()->academy->id}}">
        </form>
    </div>
    <div class="box-footer">
        <button form="formAddStudent" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
    </div>
</div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/student/createStudent.js')}}"></script>
@stop