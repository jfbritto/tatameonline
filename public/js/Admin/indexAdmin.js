$(document).ready(function(){

    getToken($("#idAcademy").val());

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
            // reset();
            // start();
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

});

