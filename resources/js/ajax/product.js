$(document).ready(function () {

    $("#addProductForm").submit(function (e) {
        e.preventDefault();
        let formData = $(this).serialize();

        $.ajax({
            url: $("meta[name='store-product-route']").attr("content"),
            type: "POST",
            data: formData,
            success: function (response) {
                if (response.success == "added") {
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
        let url = `/products/${productId}`; 

        if (confirm("Are you sure you want to delete this product?")) {
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"), 
                },
                success: function (response) {
                    if (response.success == 'deleted') {
                        $("#product-" + productId).remove();
                        alert(response.message);
                    } else {
                        alert("Failed to delete product.");
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert("Error deleting product.");
                    alert(productId);
                    alert(url);
                },
            });
        }
    });

    $(document).on("click", ".view-product", function () {
        let productId = $(this).data("id");

        $.ajax({
            url: `/products/${productId}`,
            type: "GET",
            success: function (response) {
                if (response.success == 'shown') {
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

    $(document).ready(function () {
       
        $(document).on('click', '.edit-product', function () {
            let productId = $(this).data('id');
            let productName = $(this).data('name');
            let productDescription = $(this).data('description');
            let productQuantity = $(this).data('quantity');
            let productPrice = $(this).data('price');
    
           
            $('#editProductId').val(productId);
            $('#editName').val(productName);
            $('#editDescription').val(productDescription);
            $('#editQuantity').val(productQuantity);
            $('#editPrice').val(productPrice);
    
       
            $('#editProductModal').modal('show');
        });
    });
    


    $(document).on('submit', '#editProductForm', function (e) {
        e.preventDefault(); 
    
        let productId = $('#editProductId').val();
        let formData = $(this).serialize();
    
        $.ajax({
            url: `/products/${productId}`, 
            type: 'PUT',
            data: formData,
            success: function (response) {
                if(response.success == 'updated'){
                    alert('Product updated!');
                    $('#editProductModal').modal('hide');
                    location.reload();
                }else if (response.success == 'no_changes'){
                    alert("No changes made");
                }else{
                    alert('Failed to update product');
                }
            },
            error: function (xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
