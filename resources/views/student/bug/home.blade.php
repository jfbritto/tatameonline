@extends('adminlte::page')

@section('title', 'Bugs')

@section('content_header')

        <h1>
            <i class="fas fa-bug"></i>&nbsp;&nbsp;Bugs
        </h1>
        <ol class="breadcrumb">
            <li><a href="/student"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/student/bug"><i class="fas fa-bug"></i>&nbsp;&nbsp;Bugs</a></li>
        </ol>

@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-bug"></i>&nbsp;&nbsp;Colabore conosco!</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

            <p>* Caso encontre alguma irregularidade no sistema, ou tenha alguma sujestão de melhoria é só falar! :)</p>

            <form id="formAddBug">
                <div class="row">
                    <div class="col-sm-12" style="margin-bottom:10px">

                        <div class="input-group" style="width:100%">
                            <label>Conteúdo da mensagem</label>
                            <select class="form-control" id="type" required autofocus>
                                <option value="">-- Selecione --</option>
                                <option value="erro">Erro no sistema</option>
                                <option value="sujestao">Sujestão</option>
                            </select>
                        </div>

                    </div>

                    <div class="col-sm-12">

                        <div class="input-group" style="width:100%">
                            <label>Descrição</label>
                            <textarea class="form-control" required id="description"></textarea>
                        </div>

                    </div>
                </div>
            </form>

        </div>
        <div class="box-footer">
            <button form="formAddBug" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
        </div>
        <!-- /.box-body -->
    </div>

    <input type="hidden" id="idStudent" value="{{auth()->user()->id}}">

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Student/bug/homeBug.js')}}"></script>
@stop
