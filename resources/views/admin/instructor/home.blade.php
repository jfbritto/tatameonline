@extends('adminlte::page')

@section('title', 'Instrutores')

@section('content_header')

        <h1>
            <i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Instrutores
        </h1>
        <ol class="breadcrumb">
            <li><a href="/admin"><i class="fas fa-home"></i>&nbsp;&nbsp;Home</a></li>
            <li><a href="/admin/instructor"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;Instrutores</a></li>
        </ol>

@stop

@section('content')

    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><i class="fas fa-user-graduate"></i> &nbsp;&nbsp; Instrutores</h3>

            <div class="box-tools">
            <div class="input-group input-group-sm" style="width: 150px; text-align: right">
                <div class="input-group-btn">
                    <a href="#" class="btn btn-success open-modal-user" title="Adicionar instrutor"><i class="fas fa-plus fa-lg"></i></i></a>
                </div>
            </div>
            </div>
        </div>
        <!-- /.box-header -->
        <div class="box-body table-responsive">
            <table class="table table-hover table-condensed datatable-table" id="instructors-table">
                <thead>
                    <tr>
                        <th></th>
                        <th>Nome</th>
                        <th class="hidden-xs">Email</th>
                        <th class="hidden-xs">Status</th>
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
                <h4 class="modal-title"><i class="fas fa-user-graduate"></i>&nbsp;&nbsp;<font id="title-modal">Cadastrar</font> instrutor</h4>
            </div>
            <div class="modal-body">
                <form id="formInstructor">

                    <input type="hidden" id="param" value="new">
                    <input type="hidden" id="id_user" value="">

                    <div class="row">
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-user"></i></span>
                                <input type="text" class="form-control" placeholder="Nome" name="name" id="name" required>
                            </div>

                        </div>
                        <div class="col-sm-5">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-at"></i></span>
                                <input type="email" class="form-control" placeholder="Email" name="email" required id="email">
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control phone-mask" placeholder="Telefone" name="phone" required id="phone">
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-address-card"></i></span>
                                <input type="text" class="form-control cpf-mask" placeholder="Cpf" name="cpf" id="cpf" required>
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
                                <input type="text" class="form-control" placeholder="Responsável" name="responsible" id="responsible">
                            </div>

                        </div>
                        <div class="col-sm-3">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-phone"></i></span>
                                <input type="text" class="form-control phone-mask" placeholder="Tel. responsável" name="phoneResponsible" id="phoneResponsible">
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control cep-mask" placeholder="Cep" name="zipCode" id="zipCode">
                            </div>

                        </div>
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Cidade" name="city" id="city">
                            </div>

                        </div>
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Bairro" name="neighborhood" id="neighborhood">
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-6">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Endereço" name="address" id="address">
                            </div>

                        </div>
                        <div class="col-sm-2">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Número" name="number" id="number">
                            </div>

                        </div>
                        <div class="col-sm-4">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-map-marker-alt"></i></span>
                                <input type="text" class="form-control" placeholder="Complemento" name="complement" id="complement">
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="input-group">
                                <span class="input-group-addon"><i class="fas fa-align-justify"></i></span>
                                <textarea class="form-control" placeholder="Observações" name="observation" id="observation"></textarea>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" id="idAcademy" name="idAcademy" value="{{auth()->user()->academy->id}}">
                </form>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-warning pull-left open-modal-pass"><i class="fas fa-lock"></i>&nbsp;&nbsp;Alterar senha</a>

                <button form="formInstructor" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="modal-pass">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fas fa-lock"></i>&nbsp;&nbsp;Editar senha</h4>
            </div>
            <div class="modal-body">
                <form id="formPass">

                    <input type="hidden" id="param" value="new">
                    <input type="hidden" id="id_user" value="">

                    <div class="row">
                        <div class="col-sm-12">

                            <div class="input-group" style="width:100%">
                                <label>Nova senha</label>
                                <input minlength="8" type="password" class="form-control" name="pass" id="pass" required>
                            </div>

                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-sm-12">

                            <div class="input-group" style="width:100%">
                                <label>Confirme a nova senha</label>
                                <input minlength="8" type="password" class="form-control" name="passConfirm" id="passConfirm" required>
                            </div>

                        </div>
                    </div>

                    <input type="hidden" id="idAcademy" name="idAcademy" value="{{auth()->user()->academy->id}}">
                </form>
            </div>
            <div class="modal-footer">

                <button form="formPass" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
            </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>

    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

          <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close fechar-modal" data-dismiss="modal">&times;</button>
                  Selecione a imagem
                </div>
                <div class="modal-body">
                        <form id="formAvatar" method="POST" action="{{ route('admin.user.update.avatar') }}" enctype="multipart/form-data">
                            @csrf
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for='avatar'>Imagem</label>
                                    @laracrop(name=avatar | aspectratio=1/1 | minsize=[100, 100] | maxsize=[400, 400] | bgcolor=black | bgopacity=0.7 | value=old('avatar'))
                                </div>
                            </div>
                            <input type="hidden" id="id_user_avatar" name="id_user_avatar" value="">
                            <input type="hidden" id="idAcademy_avatar" name="idAcademy_avatar" value="{{auth()->user()->academy->id}}">
                        </form>
                        <div class="col-md-12">
                            <button form="formAvatar" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@stop

@section('adminlte_js')
    <script src="{{asset('/js/Admin/instructor/homeInstructor.js')}}"></script>
@stop
