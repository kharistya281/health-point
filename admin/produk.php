<!-- Judul start -->
<div class="shadow p-3 mb-3 bg-white rounded">
    <h4><b>Halaman Produk</b></h4>
</div>
<!-- Judul end -->

<!-- Ambi data start -->
<?php
include '../function.php';

$produk = [];
$query = mysqli_query($conn, "SELECT * FROM produk JOIN kategori
ON produk.id_kat = kategori.id_kategori");
while ($record = mysqli_fetch_assoc($query)) {
    $produk[] = $record;
}
?>
<!-- Ambi data end -->

<!-- Form start -->
<a href="index.php?halaman=tambah_produk" class="btn btn-primary mb-3 mt-3 col-md-2">Tambah Produk</a>
<div class="card shadow bg-white">
    <div class="card-body">
        <table class="table datatable">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Foto</th>
                    <th>Nama</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Harga</th>
                    <th>Stok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                foreach ($produk as $key => $value): ?>

                    <tr>
                        <td><?= $no; ?></td>
                        <td><img src="../assets/img/produk/<?= $value['foto_produk'] ?>" alt="" width="140" class="border border-2 rounded"></td>
                        <td><?= $value['nama_produk'] ?></td>
                        <td><?= $value['nama_kategori'] ?></td>
                        <td><?= $value['desc_produk'] ?></td>
                        <td><?= $value['harga_produk'] ?></td>
                        <td><?= $value['stok_produk'] ?></td>
                        <td class="text-center">
                            <div class="d-flex">
                                <a href="index.php?halaman=edit_produk&id=<?= $value['id_produk'] ?>" class="btn btn-sm btn-primary me-1">Edit</a>
                                <a href="index.php?halaman=hapus_produk&id=<?= $value['id_produk']; ?>&foto=<?= $value['foto_produk'] ?>" class="btn btn-sm btn-danger">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php
                    $no++;
                endforeach ?>
            </tbody>
        </table>
    </div>
</div>
<!-- Form end -->