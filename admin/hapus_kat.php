<?php
require '../function.php';

$id = $_GET['id'];
if (hapusKat($id)>0) {
    echo " <script>
    alert ('Berhasil Menghapus Kategori');
    document.location.href= 'index.php?halaman=kategori';
    </script>";
} else {
    echo "<script>
    alert ('Gagal Menghapus Kategori');
    document.location.href= 'index.php?halaman=kategori';
    </script>";
}
?>