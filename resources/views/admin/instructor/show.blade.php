@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')

        <h1>
            <i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Instrutor
            <!-- <small>preview of simple tables</small> -->
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/instructor"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Instrutores</a></li>
            <li><a href="/admin/instructor/show/{{$instructor->id}}"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;{{$instructor->name}}</a></li>
        </ol>

@stop

@section('content')

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-user-graduate"></i> &nbsp;&nbsp; {{$instructor->name}}</h3>
    </div>
    <div class="box-body">
        <hr>
        <div class="row">
            <div class="col-md-3 col-sm-6" title="Email">
                <p><strong><i class="fas fa-at"></i></strong> &nbsp; {{$instructor->email}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Tel">
                <p><strong><i class="fas fa-phone"></i></strong> &nbsp; {{$instructor->phone}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="CPF">
                <p><strong><i class="fas fa-address-card"></i></strong> &nbsp; {{$instructor->cpf}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Nascimento">
                <p><strong><i class="fas fa-birthday-cake"></i></strong> &nbsp; {{date("d/m/Y", strtotime($instructor->birth))}}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 col-sm-6" title="Cep">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$instructor->zipCode}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Cidade">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$instructor->city}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Bairro">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$instructor->neighborhood}}</p>
            </div>
            <div class="col-md-3 col-sm-6" title="Endereço">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$instructor->address}}</p>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-md-3 col-sm-3" title="Número">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$instructor->number}}</p>
            </div>
            <div class="col-md-3 col-sm-3" title="Complemento">
                <p><strong><i class="fas fa-map-marker-alt"></i></strong> &nbsp; {{$instructor->complement}}</p>
            </div>
            <div class="col-md-6 col-sm-6" title="Observação">
                <p><strong><i class="fas fa-align-justify"></i></strong> &nbsp; {{$instructor->observation}}</p>
            </div>
        </div>
        <hr>

    </div>
</div>

<input type="hidden" id="idUser" value="{{auth()->user()->id}}">
<input type="hidden" id="idStudent" value="{{$instructor->id}}">

<div class="box">
    <div class="box-header">
        <h3 class="box-title"><i class="fas fa-users"></i>&nbsp;&nbsp;Aulas</h3>
    </div>
    <!-- /.box-header -->
    <div class="box-body table-responsive">
        <table class="table table-hover table-condensed">
            <thead>
                <tr>
                    <th>Esporte</th>
                    <th class="hidden-xs">Professor</th>
                    <th>Dia</th>
                    <th>Hora</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            @foreach($lessons as $lesson)
                <tr>
                    <td>{{$sports[$lesson->idSport]}}</td>
                    <td>{{$instructor->name}}</td>
                    <td>{{$dias[$lesson->weekDay]}}</td>
                    <td>{{$lesson->hour}}</td>
                    <td><a class="btn btn-primary btn-sm pull-right" href="/admin/lesson/show/{{$lesson->id}}" title="Abrir aula"><i class="fas fa-sign-in-alt"></i></a></td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
    <!-- /.box-body -->
</div>

<div id="box-modal-edit-invoice"></div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/instructor/showInstructor.js')}}"></script>
@stop
