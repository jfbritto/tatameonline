$(document).ready(function(){

    list();
});

$("#lista").on("click", ".setRead", function(){
    
    let id = $(this).attr("data-id");

    console.log(id)

    $.post(window.location.origin + "/api/root/bug/set-read/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            list();

        } else if (data.status == 'error') {
            // showError(data.message);
        }
    }, goTo500).catch(goTo500);

});

function list()
{

    $.post(window.location.origin + "/api/root/bug/list", {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr class="${data.data[i].isRead==1?'success':'danger' }">
                            <td>${data.data[i].type}</td>
                            <td>${data.data[i].description}</td>
                            <td>${dateFullFormat(data.data[i].created_at)}</td>
                            <td>${data.data[i].academy_name}</td>
                            <td>${data.data[i].user_name}</td>
                            <td>${data.data[i].isRead==1?'Sim':'Não' }</td>
                            <td>
                                <a class="btn btn-primary btn-sm pull-right setRead" data-id="${data.data[i].id}" href="#" title="Marcar como lida"><i class="fas fa-check"></i></a>
                            </td>
                        </tr>`;
            }

            $('#lista').html(html);

        } else if (data.status == 'error') {
            // showError(data.message);
        }
    }, goTo500).catch(goTo500);
}