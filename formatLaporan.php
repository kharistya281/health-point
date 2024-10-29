<?php
session_start();
require 'function.php';

$id_order = $_GET['id_order'];
$unameCust = isset($_GET['unameCust']) ? $_GET['unameCust'] : $_SESSION['unameCust'];

// if (isset($_SESSION['unameCust'])) {
//     $unameCust = $_SESSION['unameCust'];

//     // Query untuk mengambil data customer berdasarkan uname_cust
//     $cust = mysqli_query($conn, "SELECT * FROM customer WHERE uname_cust = '$unameCust'");

//     if ($cust) {
//         $customer = mysqli_fetch_assoc($cust);
//     } else {
//         echo "Error SQL: " . mysqli_error($conn);
//     }
// } else {
//     echo "Session untuk unameCust tidak ditemukan.";
// }



// ambil data pesanan
$pesanan = [];
$query = mysqli_query($conn, "SELECT * FROM pesanan 
JOIN order_detail ON pesanan.id_order = order_detail.id_order
JOIN produk ON produk.id_produk = order_detail.id_produk
JOIN order_status ON order_status.id_status = pesanan.status
WHERE pesanan.id_order = $id_order");
while ($row = mysqli_fetch_assoc($query)) {
    $pesanan[] = $row;
}

$orderDate = $pesanan[0]['order_date'];
$bank = $pesanan[0]['pembayaran'];
$bayar = $pesanan[0]['metode_pembayaran'];

// ambil data customer
$cust = mysqli_query($conn, "SELECT * FROM customer WHERE uname_cust = '$unameCust'");
$customer = mysqli_fetch_assoc($cust);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 40px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
        }

        .customer-info,
        .order-info {
            margin-bottom: 20px;
        }

        .table th,
        .table td {
            vertical-align: middle;
            text-align: start;
        }

        .table thead {
            background-color: #f8f9fa;
        }

        .total {
            font-weight: bold;
            text-align: end;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>HealthPoint</h2>
        <h2>Laporan Belanja Anda</h2>
        <hr>

        <div class="customer-info">
            <div style="margin: 20px;">
                <table border="0" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
                    <tbody>
                        <tr>
                            <th style="text-align: left; width: 20%;">User ID</th>
                            <td style="width: 30%;">: <?= $customer['id_cust'] ?></td>
                            <th style="text-align: left; width: 20%;">Tanggal</th>
                            <td style="width: 30%;">: <?= date('d F Y', strtotime($orderDate)) ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Nama</th>
                            <td>: <?= $customer['nama_cust'] ?></td>
                            <th style="text-align: left;">ID Paypal</th>
                            <td>: <?= $customer['id_paypal'] ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">Alamat</th>
                            <td>: <?= $customer['alamat_cust'] ?></td>
                            <th style="text-align: left;">Nama Bank</th>
                            <td>: <?= strtoupper($bank) ?></td>
                        </tr>
                        <tr>
                            <th style="text-align: left;">No HP</th>
                            <td>: <?= $customer['notelp_cust'] ?></td>
                            <th style="text-align: left;">Cara Bayar</th>
                            <td>: <?= ucfirst($bayar) ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>

        </div>

        <div class="order-info">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Produk</th>
                        <th>Jumlah</th>
                        <th>Harga Satuan</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $no = 1;
                    $totalbrg = 0;
                    foreach ($pesanan as $pesan) {
                        $subtotal = $pesan['jumlah'] * $pesan['harga_satuan'];
                        echo "<tr>
                            <td>{$no}</td>
                            <td>{$pesan['nama_produk']}</td>
                            <td>{$pesan['jumlah']}</td>
                            <td>Rp " . number_format($pesan['harga_satuan'], 0, ',', '.') . "</td>
                            <td>Rp " . number_format($subtotal, 0, ',', '.') . "</td>
                        </tr>";
                        $totalbrg += $subtotal;
                        $no++;
                    }
                    ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="4" class="text-end total">Total Barang:</td>
                        <td class="total">Rp <?= number_format($totalbrg) ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end total">Ongkos Kirim:</td>
                        <td class="total">Rp <?= number_format($pesan['ongkir']) ?></td>
                    </tr>
                    <tr>
                        <td colspan="4" class="text-end total">Total Keseluruhan:</td>
                        <td class="total">Rp <?= number_format($pesan['total']) ?></td>
                    </tr>
                </tfoot>
            </table>
        </div>
        <div class="text-end mt-5">
            <p>Hormat Kami</p>
            <img src="http://localhost/ujikom/assets/img/ttd.gd" alt="" width="150">
            <p>HealthPoint Team</p>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script> -->

</body>

</html>