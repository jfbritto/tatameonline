$(document).ready(function(){

    list($("#idAcademy").val());

    function list(id)
    {

        $.post(window.location.origin + "/api/admin/financial/"+id, {

        }).then(function(data) {
            if(data.status == 'success') {

                console.log(data.data.list_receive)

                $("#receive").html(data.data.receive);
                $("#received").html(data.data.received);
                $("#late").html(data.data.late);

                var html = '';
                var html2 = '';
                var html3 = '';

                for (var i in data.data.list_receive) {

                    html += `<tr>
                                <td>${data.data.list_receive[i].name}</td>
                                <td>${dateFormat(data.data.list_receive[i].dueDate)}</td>
                                <td>${moneyFormat(data.data.list_receive[i].value)}</td>
                            </tr>`;
                }
                for (var i in data.data.list_received) {

                    html2 += `<tr>
                                <td>${data.data.list_received[i].name}</td>
                                <td>${dateFormat(data.data.list_received[i].dueDate)}</td>
                                <td>${moneyFormat(data.data.list_received[i].value)}</td>
                            </tr>`;
                }
                for (var i in data.data.list_late) {

                    html3 += `<tr>
                                <td>${data.data.list_late[i].name}</td>
                                <td>${dateFormat(data.data.list_late[i].dueDate)}</td>
                                <td>${moneyFormat(data.data.list_late[i].value)}</td>
                            </tr>`;
                }

                $('#list-receive').html(html);
                $('#list-received').html(html2);
                $('#list-late').html(html3);

            } else if (data.status == 'error') {
                showError(data.message);
            }
        }, goTo500).catch(goTo500);
    }
});

