<?php
// session
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// koneksi ke database
$conn = mysqli_connect('localhost', 'root', '', 'healthpoint');
if (mysqli_connect_errno()) {
    echo "Gagal koneksi ke database " . mysqli_connect_error();
    exit;
}

// ========================
// CUSTOMER
// ========================
// registrasi customer
function registCust($data)
{
    global $conn;

    $username = (isset($data['username']) ? htmlentities($data['username']) : '');
    $name = (isset($data['nama']) ? htmlentities($data['nama']) : '');
    $paypal = (isset($data['paypal']) ? htmlentities($data['paypal']) : '');
    $email = (isset($data['email']) ? htmlentities($data['email']) : '');
    $password = (isset($data['password']) ? sha1(htmlentities($data['password'])) : '');
    $repassword = (isset($data['repassword']) ? sha1(htmlentities($data['repassword'])) : '');
    $ttl = (isset($data['tgllahir']) ? htmlentities($data['tgllahir']) : '');
    $gender = (isset($data['gender']) ? htmlentities($data['gender']) : '');
    $alamat = (isset($data['alamat']) ? htmlentities($data['alamat']) : '');
    $kota = (isset($data['kota']) ? htmlentities($data['kota']) : '');
    $notelp = (isset($data['notelp']) ? htmlentities($data['notelp']) : '');

    // echo $username, ' ', $email, ' ', $password, ' ', $repassword, ' ',
    // $ttl, ' ', $gender, ' ', $alamat, ' ', $kota, ' ', $notelp;

    $select = mysqli_query($conn, "SELECT * FROM customer WHERE uname_cust = '$username'");

    // cek apakah ada nama username yang sama
    if (mysqli_num_rows($select) > 0) {
        return "<script>alert('Username sudah ada.'); window.location='register.php';</script>";
    } else {
        // cek apakah password dan konfirmasi password sama 
        if ($password == $repassword) {
            mysqli_query($conn, "INSERT INTO customer 
            VALUES('', '$username', '$name' , '$password', '$email',
            '$ttl', '$gender', '$alamat', '$kota', $notelp, '$paypal')");

            return mysqli_affected_rows($conn);
        } else {
            return "<script>alert('Password dan konfirmasi password tidak sama.'); window.location='register.php';</script>";
        }
    }
}

// Login Customer
function loginCust($data)
{
    global $conn;

    $username = (isset($data['username']) ? htmlentities($data['username']) : '');
    $password = (isset($data['password']) ? sha1(htmlentities($data['password'])) : '');
    
    // echo $username, ' ', $password;
    // exit;
    
    if (!empty($data)) {
        $query = mysqli_query($conn, "SELECT * FROM customer WHERE uname_cust = '$username' && ps_cust='$password'");
        $result = mysqli_fetch_assoc($query);
        if ($result) {
            $_SESSION['unameCust'] = $username;
            header('location:index.php');
        } else {
            return "<script>alert ('Gagal login, username atau password tidak sesuai')
            window.location='login.php'</script>";
        }
    }
}

// checkout Barang Customer 
function checkOut($data){
    global $conn;
    
    // menangkap data untuk disimpan ke tabel pesanan
    $id_cust = (isset($data['id_cust']) ? htmlentities($data['id_cust']) : '');
    $status = 0;
    // $orderdate = date('y-m-d');
    $total = (isset($data['totalPembayaran']) ? htmlentities($data['totalPembayaran']) : '');
    $berat = (isset($data['berat']) ? htmlentities($data['berat']) : '');
    $paymentMethod = (isset($data['paymentMethod']) ? htmlentities($data['paymentMethod']) : '');
    $pembayaran = (isset($data['pembayaran']) ? htmlentities($data['pembayaran']) : '');
    $provinsi = (isset($data['nmprovinsi']) ? htmlentities($data['nmprovinsi']) : '');
    $kabkota = (isset($data['nmkabkota']) ? htmlentities($data['nmkabkota']) : '');
    $tipekabkota = (isset($data['tpkabkota']) ? htmlentities($data['tpkabkota']) : '');
    $ekspedisi = (isset($data['ekspedisi']) ? htmlentities($data['ekspedisi']) : '');
    $layanan = (isset($data['service']) ? htmlentities($data['service']) : '');
    $ongkir = (isset($data['ongkir']) ? htmlentities($data['ongkir']) : '');
    $etd = (isset($data['etd']) ? htmlentities($data['etd']) : '');

    // set status berdasarkan metode pembayaran
    $sts = [];
    // $statusRaw= [];
    $query = mysqli_query($conn, "SELECT * FROM order_status");
    while($row = mysqli_fetch_assoc($query)){
        $sts[] = $row;
    }
    foreach ($sts as $key => $value){
        if($paymentMethod === 'prepaid'){
            $status = 1;
        } elseif ($paymentMethod === 'postpaid') {
            $status = 4;
        }
    }

    
    // echo $id_cust, ', ', $total, ', ', $berat, ', ', $paymentMethod, ', ', $status, ', ',
    // $pembayaran, ', ', $provinsi, ', ', $kabkota, ', ', $tipekabkota, ', ', 
    // $ekspedisi, ', ', $layanan, ', ', $ongkir, ', ', $etd;
    // echo "<br>";
    // exit;

    // menyimpan ke tabel pesanan 
    mysqli_query($conn, "INSERT INTO pesanan VALUES('', '$id_cust' ,'$status', current_timestamp(), 
    '$total', '$berat', '$paymentMethod', '$pembayaran', '$provinsi', '$kabkota', '$tipekabkota',
    '$ekspedisi', '$layanan', '$ongkir', '$etd')");

    // echo "<pre>";
    // print_r($_SESSION['cartShop']);
    // echo "</pre>";
    // exit;
    
    $id_order = mysqli_insert_id($conn);
    // echo $id_order;
    // exit;
    foreach($_SESSION['cartShop'] as $id_produk =>$jumlah){
        $produkquery = mysqli_query($conn, "SELECT * FROM produk WHERE id_produk = '$id_produk'");
        $produk = [];
        while ($row = mysqli_fetch_assoc($produkquery)){
            $produk[] = $row;
        }
        // echo "<pre>";
        // print_r($produk);
        // echo "</pre>";
        // exit;

        foreach($produk as $key => $value){
            $harga_satuan = $value['harga_produk'];
            $jumlah_produk = $jumlah;
            $berat_satuan = $value['berat_produk'];
            $subberat = $berat_satuan*$jumlah_produk;
            $subharga = $harga_satuan * $jumlah_produk;

            // echo $harga_satuan, ', ', $jumlah_produk, ', ', $berat_satuan, ', ', $subberat, ', ', $subharga;
            // exit;

            // memasukkan data ke tabel order_detail
            mysqli_query($conn, "INSERT INTO order_detail VALUES('', '$id_order' , '$id_produk', 
            $jumlah, $harga_satuan, $subharga, $berat_satuan, $subberat)");

            // update jumlah stok barang 
            mysqli_query($conn, "UPDATE produk SET stok_produk = stok_produk - $jumlah WHERE id_produk = '$id_produk'");
        }
    }
    unset($_SESSION['cartShop']);
    return mysqli_affected_rows($conn);

}

// update status pembayaran
function updateBayar($data){
    global $conn;

    $id_order = $data['id_order'];
    $status = $data['submit'];

    mysqli_query($conn, "UPDATE pesanan SET status = '$status' WHERE id_order='$id_order'");
    return mysqli_affected_rows($conn);
}

// insert guest book
function guestBook($data){
    global $conn;

    $nama = (isset($data['nama']) ? htmlentities($data['nama']) : '');
    $email = (isset($data['email']) ? htmlentities($data['email']) : '');
    $pesan = (isset($data['pesan']) ? htmlentities($data['pesan']) : '');

    mysqli_query($conn, "INSERT INTO guest_book VALUES ('', '$nama', '$email', '$pesan')");
    return mysqli_affected_rows($conn);
}


// ========================
// ADMINISTRATOR
// ========================
// Login Admin
function loginAdmin($data)
{
    global $conn;

    $username = (isset($data['username']) ? htmlentities($data['username']) : '');
    $password = (isset($data['password']) ? sha1(htmlentities($data['password'])) : '');

    if (!empty($data)) {
        $query = "SELECT * FROM admin WHERE user_admin = '$username' && ps_admin = '$password'";
        $get = mysqli_query($conn, $query);
        $result = mysqli_fetch_assoc($get);
        if ($result) {
            $_SESSION['unameAdmin'] = $username;
            header('location: index.php');
        } else {
            return "<script>alert ('Gagal login, username atau password tidak sesuai')
            window.location='login.php'</script>";
        }
    }
}

// Tambah data produk
function tambahProduk($data)
{
    global $conn;

    $nama = (isset($data['nama']) ? htmlentities($data['nama']) : '');
    $kat = (isset($data['kat']) ? htmlentities($data['kat']) : '');
    $harga = (isset($data['harga']) ? htmlentities($data['harga']) : '');
    $stok = (isset($data['stok']) ? htmlentities($data['stok']) : '');
    $desc = (isset($data['desc']) ? htmlentities($data['desc']) : '');

    // proses foto
    $randomCode = rand(100, 999) . "-";
    $targetDir = "../assets/img/produk/" . $randomCode;
    $targetFile = $targetDir . basename(($_FILES['foto']['name']));
    $imgType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // upload file dan data
    $statusUpload = '';
    if (!empty($data)) {
        // cek apakah gambar atau bukan 
        $cekImg = getimagesize($_FILES['foto']['tmp_name']);
        if ($cekImg === false) {
            return "<script>alert('File yang diupload bukan foto.'); window.location='index.php?halaman=produk';</script>";
            $statusUpload = 0;
        } else {
            $statusUpload = 1;
            // memeriksa apakah foto sudah diupload atau belum 
            if (file_exists($targetFile)) {
                return "<script>alert('Foto yang diupload sudah ada.'); window.location='index.php?halaman=produk';</script>";
                $statusUpload = 0;
            } else {
                // cek ukuran file
                if ($_FILES['foto']['size'] > 2000000) {
                    return "<script>alert('Foto yang diupload terlalu besar.'); window.location='index.php?halaman=produk';</script>";
                    $statusUpload = 0;
                } else {
                    // cek ekstensi foto 
                    if ($imgType != "jpg" && $imgType != "png" && $imgType != "jpeg" && $imgType != "gif") {
                        return "<script>alert('Hanya file dengan format jpg, jpeg, png, dan gif.'); window.location='index.php?halaman=produk';</script>";
                        $statusUpload = 0;
                    }
                }
            }
        }
        if ($statusUpload == 1) {
            $select = mysqli_query($conn, "SELECT * FROM produk WHERE nama_produk = '$nama'");
            // cek apakah nama produk sudah atau belum 
            if (mysqli_num_rows($select) > 0) {
                return "<script>alert('Nama produk sudah ada.'); window.location='index.php?halaman=produk';</script>";
            } else {
                // upload dan simpan ke database
                if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
                    $query = mysqli_query($conn, "INSERT INTO produk
                    VALUES('', '$kat', '$nama', '" . $randomCode . $_FILES['foto']['name'] . "', '$harga', '$desc', '$stok')");

                    return mysqli_affected_rows($conn);
                } else {
                    return "<script>alert('Gagal Menambah produk baru.'); window.location='index.php?halaman=produk';</script>";
                }
            }
        }
    }
}

// Edit produk 
function editProduk($data)
{
    global $conn;

    $id = (isset($data['id']) ? htmlentities($data['id']) : '');
    $nama = (isset($data['nama']) ? htmlentities($data['nama']) : '');
    // $kat = (isset($data['kat']) ? htmlentities($data['kat']) : '');
    $harga = (isset($data['harga']) ? htmlentities($data['harga']) : '');
    $stok = (isset($data['stok']) ? htmlentities($data['stok']) : '');
    $desc = (isset($data['desc']) ? htmlentities($data['desc']) : '');

    // proses foto
    $randomCode = rand(100, 999) . "-";
    $targetDir = "../assets/img/produk/" . $randomCode;
    $targetFile = $targetDir . basename(($_FILES['foto']['name']));
    $imgType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // upload file dan data
    $statusUpload = '';
    if (!empty($data)) {
        // cek apakah gambar atau bukan 
        $cekImg = getimagesize($_FILES['foto']['tmp_name']);
        if ($cekImg === false) {
            return "<script>alert('File yang diupload bukan foto.'); window.location='index.php?halaman=produk';</script>";
            $statusUpload = 0;
        } else {
            $statusUpload = 1;
            // memeriksa apakah foto sudah diupload atau belum 
            if (file_exists($targetFile)) {
                return "<script>alert('Foto yang diupload sudah ada.'); window.location='index.php?halaman=produk';</script>";
                $statusUpload = 0;
            } else {
                // cek ukuran file
                if ($_FILES['foto']['size'] > 2000000) {
                    return "<script>alert('Foto yang diupload terlalu besar.'); window.location='index.php?halaman=produk';</script>";
                    $statusUpload = 0;
                } else {
                    // cek ekstensi foto 
                    if ($imgType != "jpg" && $imgType != "png" && $imgType != "jpeg" && $imgType != "gif") {
                        return "<script>alert('Hanya file dengan format jpg, jpeg, png, dan gif.'); window.location='index.php?halaman=produk';</script>";
                        $statusUpload = 0;
                    }
                }
            }
        }
        if ($statusUpload == 1) {
            // upload dan simpan ke database
            if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetFile)) {
                $query = mysqli_query($conn, "UPDATE produk
                    SET nama_produk = '$nama', 
                    foto_produk = '" . $randomCode . $_FILES['foto']['name'] . "', 
                    harga_produk = '$harga', 
                    desc_produk = '$desc', 
                    stok_produk = '$stok' WHERE id_produk = '$id'");

                return mysqli_affected_rows($conn);
            } else {
                return "<script>alert('Gagal Menambah produk baru.'); window.location='index.php?halaman=produk';</script>";
            }
        }
    }
}

// Hapus Produk 
function hapusProduk($id, $foto){
    global $conn;
    unlink("assets/img/produk/$foto");
    $query = mysqli_query($conn, "DELETE FROM produk WHERE id_produk = '$id'");
    return mysqli_affected_rows($conn);
}

// Tambah Kategori 
function tambahKat($data){
    global $conn;

    $nama = (isset($data['nama']) ? htmlentities($data['nama']) : '');
    
    $query = mysqli_query($conn, "INSERT INTO kategori VALUES('', '$nama')");
    mysqli_affected_rows($conn);
}


// Edit kategori
function editKat($data){
    global $conn;
    
    $id = (isset($data['id']) ? htmlentities($data['id']) : '');
    $nama = (isset($data['nama']) ? htmlentities($data['nama']) : '');
    
    // echo $id, ' ', $nama;
    // exit;
    
    $query = mysqli_query($conn, "UPDATE kategori 
    SET nama_kategori = '$nama' 
    WHERE id_kategori = '$id'");

mysqli_affected_rows($conn);
}

// Hapus kategori
function hapusKat($id){
    global $conn;
    
    $id = (isset($id) ? htmlentities($id) : '');
    // echo 'id = ', $id;
    // exit;

    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori = '$id'");
    return mysqli_affected_rows($conn);
    // exit;
}

// Hapus Customer
function hapusCust($id){
    global $conn;

    $id_cust = $id;

    mysqli_query($conn, "DELETE FROM customer WHERE id_cust = '$id_cust'");
    return mysqli_affected_rows($conn);
}