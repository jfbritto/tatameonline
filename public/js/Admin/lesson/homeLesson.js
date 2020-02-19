const DataTable = buildDataTable("#lessons-table");

$(document).ready(function(){

    $("#formAddLesson").submit(function(e) {
        e.preventDefault();

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/lesson", {
                    teacher: $("#teacher").val(),
                    weekDay: $("#weekDay").val(),
                    hour: $("#hour").val(),
                    idSport: $("#idSport").val(),
                    idAcademy: $("#idAcademy").val(),
                }).then(function(data) {
                    if(data.status == 'success') {
                        list($("#idAcademy").val());
                        Swal.fire({
                            type: 'success',
                            text: 'Aula cadastrada com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddLesson").trigger("reset");
                                setTimeout(function(){ $("#teacher").focus(); }, 300);
                            }
                        });
                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });

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

                // html += `<tr>
                //             <td>${data.data[i].sport_name}</td>
                //             <td class="hidden-xs">${data.data[i].teacher}</td>
                //             <td>${dia_semana[data.data[i].weekDay]}</td>
                //             <td>${data.data[i].hour}</td>
                //             <td class="hidden-xs">${data.data[i].alunos}</td>
                //             <td>
                //                 <div class="input-group-btn">
                //                     <a class="btn btn-primary btn-sm pull-right" href="/admin/lesson/show/${data.data[i].id}" title="Abrir aula"><i class="fas fa-sign-in-alt"></i></a>
                //                     <a class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id})" data-id="${data.data[i].id}" title="Deletar aula"><i class="fas fa-trash-alt"></i></a>
                //                 </div>
                //             </td>
                //         </tr>`;

                DataTable.row.add([data.data[i].sport_name, data.data[i].teacher, dia_semana[data.data[i].weekDay], data.data[i].hour, data.data[i].alunos || '0', `<div class="input-group-btn"><a class="btn btn-primary btn-sm pull-right" href="/admin/lesson/show/${data.data[i].id}" title="Abrir aula"><i class="fas fa-sign-in-alt"></i></a><a class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id})" data-id="${data.data[i].id}" title="Deletar aula"><i class="fas fa-trash-alt"></i></a></div>`]).draw(false);
            }

            // $('#lista').html(html);

            // buildDataTable();

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}


function destroy(id)
{

    const swalWithBootstrapButtons = Swal.mixin({
        customClass: {
          confirmButton: 'btn btn-success',
          cancelButton: 'btn btn-danger'
        },
        buttonsStyling: false
      })
      
      swalWithBootstrapButtons.fire({
        title: 'Tem certeza?',
        text: "Deseja realmente deletar a aula?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        reverseButtons: true
      }).then((result) => {
        if (result.value) {

            Swal.queue([{
                title: 'Carregando...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                onOpen: () => {
                    Swal.showLoading();
                    $.post(window.location.origin + "/api/admin/lesson/destroy/"+id, {
        
                    }).then(function(data) {
                        if(data.status == 'success') {
                            list($("#idAcademy").val());
                            Swal.fire({
                                type: 'success',
                                text: 'Aula deletada com sucesso',
                                showConfirmButton: false,
                                showCancelButton: true,
                                cancelButtonText: "OK",
                                onClose: () => {
        
                                }
                            });
                        } else if (data.status == 'error') {
                            showError(data.message);
                        }
                    }, goTo500).catch(goTo500);
                }
            }]);

        }
      })

};

