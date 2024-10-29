<!-- Judul start -->
<div class="shadow p-3 mb-3 bg-white rounded">
    <h4><b>Halaman Edit Kategori</b></h4>
</div>
<!-- Judul end -->

<?php
include '../function.php';
$id_kat = $_GET['id_kat'];

// ambil data kategori 
$kategori = [];
$query = mysqli_query($conn, "SELECT * FROM kategori WHERE id_kategori='$id_kat'");
while ($row = mysqli_fetch_assoc($query)) {
    $kategori[] = $row;
}

// Proses masukkan data 
if (isset($_POST['submit'])) {
    if (editKat($_POST)) {
        echo "<script>
        alert ('Berhasil mengubah data katagori');
        document.location.href= 'index.php?halaman=kategori';
        </script>";
    } else {
        echo "<script>
        alert ('Berhasil mengubah data kategori');
        document.location.href= 'index.php?halaman=kategori';
        </script>";
    }
}

?>


<!-- Form tambah kategori -->
<?php foreach ($kategori as $key => $value): ?>
<form action="" method="post">
    <div class="card shadow bg-white">
        <input type="hidden" value="<?= $value['id_kategori'] ?>" name="id">
        <div class="card-body">
            <div class="row mb-3 mt-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Kategori</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="nama" value="<?= $value['nama_kategori'] ?>">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
                <div class="col-sm-2">
                    <a href="index.php?halaman=kategori" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>
<?php endforeach ?>
<!-- Form tambah kategori end -->