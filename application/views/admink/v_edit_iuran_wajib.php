<div class="container">
	<div class="card">
		<div class="card-header text-center">
			<h4>Edit Jumlah Iuran Wajib</h4>
		</div>
		<div class="card-body">
			<br />
			<br />
			<?php foreach ($iuran as $row1) { ?>
				<form method="post" action="<?php echo base_url() . 'admink/editiuranwajibaksi/'; ?>">
					<div class="form-group">
						<input type="hidden" name="id" value="<?php echo $row1->id; ?>">
						<label class="font-weight-bold">Semester 1 (Januari - Juni)</label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1">Rp.</span>
							<input name="smt_satu" type="number" class="form-control" aria-label="Jumlah Iuran" aria-describedby="basic-addon1" value="<?= $row1->smt_satu; ?>">
						</div>
						<label class="font-weight-bold">Semester 2 (Juli - Desember)</label>
						<div class="input-group mb-3">
							<span class="input-group-text" id="basic-addon1">Rp.</span>
							<input name="smt_dua" type="number" class="form-control" aria-label="Jumlah Iuran" aria-describedby="basic-addon1" value="<?= $row1->smt_dua; ?>">
						</div>
					</div>
					<input type="submit" class="btn btn-primary" value="Simpan">
					<button type="button" onclick="history.back(-1)" class="btn btn-dark">Kembali</button>
				</form>
			<?php } ?>
		</div>
	</div>
</div>
