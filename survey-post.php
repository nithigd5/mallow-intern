<?php

use students\Database;
use students\MarksEntity;
use students\UserEntity;

if ($_SERVER["REQUEST_METHOD"] != "POST") {
    http_response_code(401);
    die("Call me from POST Request");
}

require_once "helpers/Validator.php";
require_once "models/UserDetails.php";
require_once "models/marksDetails.php";
require_once 'helpers/DatabaseFormHelper.php';

$survey_form_rules = array(
    new ValidationRule("name" , "string" , 3 , 100) ,
    new ValidationRule("mobile" , "int" , pattern: '/^((\+91)?|91)?[6789][0-9]{9}/' , isRequired: true) ,
    new ValidationRule("dob" , "date") ,
    new ValidationRule("email" , "email" , isRequired: true) ,
    new ValidationRule("address" , "string" , 10 , 500 , isRequired: true) ,
    new ValidationRule("profile" , "file" , isRequired: true) ,
    new ValidationRule("mark1" , "int" , 0 , 100 , isRequired: true) ,
    new ValidationRule("mark2" , "int" , 0 , 100 , isRequired: true) ,
    new ValidationRule("mark3" , "int" , 0 , 100 , isRequired: true) ,
    new ValidationRule("mark4" , "int" , 0 , 100 , isRequired: true) ,
    new ValidationRule("mark5" , "int" , 0 , 100 , isRequired: true) ,
);

$form = new FormValidator($_POST , $_FILES);
$form->validate(...$survey_form_rules);
$errors = $form->errors;

if ($form->isValid) {
    $userDetails = UserDetails::fromForm($form->formData);
    $marksDetails = MarksDetails::fromForm($form->formData);
    if (
        !DatabaseFormHelper::uploadForm($userDetails , $marksDetails)
    ) {
        $error = DatabaseFormHelper::$error;
    }
}