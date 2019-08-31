@extends('adminlte::page')

@section('title', 'Academia')

@section('content_header')

        <h1>
            Cadastrar academia &nbsp;&nbsp;<i class="fas fa-briefcase"></i>
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="#"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Academias</a></li>
            <li><a href="/admin/student/create"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Cadastrar</a></li>
        </ol>

@stop

@section('content')
    
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title">Formulário de cadastro</h3>
    </div>
    <div class="box-body">

        <div class="row">
            <div class="col-sm-6">

                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
        
            </div>
            <div class="col-sm-6">

                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="text" class="form-control" placeholder="Username">
                </div>

            </div>
        </div>

        <br>

        <div class="row">
            <div class="col-sm-6">

                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="text" class="form-control" placeholder="Username">
                </div>
        
            </div>
            <div class="col-sm-6">

                <div class="input-group">
                    <span class="input-group-addon">@</span>
                    <input type="text" class="form-control" placeholder="Username">
                </div>

            </div>
        </div>

    </div>
    <div class="box-footer">
        <button class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
    </div>
</div>

@stop