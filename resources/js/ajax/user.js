$(document).ready(function () {
    let baseUrl = $("meta[name='store-users-route']").attr("content");

    $('#editUserForm').on('submit', function(e) {
        e.preventDefault();

        let userId = $('#editUserId').val();
        $.ajax({
            url: `${baseUrl}/${userId}`,
            method: 'PUT',
            data: $(this).serialize(),
            success: function(response) {
                alert(response.success);
                location.reload(); // Reload the page to see the updated category
            },
            error: function(response) {
                alert(response);
            }
        });
    });


    $(document).on("click", ".delete-user", function () {
        let userId = $(this).data("id");
        let url = `${baseUrl}/${userId}`;

        if (confirm("Are you sure you want to delete this unit?")) {
            $.ajax({
                url: url,
                type: "DELETE",
                data: {
                    _token: $('meta[name="csrf-token"]').attr("content"),
                },
                success: function (response) {
                    if (response.success === "deleted") {
                        $(`#user-${userId}`).remove();
                        alert(response.message);
                    } else {
                        alert("Failed to delete unit.");
                    }
                },
                error: function (xhr) {
                    console.log(xhr.responseText);
                    alert("Error deleting user.");
                },
            });
        }
    });
});
