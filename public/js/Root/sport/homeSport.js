$(document).ready(function(){

    list();
});

function list()
{

    $.post(window.location.origin + "/api/root/sport/list", {
        
    }).then(function(data) {
        if(data.status == 'success') {
    
            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td>${data.data[i].name}</td>
                            <td>
                                <a class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id})" data-id="${data.data[i].id}" title="Deletar esporte"><i class="fas fa-trash-alt"></i></a>
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
            $.post(window.location.origin + "/api/root/sport/destroy/"+id, {
            
            }).then(function(data) {
                if(data.status == 'success') {
                    list();
                    Swal.fire({
                        type: 'success',
                        text: 'Esporte deletado com sucesso',
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

