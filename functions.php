<?php
require "config.php";

// ambil data start
function AmbilData($query) {
  global $conn;
  $req = mysqli_query($conn, $query);

  $dataHasil = [];
  
  while ($hasil = mysqli_fetch_assoc($req)) {
    $dataHasil[]= $hasil;
  }
  return $dataHasil;
}
// ambil data end

// Upload Gambar start
function UploadGambar($data) {
  $namaFile = $data["gambar"]["name"];
  $tmpName = $data["gambar"]["tmp_name"];
  $ukuranFile = $data["gambar"]["size"];

  // cek tipe file start
  $ekstensiGambar = explode(".", $namaFile);
  $ekstensiGambar = strtolower(end($ekstensiGambar));
  if (!in_array($ekstensiGambar, ["jpg", "jpeg", "png"])) {
    echo "<script>alert('Bukan File Gambar!');</script>";
    return false;
  }
  // cek tipe file end

  // cek ukuran start
  $batasUkuran = 2097152; //batas 2 mb
  if ($ukuranFile > $batasUkuran) {
    echo "<script>alert('Ukuran Terlalu Besar!');</script>";
    return false;
  }
  // cek ukuran end

  // upload file start
  $namaFileBaru = uniqid() . "." . $ekstensiGambar;
  move_uploaded_file($tmpName, "../img/$namaFileBaru");
  // upload file end

  return $namaFileBaru;
}
// Upload Gambar end

// tambah data start
  function TambahData($data) {
    global $conn;

    $userId = $data["userId"];
    $judul = htmlspecialchars($data["judul"]);
    $isi = htmlspecialchars($data["isi"]);
    $gambar = UploadGambar($_FILES);

    if (!$gambar) {
      echo "<script>document.location.href = 'add_article.php';</script>";
      return;
    }

    $query = "INSERT INTO articles VALUES 
    (DEFAULT, '$userId', '$judul', '$isi', '$gambar', DEFAULT)";

    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) === 1) {
      echo "✅ Data Berhasil Ditambahkan!";
      echo "<br>";
    } else {
      echo "❌ Data Gagal Ditambahkan!";
      echo mysqli_error($conn);
      echo "<br>";
    }
  }
// tambah data end

// hapus data start
  function HapusData($id) {
    global $conn;
    $namaGambar = AmbilData("SELECT picture FROM articles WHERE article_id=$id")[0]["picture"];

    $query = "DELETE FROM articles WHERE article_id=$id";

    mysqli_query($conn, $query);

    unlink("../img/$namaGambar");

    if (mysqli_affected_rows($conn) === 1) {
      echo "<script>
        alert('✅ Data Berhasil Dihapus!');
        document.location.href = '../account/account.php';
      </script>";
    } else {
      echo "<script>
        alert('❌ Data Gagal Dihapus!');
        document.location.href = '../account/account.php';
      </script>";
    }
  }
// hapus data end

// edit data start
  function EditData($data) {
    global $conn;
    $id = $data["article_id"];
    $judul = htmlspecialchars($data["judul"]);
    $isi = htmlspecialchars($data["isi"]);
    $gambarLama = $data["gambar-lama"];

    if ($_FILES["gambar"]["error"] === 4) {
      $gambar = $gambarLama;
    } else {
      $gambar = UploadGambar($_FILES);
    }

    if (!$gambar) {
      echo "<script>document.location.href = 'edit.php?id=$id';</script>";
      return;
    }


    // $query = "UPDATE mahasiswa SET nama='$nama', npm='$npm', gambar='$gambar' WHERE id=$id";
    $query = "UPDATE articles SET title='$judul', content='$isi', picture='$gambar' 
              WHERE article_id=$id";
    mysqli_query($conn, $query);

    if (mysqli_affected_rows($conn) === 1) {
      echo "✅ Data Berhasil Diubah!";
      echo "<br>";
    } else {
      echo "❌ Data Gagal Diubah!";
      echo "<br>";
    }
  }
// edit data end

?>