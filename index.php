<?php
session_start();

// Cek apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Lanjutkan dengan tampilan halaman menu jika pengguna telah login
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu Utama</title>
</head>

<body>
    <h1>Menu Utama</h1>
    <ul>
        <li><a href="view/barang/barang.php">Menu Barang</a></li>
        <li><a href="menu_transaksi.php">Menu Transaksi</a></li>
        <li><a href="view/supplier/supplier.php">Menu Supplier</a></li>
        <li><a href="menu_pembelian.php">Menu Pembelian</a></li>
        <li><a href="menu_pembayaran.php">Menu Pembayaran</a></li>
        <li><a href="logout.php">Keluar</a></li>
    </ul>
</body>

</html>