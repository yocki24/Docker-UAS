$(function () {
    $("#table-admin").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${APP_URL}/admin/master`
        }, columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "4%", },
            { data: "nisn", name: "nisn" },
            { data: "name", name: "name" },
            { data: "date_of_birth", name: "date_of_birth" },
            { data: "status", name: "status" },
            { data: "action", name: "action", orderable: false, searchable: false, }
        ]
    });

    $("#table-admin").on("click", ".btn-delete-admin", function () {
        var id = $(this).attr("data-id");
        $("#form-delete-admin").attr(
            "action",
            `${APP_URL}/admin/master/${id}`
        );
    });

})
