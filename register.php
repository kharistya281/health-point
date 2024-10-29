<?php

require 'function.php';

if (isset($_POST['submit'])) {
    $result = registCust($_POST);
    if (is_numeric($result) && $result > 0) {
        echo "        <script>
        alert ('Berhasil mendaftar akun');
        document.location.href= 'login.php';
        </script>";
    } else {
        echo $result;
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
    <link rel="stylesheet" href="assets/css/sign-in.css">
</head>

<body class="d-flex align-items-center">
    <main class="form-regist m-auto">
        <div class="d-flex header">
            <h1 class="h3 mb-3 fw-normal">Form Registrasi</h1>
        </div>
        <form action="" method="post">
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="username" id="floatingUsername" required>
                        <label for="floatingUsername">Username</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-2">
                        <input type="email" class="form-control" name="email" id="floatingEmail" required>
                        <label for="floatingEmail">Email</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="nama" id="floatingUsername" required>
                        <label for="floatingUsername">Nama</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-2">
                        <input type="number" class="form-control" name="paypal" id="floatingEmail" required>
                        <label for="floatingEmail">ID Paypal</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="password" id="floatingPassword" required>
                        <label for="floatingPassword">Password</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-2">
                        <input type="password" class="form-control" name="repassword" id="floatingRePassword" required>
                        <label for="floatingRePassword">Konfirmasi Password</label>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-floating mb-2">
                        <input type="date" class="form-control" name="tgllahir" id="floatingTglLahir" required>
                        <label for="floatingTglLahir">Tanggal Lahir</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label>Jenis Kelamin</label>
                    <div class="form-floating mb-2 d-flex">
                        <div class="form-check me-2">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault1" value="laki-laki">
                            <label class="form-check-label" for="flexRadioDefault1">Laki-laki</label>
                        </div>
                        <div class="form-check">
                            <input class="form-check-input" type="radio" name="gender" id="flexRadioDefault2" value="perempuan">
                            <label class="form-check-label" for="flexRadioDefault2">Perempuan</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-floating mb-3">
                <textarea class="form-control" name="alamat" id="floatingAlamat" cols="30" rows="30" style="height: 55px;"></textarea>
                <label for="floatingAlamat">Alamat</label>
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-floating mb-2">
                        <input type="text" class="form-control" name="kota" id="floatingKota" required>
                        <label for="floatingKota">Kota</label>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-floating mb-2">
                        <input type="number" class="form-control" name="notelp" id="floatingNoTelp" required>
                        <label for="floatingNoTelp">No Telepon</label>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between">
                <button type="submit" name="submit" class="btn btn-success">Submit</button>
                <button type="reset" class="btn btn-secondary">Clear</button>
            </div>
        </form>
    </main>
</body>

</html>