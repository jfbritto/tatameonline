$(document).ready(function(){

    list($("#idAcademy").val());

});


function list(id)
{
    $.post(window.location.origin + "/api/admin/student/list/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            {/* <a onclick="openModalPhoto(${data.data[i].id})" class="btn btn-info btn-sm pull-right" href="#" title="Editar foto"><i class="fas fa-user"></i></a> */}

            for (var i in data.data) {

                html += `<tr>
                            <td><img src="${data.data[i].avatar==''||data.data[i].avatar==null?`/storage/users/default.jpg`:'/storage/users/'+data.data[i].avatar}" class='img img-circle' width='40'></td>
                            <td>${data.data[i].name}</td>
                            <td class="hidden-xs">${data.data[i].email}</td>
                            <td id="status${data.data[i].id}" class="hidden-xs">${data.data[i].isActive==1?'<span class="label label-success">Ativo</span>':'<span class="label label-danger">Inativo</span>'}</td>
                            <td class="hidden-xs">${data.data[i].aulas}</td>
                            <td style="width:130px">
                                <div class="input-group-btn">

                                    <a class="btn btn-primary btn-sm pull-right" href="/instructor/student/show/${data.data[i].id}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>

                                </div>
                            </td>
                        </tr>`;
            }

            $('#lista').html(html);

            buildDataTable();

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

