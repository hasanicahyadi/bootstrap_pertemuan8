<?php
require "../functions.php";
include "../navbar.php";
$articleId = $_GET["article_id"];

$artikel = AmbilData("SELECT * FROM articles WHERE article_id=$articleId")[0];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- link bootstrap start-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous" defer></script>
    <!-- link bootstrap end-->
    <title><?= $artikel["title"] ?></title>
</head>
<body>
    <div class="card mx-auto" style="width: 600px;">
        <img src="../img/<?= $artikel["picture"] ?>" class="card-img-top" alt="">
        <div class="card-body">
            <h1><?= $artikel["title"] ?></h1>
            <p class="card-text"><?= $artikel["content"] ?></p>
        </div>
    </div>
</body>
</html>