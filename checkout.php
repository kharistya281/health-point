<?php
session_start();
require 'function.php';

$dt = [];
$data = mysqli_query($conn, "SELECT * FROM customer WHERE uname_cust = '$_SESSION[unameCust]'");
while ($row = mysqli_fetch_assoc($data)) {
    $dt[] = $row;
}

if (isset($_POST['submit'])) {
    if (checkOut($_POST) > 0) {
        echo " <script>
    alert ('Pembelian sukses');
    document.location.href= 'pesananCust.php';
    </script>";
    }else{
        echo " <script>
    alert ('Gagal Menghapus Kategori');
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
        <h4><b>Checkout Keranjang Belanja</b></h4>
    </div>

    <div class="card shadow me-5 ms-5 mt-2 mb-2">
        <div class="card-header">
            <h5>Data Diri Pelanggan</h5>
        </div>
        <div class="card-body">
            <?php foreach ($dt as $key => $value): ?>
                <div class="row">
                    <?php $id_cust = $value['id_cust']; ?>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= $value['nama_cust'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="row mb-3">
                            <label for="inputText" class="col-sm-2 col-form-label">No Telp</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" value="<?= $value['notelp_cust'] ?>" readonly>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="row mb-3">
                            <label for="inputPassword" class="col-sm-2 col-form-label">Alamat</label>
                            <div class="col-sm-10">
                                <textarea class="form-control" style="height: 50px" readonly><?= $value['alamat_cust'] ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach ?>
        </div>
    </div>

    <div class="card shadow ms-5 me-5 mt-2 mb-4">
        <div class="card-header">
            <h5>Rincian Belanjaan</h5>
        </div>
        <div class="card-body">
            <table class="table table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    $total = 0;
                    $berat = 0;
                    foreach ($_SESSION['cartShop'] as $id_produk => $jumlah):
                        $cart = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                        $krj = [];
                        while ($row = mysqli_fetch_assoc($cart)) {
                            $krj[] = $row;
                        }
                        foreach ($krj as $key => $value):
                            $subtotal = $jumlah * $value['harga_produk'];
                            $subberat = $jumlah * $value['berat_produk'];
                            $berat += $subberat;
                            $total += $subtotal;
                    ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['nama_produk'] ?></td>
                                <td>Rp <?= number_format($value['harga_produk']) ?></td>
                                <td><?= $jumlah; ?></td>
                                <td>Rp<?= number_format($subtotal); ?></td>
                            </tr>
                    <?php $no++;
                        endforeach;
                    // $total += $total;
                    endforeach; ?>
                </tbody>
            </table>
            <!-- <p>Total belanjaan : Rp <?= number_format($total); ?></p> -->
        </div>
        <hr>
        <div class="card-body">
            <form action="" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Opsi Pengiriman</h5>
                        <div class="form-group row">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Provinsi</label>
                                <div class="col-sm-8">
                                    <select class="form-select" aria-label="Default select example" name="provinsi" id="provinsi">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Kota / Kabupaten</label>
                                <div class="col-sm-8">
                                    <select class="form-select" aria-label="Default select example" name="kabkota" id="kabkota">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Ekspedisi</label>
                                <div class="col-sm-8">
                                    <select class="form-select" aria-label="Default select example" name="ekspedisi" id="ekspedisi">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="row mb-3">
                                <label class="col-sm-4 col-form-label">Layanan Pengiriman</label>
                                <div class="col-sm-8">
                                    <select class="form-select" aria-label="Default select example" name="paket" id="layanan">
                                    </select>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="ongkirds" id="ongkir" value="">
                        <div class="row">
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="berat" class="form-control" value="<?= $berat; ?>" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="id_cust" class="form-control" value="<?php global $id_cust;
                                                                                                echo $id_cust; ?>" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="nmprovinsi" class="form-control" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="nmkabkota" class="form-control" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="tpkabkota" class="form-control" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="kodepos" class="form-control" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="nmekspedisi" class="form-control" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="service" class="form-control" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="ongkir" class="form-control" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="text" name="etd" class="form-control" hidden>
                            </div>
                            <div class="col-md-4 me-2 mb-2">
                                <input type="hidden" name="totalPembayaran" class="form-control" id="totalPembayaranInput">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <h5>Metode Pembayaran</h5>
                        <fieldset class="row mb-3">
                            <div class="col-sm-10 d-flex">
                                <div class="form-check me-5">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="prepaid" value="prepaid" onclick="toogleOption()">
                                    <label class="form-check-label" for="gridRadios1">
                                        Prepaid
                                    </label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paymentMethod" id="postpaid" value="postpaid" onclick="toogleOption()">
                                    <label class="form-check-label" for="gridRadios2">
                                        Postpaid
                                    </label>
                                </div>
                            </div>
                        </fieldset>
                        <div class="row mb-3">
                            <label class="col-sm-4 col-form-label">Pembayaran</label>
                            <div class="col-sm-8">
                                <select class="form-select" aria-label="Default select example" id="paymentSelect" name="pembayaran">
                                    <option selected>Pilih Pembayaran</option>
                                    <option value="bni" class="non-cod">BNI</option>
                                    <option value="bri" class="non-cod">BRI</option>
                                    <option value="bca" class="non-cod">BCA</option>
                                    <option value="bsi" class="non-cod">BSI</option>
                                    <option value="mandiri" class="non-cod">Mandiri</option>
                                    <option value="cash" class="cod">Bayar Ditempat</option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-4"></div>
                            <div class="col-md-4">
                                <p><strong>Grand Total</strong></p>
                                <p><strong>Ongkir</strong></p>
                                <p><strong>Total Pembayaran</strong></p>
                            </div>
                            <div class="col-md-4 text-end">
                                <p>Rp <?= number_format($total) ?></p>
                                <p>Rp <span id="ongkirText">0</span></p>
                                <p class="fs-5"> Rp <span id="totalPembayaran" data-total="<?= $total ?>"><?= number_format($total) ?></span></p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="d-flex justify-content-end">
                    <button type="submit" name="submit" class="btn btn-outline-warning">Buat Pesanan</button>
                </div>
            </form>
        </div>
    </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer end -->

    <script src="assets/js/jquery-3.7.1.min.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>