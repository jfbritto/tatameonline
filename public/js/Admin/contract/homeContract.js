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

                html += `<tr>
                            <td>${dateFormat(data.data[i].signatureDate)}</td>
                            <td class="hidden-xs">${data.data[i].months}</td>
                            <td>${moneyFormat(data.data[i].monthlyPayment)}</td>
                            <td class="hidden-xs">${data.data[i].expiryDay}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a onclick="openInvoices(${data.data[i].id})" class="btn btn-primary btn-sm pull-right" href="#" title="Ver faturas" data-toggle="modal" data-target="#modal-invoices"><i class="fas fa-file-invoice-dollar"></i></a>
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