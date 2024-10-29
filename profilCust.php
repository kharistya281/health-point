<?php
session_start();

require 'function.php';

// ambil data user
$query = mysqli_query($conn, "SELECT * FROM customer WHERE uname_cust = '$_SESSION[unameCust]'");
$user=mysqli_fetch_assoc($query);

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
        <h4><b>Profil Saya</b></h4>
    </div>


    <div class="row">
        <div class="col-md-4">
            <div class="card shadow me-2 ms-5 mt-2 mb-5">
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
            <div class="card shadow me-5 mt-2 mb-5">
                <div class="card-body">
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $user['nama_cust'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Tanggal Lahir</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $user['ttl_cust'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Jenis Kelamin</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $user['gender_cust'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Alamat</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $user['alamat_cust'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">Kota</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $user['kota_cust'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">No Telp</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $user['notelp_cust'] ?>" readonly>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="inputText" class="col-sm-2 col-form-label">ID Paypal</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" value="<?= $user['id_paypal'] ?>" readonly>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <!-- Footer -->
    <?php include 'footer.php'; ?>
    <!-- Footer end -->

</body>

</html>