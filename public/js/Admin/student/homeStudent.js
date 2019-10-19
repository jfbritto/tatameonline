$(document).ready(function(){

    $("#formAddStudent").submit(function(e) {
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
                }).then(function(data) {
                    if(data.status == 'success') {
                        list($("#idAcademy").val());
                        Swal.fire({
                            type: 'success',
                            text: 'Aluno cadastrado com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddStudent").trigger("reset");
                                setTimeout(function(){ $("#name").focus(); }, 300);
                            }
                        });
                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });


    list($("#idAcademy").val());

});

function list(id)
{
    $.post(window.location.origin + "/api/admin/student/list/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td>${data.data[i].name}</td>
                            <td class="hidden-xs">${data.data[i].email}</td>
                            <td id="status${data.data[i].id}" class="hidden-xs">${data.data[i].isActive==1?'<span class="label label-success">Ativo</span>':'<span class="label label-danger">Inativo</span>'}</td>
                            <td class="hidden-xs">${data.data[i].aulas}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a class="btn btn-primary btn-sm pull-right" href="/admin/student/show/${data.data[i].id}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>

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

