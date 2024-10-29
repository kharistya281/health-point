<?php
require 'function.php';

if (isset($_POST['submit'])) {
    if (guestBook($_POST) > 0) {
        echo " <script>
        alert ('Berhasil Mengisi Guest Book');
        document.location.href= 'index.php';
        </script>";
    } else {
        echo "<script>
        alert ('Gagal Mengisi Guest Book');
        document.location.href= 'index.php';
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
    <?php include 'navbar.php'; ?>

    <div class="shadow p-3 mt-3 me-5 ms-5 mb-2 bg-white rounded">
        <h5><b>Guest Book</b></h5>
    </div>
    <div class="card shadow ms-5 me-5 mt-2 mb-2">
        <div class="card-body">
            <form action="" method="post">
                <div class="row mb-3">
                    <label for="inputText" class="col-sm-2 col-form-label">Nama</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nama">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control" name="email">
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="inputPassword" class="col-sm-2 col-form-label">Pesan</label>
                    <div class="col-sm-10">
                        <textarea class="form-control" style="height: 100px" name="pesan"></textarea>
                    </div>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Kirim</button>
            </form>
        </div>
    </div>


    <?php include 'footer.php'; ?>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>