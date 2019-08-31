$(document).ready(function(){

    function goTo500()
    {
        window.location = '/500';
    }

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
                                    <a class="btn btn-danger btn-sm pull-right destroy" data-id="${data.data[i].name}" title="Deletar esporte"><i class="fas fa-trash-alt"></i></a>
                                </td>
                            </tr>`;
                }

                $('#lista').html(html);

            } else if (data.status == 'error') {
                // showError(data.message);
            }
        }, goTo500).catch(goTo500);
    }

    list();

    $(".destroy").on('click', function() {
        
        let id = $(this).attr('data-id');

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/root/sport/destroy", {
                    id: id
                }).then(function(data) {
                    if(data.status == 'success') {

                        $(this).remove();

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
    });
    
});