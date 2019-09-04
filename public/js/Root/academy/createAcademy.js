$(document).ready(function(){

    function goTo500()
    {
        // window.location = '/500';
    }

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
                        Swal.fire({
                            type: 'success',
                            text: 'Academia cadastrada com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddAcademy").trigger("reset");
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