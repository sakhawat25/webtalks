$(document).ready(function () {
    // Show and hide password
    $("#showpassword").click(function () {
        const inputBox = $("#password");
        const type = inputBox.attr("type");

        if (type === "password") {
            inputBox.attr("type", "text");
        } else {
            inputBox.attr("type", "password");
        }
    });

    // Set focus on first element of the page
    $(".first-element").focus();
});
