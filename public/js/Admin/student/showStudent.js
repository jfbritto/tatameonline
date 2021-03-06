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
                            <td class="hidden-xs">${data.data[i].instructor_name}</td>
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

//LISTAR O CONTRATO ATIVO
function getContrato(id)
{
    $.post(window.location.origin + "/api/admin/contract/get/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            html += `<tr class="${data.data.fatNotPay==0?'success':''}">
                        <td>${dateFormat(data.data.signatureDate)}</td>
                        <td class="hidden-xs">${data.data.months}</td>
                        <td>${moneyFormat(data.data.monthlyPayment)}</td>
                        <td class="hidden-xs">${data.data.expiryDay}</td>
                        <td class="hidden-xs">${data.data.fatPay}</td>
                        <td class="hidden-xs">${data.data.fatNotPay}</td>
                        <td>
                            <div class="input-group-btn">
                                <a onclick="openInvoices(${data.data.id})" class="btn btn-success btn-sm pull-right" href="#" title="Ver faturas" data-toggle="modal" data-target="#modal-invoices"><i class="fas fa-file-invoice-dollar"></i></a>
                            </div>
                        </td>
                    </tr>`;


            $('#listaContrato').html(html);

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

//LISTAR FATURAS DO CONTRATO ATIVO
function openInvoices(id)
{
    $.post(window.location.origin + "/api/admin/invoice/list/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';
            let cont = 0;

            for (var i in data.data) {

                if(data.data[i].isPaid==0)
                    cont++;

                html += `<tr class="${data.data[i].isPaid==0?'':'success'}">
                            <td>${dateFormat(data.data[i].dueDate)}</td>
                            <td>${moneyFormat(data.data[i].value)}</td>
                            <td>${data.data[i].isPaid==0?'Aberto':'Pago'}</td>
                            <td>
                                ${data.data[i].isPaid==0?`
                                    ${cont>1?``:`
                                        <div class="input-group-btn">
                                        <a onclick="reportPayment(${data.data[i].id}, ${data.data[i].idContract})" title="Informar pagamento" class="btn btn-sm btn-success pull-right"><i id="ico${data.data[i].id}" class="fas fa-file-invoice-dollar"></i></a>
                                        ${data.data[i].isPaid==0&&i==0?`<a onclick="editInvoice(${data.data[i].id}, ${data.data[i].idContract})" class="btn btn-sm btn-warning pull-right open-modal-edit-invoice" title="Editar 1ª fatura"><i class="fas fa-pen"></i></a>`:``}
                                        </div>
                                        `}
                                `:`
                                    <a title="Ver recibo" target="_blank" href="/payment/${data.data[i].tokenPayment}" class="btn btn-sm btn-primary pull-right"><i class="fas fa-file-invoice-dollar"></i></a>
                                `}
                            </td>
                        </tr>`;
            }

            $('#listInvoices').html(html);

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

function checkPass(){

}

//MARCAR A FATURA COMO RECEBIDA
function reportPayment(idInvoice, idContract)
{
    userId = $("#idUser").val();

    Swal.fire({
        title: 'Para confirmar o recebimento, digite sua senha de acesso:',
        input: 'password',
        inputAttributes: {
          autocapitalize: 'off',
        },
        showCancelButton: false,
        confirmButtonText: 'Autenticar',
        showLoaderOnConfirm: true,
        preConfirm: (pass) => {
          return fetch(window.location.origin + `/api/admin/academy/checkuserpass/${userId}/${pass}`)
            .then(response => {
              if (!response.status) {
                throw new Error(response.statusText)
              }
              return response.json()
            })
            .catch(error => {
              Swal.showValidationMessage(
                `Request failed: ${error}`
              )
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.value.status == 'success') {
            if (result.value.data == true) {

                $("#ico"+idInvoice).removeClass("fa-file-invoice-dollar");
                $("#ico"+idInvoice).addClass("fa-sync-alt");
                $("#ico"+idInvoice).addClass("fa-spin");

                $.post(window.location.origin + "/api/admin/invoice/reportPayment/"+idInvoice+"/"+userId, {

                }).then(function(data) {
                    if(data.status == 'success') {

                        $("#ico"+idInvoice).removeClass("fa-sync-alt");
                        $("#ico"+idInvoice).removeClass("fa-spin");
                        $("#ico"+idInvoice).addClass("fa-file-invoice-dollar");

                        openInvoices(idContract);

                        Swal.fire(
                            'Pagamento confirmado!',
                            '',
                            'success'
                        )

                    } else if (data.status == 'error') {
                        showError(data.message);
                    }
                }, goTo500).catch(goTo500);

            }else{
                Swal.fire({
                  title: `Senha incorreta!`
                })
            }

        }
      })

}

function editInvoice(idInvoice, idContract)
{

    userId = $("#idUser").val();

    html = `<div class="modal fade" id="modal-edit-invoice">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fas fa-pen"></i>&nbsp;&nbsp;Editar valor da 1ª fatura</h4>
                    </div>
                    <div class="modal-body">

                            <input type="hidden" id="idInvoice" value="${idInvoice}">
                            <input type="hidden" id="idContract" value="${idContract}">

                            <div class="row">
                                <div class="col-sm-12">

                                    <div class="input-group" style="width:100%">
                                        <label>Novo valor</label>
                                        <input type="text" class="form-control money-mask" name="newValue" id="newValue" required>
                                    </div>

                                </div>
                            </div>    
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button onclick="saveEditInvoice()" class="btn btn-primary pull-right"><i class="fas fa-save"></i>&nbsp;&nbsp;Salvar</button>
                    </div>
                    </div>
                </div>
            </div>`;

    $("#box-modal-edit-invoice").append(html);

    $('.money-mask').mask('#.##0,00', {reverse: true});

    Swal.fire({
        title: 'Para editar a fatura, digite sua senha de acesso:',
        input: 'password',
        inputAttributes: {
          autocapitalize: 'off',
        },
        showCancelButton: false,
        confirmButtonText: 'Autenticar',
        showLoaderOnConfirm: true,
        preConfirm: (pass) => {
          return fetch(window.location.origin + `/api/admin/academy/checkuserpass/${userId}/${pass}`)
            .then(response => {
              if (!response.status) {
                throw new Error(response.statusText)
              }
              return response.json()
            })
            .catch(error => {
              Swal.showValidationMessage(
                `Request failed: ${error}`
              )
            })
        },
        allowOutsideClick: () => !Swal.isLoading()
      }).then((result) => {
        if (result.value.status == 'success') {
            if (result.value.data == true) {

                $("#modal-edit-invoice").modal("show");

            }else{
                Swal.fire({
                  title: `Senha incorreta!`
                })
            }

        }
      })

}

function saveEditInvoice()
{
    let newValue = $("#newValue").val();
            newValue = newValue.replace('.', ' ');
            newValue = newValue.replace(',', '.');
            newValue = newValue.replace(' ', '');

    Swal.queue([{
        title: 'Carregando...',
        allowOutsideClick: false,
        allowEscapeKey: false,
        onOpen: () => {
            Swal.showLoading();
            $.post(window.location.origin + "/api/admin/invoice/edit", {
                newValue: newValue,
                idInvoice: $("#idInvoice").val(),
                idContract: $("#idContract").val(),
                idUser: $("#idUser").val(),
            }).then(function(data) {
                if(data.status == 'success') {
                    Swal.fire({
                        type: 'success',
                        text: 'Fatura editada com sucesso',
                        showConfirmButton: false,
                        showCancelButton: true,
                        cancelButtonText: "OK",
                        onClose: () => {
                            $("#newValue").val("");
                            $("#modal-edit-invoice").modal('hide');
                            $("#modal-invoices").modal('hide');
                        }
                    });
                } else if (data.status == 'error') {
                    showError(data.message);
                }
            }, goTo500).catch(goTo500);
        }
    }]);

}

//DESMATRICULAR DA AULA
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
        
                            list($("#idStudent").val());
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

//LISTAR GRADUAÇÕES POR ESPORTE
// listaGraduacao
function listGraduations(id)
{
    $.post(window.location.origin + "/api/admin/user-graduation/active/list/"+id, {

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

                html += `<tr class="${total_hours>=data.data[i].required_hours?'success':''}">
                            <td>${data.data[i].name_sport}</td>
                            <td><i style="color:${data.data[i].color}" class="fas fa-ribbon"></i>&nbsp;&nbsp;${data.data[i].name_graduation}</td>
                            <td class="hidden-xs">${dateFormat(data.data[i].startDate)}</td>
                            <td class="hidden-xs">${dateFormat(data.data[i].endDate)}</td>
                            <td class="hidden-xs">${data.data[i].isActive==1?'Graduando':'Graduado'}</td>
                            <td class="hidden-xs">${data.data[i].required_hours}</td>
                            <td class="hidden-xs">${total_hours}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a onclick="openPresences(${data.data[i].idUser},${data.data[i].id})" class="btn btn-success btn-sm pull-right" href="#" title="Ver presenças" data-toggle="modal" data-target="#modal-presences"><i class="fas fa-user-check"></i></a>
                                </div>
                            </td>
                        </tr>`;
            }

            $('#listGraduations').html(html);

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

//LISTAR PRESENÇAS DA GRADUAÇÃO
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
