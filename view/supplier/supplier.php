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
$supplier = query("SELECT * FROM supplier");

// tombol cari ditekan
if (isset($_POST['cari'])) {

    $supplier = cariSupplier($_POST["keyword"]);

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

    <h1>Daftar Supplier</h1>

    <a href="../../index.php">Menu</a>
    <a href="tambah_supplier.php">Tambah Data Supplier</a>
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
            <th>Nama Supplier</th>
            <th>No. Telp</th>
            <th>Alamat</th>
        </tr>

        <?php $i = 1; ?>
        <?php foreach ($supplier as $row): ?>

            <tr>
                <td>
                    <?= $i; ?>
                </td>
                <td>
                    <a href="ubah_supplier.php?id=<?= $row["id_supplier"] ?>">ubah</a>
                    <a href="hapus_supplier.php?id=<?= $row["id_supplier"] ?>"
                        onclick="return confirm('Yakin ingin dihapus ?')">hapus</a>
                </td>
                <td>
                    <?= $row["nama_supplier"] ?>
                </td>
                <td>
                    <?= $row["no_telp"] ?>
                </td>
                <td>
                    <?= $row["alamat"] ?>
                </td>

            </tr>
            <?php $i++; ?>
        <?php endforeach; ?>

    </table>


</body>

</html>