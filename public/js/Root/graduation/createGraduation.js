$(document).ready(function(){

    $("#formAddGraduation").submit(function(e) {
        e.preventDefault();
       
        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/root/graduation", {
                    name: $("#name").val(),
                    hours: $("#hours").val(),
                    idSport: $("#idSport").val()
                }).then(function(data) {
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Graduação cadastrada com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddGraduation").trigger("reset");
                                setTimeout(function(){ $("#name").focus(); }, 300);
                            }
                        });
                    } else if (data.status == 'error') {
                        // showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });   
    
    list();
});


function list()
{

    $.post(window.location.origin + "/api/root/sport/list", {
        
    }).then(function(data) {
        if(data.status == 'success') {
    
            var html = '<option value="">-- Selecione --</option>';

            for (var i in data.data) {

                html += `<option value="${data.data[i].id}">${data.data[i].name}</option>`;
            }

            $('#idSport').html(html);

        } else if (data.status == 'error') {
            // showError(data.message);
        }
    }, goTo500).catch(goTo500);
}