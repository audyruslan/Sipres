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

    $no = 1; $r = []; $nid = [];
    $alt1 = $altObj->readByFilter();
    while ($row = $alt1->fetch(PDO::FETCH_ASSOC)){
        $alt2 = $altObj->readByFilter();
        while ($roww = $alt2->fetch(PDO::FETCH_ASSOC)) {
            $nid[$row['id_alternatif']][] = $roww['id_alternatif'];
        }
        $total = $altCount-$no;
        if ($total>=1) {
            $r[$row['id_alternatif']] = $total;
        }
        $no++;
    }

    $ni=1;
    foreach ($nid as $key => $value) {
        array_splice($nid[$key], 0, $ni++);
    }
    $ne = count($nid)-1;
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
                        <table class="table table-bordered table-hover" id="preferensi" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>ID</th>
                                    <th>Nama</th>
                                    <th>Nilai</th>
                                    <th>Keterangan</th>
                                    <th>Aksi</th>

                                </tr> x
                            </thead>
                            <?php 
                            $no=1; $alt1a = $altObj->readByFilter(); while($row = $alt1a->fetch(PDO::FETCH_ASSOC)): 
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
                                    }elseif($row['keterangan'] == "C"){
                                        echo "Cukup";
                                    }else{
                                        echo "Kurang";
                                    }
                                ?>
                                </td>
                            </tr>
				            <?php endwhile; ?>  
                        </table>
                    </div>
                </div>

            </div>

            <div class="card card-outline card-secondary">
                <div class="row text-center p-3">
                    <div class="col-md-3">
                        <label for="">Pilih Kriteria</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-control" name="" id="">
                            <option >--Silahkan Pilih--</option>
                            <?php 
                                $sqlKriteria = mysqli_query($conn, "SELECT * FROM kriteria");
                                while($kriteria = mysqli_fetch_assoc($sqlKriteria)){
                            ?>
                            <option value="<?= $kriteria["id"]; ?>"><?= $kriteria["nama_kriteria"]; ?></option>
                            <?php 
                                }
                            ?>
                        </select>
                    </div>
                </div>
                <hr>
                <div class="row text-center p-3">
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
            </div>
        </div>
    </section>
</div>

<?php
require 'layouts/footer.php'; ?>