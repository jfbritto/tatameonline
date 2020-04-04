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

<h1>Ambiente do professor</h1>

<input type="hidden" id="idAcademy" value="{{auth()->user()->academy->id}}">


@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/indexAdmin.js')}}"></script>
@stop
