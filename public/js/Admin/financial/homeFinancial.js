$(document).ready(function(){


    list($("#idAcademy").val());



    function list(id)
    {

        $.post(window.location.origin + "/api/admin/financial/"+id, {

        }).then(function(data) {
            if(data.status == 'success') {

                console.log(data.data.receive)

                $("#receive").html(data.data.receive);
                $("#received").html(data.data.received);
                $("#late").html(data.data.late);

            } else if (data.status == 'error') {
                showError(data.message);
            }
        }, goTo500).catch(goTo500);
    }
});

