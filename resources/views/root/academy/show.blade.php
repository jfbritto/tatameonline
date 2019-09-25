@extends('adminlte::page')

@section('title', 'Academia')

@section('content_header')

        <h1>
            {{$academy->name}} &nbsp;&nbsp;<i class="fas fa-briefcase"></i>
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/root"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/root/academy/"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Academias</a></li>
            <li><a href="/root/academy/show/{{$academy->id}}"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;{{$academy->name}}</a></li>
        </ol>

@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Usuários</h3>
        <div class="box-tools">
        <div class="input-group input-group-sm" style="width: 150px; text-align: right">
            <div class="input-group-btn">
                <a href="#" class="btn btn-success" title="Adicionar usuário" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus fa-lg"></i></i></a>
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
                    <th></th>
                </tr>
            </thead>
            <tbody id="lista"></tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

<div class="modal fade" id="modal-default">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fas fa-user"></i>&nbsp;&nbsp;Cadastrar usuário</h4>
        </div>
        <div class="modal-body">
            <form id="formAddUser">
                <div class="row">
                    <div class="col-sm-6">

                        <div class="input-group">
                            <span class="input-group-addon"><i class="fas fa-user"></i></span>
                            <input type="text" class="form-control" placeholder="Nome" name="name" id="name">
                        </div>

                    </div>
                    <div class="col-sm-6">

                        <div class="input-group">
                            <span class="input-group-addon">@</span>
                            <input type="text" class="form-control" placeholder="Email" name="email" id="email">
                        </div>

                    </div>
                    <input type="hidden" id="idAcademy" value="{{$academy->id}}">
                </div>
            </form>
        </div>
        <div class="modal-footer">
            <button form="formAddUser" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Root/academy/showAcademy.js')}}"></script>
@stop