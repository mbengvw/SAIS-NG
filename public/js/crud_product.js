$(function () {
    /*------------------------------------------
    Pass Header Token
    --------------------------------------------*/
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    /*------------------------------------------
    Render DataTable
    --------------------------------------------*/
    let table = $(".data-table").DataTable({
        processing: true,
        serverSide: true,
        ajax: path.base_path,
        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
            },

            {
                data: "name",
                name: "name",
            },

            {
                data: "detail",
                name: "detail",
            },

            {
                data: "action",
                name: "action",
                orderable: false,
                searchable: false,
            },
        ],
    });

    /*------------------------------------------
    Click to Create Button -- Menampilkan modal form create new product
    --------------------------------------------*/
    $("#createNewProduct").click(function () {
        $("#saveBtn").val("create-product");
        $("#product_id").val("");
        $("#productForm").trigger("reset");
        $("#modelHeading").html("Create New Product");
        $("#ajaxModel").modal("show");
    });

    /*------------------------------------------
    Click to Edit Button -- Menampilkan modal form edit
    --------------------------------------------*/
    $("body").on("click", ".editProduct", function () {
        let product_id = $(this).data("id");
        $.get(path.base_path + "/" + product_id + "/edit", function (data) {
            $("#modelHeading").html("Edit Product");
            $("#saveBtn").val("edit-user");
            $("#ajaxModel").modal("show");
            $("#product_id").val(data.id);
            $("#name").val(data.name);
            $("#detail").val(data.detail);
        });
    });

    /*------------------------------------------
    Click Save Button -- Create/Update Product
    --------------------------------------------*/
    $("#saveBtn").click(function (e) {
        e.preventDefault();
        $(this).html("Sending..");
        $.ajax({
            data: $("#productForm").serialize(),
            url: path.store_path,
            type: "POST",
            dataType: "json",
            success: function (data) {
                $("#productForm").trigger("reset");
                $("#ajaxModel").modal("hide");
                table.draw();
            },
            error: function (data) {
                console.log("Error:", data);
                $("#saveBtn").html("Save Changes");
            },
        });
    });

    /*------------------------------------------
    Delete Product Code
    --------------------------------------------*/
    $("body").on("click", ".deleteProduct", function () {
        let product_id = $(this).data("id");
        let confirmed = confirm("Are You sure want to delete !");
        if (confirmed) {
            $.ajax({
                type: "DELETE",
                url: path.store_path + "/" + product_id,
                success: function (data) {
                    table.draw();
                },
                error: function (data) {
                    console.log("Error:", data);
                },
            });
        }
    });
});
