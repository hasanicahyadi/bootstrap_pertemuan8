<?php
  require "../functions.php";

  $username = $_SESSION["username"];

  // ambil data dengan username ini
  $query = mysqli_query($conn, "SELECT * FROM users WHERE username='$username'");
  $dataUser = mysqli_fetch_assoc($query);

  // cek role nya apa
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

  // ambil id dari username
  $username = $_SESSION["username"];
  $query = mysqli_query($conn, "SELECT user_id FROM users WHERE username='$username'");
  $userId = mysqli_fetch_assoc($query)["user_id"];

  // ambil data seluruh artikel yang sudah dibuat user
  $dataArtikel = AmbilData("SELECT * FROM articles WHERE user_id='$userId'");

  // var_dump($dataArtikel);

  $nomor = 1;
?>

<a class="btn btn-primary ms-3" href="../article/add_article.php" role="button">ARTIKEL BARU</a>
<div class="container-fluid text-center">
  <div class="row justify-content-center">
    <div class="col-5">
      <!-- data-data user -->
        <ul class="list-group w-auto">
          <li class="list-group-item">
            <label>Username: <?= $dataUser["username"] ?></label>
          </li>
          <li class="list-group-item">
            <label>Nama: <?= $dataUser["name"] ?></label>
          </li>
          <li class="list-group-item">
            <label>Role: <?= $role ?></label>
          </li>
          <li class="list-group-item">
            <label>Status: Active</label>
          </li>
        </ul>

    </div>
  </div>
  <div class="row justify-content-center mt-3">
    <div class="col-8">
      <!-- daftar artikel yang dibuat user ini -->
      <!-- Tampilkan hanya jika user sudah pernah buat artikel sebelumnya -->
      <?php if ($dataArtikel) { ?>
        <table class="table table-bordered">
          <thead class="table-light">
            <tr>
              <th>No.</th>
              <th>Judul</th>
              <th>Gambar</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($dataArtikel as $artikel) { ?>
              <tr>
                <td><?= $nomor ?></td>
                <td><?= $artikel["title"] ?></td>
                <td>
                  <img src="../img/<?= $artikel["picture"] ?>" alt="artikel" width="100">
                </td>
                <td>
                  <a href="../article/edit_article.php?article_id=<?= $artikel["article_id"] ?>">EDIT</a>
                  |
                  <a href="../article/delete_article.php?article_id=<?= $artikel["article_id"] ?>">HAPUS</a>
                </td>
              </tr>
              <?php $nomor++; ?>
            <?php } ?>
          </tbody>
        </table>
      <?php } ?>
    </div>
  </div>
</div>
