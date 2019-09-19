$(document).ready(function(){

    function goTo500()
    {
        // window.location = '/500';
    }

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
                }).then(function(data) {
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Usuário cadastrado com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddUser").trigger("reset");
                                list(idAcademy);
                            }
                        });
                    } else if (data.status == 'error') {
                        // showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });   
    
    list($("#idAcademy").val());
});

function goTo500()
{
    // window.location = '/500';
}

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
                                    <a class="btn btn-primary btn-sm pull-right" href="/root/academy/show/${data.data[i].id}" title="Abrir academia"><i class="fas fa-sign-in-alt"></i></a>
                                    <a class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id})" data-id="${data.data[i].id}" title="Deletar academia"><i class="fas fa-trash-alt"></i></a>
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