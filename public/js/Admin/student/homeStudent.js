$(document).ready(function(){

    $(".open-modal-pass").on("click", function(){

        $("#modal-pass").modal("show");

    });

    $(".open-modal-user").on("click", function(){

        $(".open-modal-pass").hide();
        $("#param").val("new");
        $("#title-modal").html("Cadastrar");
        $("#modal-user").modal("show");

    });

    $("#formStudent").submit(function(e) {
        e.preventDefault();

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/student", {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    idAcademy: $("#idAcademy").val(),
                    phone: $("#phone").val(),
                    cpf: $("#cpf").val(),
                    birth: $("#birth").val(),
                    responsible: $("#responsible").val(),
                    phoneResponsible: $("#phoneResponsible").val(),
                    zipCode: $("#zipCode").val(),
                    city: $("#city").val(),
                    neighborhood: $("#neighborhood").val(),
                    address: $("#address").val(),
                    number: $("#number").val(),
                    complement: $("#complement").val(),
                    observation: $("#observation").val(),
                    param: $("#param").val(),
                    id_user: $("#id_user").val(),
                }).then(function(data) {

                    let msg = '';
                    let param = $("#param").val();

                    if(param == 'new'){
                        msg = 'Aluno cadastrado com sucesso';
                    }else{
                        msg = 'Aluno editado com sucesso';
                    }

                    if(data.status == 'success') {
                        list($("#idAcademy").val());
                        Swal.fire({
                            type: 'success',
                            text: msg,
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                if(param == 'new'){
                                    $("#formStudent").trigger("reset");
                                    setTimeout(function(){ $("#name").focus(); }, 300);
                                }else{
                                    $("#modal-user").modal("hide");
                                }
                            }
                        });
                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });

    $("#formPass").submit(function(e) {
        e.preventDefault();

        if($("#pass").val() != $("#passConfirm").val()){
            showError("Senhas divergentes!");
            return false;
        }

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/student/edit/pass", {
                    pass: $("#pass").val(),
                    idAcademy: $("#idAcademy").val(),
                    id_user: $("#id_user").val(),
                }).then(function(data) {
                    if(data.status == 'success') {
                        list($("#idAcademy").val());
                        Swal.fire({
                            type: 'success',
                            text: 'Senha editada com sucesso!',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {

                                $("#formPass").trigger("reset");
                                $("#modal-pass").modal("hide");

                            }
                        });
                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });

    // $("#formAvatar").submit(function(e) {
    //     e.preventDefault();

    //     if($("input[name='avatar']").val() == ''){
    //         showError("Selecione uma imagem!");
    //         return false;
    //     }

    //     Swal.queue([{
    //         title: 'Carregando...',
    //         allowOutsideClick: false,
    //         allowEscapeKey: false,
    //         onOpen: () => {
    //             Swal.showLoading();


    //             // $.post(window.location.origin + "/api/admin/student/edit/avatar", {
    //             //     avatar: $("input[name='avatar']").val(),
    //             //     id_user_avatar: $("#id_user_avatar").val(),
    //             //     idAcademy: $("#idAcademy").val(),
    //             // }).then(function(data) {
    //             //     if(data.status == 'success') {
    //             //         list($("#idAcademy").val());
    //             //         Swal.fire({
    //             //             type: 'success',
    //             //             text: 'Senha editada com sucesso!',
    //             //             showConfirmButton: false,
    //             //             showCancelButton: true,
    //             //             cancelButtonText: "OK",
    //             //             onClose: () => {

    //             //                 $("#formAvatar").trigger("reset");
    //             //                 $("#myModal").modal("hide");

    //             //             }
    //             //         });
    //             //     } else if (data.status == 'error') {
    //             //         showError(data.message);
    //             //     }
    //             // }, goTo500).catch(goTo500);

    //             var fd = new FormData();

    //             // fd.append('avatar', $("input[name='avatar']").val());
    //             fd.append('avatar', dataURItoBlob(data));
    //             fd.append('id_user_avatar', $("#id_user_avatar").val());
    //             fd.append('idAcademy', $("#idAcademy").val());

    //             $.ajax({
    //                 type: 'POST',
    //                 url: window.location.origin + "/api/admin/student/edit/avatar",
    //                 data: fd,
    //                 processData: false,
    //                 contentType: false
    //             }).done(function(data) {
    //                 if(data.status == 1) {
    //                     swal({
    //                         type: 'success',
    //                         title: "",
    //                         text: 'Foto atualizada com sucesso!',
    //                         showConfirmButton: false,
    //                         showCancelButton: true,
    //                         cancelButtonText: "OK"
    //                     });
    //                 } else if (data.status == 0) {
    //                     showError(data.message);
    //                 }
    //             });


    //         }
    //     }]);
    // });

    // function dataURItoBlob(dataURI) {
    //     var binary = atob(dataURI.split(',')[1]);
    //     var array = [];
    //     for (var i = 0; i < binary.length; i++) {
    //         array.push(binary.charCodeAt(i));
    //     }
    //     return new Blob([new Uint8Array(array)], {type: 'image/jpeg'});
    // }

    list($("#idAcademy").val());

});

function openModalPhoto(id){
    $("#id_user_avatar").val(id);
    $("#myModal").modal('show');
}

function list(id)
{
    $.post(window.location.origin + "/api/admin/student/list/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td><img src="${data.data[i].avatar==''||data.data[i].avatar==null?`/storage/users/default.jpg`:'/storage/users/'+data.data[i].avatar}" class='img img-circle' width='40'></td>
                            <td>${data.data[i].name}</td>
                            <td class="hidden-xs">${data.data[i].email}</td>
                            <td id="status${data.data[i].id}" class="hidden-xs">${data.data[i].isActive==1?'<span class="label label-success">Ativo</span>':'<span class="label label-danger">Inativo</span>'}</td>
                            <td class="hidden-xs">${data.data[i].aulas}</td>
                            <td style="width:130px">
                                <div class="input-group-btn">

                                    <a class="btn btn-primary btn-sm pull-right" href="/admin/student/show/${data.data[i].id}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>

                                    <a onclick="fillUser(${data.data[i].id})" class="btn btn-warning btn-sm pull-right" href="#" title="Editar aluno"><i class="fas fa-pen"></i></a>

                                    <a onclick="openModalPhoto(${data.data[i].id})" class="btn btn-info btn-sm pull-right" href="#" title="Editar foto"><i class="fas fa-user"></i></a>

                                    ${data.data[i].isActive==1?`

                                        <a id="power${data.data[i].id}" class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id})" data-id="${data.data[i].id}" title="Inativar aluno"><i class="fas fa-power-off"></i></a>
                                    `:`
                                        <a id="power${data.data[i].id}" class="btn btn-success btn-sm pull-right destroy" onclick="activate(${data.data[i].id})" data-id="${data.data[i].id}" title="Ativar aluno"><i class="fas fa-power-off"></i></a>

                                    `}

                                </div>
                            </td>
                        </tr>`;
            }

            $('#lista').html(html);

        } else if (data.status == 'error') {
            // showError(data.message);
        }
    }, goTo500).catch(goTo500);
}


function fillUser(id){

    $.post(window.location.origin + "/api/admin/student/find/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            $("#name").val(data.data.name);
            $("#email").val(data.data.email);
            $("#phone").val(data.data.phone);
            $("#cpf").val(data.data.cpf);
            $("#birth").val(data.data.birth);
            $("#responsible").val(data.data.responsible);
            $("#phoneResponsible").val(data.data.phoneResponsible);
            $("#zipCode").val(data.data.zipCode);
            $("#city").val(data.data.city);
            $("#neighborhood").val(data.data.neighborhood);
            $("#address").val(data.data.address);
            $("#number").val(data.data.number);
            $("#complement").val(data.data.complement);
            $("#observation").val(data.data.observation);

            $("#param").val("edit");
            $(".open-modal-pass").show();
            $("#title-modal").html("Editar");
            $("#id_user").val(data.data.id);

            $("#modal-user").modal("show");

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);


}

function destroy(id)
{

    Swal.queue([{
        title: 'Carregando...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        onOpen: () => {
            Swal.showLoading();
            $.post(window.location.origin + "/api/admin/student/destroy/"+id, {

            }).then(function(data) {
                if(data.status == 'success') {

                    $("#status"+id).html('<span class="label label-danger">Inativo</span>');

                    $("#power"+id).removeClass('btn-danger');
                    $("#power"+id).addClass('btn-success');

                    $("#power"+id).attr('onclick', 'activate('+id+')');
                    $("#power"+id).attr('title', 'Ativar aluno');

                    // list($("#idAcademy").val());
                    Swal.fire({
                        type: 'success',
                        text: 'Aluno inativado com sucesso',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: "OK",
                        onClose: () => {

                        }
                    });
                } else if (data.status == 'error') {
                    showError(data.message);
                }
            }, goTo500).catch(goTo500);
        }
    }]);
};

function activate(id)
{

    Swal.queue([{
        title: 'Carregando...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        onOpen: () => {
            Swal.showLoading();
            $.post(window.location.origin + "/api/admin/student/activate/"+id, {

            }).then(function(data) {
                if(data.status == 'success') {

                    $("#status"+id).html('<span class="label label-success">Ativo</span>');

                    $("#power"+id).removeClass('btn-success');
                    $("#power"+id).addClass('btn-danger');

                    $("#power"+id).attr('onclick', 'destroy('+id+')');
                    $("#power"+id).attr('title', 'Inativar aluno');

                    // list($("#idAcademy").val());
                    Swal.fire({
                        type: 'success',
                        text: 'Aluno ativado com sucesso',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: "OK",
                        onClose: () => {

                        }
                    });
                } else if (data.status == 'error') {
                    showError(data.message);
                }
            }, goTo500).catch(goTo500);
        }
    }]);
};

