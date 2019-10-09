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

            for (var i in data.data) {

                html += `<tr class="${data.data[i].isPaid==0?'':'success'}">
                            <td>${dateFormat(data.data[i].dueDate)}</td>
                            <td>${moneyFormat(data.data[i].value)}</td>
                            <td>${data.data[i].isPaid==0?'Aberto':'Pago'}</td>
                            <td>
                                <a title="Informar pagamento" onclick="reportPayment(${data.data[i].id}, ${data.data[i].idContract})" class="btn btn-sm btn-success pull-right"><i id="ico${data.data[i].id}" class="fas fa-file-invoice-dollar"></i></a>
                            </td>
                        </tr>`;
            }

            $('#listInvoices').html(html);

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

//MARCAR A FATURA COMO RECEBIDA
function reportPayment(idInvoice, idContract)
{


    Swal.fire({
        title: 'Atenção!',
        text: "Confirma o recebimento?",
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim'
      }).then((result) => {
        if (result.value) {

            $("#ico"+idInvoice).removeClass("fa-file-invoice-dollar");
            $("#ico"+idInvoice).addClass("fa-sync-alt");
            $("#ico"+idInvoice).addClass("fa-spin");

            $.post(window.location.origin + "/api/admin/invoice/reportPayment/"+idInvoice, {

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

        }
      })

}

//DESMATRICULAR DA AULA
function destroy(id)
{

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
                            <td>${data.data[i].name_graduation}</td>
                            <td class="hidden-xs">${dateFormat(data.data[i].startDate)}</td>
                            <td class="hidden-xs">${dateFormat(data.data[i].endDate)}</td>
                            <td class="hidden-xs">${data.data[i].isActive==1?'Graduando':'Graduado'}</td>
                            <td class="hidden-xs">${data.data[i].required_hours}</td>
                            <td>${total_hours}</td>
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
                            <td>${data.data[i].teacher}</td>
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
