<!-- kite punye -->
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
    <title>Guestbook</title>
</head>
<body>
    <?php include "../navbar.php" ?>
    <!-- FORM UNTUK KOMENTAR -->
    <div class="card mx-auto mb-3" style="width: 600px;">
        <div class="card-body">
            <form action="proses_guestbook.php" method="post">
                <div>
                    <div class="mb-3">
                        <label for="floatingInput">Nama</label>
                        <input type="text" class="form-control" id="floatingInput" name="nama" required>
                    </div>
                    <div class="mb-3">
                        <label for="floatingInput">Email</label>
                        <input type="email" class="form-control" id="floatingInput" name="email" required>
                    </div>
                <div class="mb-3">
                    <label for="floatingTextarea">Komentar</label>
                    <textarea name="komentar" class="form-control" id="floatingTextarea"></textarea>
                </div>
                <button class="mb-3 w-100 mt-3 btn btn-lg btn-primary" type="submit" name="kirim">Submit</button>
                </div>
        
            </form>
        </div>

    </div>

    <?php
        // AMBIL CONFIG UNTUK KONEKSI SQL
        require "../config.php";
        // BATAS JUMLAH KOMENTAR PER PAGE
        $perpage = 5;
        // HITUNG JUMLAH DATA DI DATABASE
        $sql = "SELECT `no` FROM guestbook";
        $query = mysqli_query($conn, $sql);
        $jumlah_post = mysqli_num_rows($query); 
        
        // BUAT PAGE = 1 (HALAMAN PERTAMA) JIKA DATA PAGE TIDAK SESUAI,
        //  MISALNYA DATA PAGE GA ADA, ATAU PAGE < 0, ATAU PAGE > JUMLAH POST
        if (!isset($_GET['page']) or ($_GET['page'] <0) or ($_GET['page'] > $jumlah_post)){
            $page =1;
        } else {
            $page = $_GET['page'];
        }

        // JUMLAH DATA YANG AKAN DIAMBIL DARI DATABASE
        $offset = ($page-1) * $perpage;

        // AMBIL DATA DARI DATABASE SEJUMLAH OFFSET, DITULISKAN SEJUMLAH PERPAGE, 
        // DIURUTKAN DARI YANG TERBARU
        $sql = "SELECT * FROM guestbook ORDER BY `no` DESC LIMIT $offset, $perpage";
        $query = mysqli_query($conn, $sql);

        ?>
        <h3>Komentar</h3>
        <ul class="list-group">
            <?php
            // LAKUKAN PENGULANGAN SELAGI DATA MASIH ADA
            while ($data = mysqli_fetch_assoc($query)){ 
                // DATA DIPISAH KE BEBERAPA VARIABEL
                $nama = $data['name'];
                $email = $data['email'];
                $komentar = $data['comment'];
            ?>
            <li class="list-group-item">
                Dari: <?= $nama ?> (<?= $email ?>)
                <br>
                Komentar: <?= $komentar ?>
            </li>

            <?php } ?> 
        </ul>

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
    <?php include "../footer.php" ?>
</body>
</html>