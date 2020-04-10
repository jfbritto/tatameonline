$(document).ready(function(){

    list($("#idUser").val());

});


function list(id)
{
    $.post(window.location.origin + "/api/admin/user-graduation/list/"+id, {

    }).then(function(data) {

        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                let comp_hours = parseInt(0);
                let stt_hours = parseInt(0);
                let total_hours = parseInt(0);

                if(data.data[i].completed_hours!=null)
                    comp_hours = parseInt(data.data[i].completed_hours);

                if(data.data[i].start_hours!=null)
                    stt_hours = parseInt(data.data[i].start_hours);

                total_hours = comp_hours+stt_hours;

                html += `<tr class="${data.data[i].isActive==0?'danger':''} ${total_hours>=data.data[i].required_hours&&data.data[i].isActive==1?'success':''}">
                            <td>${data.data[i].name_sport}</td>
                            <td>${data.data[i].name_graduation}&nbsp;&nbsp;<i style="color:${data.data[i].color}" class="fas fa-ribbon"></i></td>
                            <td class="hidden-xs">${dateFormat(data.data[i].startDate)}</td>
                            <td class="hidden-xs">${dateFormat(data.data[i].endDate)}</td>
                            <td>${data.data[i].isActive==1?'Graduando':'Graduado'}</td>
                            <td>${data.data[i].required_hours}</td>
                            <td>${total_hours}</td>
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

function openPresences(idUser, idUserGraduation)
{
    $.post(window.location.origin + "/api/admin/presence/list/"+idUser+"/"+idUserGraduation, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr">
                            <td>${dia_semana[data.data[i].weekDay]}</td>
                            <td>${data.data[i].instructor_name}</td>
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
