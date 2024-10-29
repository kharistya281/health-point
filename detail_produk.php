<?php
session_start();
require 'function.php';
$id = $_GET['id'];

// ambil data produk 
$produk = [];
$query = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id'");
while ($row = mysqli_fetch_assoc($query)) {
    $produk[] = $row;
}



?>

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

    <!-- Detail produk -->
    <div class="shadow p-3 mt-3 me-5 ms-5 mb-2 bg-white rounded">
        <h5><b>Detail Produk</b></h5>
    </div>

    <?php foreach ($produk as $key => $value): ?>
        <div class="row ms-5 me-5 mt-2 mb-2">
            <div class="card shadow">
                <div class="card-body d-flex">
                    <div class="col-md-5">
                        <img src="assets/img/produk/<?= $value['foto_produk'] ?>" alt="" class="border rounded ms-3 detail-img" width="370">
                    </div>
                    <div class="col-md-7">
                        <h4><?= $value['nama_produk'] ?></h4>
                        <hr>
                        <h5>Rp <?= number_format($value['harga_produk']) ?></h5>
                        <br><br>
                        <form action="" method="post">
                            <div class="row d-flex">
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-3 col-form-label">Jumlah</label>
                                        <div class="col-sm-5">
                                            <input type="number" class="form-control" name="jumlah" value="1" min="1" max="<?= $value['stok_produk'] ?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row mb-3">
                                        <label for="inputNumber" class="col-sm-2 col-form-label">Stok</label>
                                        <div class="col-sm-4">
                                            <input type="number" class="form-control" readonly value="<?= $value['stok_produk'] ?>">
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="action d-flex justify-content-between">
                                <button class="btn btn-success me-2" name="beli" type="submit">
                                    <i class="bi bi-cart2"> Beli</i>
                                </button>
                                <a href="index.php#produk" class="btn btn-danger">
                                    <i class="bi bi-arrow-left-short"></i> Kembali
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row ms-5 me-5 mb-3 deskripsi">
            <div class="card shadow">
                <div class="card-header">Deskripsi Produk</div>
                <div class="card-body">
                    <p><?= $value['desc_produk'] ?></p>
                </div>
            </div>
        </div>

        <!-- <div class="row ms-5 me-5 mb-3 review">
            <div class="card shadow">
                <div class="card-header">Ulasan Produk</div>
                <div class="card-body">

                </div>
            </div>
        </div> -->
    <?php endforeach ?>

    <?php
    if (isset($_POST['beli'])) {
        if (!isset($_SESSION['unameCust'])) {
            echo "<script>alert('Anda harus login terlebih dahulu untuk menambahkan produk ke keranjang')</script>";
            echo "<script>location='login.php'</script>";
        } else {

            $jumlah = $_POST['jumlah'];
            $_SESSION['cartShop'][$id] = $jumlah;

            echo "<script>alert('Produk berhasil ditambahkan ke keranjang belanja')</script>";
            echo "<script>location='cart.php'</script>";
        }
    }




    ?>

    <?php include 'footer.php'; ?>

</body>



</html>