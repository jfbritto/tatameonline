@extends('adminlte::page')

@section('title', 'Financeiro')

@section('content_header')

        <h1>
            Financeiro
            <!-- <small>preview of simple tables</small> -->
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
                <h3 id="receive">1.150,00</h3>

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
                <h3 id="received">830,00</h3>

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
                <h3 id="late">470,00</h3>

                <p>Atrasado</p>
            </div>
            <div class="icon">
                <i class="ion ion-cash"></i>
            </div>
        </div>
    </div>

</div>

<input type="hidden" id="idAcademy" name="idAcademy" value="{{auth()->user()->academy->id}}">

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/financial/homeFinancial.js')}}"></script>
@stop
