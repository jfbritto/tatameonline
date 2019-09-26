@extends('adminlte::page')

@section('title', 'Academia')

@section('content_header')

        <h1>
            Cadastrar academia &nbsp;&nbsp;<i class="fas fa-briefcase"></i>
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/root"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/root/academy/"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Academias</a></li>
            <li><a href="/root/academy/create"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Cadastrar</a></li>
        </ol>

@stop

@section('content')
    
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Cadastrar academia</h3>
    </div>
    <div class="box-body">
        
        <form id="formAddAcademy">
            <div class="row">
                <div class="col-sm-6">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                        <input type="text" class="form-control" placeholder="Nome da academia" name="name" id="name" autofocus>
                    </div>
            
                </div>
                <div class="col-sm-6">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                        <input type="text" class="form-control" placeholder="Telefone da academia" name="phone" id="phone">
                    </div>

                </div>
            </div>

            <br>

            <div class="row">
                <div class="col-sm-6">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-user"></i></span>
                        <input type="text" class="form-control" placeholder="Nome do responsável" name="responsable" id="responsable">
                    </div>
            
                </div>
                <div class="col-sm-6">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                        <input type="text" class="form-control" placeholder="Telefone do responsável" name="phoneResponsable" id="phoneResponsable">
                    </div>

                </div>
            </div>
        </form>

    </div>
    <div class="box-footer">
        <button form="formAddAcademy" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
    </div>
</div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Root/academy/createAcademy.js')}}"></script>
@stop