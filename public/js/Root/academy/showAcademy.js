$(document).ready(function(){

    $("#btn-click").on('click', function(){
        setTimeout(function(){ $("#name").focus(); }, 300);
    });

    $("#formAddUser").submit(function(e) {

        e.preventDefault();

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/root/academy/users", {
                    name: $("#name").val(),
                    email: $("#email").val(),
                    idAcademy: $("#idAcademy").val(),
                    phone: $("#phone").val(),
                    cpf: $("#cpf").val(),
                    birth: $("#birth").val(),
                    zipCode: $("#zipCode").val(),
                    city: $("#city").val(),
                    neighborhood: $("#neighborhood").val(),
                    address: $("#address").val(),
                    number: $("#number").val(),
                    complement: $("#complement").val(),
                }).then(function(data) {
                    callList();
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Usuário cadastrado com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddUser").trigger("reset");
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

    function callList(){
        list($("#idAcademy").val());
    }

    callList();

});


function list(id)
{
    $.post(window.location.origin + "/api/root/academy/users/list/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td>${data.data[i].name}</td>
                            <td class="hidden-xs">${data.data[i].email}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id})" data-id="${data.data[i].id}" title="Deletar usuário"><i class="fas fa-trash-alt"></i></a>
                                </div>
                            </td>
                        </tr>`;
            }

            $('#lista').html(html);

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
            $.post(window.location.origin + "/api/root/academy/users/destroy/"+id, {

            }).then(function(data) {
                if(data.status == 'success') {

                    Swal.fire({
                        type: 'success',
                        text: 'Usuário deletado com sucesso',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: "OK",
                        onClose: () => {
                            list(id);
                        }
                    });
                } else if (data.status == 'error') {
                    showError(data.message);
                }
            }, goTo500).catch(goTo500);
        }
    }]);
};
