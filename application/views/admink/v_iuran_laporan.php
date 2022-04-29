<div class="container ">

	<div class="card">
		<div class="card-header text-center">
			<h4>Data Iuran</h4>
		</div>
		<div class="card-body">

			<form method="get" action="<?php echo base_url() . 'admink/listdataiuran'; ?>">
				<div class="form-group">
					<label class="font-weight-bold">Kecamatan</label>
					<select required name="id_kecamatan" id="kecamatan" class="form-control">
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
					<select required name="id_gampong" id="gampong" class="form-control">
						<option value="">- Pilih Gampong</option>
					</select>

				</div>
				<div class="form-group">
					<label class="font-weight-bold">Tahun</label>
					<input class="form-control" type="text" name="year" id="year">
				</div>
				<div class="form-group">
					<label class="font-weight-bold">Pilih Tahap</label>
					<select class="form-select" name="semester" id="semester">
						<option selected>-- Pilih Tahap --</option>
						<option value="1">Tahap 1 | Januari - Juni</option>
						<option value="2">Tahap 2 | Juli - Desember</option>
					</select>
				</div>

				<div class="container text-center">
					<input type="submit" class="btn btn-primary" value="Filter">

				</div>

			</form>
		</div>
	</div>

</div>


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
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css" />

<script>
	$("#datepicker").datepicker({
		format: "mm-yyyy",
		startView: "months",
		minViewMode: "months"
	});
</script>
