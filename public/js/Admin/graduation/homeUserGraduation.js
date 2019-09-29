$(document).ready(function(){

    $("#formAddUserGraduation").submit(function(e) {
        
        e.preventDefault();
      
        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/graduation", {
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
    

    list($("#idUser").val());

    listSports()

    $("#sports").on("change", function(){

        listGraduationsBySport($(this).val());

    });

    setTimeout(function(){ listGraduationsBySport($("#sports option:selected").val()); }, 300);
    

});


function list(id)
{
    $.post(window.location.origin + "/api/admin/graduation/list/"+id, {
        
    }).then(function(data) {
        
        
        if(data.status == 'success') {
                
            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td>${data.data[i].name_sport}</td>
                            <td>${data.data[i].name_graduation}</td>
                            <td class="hidden-xs">${dateFormat(data.data[i].startDate)}</td>
                            <td class="hidden-xs">${dateFormat(data.data[i].endDate)}</td>
                            <td>${data.data[i].isActive==1?'Graduando':'Graduado'}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a onclick="openPresences(${data.data[i].idUser},${data.data[i].id})" class="btn btn-primary btn-sm pull-right" href="#" title="Ver presenças" data-toggle="modal" data-target="#modal-presences"><i class="fas fa-user-check"></i></a>
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

function listGraduationsBySport(id)
{
    
    $.post(window.location.origin + "/api/admin/graduation/list/sport/"+id, {
    
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
            $.post(window.location.origin + "/api/admin/graduation/destroy/"+id, {
            
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