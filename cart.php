<?php
session_start();
require 'function.php';

if (empty($_SESSION['cartShop'])) {
    echo "<script>alert('Keranjang belanja kosong, silahkan menambah barang')</script>";
    echo "<script>location='index.php#produk'</script>";
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
        <h5><b>Keranjang Belanja</b></h5>
    </div>

    <div class="card shadow ms-5 me-5 mt-2 mb-2">
        <div class="card-body">
            <!-- <p>Anda mempunyai ... barang di keranjang</p> -->
            <table class="table table-hover table-striped" id="tables">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Harga</th>
                        <th>Jumlah</th>
                        <th>Sub Total</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    $total = 0;
                    foreach ($_SESSION['cartShop'] as $id_produk => $jumlah):
                        $cart = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
                        $krj = [];
                        while ($row = mysqli_fetch_assoc($cart)) {
                            $krj[] = $row;
                        }
                        foreach ($krj as $key => $value):
                            $subtotal = $jumlah * $value['harga_produk'];
                            $total += $subtotal;
                    ?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $value['nama_produk'] ?> - </td>
                                <td>Rp <?= number_format($value['harga_produk']) ?></td>
                                <td><?= $jumlah; ?></td>
                                <td>Rp<?= number_format($subtotal); ?></td>
                                <td><a href="hapus_cart.php?id=<?= $value['id_produk'] ?>" class="btn btn-danger"><i class="bi bi-trash3"></i></a></td>
                            </tr>
                    <?php $no++;
                        endforeach;
                    // $total += $total;
                    endforeach; ?>
                </tbody>
            </table>
            <p>Total belanjaan : Rp <?= number_format($total); ?></p>
        </div>
        <div class="card-header">
            <div class="row">
                <div class="col-md-10">
                    <a href="index.php#produk" class="btn btn-outline-info">Kembali Belanja</a>
                </div>
                <div class="col-md-2 text-right">
                    <a href="checkout.php" class="btn btn-outline-success">Check Out</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer end -->


</body>

</html>