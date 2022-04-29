<div class="container text-center">
	<div class="card">
		<div class="card-header">
			<h4 class="card-title">Iuran Wajib</h4>
		</div>
		<div class="card-body">
			<table class="table">
				<thead>
					<tr>
						<th scope="col">No</th>
						<th scope="col">Semester Satu (Januari - Juni)</th>
						<th scope="col">Semester Dua (Juli - Desember)</th>
						<th scope="col">Aksi</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>1</td>
						<td>Rp. <?php echo $iuran[0]['smt_satu'] ?></td>
						<td>Rp. <?php echo $iuran[0]['smt_dua'] ?></td>
						<td>
							<a href="<?php echo base_url() . 'admink/editiuranwajib/' . $iuran[0]['id']; ?>" class="btn btn-sm btn-primary"><i class="fas fa-edit"></i> Edit</a>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</div>
