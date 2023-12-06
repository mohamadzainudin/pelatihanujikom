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

//ambil data di url
$id = $_GET["id"];
//query data mahasiswa
$spl = query("SELECT * FROM supplier WHERE id_supplier=$id")[0];



if (isset($_POST["submit"])) {

    if (ubahSupplier($_POST) > 0) {
        echo "<script>
                alert('data berhasil diubah !');
                document.location.href = 'supplier.php';
         </script>";
    } else {
        echo "<script>
    alert('data gagal diubah !');
    document.location.href = 'supplier.php';
</script>";
    }
}
//

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Supplier</title>
</head>

<body>
    <h1>Ubah data supplier</h1>

    <form action="" method="post">
        <input type="hidden" name="id_supplier" value="<?= $spl["id_supplier"]; ?>">
        <ul>

            <li>
                <label for="nama_supplier">Nama Supplier : </label>
                <input type="text" name="nama_supplier" value="<?= $spl["nama_supplier"]; ?>" id="nama_supplier"
                    required>
            </li>
            <li>
                <label for="no_telp">No Telp : </label>
                <input type="number" name="no_telp" value="<?= $spl["no_telp"]; ?>" id="no_telp">
            </li>
            <li>
                <label for="alamat">Alamat : </label>
                <input type="text" name="alamat" value="<?= $spl["alamat"]; ?>" id="alamat">
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data !</button>
            </li>
        </ul>
    </form>
</body>

</html>