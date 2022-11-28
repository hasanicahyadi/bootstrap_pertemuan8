<?php
require "../config.php";

if (isset($_POST['kirim'])) {

    $nama = htmlspecialchars($_POST['nama']);
    $email = htmlspecialchars($_POST['email']);
    $komentar = htmlspecialchars($_POST['komentar']);
    $sql = "INSERT INTO guestbook VALUES (DEFAULT, '$nama', '$email', '$komentar')";
    $query = mysqli_query($conn, $sql);
    header ('location: guestbook.php');
}

?>