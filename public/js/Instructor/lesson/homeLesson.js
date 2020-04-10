const DataTable = buildDataTable("#lessons-table");

$(document).ready(function(){

    list($("#idAcademy").val());

});

function list(id)
{
    $.post(window.location.origin + "/api/admin/lesson/list/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            // let html = '';

            DataTable.clear();
            for (var i in data.data) {

                DataTable.row.add([data.data[i].sport_name, data.data[i].instructor_name, dia_semana[data.data[i].weekDay], data.data[i].hour, data.data[i].alunos || '0', `<div class="input-group-btn"><a class="btn btn-primary btn-sm pull-right" href="/instructor/lesson/show/${data.data[i].id}" title="Abrir aula"><i class="fas fa-sign-in-alt"></i></a></div>`]).draw(false);
            }

            // $('#lista').html(html);

            // buildDataTable();

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}


