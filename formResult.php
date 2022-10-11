<?php
//if (empty($form)) {
//    http_response_code(403);
//    die("Don't Call this script.");
//}
require_once "Database/students/Database.php";
require_once "Database/students/MarksEntity.php";
require_once "Database/students/UserEntity.php";

use students\Database;
use students\MarksEntity;
use students\UserEntity;

try {
    $userEntity = new UserEntity(Database::getINSTANCE());
    $marksEntity = new MarksEntity(Database::getINSTANCE());
    $allUserDetails = $userEntity->getAll();
    $allMarksDetails = $marksEntity->getAll();
} catch (Exception $e) {
    $error = "Error Connecting PLease try again";
    http_response_code(503);
    die($error);
}
require_once "helpers/utilities.php";

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Form Result</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
<div class="container-fluid">
    <h2 class="text-bg-danger text-center">
        <?php if(!empty($error)) echo $error; ?>
    </h2>
</div>
<div class="jumbotron text-center">
    <h1>Students Data and Uploaded Profile Image</h1>
    <p1 class="lead">Students details are displayed here and Images also displayed here</p1>
    <?php if (isset($form)): ?>
        <h4 class="text-success">Total Marks Scored:
            <?php $total = $form->formData["mark1"] + $form->formData["mark2"] + $form->formData["mark3"]
                + $form->formData["mark4"] + $form->formData["mark5"];
            echo $total;
            ?> out of 500</h4>
        <h4 class="text-success">Percentage Scored:
            <?php echo $total / 500 * 100; ?>%</h4>
    <?php endif ?>
</div>

<div class="container">
    <table class="table table-striped h-100 table-hover table-dark">
        <thead>
        <tr class="table-primary">
            <th>USER ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Date Of Birth</th>
            <th>Phone</th>
            <th>Address</th>
            <th>Gender</th>
            <th>Profile Picture</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($allUserDetails as $user) {
            ?>
            <tr>
                <td><?= $user->id; ?></td>
                <td><?= $user->name; ?></td>
                <td><?= $user->email; ?></td>
                <td><?= $user->date_of_birth; ?></td>
                <td><?= $user->phone; ?></td>
                <td><?= $user->address; ?></td>
                <td><?= $user->gender; ?></td>
                <td><img alt="Profile Image" class="img-fluid rounded" width="100px" src="<?= fileToUrl($user->profile); ?>"/></td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
    <h2>Students Marks</h2>
    <table class="table table-striped h-100 table-hover table-dark">
        <thead>
        <tr class="table-primary">
            <th>USER ID</th>
            <th>MARK ID</th>
            <th>Mark 1</th>
            <th>Mark 2</th>
            <th>Mark 3</th>
            <th>Mark 4</th>
            <th>Mark 5</th>
            <th>Average</th>
            <th>Percentage</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($allMarksDetails as $mark) {
            $average = $mark->mark1 + $mark->mark2 + $mark->mark3 + $mark->mark4 + $mark->mark5;
            $percentage = ($average / 500) * 100;
            $average /= 5;
            ?>
            <tr>
                <td><?= $mark->user_id; ?></td>
                <td><?= $mark->id; ?></td>
                <td><?= $mark->mark1; ?></td>
                <td><?= $mark->mark2; ?></td>
                <td><?= $mark->mark3; ?></td>
                <td><?= $mark->mark4; ?></td>
                <td><?= $mark->mark5; ?></td>
                <td><?= $average; ?></td>
                <td><?= $percentage; ?>%</td>
            </tr>
            <?php
        }
        ?>
        </tbody>
    </table>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>
