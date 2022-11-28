<?php
  session_start();
  require "../config.php";

  $usernameLama = htmlspecialchars($_POST["username_lama"]);
  $usernameBaru = htmlspecialchars($_POST["username_baru"]);
  $passwordBaru = htmlspecialchars($_POST["password_baru"]);
  $name = $_POST["name"];

  // jalankan isi if ini hanya jika isi username berubah
  // cara baca: jika isi usernameBaru tidak sama dengan isi usernameLama, maka...
  if ($usernameBaru !== $usernameLama) {
    $cekUsername = mysqli_query($conn, "SELECT * FROM users WHERE username='$usernameBaru'");
    
    // kalau username sudah ada, tidak jadi ganti username & kembali ke account.php
    if (mysqli_num_rows($cekUsername) === 1) {
          echo "<script>
          alert('Username sudah ada!');
          document.location.href = 'account.php';
          </script>";
          die;
    }
  }

  // kode ini hanya jalan jika usernameBaru belum ada di database
  $query = "UPDATE users SET username='$usernameBaru', name='$name' WHERE username='$usernameLama'";
  mysqli_query($conn, $query);


  // jalankan isi if ini hanya input password ada isinya
  // cara baca: jika variabel $passwordBaru isinya TIDAK KOSONG, maka...
  if (!empty($passwordBaru)) {
    // acak passwordnya
    $passwordBaru = password_hash($passwordBaru, PASSWORD_DEFAULT);
    $passwordBaru = mysqli_real_escape_string($conn, $passwordBaru);

    // update isi password baru ke tabel users
    $query = "UPDATE users SET password='$passwordBaru' WHERE username='$usernameBaru'";
    mysqli_query($conn, $query);
  }

  if (mysqli_affected_rows($conn) >= 0) {
    $_SESSION["username"] = $usernameBaru;
    echo "<script>
          alert('Data berhasil diubah!');
          document.location.href = 'account.php';
          </script>";
  }
?>