<?php
session_start();
require 'function.php';

$cust = mysqli_query($conn, "SELECT * FROM customer WHERE uname_cust = '$_SESSION[unameCust]'");
$customer = mysqli_fetch_assoc($cust);
$id_cust = $customer['id_cust'];

$pembelian = [];
$query = mysqli_query($conn, "SELECT * FROM customer 
JOIN pesanan ON customer.id_cust = pesanan.id_cust 
JOIN order_status ON order_status.id_status = pesanan.status 
WHERE pesanan.id_cust = '$id_cust'");
while ($row = mysqli_fetch_assoc($query)) {
    $pembelian[] = $row;
}


// $id_pelanggan = $_SESSION['unameCust']['id_cust'];
// echo $id_pelanggan;
// exit;

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
        <h4><b>Detail Pesanan Saya</b></h4>
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
        </div>
        <div class="col-md-8">
            <div class="card shadow me-5 mt-2 mb-2">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover" id="tables">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Barang</th>
                                    <th>Total</th>
                                    <th>Status</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $no=1;
                                foreach ($pembelian as $key => $value): ?>
                                    <tr>
                                        <td><?= $no; ?></td>
                                        <td><?= date("d F Y", strtotime($value['order_date'])); ?></td>
                                        <td>Rp <?= number_format($value['total']) ?></td>
                                        <td class="badge text-bg-info m-2"><?= $value['nama_status'] ?></td>
                                        <td>
                                            <a href="detailPesanan.php?id_order=<?= $value['id_order'] ?>" class="btn btn-sm btn-primary"><i class="bi bi-eye"></i> Detail</a>
                                        </td>
                                    </tr>
                                <?php 
                                $no++;
                                endforeach ?>
                            </tbody>
                        </table>
                    </div>
                </div>

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