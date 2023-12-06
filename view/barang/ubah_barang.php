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
$brg = query("SELECT * FROM barang WHERE id_barang=$id")[0];



if (isset($_POST["submit"])) {

    if (ubahBarang($_POST) > 0) {
        echo "<script>
                alert('data berhasil diubah !');
                document.location.href = 'barang.php';
         </script>";
    } else {
        echo "<script>
    alert('data gagal diubah !');
    document.location.href = 'barang.php';
</script>";
    }
}

$query = "SELECT * FROM supplier";
$result = mysqli_query($conn, $query);

// Inisialisasi array untuk menyimpan data supplier
$suppliers = [];

while ($row = mysqli_fetch_assoc($result)) {
    $suppliers[] = $row;
}
//

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ubah Data Barang</title>
</head>

<body>
    <h1>Ubah data barang</h1>

    <form action="" method="post">
        <input type="hidden" name="id_barang" value="<?= $brg["id_barang"]; ?>">
        <ul>
            <li>
                <label for="nama_barang">Nama Barang : </label>
                <input type="text" name="nama_barang" value="<?= $brg["nama_barang"]; ?>" id="nama_barang" required>
            </li>
            <li>
                <label for="harga">Harga : </label>
                <input type="number" name="harga" value="<?= $brg["harga"]; ?>" id="harga">
            </li>
            <li>
                <label for="stok">Stok : </label>
                <input type="number" name="stok" value="<?= $brg["stok"]; ?>" id="stok">
            </li>
            <li>
                <label for="supplier">Supplier : </label>
                <select name="id_supplier" id="id_supplier" required>
                    <option value="">Pilih Supplier</option>
                    <?php foreach ($suppliers as $supplier): ?>
                        <option value="<?= $supplier['id_supplier']; ?>">
                            <?= $supplier['nama_supplier']; ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </li>
            <li>
                <button type="submit" name="submit">Ubah Data !</button>
            </li>
        </ul>
    </form>
</body>

</html>