$(document).ready(function(){

    list($("#idUser").val());
    invoiceDue($("#idUser").val());

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
                                ${data.data[i].isPaid==0?`

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
            showError(data.message);
        }
    }, goTo500).catch(goTo500);
}

function invoiceDue(idUser)
{
    $.post(window.location.origin + "/api/student/index/"+idUser, {

    }).then(function(data) {

        //PROCURANDO FATURA ABERTA
        if(data.data.invoiceDue.status == 'success') {

            let html = '';

            if(data.data.invoiceDue.data[0] == null){

                html += '';

            }else{

                if( data.data.invoiceDue.data[0].situation == 'ontime' ){

                    html += `<div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Sua fatura está perto de vencer! pague até dia ${dateFormat(data.data.invoiceDue.data[0].dueDate)}.
                            </div>`;
                }
                if( data.data.invoiceDue.data[0].situation == 'late' ){

                    html += `<div class="alert alert-danger alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Sua fatura venceu dia ${dateFormat(data.data.invoiceDue.data[0].dueDate)}! procure o responsável e efetue o pagamento.
                            </div>`;
                }
                if( data.data.invoiceDue.data[0].situation == 'today' ){

                    html += `<div class="alert alert-warning alert-dismissible">
                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                Sua fatura vence hoje! procure o responsável e efetue o pagamento
                            </div>`;
                }
            }


            $('#lista2').html(html);

        }

    }, goTo500).catch(goTo500);
}
