$(function () {
    $("#table-candidate").DataTable({
        responsive: true,
        autoWidth: false,
        processing: true,
        serverSide: true,
        ajax: {
            url: `${APP_URL}/admin/candidate`
        }, columns: [
            { data: "DT_RowIndex", name: "DT_RowIndex", className: "text-center", width: "4%", },
            {
                data: "photo",
                render: function (data) {
                    if (data != null) {
                        var img = `${APP_URL}/storage/${data}`;
                        return (
                            '<img src="' +
                            img +
                            '" class="img-responsive img-thumbnail" style="width: 200px"/>'
                        );
                    } else {
                        return "";
                    }
                },
            },
            { data: "user.nisn", name: "user.nisn" },
            { data: "user.name", name: "user.name" },
            { data: "class", name: "class" },
            { data: "vision", name: "vision" },
            { data: "mision", name: "mision" },
            { data: "action", name: "action", orderable: false, searchable: false, }
        ]
    });

    $("#table-candidate").on("click", ".btn-delete-candidate", function () {
        var id = $(this).attr("data-id");
        $("#form-delete-candidate").attr(
            "action",
            `${APP_URL}/admin/candidate/${id}`
        );
    });

})
