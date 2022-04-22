<?php
session_start();
$title = "Hasil Perangkingan - Sipres";
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
include_once 'includes/alternatif.inc.php';
include_once 'includes/kriteria.inc.php';
include_once 'includes/ranking.inc.php';

$altObj = new Alternatif($db);
$kriObj = new Kriteria($db);
$ranObj = new Ranking($db);
$stmt = $ranObj->readKhusus();
$stmty = $ranObj->readKhusus();
$count = $ranObj->countAll();
$stmtx1y = $ranObj->readBob();
$stmtx2y = $ranObj->readBob();
?>

<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Hasil Perangkingan</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                        <li class="breadcrumb-item active">Hasil Perangkingan</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
            <hr>
        </div><!-- /.container-fluid -->
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="card card-outline card-secondary p-3">
                <div class="container">
                    <div class="row">
                        <div class="col">
                            <form action="hasil/cetak_hasil.php" method="post" enctype="multipart/form-data">
                                <button class="btn btn-primary m-2" type="submit" style="float: right;">Cetak</button>
                            </form>

                            <?php for ($i = 2018; $i <= 2019; $i++) : ?>
                                <h4>Tahun <?= $i ?></h4>
                                <table width="100%" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>NIS</th>
                                            <th>Kelas</th>
                                            <th>Nama</th>
                                            <th>Hasil Akhir</th>
                                            <th class="success">Ranking</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $altObj->periode = $i;
                                        $rank = 1;
                                        $alt1c = $altObj->readByRank();
                                        while ($row = $alt1c->fetch(PDO::FETCH_ASSOC)) : ?>
                                            <tr>
                                                <td><?= $row["nis"] ?></td>
                                                <td><?= $altObj->getNamaKelas($row["id_kelas"]) ?></td>
                                                <td><?= $row["nama"] ?></td>
                                                <td><?= number_format($row["hasil_akhir"], 4, '.', ',') ?></td>
                                                <td class="success"><?= $rank++ ?></td>
                                            </tr>
                                        <?php endwhile; ?>
                                    </tbody>
                                </table>
                                <br>
                            <?php endfor; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>