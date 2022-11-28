<?php
// cek apakah di halaman sudah ada session_start(),
// kalau belum, jalankan session.
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// sesuaikan $mainFolder dengan folder kalian di mana
$mainFolder = "/Sisfo/bootstrap_pertemuan8";
?>

<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="<?=$mainFolder?>/index.php">WEB ARTIKEL</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="navbar-nav">
        <a class="nav-link active" href="<?=$mainFolder?>/index.php">HALAMAN UTAMA</a> 
        <a class="nav-link" href="<?=$mainFolder?>/account/account.php">AKUN</a> 
        <a class="nav-link" href="<?=$mainFolder?>/guestbook/guestbook.php">BUKU TAMU</a> 

        <?php
          /* cek apakah user sekarang tamu atau user yang sudah login.
            user yang sudah login tidak perlu link login lagi. 
            sebaliknya tamu belum pernah login maka tidak perlu link logout.
          */

          // jika user, maka munculkan link logout.
          if (isset($_SESSION["username"])) {
        ?>
          <a class="nav-link" href="<?=$mainFolder?>/logout.php">LOGOUT</a> 

        <?php 
          // jika tamu, munculkan link login.
          } else { 
        ?>
          <a class="nav-link" href="<?=$mainFolder?>/login/login.php">LOGIN</a> 
        <?php 
          } 
        ?>
      </div>
    </div>
  </div>
</nav>