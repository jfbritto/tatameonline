@extends('adminlte::page')

@section('title', 'Aulas')

@section('content_header')

        <h1>
            <i class="fas fa-users"></i>&nbsp;&nbsp;Cadastrar aula
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/lesson"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</a></li>
            <li><a href="/admin/lesson/create"><i class="fas fa-users"></i>&nbsp;&nbsp;Cadastrar</a></li>
        </ol>

@stop

@section('content')
    
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-users"></i>&nbsp;&nbsp;Formulário de cadastro</h3>
    </div>
    <div class="box-body">
        
        <form id="formAddLesson">
            <div class="row">
                <div class="col-sm-6">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Nome do professor" name="teacher" id="teacher" autofocus>
                    </div>
            
                </div>
                <div class="col-sm-6">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-calendar"></i></span>
                        <select class="form-control" name="weekDay" id="weekDay">
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
                        <input type="time" class="form-control" placeholder="Hora da aula" name="hour" id="hour">
                    </div>
            
                </div>
                <div class="col-sm-6">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-futbol"></i></span>
                        <select class="form-control" name="idSport" id="idSport">
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
    <div class="box-footer">
        <button form="formAddLesson" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
    </div>
</div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/lesson/createLesson.js')}}"></script>
@stop