$(document).ready(function(){

    function goTo500()
    {
        // window.location = '/500';
    }

    $("#formAddLesson").submit(function(e) {
        e.preventDefault();
      
        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/lesson", {
                    teacher: $("#teacher").val(),
                    weekDay: $("#weekDay").val(),
                    hour: $("#hour").val(),
                    idSport: $("#idSport").val(),
                    idAcademy: $("#idAcademy").val(),
                }).then(function(data) {
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Aula cadastrada com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddLesson").trigger("reset");
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