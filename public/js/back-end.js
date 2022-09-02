$(document).ready(function () {
    let tableObject = $(".table").DataTable({
        sorting: false,
        sDom: "ltipr", // Remove searchbox
        bInfo: false, // Remove info area at bottom
        lengthChange: false, // Remove length dropdown at top
    });

    $("#searchbox").keyup(function () {
        tableObject.search($(this).val()).draw();
    });

    // Show Message info in a modal dialog box
    $("#viewMessageModal").on("show.bs.modal", (event) => {
        let message = $(event.relatedTarget).data("message");
        modalBody = $(this).find(".modal-body");
        // show loading spinner while waiting for ajax to be done
        modalBody.html(`
            <div class="text-center">
            <div class="spinner-border" role="status">
                <span class="sr-only">Loading...</span>
            </div>
            </div>
        `);

        $.ajax({
            url: `/admin/messages/${message}`, // the url for your show method
            method: "get",
        })
            .done((view) => modalBody.html(view))
            .fail((error) => console.error(error));
    });

    // Confirm delete
    $("#deleteForm").submit(function (event) {
        event.preventDefault();

        swal({
            title: "Confirm Delete",
            text: "Are you sure to delete this record?",
            icon: "warning",
            buttons: [true, "Delete"], // Set buttons text e.g: cancel, delete
            dangerMode: true,
        }).then((willDelete) => {
            if (willDelete) {
                // Proceed with delete process
                $(this).off("submit").submit();
                return true;
            } else {
                // Stop form from being submitted
                return false;
            }
        });
    });
});
