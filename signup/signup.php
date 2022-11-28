<?php
require "proses_signup.php";
  if (isset($_POST["signup"])) {
    if (SignUp($_POST) === 1) {
      echo "<script>
      alert('Anda berhasil sign up!');
      document.location.href = '../login/login.php';
      </script>";
    }
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
  <title>Sign Up</title>
</head>
<body class="text-center">
  <?php include "../navbar.php" ?>
  <div class="container">
    <div class="row justify-content-center">
      <div class="col-4">
        <div class="form-signin">
          <form action="" method="post">
            <img class="mb-4" src="https://getbootstrap.com/docs/5.2/assets/brand/bootstrap-logo.svg" alt="" width="72" height="57">
            <h1 class="h3 mb-3 fw-normal">Please sign up</h1>
            <!-- username -->
            <div class="form-floating">
              <input type="text" class="form-control" id="floatingInput" name="username" required>
              <label for="floatingInput">Username</label>
            </div>
            <!-- password -->
            <div class="form-floating mt-3">
              <input type="password" class="form-control" id="floatingPassword" name="password" required>
              <label for="floatingPassword">Password</label>
            </div>
            <!-- konfirmasi password -->
            <div class="form-floating mt-3">
              <input type="password" class="form-control" id="floatingPassword" name="password2" required>
              <label for="floatingPassword">Konfirmasi Password</label>
            </div>
            <!-- nama lengkap -->
            <div class="form-floating mt-3">
              <input type="text" class="form-control" id="floatingPassword" name="nama" required>
              <label for="floatingPassword">Nama Lengkap</label>
            </div>
            <button class="w-100 mt-3 btn btn-lg btn-primary" type="submit" name="signup">Sign Up</button>
          </form>
        <p>Sudah punya akun? <a href="../login/login.php">Login</a> di sini!</p>
        </div>  
      </div>
    </div>
  </div>
  <?php include "../footer.php" ?>
</body>
</html>