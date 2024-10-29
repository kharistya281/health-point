<?php
session_start();

if (!isset($_SESSION['unameCust'])) {
    echo "<script>alert('Anda harus login terlebih dahulu untuk menambahkan produk ke keranjang')</script>";
    echo "<script>location='login.php'</script>";
    exit;
}


$id_produk = $_GET['id'];

if(isset($_SESSION['cartShop'][$id_produk])){
    $_SESSION['cartShop'][$id_produk]+=1;
}else{
    $_SESSION['cartShop'][$id_produk]=1;
}

echo "<script>alert('Produk berhasil ditambahkan ke keranjang belanja')</script>";
echo "<script>location='cart.php'</script>";

?>