<?php
  session_start();
  require "../functions.php";
  // ambil id dari username
  $username = $_SESSION["username"];
  $query = mysqli_query($conn, "SELECT user_id FROM users WHERE username='$username'");
  $userId = mysqli_fetch_assoc($query)["user_id"];

  // ambil data artikel berdasarkan article_id
  $articleId = $_GET["article_id"];
  $dataArtikel = AmbilData("SELECT * FROM articles WHERE article_id='$articleId'")[0];

  // kalau user tekan submit,
  if (isset($_POST["submit"])) {
    EditData($_POST);
    $dataArtikel = AmbilData("SELECT * FROM articles WHERE article_id='$articleId'")[0];
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
  <title>Edit Artikel</title>
</head>
<body>
  <?php include "../navbar.php" ?>
  <h1>Edit Artikel</h1>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-8">
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="article_id" value="<?= $articleId ?>">
          <input type="hidden" name="gambar-lama" value="<?= $dataArtikel["picture"] ?>">
          <!-- Judul Artikel Start -->
            <div class="mb-3">
              <label for="floatingInput">Judul</label>
              <input type="text" value="<?= $dataArtikel["title"] ?>"  class="form-control" id="floatingInput" name="judul" required>
            </div>
          <!-- Judul Artikel End -->

          <div class="mb-3">
            <!-- Isi Artikel Start -->
              <label for="floatingTextarea">Isi Artikel</label>
              <textarea name="isi" class="form-control" id="floatingTextarea" style="height: 250px">
              <?=$dataArtikel["content"]?>
              </textarea>
            <!-- Isi Artikel End -->
          </div>
      
          <div class="text-center mb-3">
             <img src="../img/<?= $dataArtikel["picture"] ?>" alt="artikel" width="200">
          </div>
          <!-- input gambar start -->
            <label for="formFile">Gambar</label>
            <input class="form-control" type="file" name="gambar" id="formFile">
          <!-- input gambar end -->

          <button class="w-100 mt-3 btn btn-lg btn-primary" type="submit" name="submit">Submit</button>

        </form>
      </div>
    </div>
  </div>
</body>

</html>