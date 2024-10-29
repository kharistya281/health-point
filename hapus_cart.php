<?php
session_start();

$id_produk = $_GET['id'];

unset($_SESSION['cartShop'][$id_produk]);

echo "<script>alert('Produk berhasil dihapus dari keranjang belanja')</script>";
echo "<script>location='cart.php'</script>";


?>