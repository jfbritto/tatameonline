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
            <h3 class="box-title"><i class="fas fa-bug"></i></h3>

            <div class="box-tools"></div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover table-condensed">
                <thead>
                    <tr>
                        <th>Tipo</th>
                        <th>Descrição</th>
                        <th>Data Envio</th>
                        <th>Academia</th>
                        <th>Usuário</th>
                        <th>Lida</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Root/bug/homeBug.js')}}"></script>
@stop
