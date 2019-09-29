@extends('adminlte::page')

@section('title', 'Home')

@section('content_header')

        <h1>
            {{auth()->user()->academy->name}} | {{auth()->user()->name}}
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
        </ol>

@stop

@section('content')
    
<input type="hidden" id="idStudent" value="{{auth()->user()->id}}">

<div id="lista"></div>

<div class="modal fade" id="modal-check">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><i class="fas fa-user-check"></i>&nbsp;&nbsp;Lista de presença</h4>
        </div>
        <div class="modal-body">
            
            <div class="row">
                <div class="col-sm-3">
                    <p><strong>Esporte:</strong> <font id="sport-modal"></font></p>
                </div>
                <div class="col-sm-3">
                    <p><strong>Professor:</strong> <font id="teacher-modal"></font></p>
                </div>
                <div class="col-sm-3">
                    <p><strong>Dia:</strong> <font id="weekDay-modal"></font></p>
                </div>
                <div class="col-sm-3">
                    <p><strong>Hora:</strong> <font id="hour-modal"></font></p>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12">
                    <p>* Para confirmar sua presença na aula, basta preencher o campo abaixo com o token da academia informado pelo professor.</p>        
                </div>
            </div>
            <form id="formAddPresence">
            <div class="row">
                <div class="col-md-12">
                    
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fas fa-key"></i></span>
                        <input type="text" maxlength='6' class="form-control" placeholder="Informe o token" name="token" id="token">
                    </div>

                </div>
            </div>

            <input type="hidden" id="idRegistration" value="">
            <input type="hidden" id="idUserGraduation" value="">
            
            </form>
        </div>
        <div class="box-footer">
            <button form="formAddPresence" class="btn btn-primary btn-block"><i class="fas fa-save"></i>&nbsp;&nbsp;Confirmar presença</button>
        </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Student/indexStudent.js')}}"></script>
@stop