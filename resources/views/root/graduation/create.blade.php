@extends('adminlte::page')

@section('title', 'Esportes')

@section('content_header')

        <h1>
            <i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Cadastrar Graduações
        </h1>
        <ol class="breadcrumb">
            <li><a href="/root"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/root/graduation"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Graduações</a></li>
            <li><a href="#"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;cadastrar</a></li>
        </ol>

@stop

@section('content')
    
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-graduation-cap"></i>&nbsp;&nbsp;Formulário de cadastro</h3>
    </div>
    <div class="box-body">

        <form id="formAddGraduation">
            <div class="row">
                <div class="col-sm-4">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-graduation-cap"></i></span>
                        <input required type="text" class="form-control" placeholder="Nome da graduação" id="name" autofocus>
                    </div>
            
                </div>
                <div class="col-sm-4">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-futbol"></i></span>
                        <select required class="form-control" id="idSport"></select>
                    </div>
            
                </div>
                <div class="col-sm-4">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-clock"></i></span>
                        <input required type="number" class="form-control" placeholder="Horas de aula para graduar" id="hours">
                    </div>
            
                </div>
            </div>
        </form>

    </div>
    <div class="box-footer">
        <button form="formAddGraduation" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
    </div>
</div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Root/graduation/createGraduation.js')}}"></script>
@stop