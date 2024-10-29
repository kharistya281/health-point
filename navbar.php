<!-- Navbar start -->
<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container-lg">
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="index.php">
            <img src="assets/img/logo.png" alt="" width="32">
            <span>Health</span>Point
        </a>
        <div class="collapse navbar-collapse justify-content-between" id="navbarTogglerDemo03">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0 left-menu">
                <li class="nav-item">
                    <a class="nav-link" href="index.php#home">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#produk">Produk</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="index.php#about">Tentang Kami</a>
                </li>
            </ul>
            <ul class="navbar-nav mb-2 mb-lg-0 right-menu">
                <li class="nav-item akun d-flex">
                    <?php if (isset($_SESSION['unameCust'])) { ?>
                        <a href="profilCust.php" class="nav-link"> <?= $_SESSION['unameCust']; ?></a>
                        <a href="cart.php" class="nav-link"><i class="bi bi-cart2"></i></a>
                        <a href="logout.php" class="nav-link"><i class="bi bi-box-arrow-left"></i></a>
                    <?php } else { ?>
                        <a href="login.php" class="nav-link"><i class="bi bi-person-circle"></i></a>
                    <?php } ?>
                </li>
                <li class="navbar-nav mb-2 mb-lg-0 right-menu">
                    <a href="guestBook.php" class="nav-link"><i class="bi bi-book"></i></a>
                </li>
            </ul>
            <!-- <form class="d-flex" role="search">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
                    <button class="btn btn-outline-success" type="submit">Search</button>
                </form> -->
        </div>
    </div>
</nav>
<!-- Navbar end -->