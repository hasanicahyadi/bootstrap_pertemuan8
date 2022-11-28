<?php
session_start();

// Tamu tidak boleh masuk ke halaman ini. 
// jadi jika tidak ada variabel session username, kembalikan ke login.php
if (!isset($_SESSION["username"])) {
  header("location: ../login/login.php");
}

$status = $_SESSION["status"];

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
  <title>Akun</title>
</head>
<body>

<?php
  include "../navbar.php";

  // cek status akun user apa
  switch ($status) {
    // 0 = status akun belum aktif
    case "0":
      include "account_not_activated.php";
      break;

    // 1 = status akun aktif
    case "1":
      include "account_activated.php";
      break;
  }

  include "../footer.php";
?>
</body>
</html>