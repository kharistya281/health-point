<!-- Judul start -->
<div class="shadow p-3 mb-3 bg-white rounded">
    <h4><b>Halaman Tambah Produk</b></h4>
</div>
<!-- Judul end -->

<?php
//Ambil data kategori
include '../function.php';
$kat = [];
$query = mysqli_query($conn, "SELECT * FROM kategori");
while ($record = mysqli_fetch_assoc($query)) {
    $kat[] = $record;
}
// Ambil data kategori end

// Proses masukkan data 

if(isset($_POST['submit'])){
    $result = tambahProduk($_POST);
    if(is_numeric($result) && $result >0 ){
        echo "<script>
        alert ('Berhasil menambahkan data produk');
        document.location.href= 'index.php?halaman=produk';
        </script>";
    }else{
        echo $result;
    }   
}
// Proses masukkan data end

?>

<!-- Form tambah -->
<form action="" method="post" enctype="multipart/form-data">
    <div class="card shadow bg-white">
        <div class="card-body">
            <div class="row mb-3 mt-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Produk</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="nama">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-form-label">nama Kategori</label>
                <div class="col-sm-10">
                    <select class="form-select" aria-label="Default select example" name="kat">
                        <option selected disabled>Pilih kategori</option>
                        <?php foreach ($kat as $key => $value) :  ?>
                            <option value="<?= $value['id_kategori'] ?>"><?= $value['nama_kategori'] ?></option>
                        <?php endforeach ?>
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Harga Produk</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="harga">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">Stok Produk</label>
                <div class="col-sm-10">
                    <input type="number" class="form-control" name="stok">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi</label>
                <div class="col-sm-10">
                    <textarea class="form-control" style="height: 90px" name="desc"></textarea>
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputNumber" class="col-sm-2 col-form-label">File Upload</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" id="formFile" name="foto">
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-sm-10">
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                </div>
                <div class="col-sm-2">
                    <a href="index.php?halaman=produk" class="btn btn-danger">Kembali</a>
                </div>
            </div>
        </div>
    </div>
</form>
<!-- Form tambah end -->