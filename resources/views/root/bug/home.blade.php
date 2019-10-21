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
            <h3 class="box-title"><i class="fas fa-bug"></i>&nbsp;&nbsp;Bugs</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body">

                <div class="list-group">
                    <a href="#" class="list-group-item">First <span class="badge">5</span></a>
                    <a href="#" class="list-group-item">Second <span class="badge">5</span></a>
                    <a href="#" class="list-group-item">Second <span class="badge">5</span></a>
                    <a href="#" class="list-group-item">Second <span class="badge">5</span></a>
                    <a href="#" class="list-group-item">Second <span class="badge">5</span></a>
                    <a href="#" class="list-group-item">Third <span class="badge">5</span></a>
                    <a href="#" class="list-group-item">Third <span class="badge">5</span></a>
                    <a href="#" class="list-group-item">Third <span class="badge">5</span></a>
                    <a href="#" class="list-group-item">Third <span class="badge">5</span></a>
                </div>

        </div>
    </div>

    <input type="hidden" id="idUser" value="{{auth()->user()->id}}">

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/bug/homeBug.js')}}"></script>
@stop
