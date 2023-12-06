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
$id = $_GET["id"];

if (hapusSupplier($id) > 0) {
    echo "<script>
    alert('data berhasil dihapus !');
    document.location.href = 'supplier.php';
</script>";
} else {
    echo "<script>
    alert('data gagal dihapus !');
    document.location.href = 'supplier.php';
</script>";
}

?>