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
