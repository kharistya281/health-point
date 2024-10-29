<?php
session_start();

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

    <!-- Hero section start -->
    <section class="hero" id="home">
        <main class="content">
            <div class="row">
                <div class="col-md-9 main">
                    <h1><span>Health</span>Point</h1>
                    <p>Toko alat kesehatan yang terpercaya dan berkulitas tinggi.</p>
                    <a href="#produk" class="btn btn-success"><i class="bi bi-cart2"></i> Beli Sekarang</a>
                </div>
                <div class="col-md-3 hero-img">
                    <img src="assets/img/heroimg.png" alt="" width="400">
                </div>
            </div>
        </main>
    </section>
    <!-- Hero section end -->

    <div class="container">
        <!-- Produk section start -->
        <?php include 'produk.php'; ?>
        <!-- Produk section end -->

        <!-- About us section start -->
        <section class="about" id="about">
            <h1 class="judul">Tentang Kami</h1>
            <div class="row">
                <div class="col-md-6 about-img">
                    <img src="assets/img/about.jpeg" alt="">
                </div>
                <div class="col-md-6 about-content">
                    <h3>Kenapa memilih produk kami?</h3>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Inventore veritatis dolore reiciendis. Aliquam, in?</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Similique est dolores corrupti hic repellendus, perferendis vitae ea distinctio? Perferendis corrupti vero quaerat esse a.</p>
                </div>
            </div>
        </section>
        <!-- About us section end -->
    </div>

    <?php include 'footer.php'; ?>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>