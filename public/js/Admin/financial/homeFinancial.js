$(document).ready(function(){

    list($("#idAcademy").val(), $("#date").val());

    $("#date").on("change", function(){

        list($("#idAcademy").val(), $("#date").val());
    });


    function list(id, date)
    {

        $.post(window.location.origin + "/api/admin/financial/"+id+"/"+date, {

        }).then(function(data) {
            if(data.status == 'success') {

                $("#receive").html(data.data.receive);
                $("#received").html(data.data.received);
                $("#late").html(data.data.late);

                var html = '';
                var html2 = '';
                var html3 = '';
                var html4 = '';

                for (var i in data.data.list_receive) {

                    html += `<tr class="warning">
                                <td>${data.data.list_receive[i].name}</td>
                                <td>${dateFormat(data.data.list_receive[i].dueDate)}</td>
                                <td>${moneyFormat(data.data.list_receive[i].value)}</td>
                                <td>
                                    <div class="input-group-btn">
                                        <a class="btn btn-primary btn-sm pull-right" href="/admin/student/show/${data.data.list_receive[i].id}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>
                                    </div>
                                </td>
                            </tr>`;
                }
                for (var i in data.data.list_received) {

                    html2 += `<tr class="success">
                                <td>${data.data.list_received[i].name}</td>
                                <td>${dateFormat(data.data.list_received[i].dueDate)}</td>
                                <td>${moneyFormat(data.data.list_received[i].value)}</td>
                                <td>
                                    <div class="input-group-btn">
                                        <a class="btn btn-primary btn-sm pull-right" href="/admin/student/show/${data.data.list_received[i].id}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>
                                    </div>
                                </td>
                            </tr>`;
                }
                for (var i in data.data.list_late) {

                    html3 += `<tr class="danger">
                                <td>${data.data.list_late[i].name}</td>
                                <td>${dateFormat(data.data.list_late[i].dueDate)}</td>
                                <td>${moneyFormat(data.data.list_late[i].value)}</td>
                                <td>
                                    <div class="input-group-btn">
                                        <a class="btn btn-primary btn-sm pull-right" href="/admin/student/show/${data.data.list_late[i].id}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>
                                    </div>
                                </td>
                            </tr>`;
                }
                for (var i in data.data.debtors) {

                    html4 += `<tr class="danger">
                                <td>${data.data.debtors[i].name}</td>
                                <td>${data.data.debtors[i].total}</td>
                                <td>
                                    <div class="input-group-btn">
                                        <a class="btn btn-primary btn-sm pull-right" href="/admin/student/show/${data.data.debtors[i].id}" title="Abrir aluno"><i class="fas fa-sign-in-alt"></i></a>
                                    </div>
                                </td>
                            </tr>`;
                }

                $('#list-receive').html(html);
                $('#list-received').html(html2);
                $('#list-late').html(html3);
                $('#list-debtors').html(html4);

                $('#title').html(monthName(date))

            } else if (data.status == 'error') {
                showError(data.message);
            }
        }, goTo500).catch(goTo500);
    }
});

