@extends('adminlte::page')

@section('title', 'Alunos')

@section('content_header')

        <h1>
            <i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Alunos
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/student"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Alunos</a></li>
        </ol>

@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Alunos</h3>

            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" data-toggle="modal" data-target="#modal-user" class="btn btn-success" title="Adicionar aluno"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover datatable-table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th class="hidden-xs">Email</th>
                        <th class="hidden-xs">Status</th>
                        <th class="hidden-xs">Aulas</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody id="lista"></tbody>
            </table>
        </div>
        <!-- /.box-body -->
    </div>

    <div class="modal fade" id="modal-user">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Cadastrar aluno</h4>
            </div>
            <div class="modal-body">
                <form id="formAddStudent">

                    <div class="row">
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Nome do aluno" name="name" id="name" required>
                            </div>

                        </div>
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <input type="email" class="form-control" placeholder="Email do aluno" name="email" required id="email">
                            </div>

                        </div>
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control phone-mask" placeholder="Telefone do aluno" name="phone" required id="phone">
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-address-card"></i></span>
                                <input type="text" class="form-control" placeholder="Cpf do aluno" name="cpf" id="cpf" required>
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-birthday-cake"></i></span>
                                <input type="date" class="form-control" name="birth" required id="birth">
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-user-friends"></i></span>
                                <input type="text" class="form-control" placeholder="Responsável" name="responsible" id="responsible" required>
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control" placeholder="Tel. responsável" name="phoneResponsible" required id="phoneResponsible">
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Cep" name="zipCode" id="zipCode" required>
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Bairro" name="neighborhood" id="neighborhood" required>
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Endereço" name="address" id="address" required>
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Número" name="number" required id="number">
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Complemento" name="complement" required id="complement">
                            </div>

                        </div>
                    </div>


                    <div class="row">
                        <div class="col-sm-12">

                            <div class="input-group">
                                <span class="input-group-addon">@</span>
                                <textarea class="form-control" name="observation" id="observation"></textarea>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" id="idAcademy" name="idAcademy" value="{{auth()->user()->academy->id}}">
                </form>
            </div>
            <div class="modal-footer">
                <button form="formAddStudent" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/student/homeStudent.js')}}"></script>
@stop

{{--
cpf
birth
responsible
phoneResponsible
zipCode
city
neighborhood
address
number
complement
avatar
observation --}}
