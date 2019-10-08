$(document).ready(function(){

    getToken($("#idAcademy").val());
    lessonsNow($("#idAcademy").val());
    // lessonAlunsList(0);

    let time = 20;
    let bar = '';
    let cont = 0;

    function renderProgress(){

        bar = new ProgressBar.Circle(container, {
            color: '#333',
            // This has to be the same size as the maximum width to
            // prevent clipping
            strokeWidth: 4,
            trailWidth: 4,
            // easing: 'ease',
            duration: 30000,
            text: {
                autoStyleContainer: false
            },
            from: { color: '#333', width: 4 },
            to: { color: '#333', width: 4 },
            // Set default step function for all animate calls
            step: function(state, circle) {
                circle.path.setAttribute('stroke', state.color);
                circle.path.setAttribute('stroke-width', state.width);

                circle.setText("<center><font style='font-size:10px'>TOKEN</font><br><font style='font-size:35px'>"+token+"</font></center>");
            }
        });
        bar.text.style.fontFamily = '"Raleway", Helvetica, sans-serif';
        bar.text.style.fontSize = '2rem';
    }

    $("#btn-container").on("click", function(){
        if(bar.value() != 0)
        reset();
        else
        startProgress();
    });

    $("#btn-container-pause").on("click", function(){
        $("#btn-container").show();
        $("#btn-container-pause").hide();
        bar.stop(1.0);
    });

    $('#modal-token').on('hidden.bs.modal', function (e) {
        $("#btn-container").show();
        $("#btn-container-pause").hide();
        bar.stop(1.0);
    })

    function startProgress(){

        time = $("#time option:selected").val();

        $("#btn-container").hide();
        $("#btn-container-pause").show();

        bar.animate(1.0, {
            duration: transformTime(time)
        }, function() {
            updateToken($("#idAcademy").val());
            getToken($("#idAcademy").val());
        });
    }

    function reset(){
        bar.set(0);
        startProgress();
    }
    function start(){
        startProgress();
    }

    function transformTime(seconds){
        return (seconds*1000);
    }

    function getToken(id)
    {
        $.post(window.location.origin + "/api/admin/academy/list/"+id, {

        }).then(function(data) {

            if(data.status == 'success') {

                $("#info-box-token").html(data.data.token)
                $("#info-box-aluns").html(data.data.aluns)
                $("#info-box-lessons").html(data.data.lessons)
                token = data.data.token;

                if(cont == 0){
                    renderProgress();
                    cont++;
                }

            } else if (data.status == 'error') {
                showError(data.message);
            }
        }, goTo500).catch(goTo500);
    }

    function updateToken(id)
    {
        $.post(window.location.origin + "/api/admin/academy/update-token/"+id, {

        }).then(function(data) {

            if(data.status == 'success') {

                $("#info-box-token").html(data.data)
                token = data.data;

                reset();
                start();

            } else if (data.status == 'error') {
                showError(data.message);
            }
        }, goTo500).catch(goTo500);
    }

    function lessonsNow(id)
    {
        $.post(window.location.origin + "/api/admin/lesson/now/list/"+id, {

        }).then(function(data) {
            if(data.status == 'success') {

                var html = '';

                for (var i in data.data) {

                    html += `<div class="col-md-3 col-sm-6 col-xs-12">
                                <div class="info-box">
                                <a href="#" onclick="lessonAlunsList(${data.data[i].id})">
                                        <span class="info-box-icon bg-green"><i class="fas fa-users"></i></span>
                                    </a>
                                <div class="info-box-content">
                                    <span class="info-box-text">${data.data[i].sport_name}</span>
                                    <span class="info-box-text">${data.data[i].teacher}</span>
                                    <span class="info-box-text">${data.data[i].hour}</span>
                                    <span class="info-box-text">Presentes: <strong id="lesson${data.data[i].id}">${data.data[i].presences}</strong></span>
                                    </div>

                                </div>
                             </div>`;
                            }

                $('#lessons-now').html(html);

            } else if (data.status == 'error') {
                showError(data.message);
            }
        }, goTo500).catch(goTo500);
    }



});

function givePresence(idReg, idUsGr, idLesson)
{
    $.post(window.location.origin + "/api/student/presence", {
        idRegistration: idReg,
        idUserGraduation: idUsGr,
    }).then(function(data) {
        // $("#modal-presences").modal('hide');

        let totPres = parseInt($("#lesson"+idLesson).html());
        let res = totPres + 1;
        $("#lesson"+idLesson).html(res)

        $("#situ"+idReg).html('<span class="label label-success">Presente</span>')
        $("#btn"+idReg).hide()

        if(data.status == 'success') {
            Swal.fire({
                type: 'success',
                text: 'Presença cadastrada com sucesso',
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

function lessonAlunsList(id)
{

    $.post(window.location.origin + "/api/admin/lesson/students/now/list/"+id, {

    }).then(function(data) {
        if(data.status == 'success') {

            var html = '';

            for (var i in data.data) {

                html += `<tr>
                <td>${data.data[i].student_name}</td>
                            <td id="situ${data.data[i].id_registration}">${data.data[i].present != null?'<span class="label label-success">Presente</span>':'<span class="label label-danger">Ausente</span>'}</td>
                            <td>
                                ${data.data[i].present != null?'':`
                                <div class="input-group-btn">
                                <a id="btn${data.data[i].id_registration}" class="btn btn-success btn-sm pull-right" href="#" onclick="givePresence(${data.data[i].id_registration}, ${data.data[i].id_user_graduation}, ${data.data[i].id})" title="Confirmar presença de ${data.data[i].student_name}"><i class="fas fa-user-check"></i></a>
                                </div>
                                `}
                                </td>
                                </tr>`;
            }


            $("#title-lessons-now").show()

            $('#listPresences').html(html);

            $("#modal-presences").modal("show");

        } else if (data.status == 'error') {
            showError(data.message);
        }
    }, goTo500).catch(goTo500);

}
