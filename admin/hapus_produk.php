<?php 
require '../function.php';

$id = $_GET['id'];
$foto = $_GET['foto'];

if(hapusProduk($id, $foto)>0){
    echo " <script>
    alert ('Berhasil Menghapus Produk');
    document.location.href= 'index.php?halaman=produk';
    </script>";

}   else{
    echo "<script>
    alert ('Gagal Menghapus Produk');
    document.location.href= 'index.php?halaman=produk';
    </script>";
}

?>