<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../public/bootstrap/css/bootstrap.css" />
    <link rel="stylesheet" href="../public/scss/core.css?v=<?php echo time() ?>" />
    <title>Document</title>
</head>

<body>

    <?php require 'components/nav.php' ?>

    <div class="content-container" style="margin-top: 50px;">
        <?= $params["content"] ?>
    </div>

    <script type="text/javascript" src="../public/bootstrap/js/bootstrap.js"></script>
</body>

</html>