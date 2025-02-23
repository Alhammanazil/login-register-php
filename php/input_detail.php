<?php
session_start();
include "../db_conn.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Tangkap data dari formulir
    $nama_barang = $_POST['nama_barang'];
    $total_nominal = $_POST['total_nominal'];
    $total_jumlah = $_POST['total_jumlah'];
    $nama_sub_sumbangan = $_POST['nama_sub_sumbangan'];
    $atas_nama = $_POST['atas_nama'];
    $keterangan = $_POST['keterangan'];

    // Retrieve the maximum value of kodetrx from the input table
    $maxQuery = "SELECT MAX(kodetrx) AS max_kodetrx FROM input";
    $maxResult = mysqli_query($conn, $maxQuery);
    $maxRow = mysqli_fetch_assoc($maxResult);
    $kodetrx = $maxRow['max_kodetrx'];

    // Submit data to the database
    $sql = "INSERT INTO input_detail (nama_barang, total_nominal, total_jumlah, nama_sub_sumbangan, atas_nama, keterangan, kodetrx) 
    VALUES ('$nama_barang', '$total_nominal', '$total_jumlah', '$nama_sub_sumbangan', '$atas_nama', '$keterangan', '$kodetrx')";

    if (mysqli_query($conn, $sql)) {
        echo "<script>
                alert('Data berhasil ditambahkan');
                window.location.href = '../input_detail.php?success=1';
              </script>";
        exit();
    } else {
        echo "<script>
                alert('Data gagal ditambahkan');
                window.location.href = '../input_detail.php?error=1';
              </script>";
        exit();
    }
}