@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')

        <h1>
            {{auth()->user()->academy->name}}
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
        </ol>

@stop

@section('content')

<div class="row">
    <div class="col-md-3 col-sm-6 col-xs-12">
            <div class="info-box">
                <a href="#" data-toggle="modal" data-target="#modal-token">
                    <span class="info-box-icon bg-yellow"><i class="fas fa-key"></i></span>
                </a>
            <div class="info-box-content">
                <span class="info-box-text">TOKEN</span>
                <span class="info-box-number" id="info-box-token"></span>
            </div>

            </div>
    </div>
</div>

<input type="hidden" id="idAcademy" value="{{auth()->user()->academy->id}}">

<div class="modal fade" id="modal-token">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fas fa-key"></i>&nbsp;&nbsp;Token</h4>
        </div>
        <div class="modal-body text-center">
            <div class="row">
                <div class="col-md-12">
                    <div id="container" style="margin-left: auto; margin-right: auto; width: 200px;height: 200px;position: relative;"></div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
        <div class="row">
            <div class="col-sm-6">
                <select id="time" class="form-control">
                    <option value="10">10 segundos</option>
                    <option value="20">20 segundos</option>
                    <option value="30">30 segundos</option>
                    <option value="40">40 segundos</option>
                    <option value="50">50 segundos</option>
                    <option value="60">60 segundos</option>
                </select>
            </div>
            <div class="col-sm-6">
                <a class="btn btn-success btn-block" id="btn-container" href="#"><i class="fas fa-play"></i>&nbsp;&nbsp;START</a>
                <a class="btn btn-danger btn-block" id="btn-container-pause" href="#" style="display:none"><i class="fas fa-stop"></i>&nbsp;&nbsp;STOP</a>
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
    <script src="{{asset('/js/Admin/indexAdmin.js')}}"></script>
@stop