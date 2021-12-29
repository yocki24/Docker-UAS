$(function () {
    $("#table-student").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: window.location.href
        }, columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "4%", },
            { data: "nisn", name: "nisn" },
            { data: "name", name: "name" },
            { data: "date_of_birth", name: "date_of_birth" },
            { data: "class", name: "class" },
            { data: "major", name: "major" },
            { data: "role", name: "role" },
            { data: "action", name: "action", orderable: false, searchable: false, }
        ]
    });

    $("#table-student").on("click", ".btn-delete-student", function () {
        var id = $(this).attr("data-id");
        $("#form-delete-student").attr(
            "action",
            `${APP_URL}/admin/student/${id}`
        );
    });

})
