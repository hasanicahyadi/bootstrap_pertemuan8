<?php
require "../config.php";
session_start();
// login start
function Login($data) {
  global $conn;
  $username = $data["username"];
  $password = $data["password"];

  $cekUsername = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");

  // === 0 artinya tidak ada data pada tabel users dengan username yg diinput user
  if (mysqli_num_rows($cekUsername) === 0) {
    return false;
  }

  // ambil password user
  $dataUser = mysqli_fetch_assoc($cekUsername);
  $passwordDatabase = $dataUser["password"];

  // cek password yang diinput user sudah sesuai atau tidak
  if (!password_verify($password, $passwordDatabase)) {
      return false;
  }

  // $role = mysqli_fetch_assoc($cekUsername)["role"];
  $_SESSION["username"] = $username;
  $_SESSION["role"] = $dataUser["role"];
  $_SESSION["status"] = $dataUser["status"];
  return true;
}
// login end

?>