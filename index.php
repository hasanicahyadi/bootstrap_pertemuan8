<?php
  session_start();
  $username = "Tamu";
  if (isset($_SESSION["username"])) {
    $username = $_SESSION["username"];
  }
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
  <title>Halaman Utama</title>
</head>
<body>
  <?php include "navbar.php" ?>
  <h1 class="ms-3">Halaman Utama</h1>
  <div class="alert alert-primary" role="alert">
    <h2>Halo <?= $username ?> !</h2>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-8">
        <?php include "article/daftar_article.php" ?>
      </div>
      <div class="col-4">
        <?php include "sidebar.php" ?>
      </div>
    </div>
  </div>
  <?php include "footer.php" ?>

  
  

</body>
</html>