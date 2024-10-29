<div class="shadow p-3 mb-3 bg-white rounded">
    <h4><b>Halaman Customer</b></h4>
</div>

<!-- ambil data -->
<?php
require '../function.php';

$user = [];
$query = mysqli_query($conn, "SELECT * FROM customer");
while ($row = mysqli_fetch_assoc($query)) {
    $user[] = $row;
}



?>

<!-- Tampilan customer -->
<div class="card shadow bg-white">
    <div class="card-body">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Alamat</th>
                    <th>Jenis Kelamin</th>
                    <th>No Telp</th>
                    <th>Kota</th>
                    <th>Tanggal Lahir</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($user as $key => $value): ?>

                    <tr>
                        <td><?= $no; ?></td>
                        <td><?= $value['nama_cust'] ?></td>
                        <td><?= $value['alamat_cust'] ?></td>
                        <td><?= $value['gender_cust'] ?></td>
                        <td><?= $value['notelp_cust'] ?></td>
                        <td><?= $value['kota_cust'] ?></td>
                        <td><?= $value['ttl_cust'] ?></td>
                        <td><a href="hapus_cust.php?id_cust=<?= $value['id_cust'] ?>" class="btn btn-sm btn-danger">
                                <i class="bi bi-trash3"></i></a></td>
                    </tr>
                <?php
                    $no++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Tampilan customer end -->