$(document).ready(function(){

    $("#formAddAlun").submit(function(e) {
        
        e.preventDefault();

        if($("#idUser option:selected").val() == undefined)
            return showError("Nenhum aluno selecionado!");
      
        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/registration", {
                    idUser: $("#idUser option:selected").val(),
                    idLesson: $("#idLesson").val(),
                }).then(function(data) {
                    callList();
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Aluno matriculado com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddAlun").trigger("reset");
                            }
                        });
                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);
            }
        }]);
    });
    
    function callList(){
        list($("#idLesson").val());
        listAluns($("#idLesson").val(), $("#idAcademy").val());
    }

    callList();

});

function list(id)
{
    $.post(window.location.origin + "/api/admin/registration/list/"+id, {
        
    }).then(function(data) {
        if(data.status == 'success') {
    
            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td>${data.data[i].name_alun}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a class="btn btn-primary btn-sm pull-right" href="/admin/student/show/${data.data[i].idUser}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>
                                    <a class="btn btn-danger btn-sm pull-right destroy" onclick="destroy(${data.data[i].id})" data-id="${data.data[i].id}" title="Deletar matricula"><i class="fas fa-trash-alt"></i></a>
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

function listAluns(idLesson, idAcademy)
{
    $.post(window.location.origin + "/api/admin/lesson/not/aluns/list/"+idLesson+"/"+idAcademy, {
        
    }).then(function(data) {
        if(data.status == 'success') {
    
            var html = '';

            for (var i in data.data) {

                html += `<option value='${data.data[i].id}'>${data.data[i].name}</option>`;
            }

            $('#idUser').html(html);
            $('#idUser').select2();


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
        text: "Deseja realmente deletar a matrícula?",
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
                    $.post(window.location.origin + "/api/admin/registration/destroy/"+id, {
                    
                    }).then(function(data) {
                        if(data.status == 'success') {
                            
                            list($("#idLesson").val());
                            listAluns($("#idLesson").val(), $("#idAcademy").val());
                            Swal.fire({
                                type: 'success',
                                text: 'Matricula deletada com sucesso',
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