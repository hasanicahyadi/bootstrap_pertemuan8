<style>
    #daftar-artikel {
    border-collapse: collapse;
    /* width: 100%; */
    }

    #daftar-artikel tr {
    border: 1px solid black;
    }

    #daftar-artikel td,
    th {
    padding: 0.5rem;
    }
    
    #daftar-artikel h3 {
        margin: 0;
    }
</style>

<?php
    require "functions.php";

    // maksimal menampilkan 5 daftar artikel dalam satu halaman
    $perpage = 5;

    // hitung jumlah artikel yang ada dalam database
    $sql = "SELECT `article_id` FROM articles";
    $query = mysqli_query($conn, $sql);
    $jumlah_post = mysqli_num_rows($query); 

    // ini intinya kalau angka page nya ga sesuai, kembali ke page 1
    if (!isset($_GET['page']) or ($_GET['page'] <0) or ($_GET['page'] > ceil ($jumlah_post/$perpage))){
        header("location: index.php?page=1");
    } else {
    $page = $_GET['page'];
    }

    $offset = ($page-1) * $perpage;

    $dataArtikel = AmbilData(
    "SELECT users.name, articles.article_id, articles.title, articles.content, 
    articles.picture, articles.created_at 
    FROM articles INNER JOIN users ON articles.user_id = users.user_id 
    ORDER BY articles.created_at DESC LIMIT $offset, $perpage
    ");


    $jumlahKataPadaJudul = 10;
    $jumlahKataPadaKonten = 20;
?>

<table id="daftar-artikel">
    <?php 
    foreach ($dataArtikel as $artikel) {
        // sesuaikan judul
        $judul = explode(" ", $artikel["title"]);
        if (count($judul) > $jumlahKataPadaJudul) {
            $judul = array_slice($judul, 0, $jumlahKataPadaJudul);
            $judul = join(" ", $judul);
            $judul .= "...";
        } else {
            $judul = join(" ", $judul);
        }

        // sesuaikan tanggal
        $tanggal = strtotime($artikel["created_at"]);
        $tanggal = date("d F, Y", $tanggal);

        // sesuaikan konten
        $konten = explode(" ", $artikel["content"]);
        $konten = array_slice($konten, 0, $jumlahKataPadaKonten);
        $konten = join(" ", $konten);
        $konten .= "...";


    ?>
    <tr>
        <td><img src="img/<?= $artikel["picture"] ?>" alt="" width="300"></td>
        <td>
            <a href="article/article.php?article_id=<?=$artikel["article_id"]?>">
                <h3><?= $judul ?></h3>
            </a>
            <br>
            <?= "$tanggal — $konten" ?>
            <br>
            By: <span class="text-primary"> <?= $artikel["name"] ?> </span> 
        </td>
    </tr>
    <?php } ?>
</table>

<nav aria-label="Page navigation example" class="mt-3">
  <ul class="pagination justify-content-center">
    <li class="page-item"><a class="page-link" href="?page=<?=$page - 1?>">Previous</a></li>
    <?php
        // ini kode untuk nomor halaman yang ada di bawah
        for ($i = 1; $i <= ceil ($jumlah_post/$perpage); $i++){ 
            if ($i == $page) {
                echo "<li class='page-item active'><a class='page-link' href='?page=$i'>$i</a></li>";
            }
            else {
                echo "<li class='page-item'><a class='page-link' href='?page=$i'>$i</a></li>";
            }     
        } 
    ?>
    <li class="page-item"><a class="page-link" href="?page=<?=$page + 1?>">Next</a></li>
  </ul>
</nav>
