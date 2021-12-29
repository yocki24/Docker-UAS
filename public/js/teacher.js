$(function () {
    $("#table-teacher").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${APP_URL}/admin/teacher`
        }, columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "4%", },
            { data: "nisn", name: "nisn" },
            { data: "name", name: "name" },
            { data: "date_of_birth", name: "date_of_birth" },
            { data: "role", name: "role" },
            { data: "action", name: "action", orderable: false, searchable: false, }
        ]
    });

    $("#table-teacher").on("click", ".btn-delete-teacher", function () {
        var id = $(this).attr("data-id");
        $("#form-delete-teacher").attr(
            "action",
            `${APP_URL}/admin/teacher/${id}`
        );
    });

})
