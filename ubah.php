<?php
error_reporting(E_ALL);
include_once 'koneksi.php';

if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga_jual = $_POST['harga_jual'];
    $harga_beli = $_POST['harga_beli'];
    $stok = $_POST['stok'];
    $file_gambar = $_FILES['file_gambar'];
    $gambar = null;

    if ($file_gambar['error'] == 0) {
        $filename = str_replace(' ', '_', $file_gambar['name']);
        $destination = dirname(__FILE__).'/gambar/' . $filename;

        if (move_uploaded_file($file_gambar['tmp_name'], $destination)) {
            $gambar = 'gambar/' . $filename;
        }
    }

    $sql = "UPDATE data_barang SET 
            nama='{$nama}', kategori='{$kategori}', 
            harga_jual='{$harga_jual}', harga_beli='{$harga_beli}', 
            stok='{$stok}'";

    if (!empty($gambar)) {
        $sql .= ", gambar='{$gambar}'";
    }

    $sql .= " WHERE id_barang='{$id}'";

    mysqli_query($conn, $sql);
    header("location: index.php");
}

$id = $_GET['id'];
$sql = "SELECT * FROM data_barang WHERE id_barang='{$id}'";
$result = mysqli_query($conn, $sql);
$data = mysqli_fetch_array($result);
?>