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

let meses_nome = {
    "01":"Janeiro",
    "02":"Fevereiro",
    "03":"Março",
    "04":"Abril",
    "05":"Maio",
    "06":"Junho",
    "07":"Julho",
    "08":"Agosto",
    "09":"Setembro",
    "10":"Outubro",
    "11":"Novembro",
    "12":"Dezembro",
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

function dateFormat(data)
{
    if(data == null || data == undefined || data == ''){
        return '';
    }else{
        const [ano, mes, dia] = data.split('-');
        return `${dia}/${mes}/${ano}`;
    }
}

function hourFormat(data)
{
    if(data == null || data == undefined || data == ''){
        return '';
    }else{
        let hr = data.split(' ');
        return `${hr[1]}`;
    }
}

function monthName(data)
{
    if(data == null || data == undefined || data == ''){
        return '';
    }else{
        let dt = data.split('-');

        return `${meses_nome[dt[1]]} de ${dt[0]}`;
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
