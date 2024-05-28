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

function fetchAllItems()
{
    global $connection;
    $query = "SELECT * FROM barang";
    $result = mysqli_query($connection, $query);

    $items = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $items[] = $row;
    }
    return $items;
}

function fetchItems($id)
{
    global $connection;
    $query = "SELECT * FROM barang WHERE `id`='$id'";
    $result = mysqli_query($connection, $query);
    return mysqli_fetch_assoc($result);
}

if (isset($_POST['fetchAllItems'])) {
    echo json_encode(fetchAllItems());
    exit;
}

if (isset($_POST['fetchItems'])) {
    echo json_encode(fetchItems($_POST['idEdit']));
    exit;
}

if (isset($_POST['addData'])) {
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jumlah = intval($_POST['jumlah']);
    $satuan = $_POST['satuan'];
    $harga = doubleval($_POST['harga']);
    if ($jumlah > 0) {
        $status = 1;
    } else {
        $status = 0;
    }

    $query = "INSERT INTO `barang` (`id`, `kode_barang`, `nama_barang`, `jumlah_barang`, `satuan_barang`, `harga_beli`, `status_barang`) VALUES (NULL, '$kode', '$nama', '$jumlah', '$satuan', '$harga', '$status')";

    $result = mysqli_query($connection, $query);
    if ($result) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data: " . mysqli_error($connection);
    }
}

if (isset($_POST['idedit'])) {
    $idEdit = $_POST['idedit'];
    $kode = $_POST['kode'];
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    $satuan = $_POST['satuan'];
    $harga = $_POST['harga'];
    if ($jumlah > 0) {
        $status = 1;
    } else {
        $status = 0;
    }

    $query = "UPDATE barang SET kode_barang='$kode', nama_barang='$nama', jumlah_barang='$jumlah', satuan_barang='$satuan', harga_beli='$harga', status_barang='$status' WHERE id='$idEdit'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Data update successfully";
    } else {
        echo "Error updating data: " . mysqli_error($connection);
    }
}

if (isset($_POST['pakaiBarang'])) {
    $jumlahPakai = $_POST['jumlah_pakai'];
    $barangId = $_POST['barangId'];

    $query = "SELECT `id`,`jumlah_barang` FROM barang WHERE `id`='$barangId'";
    $result = mysqli_query($connection, $query);
    $row  = mysqli_fetch_assoc($result);

    if ($jumlahPakai > $row['jumlah_barang']) {
        echo "exceeds the available amount";
        exit;
    }

    $query = "UPDATE barang SET `jumlah_barang` = `jumlah_barang`-'$jumlahPakai' WHERE `id` = '$barangId'";
    mysqli_query($connection, $query);
    echo "item successfully used";
}

if (isset($_POST['restockID'])) {
    $idEdit = $_POST['restockID'];
    $nama = $_POST['nama'];
    $jumlah = $_POST['jumlah'];
    if ($jumlah > 0) {
        $status = 1;
    } else {
        $status = 0;
    }

    $query = "UPDATE barang SET jumlah_barang='$jumlah', status_barang='$status' WHERE id='$idEdit'";
    $result = mysqli_query($connection, $query);

    if ($result) {
        echo "Data update successfully";
    } else {
        echo "Error updating data: " . mysqli_error($connection);
    }
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
