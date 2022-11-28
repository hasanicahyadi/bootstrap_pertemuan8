<?php
  require "../functions.php";
  session_start();

  // tamu tidak boleh masuk ke halaman ini
  if (!isset($_SESSION["username"])) {
    header("location: ..login//login.php");
  }

  // ambil id dari username
  $username = $_SESSION["username"];
  $query = mysqli_query($conn, "SELECT user_id FROM users WHERE username='$username'");
  $userId = mysqli_fetch_assoc($query)["user_id"];

  // lakukan ini kalau user tekan submit
  if (isset($_POST["submit"])) {
    TambahData($_POST);
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
  <title>Tambah Artikel</title>
</head>
<body>
  <?php include "../navbar.php" ?>
  <h1>Tambah Artikel</h1>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-8">
        <form action="" method="post" enctype="multipart/form-data">
          <input type="hidden" name="userId" value="<?= $userId ?>">
          <!-- Judul Artikel Start -->
            <div class="mb-3">
              <label for="floatingInput">Judul</label>
              <input type="text" class="form-control" id="floatingInput" name="judul" required>
            </div>
          <!-- Judul Artikel End -->

          <div class="mb-3">
            <!-- Isi Artikel Start -->
              <label for="floatingTextarea">Isi Artikel</label>
              <textarea name="isi" class="form-control" id="floatingTextarea" style="height: 250px"></textarea>
            <!-- Isi Artikel End -->
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