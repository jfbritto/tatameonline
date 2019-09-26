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
                }).then(function(data) {
                    if(data.status == 'success') {
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
});