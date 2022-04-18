<?php
session_start();
require '../functions.php';

function tambah($data)
{
    global $conn;
    
    $nilai = $data['nilai'];
    $keterangan_nilai = $data['keterangan_nilai'];

    // tambahkan data ke database
    mysqli_query($conn, "INSERT INTO preferensi 
        (nilai,keterangan_nilai)
        VALUES
        ('$nilai','$keterangan_nilai')");

    return mysqli_affected_rows($conn);
}

//Jika Tombol Tambah Ditekan
if (isset($_POST["tambah"])) {

    if (tambah($_POST) > 0) {
        $_SESSION['status'] = "Data Preferensi";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Terkirim";
        header("Location: ../nilai_preferensi.php");
    } else {
        $_SESSION['status'] = "Data Preferensi";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Terkirim";
        header("Location: ../nilai_preferensi.php");
    }
}