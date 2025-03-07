$(document).ready(function () {
    let baseUrl = $("meta[name='store-product-route']").attr("content");
    let baseDeleteUrl = $("meta[name='delete-product-route']").attr("content");

    $("#addProductForm").submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: `${baseUrl}`,
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.success === "added") {
                    $("#addProductModal").modal("hide");
                    $("#addProductForm")[0].reset();
                    $("#product-list").append(response.html);
                    alert(response.message);
                } else {
                    alert("Failed to add product.");
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                alert("Error adding product.");
            },
        });
    });

    $(document).on("click", ".delete-product", function () {
        let productId = $(this).data("id");
        let url = `${baseDeleteUrl}/${productId}`;

        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.success === "deleted") {
                        $(`#product-${productId}`).remove();
                        alert(response.message);
                    } else {
                        alert("Failed to delete product.");
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert("Error deleting product.");
                },
            });
        }
    });

    $(document).on("click", ".view-product", function () {
        let productId = $(this).data("id");

        $.ajax({
            url: `${baseUrl}/${productId}`,
            type: "GET",
            success: function (response) {
                if (response.success === "shown") {
                    $("#viewProductModal .modal-body").html(response.html);
                    $("#viewProductModal").modal("show");
                } else {
                    alert("Failed to fetch product details.");
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
                alert("Error fetching product details.");
            },
        });
    });

    $(document).on("click", ".edit-product", function () {
        let productId = $(this).data("id");

        $("#editProductId").val(productId);
        $("#editName").val($(this).data("name"));
        $("#editDescription").val($(this).data("description"));
        $("#editQuantity").val($(this).data("quantity"));
        $("#editPrice").val($(this).data("price"));

        $("#editProductModal").modal("show");
    });

    $(document).on("submit", "#editProductForm", function (e) {
        e.preventDefault();

        let productId = $("#editProductId").val();
        let formData = $(this).serialize() + "&_method=PUT";

        $.ajax({
            url: `${baseUrl}/${productId}`,
            type: "POST", // Use POST to simulate PUT
            data: formData,
            success: function (response) {
                if (response.success === "updated") {
                    alert("Product updated!");
                    $("#editProductModal").modal("hide");
                    location.reload();
                } else if (response.success === "no_changes") {
                    alert("No changes made");
                } else {
                    alert("Failed to update product");
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            },
        });
    });
    
});
