<?php
require '../function.php';

$id_cust = isset($_GET['id_cust']) ? htmlentities($_GET['id_cust']) : ' ';

if (hapusCust($id_cust)>0) {
    echo " <script>
    alert ('Berhasil Menghapus Customer');
    document.location.href= 'index.php?halaman=customer';
    </script>";
} else {
    echo "<script>
    alert ('Gagal Menghapus Customer');
    document.location.href= 'index.php?halaman=customer';
    </script>";
}
?>