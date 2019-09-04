@extends('adminlte::page')

@section('title', 'Esportes')

@section('content_header')

        <h1>
            Cadastrar esporte &nbsp;&nbsp;<i class="fas fa-futbol"></i>
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/root"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/root/sport"><i class="fas fa-futbol"></i>&nbsp;&nbsp;Esportes</a></li>
            <li><a href="/root/sport/create"><i class="fas fa-futbol"></i>&nbsp;&nbsp;Cadastrar</a></li>
        </ol>

@stop

@section('content')
    
<div class="box">
    <div class="box-header with-border">
        <h3 class="box-title"><i class="fas fa-futbol"></i>&nbsp;&nbsp;Cadastrar esporte</h3>
    </div>
    <div class="box-body">

        <form id="formAddSport">
            <div class="row">
                <div class="col-sm-12">

                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-futbol"></i></span>
                        <input type="text" class="form-control" placeholder="Nome do esporte" id="name">
                    </div>
            
                </div>
            </div>
        </form>

    </div>
    <div class="box-footer">
        <button form="formAddSport" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
    </div>
</div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Root/sport/createSport.js')}}"></script>
@stop