$(document).ready(function(){

    list($("#idStudent").val());
    getContrato($("#idStudent").val());
    listGraduations($("#idStudent").val());

});

//LISTAR AULAS VINCULADAS
function list(id)
{
    $.post(window.location.origin + "/api/admin/lesson/student/list/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td>${data.data[i].sport_name}</td>
                            <td class="hidden-xs">${data.data[i].teacher}</td>
                            <td>${dia_semana[data.data[i].weekDay]}</td>
                            <td>${data.data[i].hour}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a class="btn btn-primary btn-sm pull-right" href="/admin/lesson/show/${data.data[i].id}" title="Abrir aula"><i class="fas fa-sign-in-alt"></i></a>
                                    <a class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id_registration})" data-id="${data.data[i].id_registration}" title="Deletar matricula"><i class="fas fa-trash-alt"></i></a>
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
