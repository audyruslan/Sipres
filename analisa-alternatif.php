<?php
session_start();
$title = "Analisa Alternatif - Sipres";
require 'layouts/header.php';
require 'layouts/navbar.php';
require 'functions.php';
if (!isset($_SESSION["username"])) {
    echo '<script>
                    alert("Mohon login dahulu !");
                    window.location="' . $base_url . '/";
                </script>';
    return false;
}

if ($_SESSION["role_id"] != "1") {
    echo '<script>
                    alert("Maaf Anda Tidak Berhak Ke Halaman ini !");
                    window.location="' . $base_url . '/' . $_SESSION["role"] . '/";
                    </script>';
    return false;
}
$user = $_SESSION["username"];
$query = mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
$admin = mysqli_fetch_assoc($query);
require 'layouts/sidebar.php';

include("includes/config.php");
$config = new Config();
$db = $config->getConnection();
include_once('includes/skor.inc.php');
include_once('includes/alternatif.inc.php');
include_once('includes/kriteria.inc.php');
include_once('includes/nilai.inc.php');

$altObj = new Alternatif($db);
$skoObj = new Skor($db);
$kriObj = new Kriteria($db);
$nilObj = new Nilai($db);

$altCount = $altObj->countByFilter();

$no = 1;
$r = [];
$nid = [];
$alt1 = $altObj->readByFilter();
while ($row = $alt1->fetch(PDO::FETCH_ASSOC)) {
    $alt2 = $altObj->readByFilter();
    while ($roww = $alt2->fetch(PDO::FETCH_ASSOC)) {
        $nid[$row['id_alternatif']][] = $roww['id_alternatif'];
    }
    $total = $altCount - $no;
    if ($total >= 1) {
        $r[$row['id_alternatif']] = $total;
    }
    $no++;
}

$ni = 1;
foreach ($nid as $key => $value) {
    array_splice($nid[$key], 0, $ni++);
}
$ne = count($nid) - 1;
array_splice($nid, $ne, 1);
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Analisa Alternatif</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Analisa Alternatif</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-secondary">
                <div class="row p-3">
                    <div class="col">
                        <table class="table table-striped table-bordered" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>

                                </tr>
                            </thead>
                            <?php
                            $no = 1;
                            $alt1a = $altObj->readByFilter();
                            while ($row = $alt1a->fetch(PDO::FETCH_ASSOC)) :
                            ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= $row['id_alternatif']; ?></td>
                                <td><?= $row['nama']; ?></td>
                                <td><?= $row['nilai']; ?></td>
                                <td>
                                    <?php
                                        if ($row['keterangan'] == "B") {
                                            echo "Baik";
                                        } elseif ($row['keterangan'] == "C") {
                                            echo "Cukup";
                                        } else {
                                            echo "Kurang";
                                        }
                                        ?>
                                </td>
                                <td>
                                    <a class="btn btn-primary btn-sm" data-toggle="modal"
                                        data-target="#exampleModal<?= $row["id_alternatif"] ?>">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                </td>
                            </tr>


                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal<?= $row["id_alternatif"] ?>" tabindex="-1"
                                role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Nilai Detail</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <h2></h2>
                                            <hr>

                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-dismiss="modal">Tutup</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endwhile; ?>
                        </table>
                    </div>
                </div>

            </div>

            <div class="card card-outline card-secondary">
                <div class="container">
                    <form method="post" action="analisa-alternatif-tabel.php">
                        <div class="row text-center p-3">
                            <div class="col-md-3">
                                <label for="">Pilih Kriteria</label>
                            </div>
                            <div class="col-md-9">
                                <select class="form-control" id="kriteria" name="kriteria">
                                    <?php $kri2 = $kriObj->readAll();
                                    while ($row = $kri2->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <option value="<?= $row['id_kriteria'] ?>"><?= $row['nama_kriteria'] ?></option>
                                    <?php endwhile; ?>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row text-center">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kriteria Pertama</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Penilaian</label>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Kriteria Kedua</label>
                                </div>
                            </div>
                        </div>

                        <?php $no = 1;
                        foreach ($r as $k => $v) : ?>
                        <?php $j = 0;
                            for ($i = 1; $i <= $v; $i++) : ?>
                        <?php $rows = $altObj->readSatu($k);
                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                        <div class="row">
                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <?php $rows = $skoObj->readAlternatif($k);
                                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <input type="text" class="form-control" value="<?= $row['nama'] ?>" readonly />
                                    <input type="hidden" name="<?= $k ?><?= $no ?>"
                                        value="<?= $row['id_alternatif'] ?>" />
                                    <?php endwhile; ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <select class="form-control" name="nl<?= $no ?>">
                                        <?php $stmt1 = $nilObj->readAll();
                                                    while ($row2 = $stmt1->fetch(PDO::FETCH_ASSOC)) : ?>
                                        <option value="<?= $row2['jum_nilai'] ?>"><?= $row2['jum_nilai'] ?> -
                                            <?= $row2['ket_nilai'] ?></option>
                                        <?php endwhile; ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-3">
                                <div class="form-group">
                                    <?php $rows = $skoObj->readAlternatif($nid[$k][$j]);
                                                while ($row = $rows->fetch(PDO::FETCH_ASSOC)) : ?>
                                    <input type="text" class="form-control" value="<?= $row['nama'] ?>" readonly />
                                    <input type="hidden" name="<?= $nid[$k][$j] ?><?= $no ?>"
                                        value="<?= $row['id_alternatif'] ?>" />
                                    <?php endwhile; ?>
                                </div>
                            </div>
                        </div>
                        <?php endwhile;
                                $no++;
                                $j++; ?>
                        <?php endfor; ?>
                        <?php endforeach; ?>
                        <button type="submit" name="submit" class="btn btn-dark mb-3"> Selanjutnya <span
                                class="fa fa-arrow-right"></span></button>
                    </form>
                </div>
            </div>

        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>