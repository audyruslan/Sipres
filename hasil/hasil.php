<div class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1 class="m-0 text-dark">Hasil</h1>
			</div><!-- /.col -->
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item"><a href="?module=home">Home</a></li>
					<li class="breadcrumb-item active">Hasil</li>
				</ol>
			</div><!-- /.col -->
		</div><!-- /.row -->
	</div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
<!-- Main content -->
<section class="content">
	<div class="row">
		<div class="col-6">

			<div class="card">
				<div class="card-header">
					<h2>Hasil Perhitungan Metode WP</h2>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>No. Register</th>
								<th>Nama Narapidana</th>
								<th>Hasil WP</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql =  mysqli_query($koneksi, "SELECT * FROM vektor_v,narapidana WHERE vektor_v.id_narapidana=narapidana.id_narapidana ORDER BY vektor_v.nilai_vektor DESC");
							$no = 1;
							while ($row = mysqli_fetch_array($sql)) {
							?>

								<tr>

									<td><?php echo $angka++ ?></td>
									<td><?php echo $row['no_registrasi']; ?></td>
									<td><?php echo $row['nama_narapidana']; ?></td>
									<td><?php echo $row['nilai_vektor']; ?></td>
								</tr>

							<?php
								$no++;
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
		<div class="col-6">

			<div class="card">
				<div class="card-header">
					<h2>Hasil Perhitungan Metode WASPAS</h2>
				</div>
				<!-- /.card-header -->
				<div class="card-body">
					<table id="example2" class="table table-bordered table-striped">
						<thead>
							<tr>
								<th>No</th>
								<th>No. Register</th>
								<th>Nama Narapidana</th>
								<th>Hasil WASPAS</th>
							</tr>
						</thead>
						<tbody>
							<?php
							$sql =  mysqli_query($koneksi, "SELECT * FROM hasil_waspas,narapidana WHERE hasil_waspas.id_narapidana=narapidana.id_narapidana ORDER BY hasil_waspas.hasil_waspas DESC");
							$no = 1;
							while ($row = mysqli_fetch_array($sql)) {

							?>

								<tr>

									<td><?php echo $no ?></td>
									<td><?php echo $row['no_registrasi']; ?></td>
									<td><?php echo $row['nama_narapidana']; ?></td>
									<td><?php echo $row['hasil_waspas']; ?></td>
								</tr>

							<?php
								$no++;
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

	