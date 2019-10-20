$(document).ready(function(){

    $("#formAddPresence").submit(function(e) {
        e.preventDefault();

        let token = $("#token").val();
        let id    = $("#idStudent").val();

        $.post(window.location.origin + "/api/student/academy/token/check/"+id+"/"+token, {

        }).then(function(data) {
            if(data.status == 'success') {

                if(data.data == true){


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
                                    $("#modal-check").modal('hide');
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

                }else{
                    showError("Token inválido");
                    $("#formAddPresence").trigger("reset");
                    setTimeout(function(){ $("#token").focus(); }, 500);
                }

            } else if (data.status == 'error') {
                showError(data.message);
            }
        }, goTo500).catch(goTo500);

    });


mainFunction($("#idStudent").val());

setInterval(function(){

    mainFunction($("#idStudent").val());

}, 15000);

});

function mainFunction(idUser)
{
    $.post(window.location.origin + "/api/student/index/"+idUser, {

    }).then(function(data) {

        //PROCURANDO PRÓXIMA AULA
        if(data.data.nextLesson.status == 'success') {

            let html = '';

            if(data.data.nextLesson.data == null){

                html += `<div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            Você ainda não está matriculado em nenhuma aula.
                        </div>`;

            }else{

                html += `<div class="alert alert-info alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            Sua próxima aula será ${dia_semana[data.data.nextLesson.data.weekDay]} às ${data.data.nextLesson.data.hour}.
                        </div>`;
            }


            $('#lista').html(html);

        }

        //CASA ENCONTRE AULA ABRE O MODAL
        if(data.data.checkLesson.status == 'success') {

            if(data.data.checkLesson.data[0] != null){

                $("#sport-modal").html(data.data.checkLesson.data[0].sport_name);
                $("#teacher-modal").html(data.data.checkLesson.data[0].teacher);
                $("#weekDay-modal").html(dia_semana[data.data.checkLesson.data[0].weekDay]);
                $("#hour-modal").html(data.data.checkLesson.data[0].hour);

                $("#idRegistration").val(data.data.checkLesson.data[0].registration_id);
                $("#idUserGraduation").val(data.data.checkLesson.data[0].user_graduation_id);

                $("#modal-check").modal('show');
                setTimeout(function(){ $("#token").focus(); }, 500);
            }else{
                $("#modal-check").modal('hide');
            }


        }

        //LISTANDO ULTIMAS PRESENÇAS
        if(data.data.openLastPresencesByStudent.status == 'success') {

            var html = '';

            for (var i in data.data.openLastPresencesByStudent.data) {

                html += `<tr">
                            <td>${dia_semana[data.data.openLastPresencesByStudent.data[i].weekDay]}</td>
                            <td>${data.data.openLastPresencesByStudent.data[i].hour}</td>
                            <td>${dateFullFormat(data.data.openLastPresencesByStudent.data[i].checkedHour)}</td>
                            <td>${data.data.openLastPresencesByStudent.data[i].name_sport}</td>
                        </tr>`;
            }

            $('#listPresences').html(html);

        }

        //PROCURANDO FATURA ABERTA
        if(data.data.invoiceDue.status == 'success') {

            let html = '';

            if(data.data.invoiceDue.data[0] == null){

                html += '';

            }else{

                html += `<div class="alert alert-warning alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            Sua fatura está perto de vencer! pague até dia ${dateFormat(data.data.invoiceDue.data[0].dueDate)}
                        </div>`;
            }


            $('#lista2').html(html);

        }

    }, goTo500).catch(goTo500);
}
