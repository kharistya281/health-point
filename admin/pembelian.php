<!-- Judul start -->
<div class="shadow p-3 mb-3 bg-white rounded">
    <h4><b>Halaman Pembelian</b></h4>
</div>
<!-- Judul end -->

<!-- ambil data pembelian -->
<?php
require '../function.php';

$pembelian = [];
$query = mysqli_query($conn, "SELECT * FROM pesanan 
JOIN order_detail ON pesanan.id_order = order_detail.id_order
JOIN order_status on pesanan.status = order_status.id_status");
while($row = mysqli_fetch_assoc($query)){
    $pembelian[] = $row;
}

?>


<!-- Tampilan pembelian -->
<div class="card shadow bg-white">
    <div class="card-body">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Produk ID</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Metode Pembayaran</th>
                    <th>Pembayaran</th>
                    <th>Ongkir</th>
                    <th>Tanggal Pembelian</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach($pembelian as $key => $value):?>

                <tr>
                    <td><?=$no;?></td>
                    <td><?=$value['id_produk']?></td>
                    <td><?=$value['sub_harga']?></td>
                    <td><?=$value['nama_status']?></td>
                    <td><?=$value['metode_pembayaran']?></td>
                    <td><?=$value['pembayaran']?></td>
                    <td><?=$value['ongkir']?></td>
                    <td><?=$value['order_date']?></td>
                </tr>
                <?php
                $no++;
                endforeach?>
            </tbody>
        </table>
    </div>
</div>
<!-- Tampilan pembelian end -->