$(document).ready(function(){

    $("#formAddContract").submit(function(e) {

        e.preventDefault();

        let monthlyPayment = $("#monthlyPayment").val();
            monthlyPayment = monthlyPayment.replace('.', ' ');
            monthlyPayment = monthlyPayment.replace(',', '.');
            monthlyPayment = monthlyPayment.replace(' ', '');

        Swal.queue([{
            title: 'Carregando...',
            allowOutsideClick: false,
            allowEscapeKey: false,
            onOpen: () => {
                Swal.showLoading();
                $.post(window.location.origin + "/api/admin/contract", {
                    signatureDate: $("#signatureDate").val(),
                    months: $("#months").val(),
                    monthlyPayment: monthlyPayment,
                    expiryDay: $("#expiryDay").val(),
                    idUser: $("#idUser").val(),
                    idAcademy: $("#idAcademy").val(),
                }).then(function(data) {
                    callList();
                    if(data.status == 'success') {
                        Swal.fire({
                            type: 'success',
                            text: 'Contrato cadastrado com sucesso',
                            showConfirmButton: false,
                            showCancelButton: true,
                            cancelButtonText: "OK",
                            onClose: () => {
                                $("#formAddContract").trigger("reset");
                                $("#modal-default").modal('hide');
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
        list($("#idUser").val());
    }

    callList();
});

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
                                        <a title="Informar pagamento" onclick="reportPayment(${data.data[i].id}, ${data.data[i].idContract})" class="btn btn-sm btn-success pull-right"><i id="ico${data.data[i].id}" class="fas fa-file-invoice-dollar"></i></a>
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

function reportPayment(idInvoice, idContract)
{

    userId = $("#idUser2").val();

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

            }else{
                Swal.fire({
                  title: `Senha incorreta!`
                })
            }

        }
      })

}

function renewContract(fld_months, fld_monthlyPayment, fld_expiryDay, fld_idUser)
{

    Swal.fire({
        title: 'Atenção!',
        text: "Deseja renovar o contrato do aluno?",
        type: 'warning',
        showCancelButton: false,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Sim'
      }).then((result) => {
        if (result.value) {

            $.post(window.location.origin + "/api/admin/contract/renew", {
                months: fld_months,
                monthlyPayment: fld_monthlyPayment,
                expiryDay: fld_expiryDay,
                idUser: fld_idUser,
            }).then(function(data) {
                list(fld_idUser);
                if(data.status == 'success') {
                    Swal.fire({
                        type: 'success',
                        text: 'Contrato renovado com sucesso',
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
      })

}

function list(id)
{
    $.post(window.location.origin + "/api/admin/contract/list/"+id, {

    }).then(function(data) {


        if(data.status == 'success') {

            if(data.data == ''){
                $("#add-contract").show();
            }else{
                $("#add-contract").hide();
            }

            var html = '';

            for (var i in data.data) {

                html += `<tr class="${data.data[i].isActive==1?'':'danger'}">
                            <td>${dateFormat(data.data[i].signatureDate)}</td>
                            <td>${data.data[i].months}</td>
                            <td>${moneyFormat(data.data[i].monthlyPayment)}</td>
                            <td>${data.data[i].expiryDay}</td>
                            <td>${data.data[i].fatPay}</td>
                            <td>${data.data[i].fatNotPay}</td>
                            <td>
                                <div class="input-group-btn">

                                <a onclick="openInvoices(${data.data[i].id})" class="btn btn-primary btn-sm pull-right" href="#" title="Ver faturas" data-toggle="modal" data-target="#modal-invoices"><i class="fas fa-file-invoice-dollar"></i></a>

                                ${data.data[i].fatPay==data.data[i].months && data.data[i].isActive==1?`
                                    <a onclick="renewContract(${data.data[i].months},${data.data[i].monthlyPayment},${data.data[i].expiryDay},${data.data[i].idUser},)" class="btn btn-success btn-sm pull-right" href="#" title="Renovar contrato" data-toggle="modal" data-target="#modal-renew">Renovar</a>
                                `:``}

                                </div>
                            </td>
                        </tr>`;
            }

            $('#lista').html(html);

        } else if (data.status == 'error') {
            // showError(data.message);
        }
    }, goTo500).catch(goTo500);
}
