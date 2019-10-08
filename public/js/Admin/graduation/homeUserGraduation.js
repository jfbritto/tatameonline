$(document).ready(function(){

    $("#formAddUserGraduation").submit(function(e) {

        e.preventDefault();

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/user-graduation", {
                    idGraduation: $("#idGraduation").val(),
                    idUser: $("#idUser").val(),
                    startDate: $("#startDate").val(),
                }).then(function(data) {
                    list($("#idUser").val());
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Graduação cadastrada com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddUserGraduation").trigger("reset");
                            }
                        });
                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });

    $("#formAddUserNewGraduation").submit(function(e) {

        e.preventDefault();

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/user-graduation/graduate", {
                    idGraduation: $("#idNewGraduation").val(),
                    idOldUserGraduation: $("#idOldUserGraduation").val(),
                    idUser: $("#idUser").val(),
                    startDate: $("#startDate").val(),
                }).then(function(data) {
                    list($("#idUser").val());
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Aluno graduado com sucesso!',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddUserNewGraduation").trigger("reset");
                            }
                        });
                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });


    list($("#idUser").val());

    listSports()

    $("#sports").on("change", function(){

        listGraduationsBySport($(this).val(), $("#idAcademy").val());

    });

    setTimeout(function(){ listGraduationsBySport($("#sports option:selected").val(), $("#idAcademy").val()); }, 1000);


});


function list(id)
{
    $.post(window.location.origin + "/api/admin/user-graduation/list/"+id, {

    }).then(function(data) {


        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr class="${data.data[i].isActive==0?'danger':''} ${data.data[i].completed_hours>=data.data[i].required_hours&&data.data[i].isActive==1?'success':''}">
                            <td>${data.data[i].name_sport}</td>
                            <td>${data.data[i].name_graduation}</td>
                            <td class="hidden-xs">${dateFormat(data.data[i].startDate)}</td>
                            <td class="hidden-xs">${dateFormat(data.data[i].endDate)}</td>
                            <td>${data.data[i].isActive==1?'Graduando':'Graduado'}</td>
                            <td>${data.data[i].required_hours}</td>
                            <td>${data.data[i].completed_hours==null?'0':data.data[i].completed_hours}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a onclick="openPresences(${data.data[i].idUser},${data.data[i].id})" class="btn btn-primary btn-sm pull-right" href="#" title="Ver presenças" data-toggle="modal" data-target="#modal-presences"><i class="fas fa-user-check"></i></a>

                                    ${data.data[i].completed_hours>=data.data[i].required_hours&&data.data[i].isActive==1?`
                                        <a onclick="alunGraduation(${data.data[i].id})" class="btn btn-success btn-sm pull-right btn-graduate" href="#" title="Graduar">Graduar</a>
                                    `:''}

                                </div>
                            </td>
                        </tr>`;
            }

            $('#lista').html(html);

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}


function alunGraduation(idUserGraduation)
{
    $.post(window.location.origin + "/api/admin/user-graduation/find/"+idUserGraduation, {

    }).then(function(data) {
        if(data.status == 'success') {

            $("#desc_graduacao").html(data.data.graduation.name_graduation);
            $("#desc_sport").html(data.data.graduation.name_sport);
            $("#idOldUserGraduation").val(data.data.graduation.id);

            var html = '';

            for (var i in data.data.list) {

                html += `<option value="${data.data.list[i].id}">${data.data.list[i].name}</option>`;
            }

            if(data.data == ''){
                html += `<option value="">Nenhuma graduação disponível</option>`;
            }

            $('#idNewGraduation').html(html);

            $("#modal-graduate").modal('show');

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

function listSports()
{
    $.post(window.location.origin + "/api/root/sport/list", {

    }).then(function(data) {


        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<option value="${data.data[i].id}">${data.data[i].name}</option>`;
            }

            $('#sports').html(html);

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

function listGraduationsBySport(idSport, idAcademy)
{

    $.post(window.location.origin + "/api/admin/user-graduation/list/sport/"+idSport+"/"+idAcademy, {

    }).then(function(data) {


        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<option value="${data.data[i].id}">${data.data[i].name}</option>`;
            }

            if(data.data == ''){
                html += `<option value="">Nenhuma graduação disponível</option>`;
            }

            $('#idGraduation').html(html);

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

function openPresences(idUser, idUserGraduation)
{
    $.post(window.location.origin + "/api/admin/presence/list/"+idUser+"/"+idUserGraduation, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr">
                            <td>${dia_semana[data.data[i].weekDay]}</td>
                            <td>${data.data[i].hour}</td>
                            <td>${dateFullFormat(data.data[i].checkedHour)}</td>
                        </tr>`;
            }

            $('#listPresences').html(html);

        } else if (data.status == 'error') {
            showError(data.message);
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
            $.post(window.location.origin + "/api/admin/user-graduation/destroy/"+id, {

            }).then(function(data) {
                if(data.status == 'success') {

                    Swal.fire({
                        type: 'success',
                        text: 'Graduação deletada com sucesso',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: "OK",
                        onClose: () => {
                            list(id);
                        }
                    });
                } else if (data.status == 'error') {
                    showError(data.message);
                }
            }, goTo500).catch(goTo500);
        }
    }]);
};
