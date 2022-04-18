<?php

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "remisi";

$koneksi = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (mysqli_connect_errno()) {
    echo 'Gagal melakukan koneksi ke Database :  ' . mysqli_connect_error();
}

require '../fpdf/fpdf.php';

$pdf = new FPDF('L', 'mm', 'Letter');
$pdf->AddPage('L', 'A4');

$sql =  mysqli_query($koneksi, "SELECT * FROM vektor_v INNER JOIN hasil_waspas ON vektor_v.id_narapidana=hasil_waspas.id_narapidana ORDER BY vektor_v.nilai_vektor DESC LIMIT 15");
$no_hasil = 1;

$judul = "DATA NARAPIDANA YANG MENDAPAT REMISI";
$header = array(
    array("label" => "No.", "length" => 10, "align" => "C"),
    array("label" => "No. Register", "length" => 35, "align" => "C"),
    array("label" => "Nama Narapidana", "length" => 60, "align" => "C"),
    array("label" => "Agama", "length" => 20, "align" => "C"),
    array("label" => "Jenis Kelamin", "length" => 32, "align" => "C"),
    array("label" => "Tanggal Masuk", "length" => 40, "align" => "C"),
    array("label" => "Ekspirasi Akhir", "length" => 40, "align" => "C"),
    array("label" => "Hasil Ranking", "length" => 40, "align" => "C")
);

#sertakan library FPDF dan bentuk objek

#gambar kop
$pdf->Image('kop1.jpg', 10, 7, 277);

#tampilkan judul laporan
$pdf->SetFont('Arial', 'B', '16');
$pdf->Cell(0, 45, '', '0', 1, 'C');
$pdf->Cell(0, 15, $judul, '0', 1, 'C');

#buat header tabel
$pdf->SetFont('Arial', 'B', '12');
$pdf->SetFillColor(67, 72, 77);
$pdf->SetTextColor(255);
$pdf->SetDrawColor(0, 0, 0);
foreach ($header as $kolom) {
    $pdf->Cell($kolom['length'], 8, $kolom['label'], 1, '0', $kolom['align'], true);
}
$pdf->Ln();

#tampilkan data tabelnya
$pdf->SetFillColor(224, 235, 255);
$pdf->SetTextColor(0);
$pdf->SetFont('');
$fill = false;
while ($row = mysqli_fetch_array($sql)) {
    $id_tampil = $row['id_narapidana'];
    $sql_1 =  mysqli_query($koneksi, "SELECT * FROM narapidana WHERE id_narapidana='$id_tampil'");
    while ($row_1 = mysqli_fetch_array($sql_1)) {
        $tanggal1 = date('d-m-Y', strtotime($row_1['expirasi_awal']));
        $tanggal2 = date('d-m-Y', strtotime($row_1['expirasi_sementara']));
        $pdf->Cell(10, 8, $no_hasil++ . '.', 1, '0', 'C', $fill);
        $pdf->Cell(35, 8, $row_1['no_registrasi'], 1, '0', 'C', $fill);
        $pdf->Cell(60, 8, $row_1['nama_narapidana'], 1, '0', 'C', $fill);
        $pdf->Cell(20, 8, $row_1['agama'], 1, '0', 'C', $fill);
        $pdf->Cell(32, 8, $row_1['jenis_kelamin'], 1, '0', 'C', $fill);
        $pdf->Cell(40, 8, $tanggal1, 1, '0', 'C', $fill);
        $pdf->Cell(40, 8, $tanggal2, 1, '0', 'C', $fill);
        $hasil_akhir = (($row['nilai_vektor'] / 0.20069593053999) * 100) + (($row['hasil_waspas'] / 3.5) * 100);
        $pdf->Cell(40, 8, $hasil_akhir / 2, 1, '1', 'C', $fill);
    }
    $fill = !$fill;
}

#output file PDF
$pdf->Output('I');