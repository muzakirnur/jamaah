<div class="container">

	<?php
	echo
	'<div class="alert alert-success alert-dismissible fade show" role="alert">' .
		$this->session->flashdata('success') . '
	
	<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>';
	?>
	<div class="card">
		<div class="card-header text-center">
			<h4>Tambah Iuran</h4>
		</div>
		<div class="card-body">

			<form method="post" action="<?php echo base_url() . 'admink/tambahiuranaksi'; ?>">
				<div class="form-group">
					<label class="font-weight-bold">Kecamatan</label>
					<select name="kecamatan" id="kecamatan" class="form-control" required>
						<option value="">- Pilih Kecamatan</option>
						<?php
						foreach ($kecamatan as $data) { // Lakukan looping pada variabel siswa dari controller
							echo "<option value='" . $data->id_kecamatan . "'>" . $data->kecamatan . "</option>";
						}
						?>
					</select>
				</div>
				<div class="form-group">

					<label class="font-weight-bold">Gampong</label>
					<select name="gampong" id="gampong" class="form-control" required>
						<option value="">- Pilih Gampong</option>
					</select>
				</div>
				<div class="form-group">
					<label class="font-weight-bold">Anggota</label>
					<select name="persiswa" id="persiswa" class="form-control" required>
						<option value="">- Pilih Anggota</option>
					</select>
				</div>
				<div class="form-group">
					<label class="font-weight-bold">Tanggal</label>
					<div class="input-group mb-3">
						<input name="tanggal_iuran" required type="date" min="2015" max="2030" step="1" value="2022" class="form-control" aria-label="Jumlah Iuran" aria-describedby="basic-addon1">
					</div>
				</div>
				<div class="form-group">
					<label class="font-weight-bold">Jumlah Iuran</label>
					<div class="input-group mb-3">
						<span class="input-group-text" id="basic-addon1">Rp.</span>
						<input name="jumlah_iuran" required type="number" class="form-control" placeholder="00" aria-label="Jumlah Iuran" aria-describedby="basic-addon1">
					</div>
				</div>
				<div class="container text-center">
					<input type="submit" class="btn btn-primary" value="Tambah">
				</div>
			</form>

		</div>
	</div>
</div>
<script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>

<script>
	$(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
		// Kita sembunyikan dulu untuk loadingnya
		$("#loading").hide();

		$("#kecamatan").change(function() { // Ketika user mengganti atau memilih data kecamatan
			$("#gampong").hide(); // Sembunyikan dulu combobox gampong nya
			$("#loading").show(); // Tampilkan loadingnya

			$.ajax({
				type: "POST", // Method pengiriman data bisa dengan GET atau POST
				url: "<?php echo base_url("index.php/form/listpilahgampong"); ?>", // Isi dengan url/path file php yang dituju
				data: {
					id_kecamatan: $("#kecamatan").val()
				}, // data yang akan dikirim ke file yang dituju
				dataType: "json",
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response) { // Ketika proses pengiriman berhasil
					$("#loading").hide(); // Sembunyikan loadingnya

					// set isi dari combobox gampong
					// lalu munculkan kembali combobox gampongnya
					$("#gampong").html(response.listpilah).show();
				},
				error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
				}
			});
		});
	});
</script>

<script>
	$(document).ready(function() { // Ketika halaman sudah siap (sudah selesai di load)
		// Kita sembunyikan dulu untuk loadingnya
		$("#loading").hide();

		$("#gampong").change(function() { // Ketika user mengganti atau memilih data gampong
			$("#persiswa").hide(); // Sembunyikan dulu combobox persiswa nya
			$("#loading").show(); // Tampilkan loadingnya

			$.ajax({
				type: "POST", // Method pengiriman data bisa dengan GET atau POST
				url: "<?php echo base_url("index.php/form/listpersiswa3"); ?>", // Isi dengan url/path file php yang dituju
				data: {
					gampong: $("#gampong").val()
				}, // data yang akan dikirim ke file yang dituju
				dataType: "json",
				beforeSend: function(e) {
					if (e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response) { // Ketika proses pengiriman berhasil
					$("#loading").hide(); // Sembunyikan loadingnya

					// set isi dari combobox persiswa
					// lalu munculkan kembali combobox persiswanya
					$("#persiswa").html(response.list_persiswa).show();
				},
				error: function(xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
				}
			});
		});
	});
</script>
<!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<script>
	$("#datepicker").datepicker({
		format: "mm-yyyy",
		startView: "months",
		minViewMode: "months"
	});
</script>
