<?php

$connection = mysqli_connect('localhost', 'root', '', 'inventory');

if (!$connection) {
    die('Connection to database Error : ' . mysqli_connect_error());
}

$query = "SELECT * FROM barang";
$dataBarang = mysqli_query($connection, $query);

if (!$dataBarang) {
    die('Query to database Error : ' . mysqli_error($connection));
}

if (isset($_POST['addData'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jumlah = intval($_POST['jumlah']);
    $satuan = $_POST['satuan'];
    $harga = doubleval($_POST['harga']);
    $status = $_POST['status'];
    

    $query = "INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `jumlah_barang`, `satuan_barang`, `harga_beli`, `status_barang`) VALUES (NULL, '$kode', '$nama', '$jumlah', '$satuan', '$harga', '$status')";

    $result = mysqli_query($connection, $query);    
    if ($result) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . mysqli_error($connection);
    }
}


if (isset($_POST['update'])) {
    echo "edit";
}
if (isset($_POST['restock'])) {
    echo "restock";
}
if (isset($_POST['idDelete'])) {
    $id = $_POST['idDelete'];
    $query = "DELETE FROM `barang` WHERE `id` = '$id'";
    $result = mysqli_query($connection, $query);    
    if ($result) {
        echo "Data deleted successfully";
    } else {
        echo "Error deleting data: " . mysqli_error($connection);
    }
}
