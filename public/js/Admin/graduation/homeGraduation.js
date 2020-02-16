$(document).ready(function(){

    $("#formAddGraduation").submit(function(e) {
        e.preventDefault();

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/graduation", {
                    name: $("#name").val(),
                    hours: $("#hours").val(),
                    color: $("#color").val(),
                    idSport: $("#idSport").val(),
                    idAcademy: $("#idAcademy").val(),
                    startDate: $("#startDate").val()
                }).then(function(data) {
                    if(data.status == 'success') {
                        list($("#idAcademy").val());
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

    list($("#idAcademy").val());
    listSports();
});

function list(id)
{

    $.post(window.location.origin + "/api/admin/graduation/list/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td><i style="color:${data.data[i].color}" class="fas fa-ribbon"></i>&nbsp;&nbsp;${data.data[i].name}</td>
                            <td>${data.data[i].sport_name}</td>
                            <td>${data.data[i].hours}</td>
                            <td>${data.data[i].graduations}</td>
                            <td>
                                <a class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id})" data-id="${data.data[i].id}" title="Deletar esporte"><i class="fas fa-trash-alt"></i></a>
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

function listSports()
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
        text: "Deseja realmente deletar a graduação?",
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
                    $.post(window.location.origin + "/api/admin/graduation/destroy/"+id, {
        
                    }).then(function(data) {
                        if(data.status == 'success') {
                            list($("#idAcademy").val());
                            Swal.fire({
                                type: 'success',
                                text: 'Graduação deletada com sucesso',
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

