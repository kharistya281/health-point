<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require 'function.php';

// ambil data produk
$produk = [];
$query = mysqli_query($conn, "SELECT * FROM produk JOIN kategori
ON produk.id_kat = kategori.id_kategori");
while ($record = mysqli_fetch_assoc($query)) {
    $produk[] = $record;
}

// ambil data kategori

$kategori = [];
$kat = mysqli_query($conn, "SELECT * FROM kategori");
while ($get = mysqli_fetch_assoc($kat)) {
    $kategori[] = $get;
}

// data produk berdasarkan kategori 

if (isset($_GET['id'])) {
    $id_kat = $_GET['id'];
} else {
    $id_kat = '';
}


$kat_produk = [];
$query = mysqli_query($conn, "SELECT * FROM produk JOIN kategori
ON produk.id_kat = kategori.id_kategori WHERE produk.id_kat = '$id_kat'");
while ($row = mysqli_fetch_assoc($query)) {
    $kat_produk[] = $row;
}
?>


<section class="produk" id="produk">
    <h1 class="judul">Produk Kami</h1>
    <div class="row">
        <div class="col-md-9">
            <div class="row">
                <?php if (isset($_GET['id'])): ?>
                    <?php foreach ($kat_produk as $key => $value): ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="assets/img/produk/<?= $value['foto_produk']; ?>" alt="">
                                <div class="card-body">
                                    <h5><?= $value['nama_produk'] ?></h5>
                                    <p>Rp <?= number_format($value['harga_produk']) ?></p>
                                    <div class="action d-flex justify-content-center">
                                        <?php if(isset($_SESSION['unameCust'])): ?>
                                            <a href="buy.php?id=<?= htmlspecialchars($value['id_produk'], ENT_QUOTES, 'UTF-8') ?>" class="btn btn-success me-2">
                                                <i class="bi bi-cart2"> Beli</i>
                                            </a>
                                        <?php else: ?>
                                            <a href="login.php" class="btn btn-success me-2">
                                                <i class="bi bi-cart2"> Beli</i>
                                            </a>
                                        <?php endif ?>
                                        <a href="detail_produk.php?id=<?= $value['id_produk'] ?>" class="btn btn-info">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php else: ?>
                    <?php foreach ($produk as $key => $prd) : ?>
                        <div class="col-md-4">
                            <div class="card">
                                <img src="assets/img/produk/<?= $prd['foto_produk']; ?>" alt="">
                                <div class="card-body">
                                    <h5><?= $prd['nama_produk'] ?></h5>
                                    <p>Rp <?= number_format($prd['harga_produk']) ?></p>
                                    <div class="action d-flex justify-content-center">
                                        <a href="buy.php?id=<?= $prd['id_produk'] ?>" class="btn btn-success me-2">
                                            <i class="bi bi-cart2"> Beli</i>
                                        </a>
                                        <a href="detail_produk.php?id=<?= $prd['id_produk'] ?>" class="btn btn-info">
                                            <i class="bi bi-eye"></i> Detail
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                <?php endif ?>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card">
                <div class="card-header">
                    <h4>Kategori Produk</h4>
                </div>
                <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                        <?php foreach ($kategori as $key => $value) : ?>
                            <li class="nav-item">
                                <a href="index.php?id=<?= $value['id_kategori'] ?>#produk" class="nav-link"><?= $value['nama_kategori']; ?></a>
                            </li>
                        <?php endforeach ?>
                        <li class="nav-item">
                            <a href="index.php#produk" class="nav-link">Semua produk</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>