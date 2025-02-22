$(document).ready(function () {
    // Delete profile picture with ajax
    $("#delete-picture-btn").click(function () {
        $.ajax({
            url: URL + "/profile/deletepicture",
            success: function (result) {
                $(".profile-picture").attr("src", result).fadeIn();
                $("#delete-picture-btn").hide();
                return true;
            },
        });
    });

    /*
     * jQuery validation settings
     */

    // Custom method to validate file size
    $.validator.addMethod(
        "filesize",
        function (value, element, param) {
            return (
                this.optional(element) ||
                element.files[0].size <= param * 1000000
            );
        },
        "File size must be less than {0} MB"
    );

    // Validate before updating profile
    $("#update-profile").validate({
        rules: {
            name: {
                required: true,
                minlength: 4,
            },
            image: {
                extension: "jpg,jpeg,png",
                filesize: 2,
            },
        },
        messages: {
            username: {
                required: "Please enter your name",
                minlength: "Your name must consist of at least 4 characters",
            },
            image: {
                extension: "Image should be of type jpg, jpeg or png",
            },
        },
    });
});
