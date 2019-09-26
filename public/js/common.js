function goTo500()
{
    // window.location = '/500';
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