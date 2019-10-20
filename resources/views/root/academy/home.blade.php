@extends('adminlte::page')

@section('title', 'Academias')

@section('content_header')

        <h1>
            <i class="fas fa-briefcase"></i>&nbsp;&nbsp;Academias
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/root/academy"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Academias</a></li>
        </ol>

@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-briefcase"></i></h3>
            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" data-toggle="modal" data-target="#modal-academy" class="btn btn-success" title="Adicionar academia"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hidden-xs">Tel</th>
                        <th class="hidden-xs">Responsável</th>
                        <th class="hidden-xs">Tel. Responsável</th>
                        <th class="hidden-xs">Token</th>
                        <th class="hidden-xs">Status</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="modal fade" id="modal-academy">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-briefcase"></i>&nbsp;&nbsp;Cadastrar academia</h4>
            </div>
            <div class="modal-body">
                <form id="formAddAcademy">
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-briefcase"></i></span>
                                <input type="text" class="form-control" placeholder="Nome" name="name" id="name" autofocus>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control phone-mask" placeholder="Telefone" name="phone" id="phone">
                            </div>

                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Responsável" name="responsible" id="responsible">
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control phone-mask" placeholder="Telefone do responsável" name="phoneResponsible" id="phoneResponsible">
                            </div>

                        </div>
                    </div>

                    <br>
                    <div class="row">
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control cep-mask" placeholder="Cep" name="zipCode" id="zipCode">
                            </div>

                        </div>
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Cidade" name="city" id="city">
                            </div>

                        </div>
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Bairro" name="neighborhood" id="neighborhood">
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Endereço" name="address" id="address">
                            </div>

                        </div>
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Número" name="number" id="number">
                            </div>

                        </div>
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Complemento" name="complement" id="complement">
                            </div>

                        </div>
                    </div>

                    <br>

                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Latitude" name="latitude" id="latitude">
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Longitude" name="longitude" id="longitude">
                            </div>

                        </div>
                    </div>

                </form>
            </div>
            <div class="modal-footer">
                <button form="formAddAcademy" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Root/academy/homeAcademy.js')}}"></script>
@stop
