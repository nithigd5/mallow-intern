$(document).ready(function () {
    //Comment this to see php validation
    let form = $('#register-form').parsley();

    $("#submit-form").on("click", function () {
        // $('#register-form').submit();

        form.validate();
        if (form.isValid()) {
            $("#confirm")[0].style.display = "block";
        }
    });

    $("#profile").change(function () {
        previewFile(this, "#profile-preview");
        console.log("File changed");
    });


    $("#close").on("click", () => {
        $("#confirm")[0].style.display = "none";
    })

    $("#ok").on("click", () => {
        $("#confirm")[0].style.display = "none";
        alert("success");
        $('#register-form').submit();
    })

    $("#no").on("click", () => {
        $("#confirm")[0].style.display = "none";
    })
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
