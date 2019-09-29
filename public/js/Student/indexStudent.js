$(document).ready(function(){

    $("#formAddPresence").submit(function(e) {
        e.preventDefault();
      
        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/student/presence", {
                    idRegistration: $("#idRegistration").val(),
                    idUserGraduation: $("#idUserGraduation").val(),
                }).then(function(data) {
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Presença cadastrada com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddPresence").trigger("reset");
                            }
                        });
                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });
    

list($("#idStudent").val());

checkLesson($("#idStudent").val());
setInterval(function(){ checkLesson($("#idStudent").val()); }, 5000);

});

function list(id)
{
    $.post(window.location.origin + "/api/student/lesson/next/"+id, {
        
    }).then(function(data) {
        if(data.status == 'success') {

            let html = '';

            if(data.data == null){

                html += `<div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Alerta!</strong> Você ainda não está matriculado em nenhuma aula.
                        </div>`;    

            }else{
   
                html += `<div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        <strong>Alerta!</strong> Sua próxima aula será ${dia_semana[data.data.weekDay]} às ${data.data.hour}.
                        </div>`;        
            }
                

            $('#lista').html(html);

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

function checkLesson(id)
{
    $.post(window.location.origin + "/api/student/lesson/check/"+id, {
        
    }).then(function(data) {
        if(data.status == 'success') {

            if(data.data != null){

                $("#sport-modal").html(data.data.sport_name);
                $("#teacher-modal").html(data.data.teacher);
                $("#weekDay-modal").html(dia_semana[data.data.weekDay]);
                $("#hour-modal").html(data.data.hour);

                $("#idRegistration").val(data.data.registration_id);
                $("#idUserGraduation").val(data.data.user_graduation_id);

                $("#modal-check").modal('show');
                setTimeout(function(){ $("#token").focus(); }, 300);
            }    
            

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}