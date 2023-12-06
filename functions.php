<?php
//koneksi ke database
$conn = mysqli_connect("localhost", "root", "", "penjualan");
if (!$conn) {
    echo "koneksi gagal";
}
function query($query)
{
    global $conn;
    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
    return $rows;
}


//barang
function tambahBarang($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama_barang"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);
    $supplier = htmlspecialchars($data["id_supplier"]);
    // $gambar = htmlspecialchars($data["gambar"]);

    $query = "INSERT INTO barang (nama_barang, harga, stok, id_supplier)
        VALUES
        ('$nama', '$harga','$stok', $supplier)";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}
function ubahBarang($data)
{
    global $conn;

    $id = $data["id_barang"];
    $nama = htmlspecialchars($data["nama_barang"]);
    $harga = htmlspecialchars($data["harga"]);
    $stok = htmlspecialchars($data["stok"]);
    $supplier = htmlspecialchars($data["id_supplier"]);

    $query = "UPDATE barang SET
            nama_barang='$nama',
            harga=$harga,
            stok=$stok,
            id_supplier=$supplier

            WHERE id_barang=$id

        ";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}
function hapusBarang($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM barang WHERE id_barang=$id");

    return mysqli_affected_rows($conn);
}
//supplier
function tambahSupplier($data)
{
    global $conn;

    $nama = htmlspecialchars($data["nama_supplier"]);
    $telp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);

    $query = "INSERT INTO supplier (nama_supplier, no_telp, alamat)
        VALUES
        ('$nama', $telp, '$alamat')";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

function ubahSupplier($data)
{
    global $conn;

    $id = $data["id_supplier"];
    $nama = htmlspecialchars($data["nama_supplier"]);
    $telp = htmlspecialchars($data["no_telp"]);
    $alamat = htmlspecialchars($data["alamat"]);


    $query = "UPDATE supplier SET
            nama_supplier='$nama',
            no_telp=$telp,
            alamat='$alamat'
            WHERE id_supplier=$id";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);

}

function hapusSupplier($id)
{
    global $conn;
    mysqli_query($conn, "DELETE FROM supplier WHERE id_supplier=$id");

    return mysqli_affected_rows($conn);
}

function cariBarang($keyword)
{

    $barang = query(
        "SELECT barang.id_barang as id_barang, barang.nama_barang as nama_barang, barang.harga as harga, barang.stok as stok, barang.id_supplier as id_supplier, supplier.nama_supplier as nama_supplier
    FROM barang
    LEFT JOIN supplier
    ON barang.id_supplier = supplier.id_supplier
    WHERE nama_barang LIKE '%$keyword%'"
    );


    return $barang;
}

function cariSupplier($keyword)
{

    $supplier = query(
        "SELECT *
    FROM supplier
    WHERE nama_supplier LIKE '%$keyword%'"
    );


    return $supplier;
}

?>