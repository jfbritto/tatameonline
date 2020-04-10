$(document).ready(function(){

    function callList(){
        list($("#idLesson").val());
    }

    callList();

});

function list(id)
{
    $.post(window.location.origin + "/api/admin/registration/list/"+id, {
        
    }).then(function(data) {
        if(data.status == 'success') {
    
            var html = '';

            for (var i in data.data) {

                html += `<tr>
                            <td>${data.data[i].name_alun}</td>
                            <td>
                                <div class="input-group-btn">
                                    <a class="btn btn-primary btn-sm pull-right" href="/instructor/student/show/${data.data[i].idUser}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>
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
