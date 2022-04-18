<?php
session_start();
require '../functions.php';

function ubah($data)
{
    global $conn;
    $id = $data["id_kriteria"];
    $nama_kriteria = $data['nama_kriteria'];

    $query = "UPDATE kriteria
                SET
				nama_kriteria = '$nama_kriteria'
                WHERE id_kriteria = $id
			";

    mysqli_query($conn, $query);

    return mysqli_affected_rows($conn);
}

// Ubah Data
// cek apakah tombol submit sudah ditekan atau belum
if (isset($_POST["ubah"])) {

    // cek apakah data berhasil diubah atau tidak
    if (ubah($_POST) > 0) {
        $_SESSION['status'] = "Frequently Asked Questions";
        $_SESSION['status_icon'] = "success";
        $_SESSION['status_info'] = "Berhasil Diubah";
        header("Location: ../kriteria.php");
    } else {
        $_SESSION['status'] = "Frequently Asked Questions";
        $_SESSION['status_icon'] = "error";
        $_SESSION['status_info'] = "Gagal Diubah";
        header("Location: ../kriteria.php");
    }
}