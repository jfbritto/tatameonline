function buildDataTable(){

    // setTimeout(() => {
        $(".datatable-table").DataTable({
            "language": {
                "url": "//cdn.datatables.net/plug-ins/1.10.20/i18n/Portuguese-Brasil.json"
            },
            "bLengthChange": false,
            "paging": true,
            "bDestroy": true
        });

        $("table tr td").css("vertical-align", "middle");

    // }, 1000);

}
