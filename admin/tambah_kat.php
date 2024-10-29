<!-- Judul start -->
<div class="shadow p-3 mb-3 bg-white rounded">
    <h4><b>Halaman Tambah Kategori</b></h4>
</div>
<!-- Judul end -->

<?php
include '../function.php';

// Proses masukkan data 
if(isset($_POST['submit'])){
    if(tambahKat($_POST)){
        echo "<script>
        alert ('Berhasil menambahkan data katagori');
        document.location.href= 'index.php?halaman=kategori';
        </script>";
    }else{
        echo "<script>
        alert ('Berhasil menambahkan data kategori');
        document.location.href= 'index.php?halaman=kategori';
        </script>";
    }
}

?>


<!-- Form tambah kategori -->
<form action="" method="post">
    <div class="card shadow bg-white">
        <div class="card-body">
            <div class="row mb-3 mt-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label">Nama Kategori</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="inputText" name="nama">
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
<!-- Form tambah kategori end -->