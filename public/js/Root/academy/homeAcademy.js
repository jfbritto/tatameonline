$(document).ready(function(){

    $("#formAddAcademy").submit(function(e) {
        e.preventDefault();
      
        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/root/academy", {
                    name: $("#name").val(),
                    phone: $("#phone").val(),
                    responsable: $("#responsable").val(),
                    phoneResponsable: $("#phoneResponsable").val(),
                }).then(function(data) {
                    if(data.status == 'success') {
                        list();
                        Swal.fire({
                            type: 'success',
                            text: 'Academia cadastrada com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddAcademy").trigger("reset");
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

    list();
});

function list()
{

    $.post(window.location.origin + "/api/root/academy/list", {
        
    }).then(function(data) {
        if(data.status == 'success') {
    
            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td>${data.data[i].name}</td>
                            <td class="hidden-xs">${data.data[i].phone}</td>
                            <td class="hidden-xs">${data.data[i].responsable}</td>
                            <td class="hidden-xs">${data.data[i].phoneResponsable}</td>
                            <td class="hidden-xs">${data.data[i].token}</td>
                            <td class="hidden-xs">${data.data[i].isActive==1?'Ativo':'Inativo' }</td>
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


function destroy(id)
{
    
    Swal.queue([{
        title: 'Carregando...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        onOpen: () => {
            Swal.showLoading();
            $.post(window.location.origin + "/api/root/academy/destroy/"+id, {
            
            }).then(function(data) {
                if(data.status == 'success') {
                    list();
                    Swal.fire({
                        type: 'success',
                        text: 'Academia deletada com sucesso',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: "OK",
                        onClose: () => {
                            
                        }
                    });
                } else if (data.status == 'error') {
                    // showError(data.message);
                }
            }, goTo500).catch(goTo500);
        }
    }]);
};

