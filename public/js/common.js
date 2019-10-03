function goTo500(e)
{
    console.log(e);
}

let dia_semana = {
    "1":"Segunda",
    "2":"Terça",
    "3":"Quarta",
    "4":"Quinta",
    "5":"Sexta",
    "6":"Sábado",
    "7":"Domingo",
}

function showError(message)
{
    Swal.fire({
        type: 'error',
        text: message,
        showConfirmButton: false,
        showCancelButton: true,
        cancelButtonText: "OK",
        onClose: () => {
            
        }
    });
}

function dateFormat(data)
{
    if(data == null || data == undefined || data == ''){
        return '';
    }else{
        const [ano, mes, dia] = data.split('-');
        return `${dia}/${mes}/${ano}`;
    }
}

function dateFullFormat(data)
{
    if(data == null || data == undefined || data == ''){
        return '';
    }else{
        
        const [date, hour] = data.split(' ');
        
        const [ano, mes, dia] = date.split('-');
        return `${dia}/${mes}/${ano} ${hour}`;
    }
}

function moneyFormat(money)
{
    let cash = money.replace('.', ',')

    if(cash.length >= 7)
        return `R$${cash.substr(0, (cash.length-6))}.${cash.substr(-6, 7)}`;
    else
        return `R$${cash}`;
}

var SPMaskBehavior = function (val) {
    return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
  },
  spOptions = {
    onKeyPress: function(val, e, field, options) {
        field.mask(SPMaskBehavior.apply({}, arguments), options);
      }
  };

$('.phone-mask').mask(SPMaskBehavior, spOptions);

$('.money-mask').mask('#.##0,00', {reverse: true});