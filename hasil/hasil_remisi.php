<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Hasil Remisi</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="?module=home">Home</a></li>
					<li class="breadcrumb-item active">Hasil Remisi</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<div class="" hidden>
	<?php
	$sql =  mysqli_query($koneksi, "SELECT * FROM vektor_v,narapidana WHERE vektor_v.id_narapidana=narapidana.id_narapidana ORDER BY vektor_v.nilai_vektor DESC LIMIT 5");
	$no_wp = 1;
	while ($row = mysqli_fetch_array($sql)) {
		$get_wp[$no_wp] = $no_wp . '-' . $row['id_narapidana'];
	?>
		<tr>
			<td><?php echo $angka++ ?></td>
			<td><?php echo $row['no_registrasi']; ?></td>
			<td><?php echo $row['id_narapidana']; ?></td>
			<td><?php echo $row['nilai_vektor']; ?></td>
		</tr>
	<?php
		$no_wp++;
	}
	?>
</div>
<div class="" hidden>
	<?php
	$sql =  mysqli_query($koneksi, "SELECT * FROM hasil_waspas,narapidana WHERE hasil_waspas.id_narapidana=narapidana.id_narapidana ORDER BY hasil_waspas.hasil_waspas DESC LIMIT 5");
	$no_waspas = 1;
	while ($row = mysqli_fetch_array($sql)) {
		$get_waspas[$no_waspas] = $no_waspas . '-' . $row['id_narapidana'];
	?>

		<tr>

			<td><?php echo $no_waspas ?></td>
			<td><?php echo $row['no_registrasi']; ?></td>
			<td><?php echo $row['nama_narapidana']; ?></td>
			<td><?php echo $row['hasil_waspas']; ?></td>
		</tr>

	<?php
		$no_waspas++;
	}
	?>
</div>
<section class="content">
	<div class="row">
		<div class="col-12">

			<div class="card">
				<div class="card-header">
					<h2 style="float: left;">Hasil Perhitungan Remisi</h2>
					<form action="modul/hasil/cetak_hasil.php" method="post" enctype="multipart/form-data">
						<button class="btn btn-primary" type="submit" style="float: right;">Cetak Data Remisi</button>
					</form>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>No. Register</th>
								<th>Nama Narapidana</th>
								<th>Hasil Akhir</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql =  mysqli_query($koneksi, "SELECT * FROM vektor_v INNER JOIN hasil_waspas ON vektor_v.id_narapidana=hasil_waspas.id_narapidana ORDER BY vektor_v.nilai_vektor DESC LIMIT 15");
							$no_hasil = 1;
							while ($row = mysqli_fetch_array($sql)) {
								$id_tampil = $row['id_narapidana']
							?>
								<tr>
									<td><?php echo $no_hasil++ ?></td>
									<?php $sql_1 =  mysqli_query($koneksi, "SELECT * FROM narapidana WHERE id_narapidana='$id_tampil'");
									while ($row_1 = mysqli_fetch_array($sql_1)) { ?>
										<td><?php echo $row_1['no_registrasi']; ?></td>
										<td><?php echo $row_1['nama_narapidana']; ?></td>
									<?php }
									$hasil_akhir = (($row['nilai_vektor'] / 0.20069593053999) * 100) + (($row['hasil_waspas'] / 3.5) * 100);
									?>
									<td><?php echo $hasil_akhir / 2; ?></td>
								</tr>
							<?php
							}
							?>
						</tbody>
					</table>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
	<div class="row">
		<div class="col-6">

			<div class="card">
				<div class="card-header">
					<h2>Grafik Hasil Perhitungan Metode WP</h2>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<?php include "grafik2.php" ?>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
		<div class="col-6">

			<div class="card">
				<div class="card-header">
					<h2>Grafik Hasil Perhitungan Metode WASPAS</h2>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<?php include "grafik.php" ?>
				</div>
				<!-- /.card-body -->
			</div>
			<!-- /.card -->
		</div>
		<!-- /.col -->
	</div>
	<!-- /.row -->
</section>
<!-- /.content --

	