<?php
session_start();
require 'function.php';

$id_order = $_GET['id_order'];

// ambil data pesanan
$pesanan = [];
$query = mysqli_query($conn, "SELECT * FROM pesanan 
JOIN order_detail ON pesanan.id_order = order_detail.id_order
JOIN produk ON produk.id_produk = order_detail.id_produk
JOIN order_status ON order_status.id_status = pesanan.status
WHERE pesanan.id_order = '$id_order'");
while ($row = mysqli_fetch_assoc($query)) {
    $pesanan[] = $row;
}

$orderDate = $pesanan[0]['order_date'];
$bank = $pesanan[0]['pembayaran'];
$bayar = $pesanan[0]['metode_pembayaran'];

// ambil data customer
$cust = mysqli_query($conn, "SELECT * FROM customer WHERE uname_cust = '$_SESSION[unameCust]'");
$customer = mysqli_fetch_assoc($cust);

// ubah pembayaran 
if(isset($_POST['submit'])){
    if(updateBayar($_POST) >0){
        echo " <script>
    alert ('Pembayaran berhasil');
    document.location.href= 'pesananCust.php';
    </script>";
    }else{
        echo " <script>
    alert ('Pembayaran gagal');
    document.location.href= 'pesananCust.php';
    </script>";
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HealthPoint</title>
    <link rel="icon" href="assets/img/logo.png" type="image/png">

    <!-- Boostrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <!-- Boostrap Icon -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">

    <!-- Fonts Google -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&display=swap" rel="stylesheet">

    <!-- CSS Link -->
    <link rel="stylesheet" href="assets/css/style.css">
</head>

<body>
    <!-- Navbar start -->
    <?php include 'navbar.php'; ?>
    <!-- Navbar end -->

    <div class="shadow p-3 mt-3 me-5 ms-5 mb-2 bg-white rounded">
        <h4><b>Pesanan Saya</b></h4>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="card shadow me-2 ms-5 mt-2 mb-2">
                <div class="card-body">
                    <ul class="nav nav-pills flex-column">
                        <li class="nav-item">
                            <a href="profilCust.php" class="nav-link">Profil Saya</a>
                        </li>
                        <li class="nav-item">
                            <a href="pesananCust.php" class="nav-link">Pesanan Saya</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="alert alert-success ms-5 mt-3 me-2" role="alert">
                <?php 
                if($pesanan[0]['status'] == 1){
                    echo "Silahkan melakukan pembayaran maksimal 1x24 jam.";
                } else if($pesanan[0]['status'] == 4){
                    echo "Silahkan ambil dan bayar pesanan di toko maksimal 1x24 jam.";
                }
                ?>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card shadow me-5 mt-2 mb-2">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <label class="col-sm-4 col-form-label">User ID</label>
                            <label class="col-sm-8 col-form-label">: <?= $customer['id_cust'] ?> </label>
                        </div>
                        <div class="col-md-6 d-flex">
                            <label class="col-sm-4 col-form-label">Tanggal</label>
                            <label class="col-sm-8 col-form-label">: <?= date('d F Y', strtotime($orderDate)) ?> </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <label class="col-sm-4 col-form-label">Nama </label>
                            <label class="col-sm-8 col-form-label">: <?= $customer['nama_cust'] ?> </label>
                        </div>
                        <div class="col-md-6 d-flex">
                            <label class="col-sm-4 col-form-label">ID Paypal</label>
                            <label class="col-sm-8 col-form-label">: <?= $customer['id_paypal'] ?> </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <label class="col-sm-4 col-form-label">Alamat </label>
                            <label class="col-sm-8 col-form-label">: <?= $customer['alamat_cust'] ?> </label>
                        </div>
                        <div class="col-md-6 d-flex">
                            <label class="col-sm-4 col-form-label">Nama Bank</label>
                            <label class="col-sm-8 col-form-label">: <?= ucfirst($bank) ?> </label>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6 d-flex">
                            <label class="col-sm-4 col-form-label">No HP</label>
                            <label class="col-sm-8 col-form-label">: <?= $customer['notelp_cust'] ?> </label>
                        </div>
                        <div class="col-md-6 d-flex">
                            <label class="col-sm-4 col-form-label">Cara Bayar</label>
                            <label class="col-sm-8 col-form-label">: <?= ucfirst($bayar); ?> </label>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Produk</th>
                                    <th>Jumlah</th>
                                    <th>Harga</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $totalbrg = 0;
                                foreach ($pesanan as $key => $value): ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= $value['nama_produk'] ?> - <?= $value['id_produk'] ?></td>
                                        <td><?= $value['jumlah'] ?></td>
                                        <td>Rp <?= number_format($value['harga_satuan']) ?></td>
                                        <td>Rp <?= number_format($value['sub_harga']) ?></td>
                                    </tr>
                                    <?php
                                    $no++;
                                    $totalbrg += $value['sub_harga'] ?>
                            </tbody>
                        <?php endforeach ?>
                        </table>
                        <p>Total Barang : Rp <?= number_format($totalbrg) ?></p>
                        <p>Ongkos Kirim : Rp <?= number_format($value['ongkir']) ?></p>
                        <p>Total Keseluruhan : Rp <?= number_format($value['total']) ?></p>
                        <p>Status Pesanan : <span class="bagde text-bg-warning"><?= $value['nama_status'] ?></span></p>
                    </div>
                </div>
                <form action="" method="post">
                    <div class="d-flex justify-content-between ms-2 me-2 mb-3">
                        <input type="hidden" name="id_order" value="<?= $value['id_order'] ?>">
                        <button type="submit" name="submit" value="5" class="<?= ($value['status'] == 1) ? "btn btn-sm btn-success" : "btn btn-sm btn-success disabled" ?>">Bayar Sekarang</button>
                        <a href="cetakLaporan.php?id_order=<?= $value['id_order']?>" target="_blank" class="btn btn-sm btn-secondary">Cetak Laporan</a>
                        <a href="index.php" class="btn btn-sm btn-danger">Kembali</a>
                    </div>
                </form>

            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer end -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>