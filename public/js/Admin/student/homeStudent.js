$(document).ready(function(){
    
    function callList(){
        list($("#idAcademy").val());
    }

    callList();

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
                            <td class="hidden-xs">${data.data[i].aulas}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a class="btn btn-primary btn-sm pull-right" href="/admin/student/show/${data.data[i].id}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>
                                    <a class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id})" data-id="${data.data[i].id}" title="Deletar aluno"><i class="fas fa-trash-alt"></i></a>
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
                    list($("#idAcademy").val());
                    Swal.fire({
                        type: 'success',
                        text: 'Aluno deletado com sucesso',
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

