$(document).ready(function(){
    
    function callList(){
        list($("#idStudent").val());
    }

    callList();

});

function list(id)
{
    $.post(window.location.origin + "/api/student/lesson/list/"+id, {
        
    }).then(function(data) {
        if(data.status == 'success') {

            let html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td>${data.data[i].sport_name}</td>
                            <td class="hidden-xs">${data.data[i].teacher}</td>
                            <td>${dia_semana[data.data[i].weekDay]}</td>
                            <td>${data.data[i].hour}</td>
                        </tr>`;
            }

            $('#lista').html(html);

        } else if (data.status == 'error') {
            // showError(data.message);
        }
    }, goTo500).catch(goTo500);
}
