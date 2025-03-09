$(document).ready(function () {
    let baseUrl = $("meta[name='store-units-route']").attr("content");
    let baseDeleteUrl = $("meta[name='delete-units-route']").attr("content");


    $('#addUnitForm').on('submit', function(e) {
        e.preventDefault();
    
        $.ajax({
            url: `${baseUrl}`,
            method: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                if(response.success == "added"){
                    alert(response.message);
                    $('#addUnitForm')[0].reset();
                    $('#addUnitModal').modal('hide');
                    $('#unit-list').append(response.html);
                }else{
                    alert("Failed to add unit");
                }
            },
            error: function(response) {
                alert('Error adding unit');
            }
        });
    });

    $(document).on('click', '.edit-unit', function() {
        let unitName = $(this).data('name');

        $('#editUnitId').val(unitId);
        $('#editUnitName').val(unitName);
    });

    $('#editUnitForm').on('submit', function(e) {
        e.preventDefault();

        let categoryId = $('#editUnitId').val();
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


    $(document).on("click", ".delete-unit", function () {
        let unitId = $(this).data("id");
        let url = `${baseDeleteUrl}/${unitId}`;

        if (confirm("Are you sure you want to delete this unit?")) {
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.success === "deleted") {
                        $(`#unit-${categoryId}`).remove();
                        alert(response.message);
                    } else {
                        alert("Failed to delete unit.");
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert("Error deleting unit.");
                },
            });
        }
    });
});
