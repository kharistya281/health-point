<!-- Judul start -->
<div class="shadow p-3 mb-3 bg-white rounded">
    <h4><b>Halaman Kategori</b></h4>
</div>
<!-- Judul end -->

<!-- Ambil data dari database start-->
<?php
require '../function.php';

$kategori = [];
$query = mysqli_query($conn, "SELECT * FROM kategori");
while ($kat = mysqli_fetch_assoc($query)) {
    $kategori[] = $kat;
}
?>
<!-- Ambil data dari database end -->

<!-- Tampilan kategori start -->
<a href="index.php?halaman=tambah_kat" class="btn btn-primary mb-3 mt-3 col-md-2">Tambah Kategori</a>
<div class="card shadow bg-white">
    <div class="card-body">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                foreach($kategori as $key => $value):?>

                <tr>
                    <td><?=$no;?></td>
                    <td><?=$value['nama_kategori']?></td>
                    <td class="text-center" width="180">
                        <a href="index.php?halaman=edit_kat&id_kat=<?= $value['id_kategori']?>" class="btn btn-sm btn-primary">Edit</a>
                        <a href="index.php?halaman=hapus_kat&id=<?= $value['id_kategori']; ?>" class="btn btn-sm btn-danger">Delete</a>
                    </td>
                </tr>
                <?php
                $no++;
                endforeach?>
            </tbody>
        </table>
    </div>
</div>
<!-- Tampilan kategori end -->