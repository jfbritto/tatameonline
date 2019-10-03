@extends('adminlte::page')

@section('title', 'Contratos')

@section('content_header')

        <h1>
            <i class="fas fa-file-contract"></i> &nbsp;&nbsp; Contratos
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/student"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</a></li>
            <li><a href="/admin/student/show/{{$student->id}}"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;{{$student->name}}</a></li>
            <li><a href="/admin/student/contract/{{$student->id}}"><i class="fas fa-file-contract"></i>&nbsp;&nbsp;Contratos</a></li>
        </ol>

@stop

@section('content')
    
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
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Data de assinatura</th>
                        <th class="hidden-xs">Período (mêses)</th>
                        <th>Mensalidade</th>
                        <th class="hidden-xs">Dia vencimento</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <input type="hidden" id="idAcademy" value="{{auth()->user()->academy->id}}">

    <div class="modal fade" id="modal-default">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-file-contract"></i>&nbsp;&nbsp;Adicionar contrato</h4>
            </div>
            <div class="modal-body">
                <form id="formAddContract">
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <label for="signatureDate">Data assinatura</label>
                                <input type="date" readonly value="{{date('Y-m-d')}}" class="form-control" name="signatureDate" id="signatureDate" required>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group">
                                <label for="months">Período contrato (mêses)</label>
                                <input type="number" readonly value="12" class="form-control" name="months" id="months" required>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <label for="monthlyPayment">Mensalidade</label>
                                <input type="text" class="form-control money-mask" name="monthlyPayment" id="monthlyPayment" required>
                            </div>

                        </div>
                        <div class="col-sm-6">

                            <div class="input-group">
                                <label for="expiryDay">Dia vencimento</label>
                                <input type="number" readonly value="{{date('d')}}" class="form-control" name="expiryDay" id="expiryDay" required>
                            </div>

                        </div>
                        <input type="hidden" id="idUser" value="{{$student->id}}">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button form="formAddContract" class="btn btn-primary"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

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
                            <table class="table table-hover">
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
    <script src="{{asset('/js/Admin/contract/homeContract.js')}}"></script>
@stop