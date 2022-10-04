<?php
!!session_start();

$errors = [];
$form = FormValidator::class;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once "surveypost.php";
    if ($form->isValid) {
        require_once "formResult.php";
        exit;
    }
}

function getError($name)
{
    global $errors;
    if (!isset($errors[$name]))
        return "";
    else return
        $errors[$name];
}

function getValue($name)
{
    global $form;
    if (!isset($form)) return "";
    if (empty($form->formData[$name]) && $form->formData[$name] != 0) return "";
    return $form->formData[$name];
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>User Registration</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ=" crossorigin="anonymous">
    </script>
    <script src="assets/script.js"></script>
    <link rel="stylesheet" href="assets/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Mono&family=Open+Sans&family=Roboto&display=swap"
          rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <script src="assets/parsley.min.js"></script>
</head>

<body>
<div class="container">
    <h2 class="title">Register Form</h2>
    <form action="Register.php" id="register-form" class="form" method="post" enctype="multipart/form-data">
        <div class="form-field">
            <label class="input-title" for="name">Name</label>
            <input type="text" name="name" id="name" placeholder="Name" class="form-input" Minlength="3" Maxlength="100"
                   value="<?= getValue("name"); ?>"
                   required>
            <label class="error"><?= getError("name"); ?></label>
        </div>

        <fieldset class="form-group">
            <div class="form-field">
                <label class="input-title" for="mobile">Mobile</label>
                <input type="tel" name="mobile" pattern="^((\+91)?|91)?[6789][0-9]{9}" placeholder="Mobile"
                       data-parsley-type="digits" class="form-input" id="mobile" value="<?= getValue("mobile"); ?>"
                       required>
                <label class="error"><?= getError("mobile"); ?></label>
            </div>
            <div class="form-field">
                <label class="input-title" for="dob">Date Of Birth</label>
                <input type="date" name="dob" id="dob" class="form-input" value="<?= getValue("dob"); ?>" required>
                <label class="error"><?= getError("dob"); ?></label>
            </div>
        </fieldset>
        <div class="form-field">
            <label class="input-title" for="address">Address</label>
            <textarea Minlength="10" name="address" id="address" placeholder="Address" class="form-input"
                      rows="4" required><?= getValue("address"); ?></textarea>
            <label class="error"><?= getError("address"); ?></label>
        </div>
        <div class="form-field">
            <label class="input-title" for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= getValue("email"); ?>" placeholder="Email"
                   class="form-input" required>
            <label class="error"><?= getError("email"); ?></label>
        </div>
        <fieldset class="form-group">
            <div class="form-field form-image">
                <label class="input-title" for="profile">
                    <img src="assets/character_icons_4.png" alt="Your Profile Picture here" class="img"
                         id="profile-preview">
                </label>
                <input type="file" accept="image/*" name="profile" id="profile" class="form-input" required>
                <label class="error"><?= getError("profile"); ?></label>
            </div>
        </fieldset>

        <fieldset class="form-section">
            <h3 class="form-section-h">Please Enter your marks:</h3>
            <fieldset class="form-group">
                <div class="form-field">
                    <label class="input-title" for="mark1">Mark in Subject 1</label>
                    <input type="number" min="0" max="100" name="mark1" placeholder="Subject 1 Mark"
                           value="<?= getValue("mark1"); ?>" class="form-input"
                           id="mark1" data-parsley-type="number" required>
                    <label class="error"><?= getError("mark1"); ?></label>
                </div>
                <div class="form-field">
                    <label class="input-title" for="mark2">Mark in Subject 2</label>
                    <input type="number" min="0" max="100" name="mark2" placeholder="Subject 2 Mark" class="form-input"
                           value="<?= getValue("mark2"); ?>"
                           id="mark2" data-parsley-type="number" required>
                    <label class="error"><?= getError("mark2"); ?></label>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <div class="form-field">
                    <label class="input-title" for="mark3">Mark in Subject 3</label>
                    <input type="number" min="0" max="100" name="mark3" placeholder="Subject 3 Mark" class="form-input"
                           value="<?= getValue("mark3"); ?>"
                           id="mark3" data-parsley-type="number" required>
                    <label class="error"><?= getError("mark3"); ?></label>
                </div>
                <div class="form-field">
                    <label class="input-title" for="mark4">Mark in Subject 4</label>
                    <input type="number" min="0" max="100" name="mark4" placeholder="Subject 4 Mark" class="form-input"
                           value="<?= getValue("mark4"); ?>"
                           id="mark4" data-parsley-type="number" required>
                    <label class="error"><?= getError("mark4"); ?></label>
                </div>
            </fieldset>
            <fieldset class="form-group">
                <div class="form-field">
                    <label class="input-title" for="mark5">Mark in Subject 5</label>
                    <input type="number" min="0" max="100" name="mark5" placeholder="Subject 5 Mark" class="form-input"
                           value="<?= getValue("mark5"); ?>"
                           id="mark5" data-parsley-type="number" required>
                    <label class="error"><?= getError("mark5"); ?></label>
                </div>
            </fieldset>
        </fieldset>
        <input type="button" id="submit-form" class="sbtn" value="submit">
    </form>
</div>

<div id="confirm" class="modal">
    <div class="modal-content">
        <span id="close" class="close">&times;</span>
        <p>Do you want to submit the form?</p>
        <button class="sbtn" id="ok" type="button">Yes</button>
        <button class="sbtn" id="no" type="button">No</button>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.min.js"
        integrity="sha384-IDwe1+LCz02ROU9k972gdyvl+AESN10+x7tBKgc9I5HFtuNz0wWnPclzo6p9vxnk"
        crossorigin="anonymous"></script>
</body>
</html>
