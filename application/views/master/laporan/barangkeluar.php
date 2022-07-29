<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
		integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

</head>

<body>
	<div class="container-fluid">

		<!-- Page Heading -->
		<h1 class="h3 mb-4 text-gray-800">Laporan Barang Keluar</h1>

		<div class="row">

			<div class="col-lg-6">

				<!-- Circle Buttons -->
				<div class="card shadow mb-12">
					<div class="card-body">
						<form method="post" action="<?=base_url('Laporan-masuk-cari-keluar')?>" autocomplete="off">
							<label for="dari">Dari</label>
							<input type="date" name="dari" id="dari">
							<label for="sampai">Sampai</label>
							<input type="date" name="sampai" id="sampai">
							<input type="submit" value="Cari" class="btn btn-primary">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
  <!-- laporan -->
  <br><br>
  
	<div class="container-fluid">
  <div class="card shadow mb-12">
	<div class="card-body">
		<div class="table-responsive">
			<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
				<thead>
					<tr>
						<th>No</th>
						<th>Tanggal</th>
						<th>Nama Barang</th>
						<th>Jumlah Keluar</th>
						<th>Penerima</th>
						<th>Note</th>
					</tr>
				</thead>

				<tbody>
					<?php $no = 1; if (!empty($caribarang)) : ?>
					<?php foreach ($caribarang as $row) : 
								// $stok = $row->stokbarang;
								// $keluar = $row->keluar;
								// $jumlah = $stok-$keluar;
							?>
					<tr>
						<td><?php echo $no++; ?></td>
						<td><?php echo $row->tanggal ?></td>
						<td><?php echo $row->nama_barang ?></td>
						<td><?php echo $row->jumlah_keluar .' '. $row->satuan_barang ?></td>
						<td><?php echo $row->pic_penerima ?></td>
						<td><?php echo $row->note ?></td>

					</tr>
					<?php endforeach ?>
					<?php else: ?>
					<tr>
						<td colspan="9" align="center">Tidak Ada Data</td>
					</tr>
					<?php endif ?>
				</tbody>
        
			</table>
		</div>
		<!--Export Button-->
		<div class="d-flex flex-row-reverse">
			<div class="p-2">
				<a href="<?php
					$dari = $this->input->post('dari');
					$sampai = $this->input->post('sampai');
					echo base_url('Export-pdf-laporan-keluar/').$dari.'/'.$sampai ?>">
					<input type="submit" value="Export PDF" class="btn-sm btn-danger"><br>
				</a>
			</div>
			<div class="p-2">
				<a href="<?php
					echo base_url('Export-excel-trxout/').$dari.'/'.$sampai?>">
					<input type="submit" value="Export Excel" class="btn-sm btn-success"><br>
				</a>
			</div>
		</div>
	</div>
  </div>
  </div>
  <!-- end laporan -->
</body>

</html>
</div>
