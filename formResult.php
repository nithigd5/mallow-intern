<?php
if (empty($form)) {
    http_response_code(403);
    die("Don't Call this script.");
}
require_once "utilities.php";

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
<div class="jumbotron text-center">
    <h1>Students Data and Uploaded Profile Image</h1>
    <p1>Students details are displayed here and Images also displayed here</p1>
    <h5>Total Marks Scored:
        <?php $total = $form->formData["mark1"] + $form->formData["mark2"] + $form->formData["mark3"]
            + $form->formData["mark4"] + $form->formData["mark5"];
            echo $total;
        ?> out of 500</h5>
    <h5>Percentage Scored:
        <?php echo $total/500 * 100; ?>%</h5>
</div>

<div class="container">
    <div class="row">
        <div class="col">
            <table class="table table-striped h-100 table-hover table-dark">
                <thead>
                <tr class="table-primary">
                    <th>Name</th>
                    <th>Value</th>
                </tr>
                </thead>
                <tbody>
                <?php
                foreach ($form->formData as $key => $value) {
                    ?>
                    <tr>
                        <td><?= $key; ?></td>
                        <td><?= $value; ?></td>
                    </tr>
                    <?php
                }
                ?>
                </tbody>
            </table>
        </div>
        <div class="col">
            <img class="img-fluid rounded" src="<?= fileToUrl($form->formData['profile'] ?: ""); ?>"/>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8"
        crossorigin="anonymous"></script>
</body>
</html>
