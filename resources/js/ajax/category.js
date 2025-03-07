$(document).ready(function () {
    let baseUrl = $("meta[name='store-categories-route']").attr("content");
    let baseDeleteUrl = $("meta[name='delete-categories-route']").attr("content");


    $('#addCategoryForm').on('submit', function(e) {
        e.preventDefault();
    
        $.ajax({
            url: `${baseUrl}`,
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                alert(response.success);
                let parentCategoryId = $('#parent_id').val(); 
                $('#addCategoryForm')[0].reset();
            // Get selected parent ID
                console.log("id", parentCategoryId)
                if (parentCategoryId) {
                    $(`#category-${parentCategoryId} .subcategories`).append(response.html); // Append to the correct parent
                } else {
                    $('.category-list').append(response.html); // Append to the main list if no parent
                }
            
                $('#addCategoryModal').modal('hide');
            },
            error: function(response) {
                alert('Error adding category');
            }
        });
    });

    $(document).on('click', '.edit-category', function() {
        let categoryId = $(this).data('id');
        let categoryName = $(this).data('name');
        let parentId = $(this).data('parent-id');

        $('#editCategoryId').val(categoryId);
        $('#editCategoryName').val(categoryName);
        $('#editParentCategory').val(parentId);
        $('#editCategoryModal').modal('show');
    });

    $('#editCategoryForm').on('submit', function(e) {
        e.preventDefault();

        let categoryId = $('#editCategoryId').val();
        $.ajax({
            url: `${baseDeleteUrl}/${categoryId}`,
            method: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                alert(response.success);
                location.reload(); // Reload the page to see the updated category
            },
            error: function(response) {
                alert('Error updating category');
            }
        });
    });


    $(document).on("click", ".delete-category", function () {
        let categoryId = $(this).data("id");
        let url = `${baseDeleteUrl}/${categoryId}`;

        if (confirm("Are you sure you want to delete this category?")) {
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.success === "deleted") {
                        $(`#category-${categoryId}`).remove();
                        alert(response.message);
                    } else {
                        alert("Failed to delete category.");
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert("Error deleting category.");
                },
            });
        }
    });
});

