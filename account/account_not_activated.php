<?php
require "../config.php";

// ambil data dengan username yang ada dalam session
$username = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
$dataUser = mysqli_fetch_assoc($query);

// cek role si username apa
switch ($dataUser["role"]){
  case "1":
    $role = "Member";
    break;
  case "2":
    $role = "Admin";
    break;
  case "3":
    $role = "Manager";
    break;
}
?>
<form action="proses_account.php" method="post">
  <input type="hidden" name="username_lama" value="<?= $dataUser["username"] ?>">
  <ul>
    <li>
      <label>Username: <input type="text" name="username_baru" value="<?= $dataUser["username"] ?>"></label>
    </li>
    <li>
      <label>Password Baru: <input type="password" name="password_baru"> (Optional)</label>
    </li>
    <li>
      <label>Nama: <input type="text" name="name" value="<?= $dataUser["name"] ?>"></label>
    </li>
    <li>
      <label>Role: <?= $role ?></label>
    </li>
    <li>
      <label>Status: Not Active</label>
    </li>
    <li>
      <button type="submit" name="submit">SUBMIT</button>
    </li>
  </ul>
</form>