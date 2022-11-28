<?php
require "../config.php";

  // signup start
function SignUp($data) {
  global $conn;
  $username = $data["username"];
  $password = $data["password"];
  $password2 = $data["password2"];
  $nama = $data["nama"];

  // role = 1 karena user baru harus user, tidak boleh langsung admin
  $role = 1;

  // status = 0 karena user baru harus otomatis not active
  $status = 0;

  // cek apakah username sudah ada
  $cekUsername = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

  // === 1 berarti username yang diinput sudah ada , jadi tidak boleh dipakai
  if (mysqli_num_rows($cekUsername) === 1) {
    echo "<script>
          alert('Username sudah ada!');
          </script>";
    return false;
  }

  // cek password sudah sesuai belum dengan konfirmasinya (password2)
  if ($password !== $password2) {
    echo "<script>
      alert('Konfirmasi password belum sesuai!');
    </script>";
    return false;
  }

  // insert data user ke tabel users

  // acak password dan escape supaya aman masuk ke database
  $password = password_hash($password, PASSWORD_DEFAULT);
  $password = mysqli_real_escape_string($conn, $password);

  $query = "INSERT INTO users VALUES (
    DEFAULT, '$username', '$password', '$nama', '$role', '$status', DEFAULT)";

  mysqli_query($conn, $query);

  return mysqli_affected_rows($conn);

}
// signup end

?>