$(document).ready(function(){

    $("#formAddBug").submit(function(e) {
        e.preventDefault();

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/bug", {
                    type: $("#type").val(),
                    description: $("#description").val(),
                    idUser: $("#idUser").val()
                }).then(function(data) {
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Mensagem enviada com sucesso!',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddBug").trigger("reset");
                            }
                        });
                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });

});

