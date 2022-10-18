import './bootstrap';

$(document).ready(function () {
    let form = $('#register-form').parsley();

    $("#submit-form").on("click", function () {

        form.validate();
        if (form.isValid()) {
            $('#register-form').submit();
        }
    });

    $("#profile").change(function () {
        previewFile(this, "#profile-preview");
        console.log("File changed");
    });
});

function previewFile(image, destination) {
    const file = $(image).get(0).files[0];

    if (file) {
        const reader = new FileReader();

        reader.onload = function () {
            $(destination).attr("src", reader.result);
        }

        reader.readAsDataURL(file);
    }
}
