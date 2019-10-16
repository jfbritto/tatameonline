@extends('adminlte::page')

@section('title', 'Financeiro')

@section('content_header')

        <h1>
            <i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Financeiro - <font id="title"></font>
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="#"><i class="fas fa-dollar-sign"></i>&nbsp;&nbsp;Financeiro</a></li>
            <!-- <li class="active">Data tables</li> -->
        </ol>

@stop

@section('content')

<div class="row">

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3 id="receive"><i class="fas fa-sync-alt fa-spin"></i></h3>

                <p>À receber</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="small-box bg-green">
            <div class="inner">
                <h3 id="received"><i class="fas fa-sync-alt fa-spin"></i></h3>

                <p>Recebido</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <div class="small-box bg-red">
            <div class="inner">
                <h3 id="late"><i class="fas fa-sync-alt fa-spin"></i></h3>

                <p>Atrasado</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
        </div>
    </div>

</div>


<div class="panel panel-default">
    <div class="panel-body">

        <div class="row" style="margin-bottom:10px">
            <div class="col-sm-12">
                <form id="formSearchRevenue">
                    <div class="input-group">
                        <label for="months">Mês</label>
                        <input type="month" class="form-control" id="date" value="{{date('Y-m')}}">
                    </div>
                </form>

            </div>
        </div>

        <ul class="nav nav-tabs">
            <li class="active"><a data-toggle="tab" href="#home">À receber</a></li>
            <li><a data-toggle="tab" href="#menu1">Recebido</a></li>
            <li><a data-toggle="tab" href="#menu2">Atrasado</a></li>
        </ul>

        <div class="tab-content">
            <div id="home" class="tab-pane fade in active">
            <div class="box-body table-responsive">
                    <table class="table table-hover datatable-table">
                        <thead>
                            <tr>
                                <th>Aluno</th>
                                <th>Vencimento</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="list-receive"></tbody>
                    </table>
                </div>
            </div>
            <div id="menu1" class="tab-pane fade">
                <div class="box-body table-responsive">
                    <table class="table table-hover datatable-table">
                        <thead>
                            <tr>
                                <th>Aluno</th>
                                <th>Vencimento</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="list-received"></tbody>
                    </table>
                </div>
            </div>
            <div id="menu2" class="tab-pane fade">
                <div class="box-body table-responsive">
                    <table class="table table-hover datatable-table">
                        <thead>
                            <tr>
                                <th>Aluno</th>
                                <th>Vencimento</th>
                                <th>Valor</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody id="list-late"></tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="panel panel-default">
        <div class="panel-heading">
            Alunos com débito
        </div>

        <div class="box-body table-responsive">
            <table class="table table-hover datatable-table">
                <thead>
                    <tr>
                        <th>Aluno</th>
                        <th>Faturas vencidas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="list-debtors"></tbody>
            </table>
        </div>
    </div>
</div>







<input type="hidden" id="idAcademy" name="idAcademy" value="{{auth()->user()->academy->id}}">

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/financial/homeFinancial.js')}}"></script>
@stop
