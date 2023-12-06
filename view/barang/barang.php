<?php
session_start();

// Cek apakah pengguna telah login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit();
}
// Lanjutkan dengan tampilan halaman menu jika pengguna telah login
?>

<?php
require '../../functions.php';
$barang = query(
    "SELECT barang.id_barang as id_barang, barang.nama_barang as nama_barang, barang.harga as harga, barang.stok as stok, barang.id_supplier as id_supplier, supplier.nama_supplier as nama_supplier
    FROM barang
    LEFT JOIN supplier
    ON barang.id_supplier = supplier.id_supplier"
);

//tombol cari ditekan
if (isset($_POST['cari'])) {

    $barang = cariBarang($_POST["keyword"]);

}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Halaman Admin</title>
</head>

<body>

    <h1>Daftar Barang</h1>

    <a href="../../index.php">Menu</a>
    <a href="tambah_barang.php">Tambah Data Barang</a>
    <!-- <a href="print.php">print</a> -->
    <br><br>

    <form action="" method="post">

        <input type="text" name="keyword" size="40" autofocus placeholder="masukkan keyword pencarian..."
            autocomplete="off">
        <button type="submit" name="cari">Cari !</button>

    </form>
    <br>



    <table border="1" cellpadding="10" cellspacing="0">

        <tr>
            <th>No.</th>
            <th>Aksi</th>
            <th>Nama Barang</th>
            <th>Harga</th>
            <th>Stok</th>
            <th>Supplier</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($barang as $row): ?>

            <tr>
                <td>
                    <?= $i; ?>
                </td>
                <td>
                    <a href="ubah_barang.php?id=<?= $row["id_barang"] ?>">ubah</a>
                    <a href="hapus_barang.php?id=<?= $row["id_barang"] ?>"
                        onclick="return confirm('Yakin ingin dihapus ?')">hapus</a>
                </td>
                <td>
                    <?= $row["nama_barang"] ?>
                </td>
                <td>
                    <?= $row["harga"] ?>
                </td>
                <td>
                    <?= $row["stok"] ?>
                </td>
                <td>
                    <?= $row["nama_supplier"] ?>
                </td>

            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </table>


</body>

</html>