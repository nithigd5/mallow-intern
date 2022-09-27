let surveyFormRules = {
    name: {
        minLength: 3,
        maxLength: 100,
        required: true,
        pattern: /[a-zA-Z_]*/,
    },
    mobile: {
        minLength: 10,
        maxLength: 10,
        required: true,
        pattern: /[6-9][0-9]{9}/
    },
    email: {
        minLength: 5,
        maxLength: 50,
        required: true,
        pattern: /^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/
    },
    address: {
        required: true,
        minLength: 20,
        maxLength: 200
    },
    dob: {
        required: true,
    },
    profile: {
        required: true
    },
    mark1: {
        required: true,
        minLength: 0,
        maxLength: 100,
        dataType: "number"
    },
    mark2: {
        required: true,
        minLength: 0,
        maxLength: 100,
        dataType: "number"
    },
    mark3: {
        required: true,
        minLength: 0,
        maxLength: 100,
        dataType: "number"
    },
    mark4: {
        required: true,
        minLength: 0,
        maxLength: 100,
        dataType: "number"
    },
    mark5: {
        required: true,
        minLength: 0,
        maxLength: 100,
        dataType: "number"
    }
}


let surveyFormMessages = {
    name: {
        message: "Please Enter Valid Name",
        length: "Atleast 3 Characters and max 20"
    },
    email: {
        message: "Required Valid Email Address",
        missing: "Please provide it."
    },
    phone: {
        message: "Please Enteer a valid Phone Number",
    },
    dob: {
        message: "Please enter a valid Date of Birth"
    },
    address: {
        message: "Please enter your valid address",
        length: "We need your full address"
    },
    profile: {
        message: "Valid Profile Image Needed"
    },

}

$(document).ready(function () {
    $("#register-form").on('submit', function (e) {
        e.preventDefault();
        var form = $(this);

        console.log("Submit triggered")
        form.parsley().validate();

        if (form.parsley().isValid()) {
            if (confirm('Do you want to submit the form')) {
                alert("success");
            }
        }
    });

    // addValidator($(".register-form"), surveyFormRules, surveyFormMessages, {
    //     errorMsg: ".error", showBorderInput: true,
    //     showFieldBorder: true, showConfirm: true
    // });
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