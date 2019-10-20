@extends('adminlte::page')

@section('title', 'Financeiros')

@section('content_header')

        <h1>
            <i class="fas fa-dollar-sign"></i> &nbsp;&nbsp; Financeiro
        </h1>
        <ol class="breadcrumb">
            <li><a href="/student"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/student/financial"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Financeiro</a></li>
        </ol>

@stop

@section('content')

    <div id="lista2"></div>

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-file-contract"></i> &nbsp;&nbsp; Contratos</h3>

            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" class="btn btn-success" style="display:none" id="add-contract" title="Adicionar contrato" data-toggle="modal" data-target="#modal-default"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Data de assinatura</th>
                        <th>Período (mêses)</th>
                        <th>Mensalidade</th>
                        <th>Dia vencimento</th>
                        <th>Fat. Pagas</th>
                        <th>Fat. Abertas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <input type="hidden" id="idAcademy" value="{{auth()->user()->academy->id}}">

    <input type="hidden" id="idUser" value="{{auth()->user()->id}}">

    <div class="modal fade" id="modal-invoices">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-file-contract"></i>&nbsp;&nbsp;Faturas</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box-body table-responsive">
                            <table class="table table-hover table-condensed">
                                <thead>
                                    <tr>
                                        <th>Vencimento</th>
                                        <th>Valor</th>
                                        <th>Situação</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody id="listInvoices"></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Student/financial/homeFinancial.js')}}"></script>
@stop
