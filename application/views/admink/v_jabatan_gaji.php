<div class="container">
	<div class="card">
		<div class="card-header">
			<h2 class="card-title">Karyawan</h2>
		</div>
		<div class="card-body">
			<?php
			if ($this->uri->segment('3') == 3){
				?>
				<table class="table">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Ketua Kelas</th>
						<th scope="col">Majelis</th>
						<th scope="col">Gampong</th>
						<th scope="col">Kecamatan</th>
						<th scope="col">Iuran Kelas</th>
						<th scope="col">Gaji</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($gaji as $row) {
					?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row->nama; ?></td>
							<td><?php echo $row->majelis; ?></td>
							<td><?php echo $row->gampong; ?></td>
							<td><?php echo $row->kecamatan; ?></td>
							<td><?php echo rupiah($row->total); ?></td>
							<td><?php echo rupiah($row->total * $jabatan['2']->gaji / 100); ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
			<?php
			} else {
				?>
				<table class="table">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama</th>
						<th scope="col">Jabatan</th>
						<th scope="col">Gaji</th>
					</tr>
				</thead>
				<tbody>
					<?php
					$no = 1;
					foreach ($gaji as $row) {
					?>
						<tr>
							<td><?php echo $no++; ?></td>
							<td><?php echo $row->username; ?></td>
							<td><?php echo $row->jabatan; ?></td>
							<td><?php echo rupiah($row->gaji); ?></td>
						</tr>
					<?php
					}
					?>
				</tbody>
			</table>
				<?php
			}
			?>
			
		</div>
	</div>
</div>
