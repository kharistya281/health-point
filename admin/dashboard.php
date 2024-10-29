<div class="shadow p-3 mb-3 bg-white rounded">
    <h4><b>Welcome, Administrator</b></h4>
</div>

<?php
require '../function.php';

$query = mysqli_query($conn, "SELECT sum(total) as total FROM pesanan");
$total = mysqli_fetch_assoc($query)['total'];

$query2 = mysqli_query($conn, "SELECT sum(jumlah) as jumlah FROM order_detail");
$ttlproduk = mysqli_fetch_assoc($query2)['jumlah'];



?>

<div class="row">
    <div class="col-xxl-4 col-md-6">
        <div class="card info-card revenue-card">
            <div class="card-body">
                <h5 class="card-title">Pendapatan</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3">
                        <h6>Rp <?= number_format($total); ?></h6>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-xxl-4 col-md-6">
        <div class="card info-card sales-card">
            <div class="card-body">
                <h5 class="card-title">Produk Terjual</h5>
                <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                        <i class="bi bi-bag-fill"></i>
                    </div>
                    <div class="ps-3">
                        <h6><?= $ttlproduk; ?></h6>
                        <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>