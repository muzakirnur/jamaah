		<table cellpadding="8">
		<tr>
			<td><b>kecamatan</b></td>
			<td>
			<div class="form-group">
          <label class="font-weight-bold" for="kelas">kelas</label>
          <select name="kelas" class="form-control">
            <option value="">- Pilih kelas</option>
            <?php
					foreach($kecamatan as $data){ // Lakukan looping pada variabel siswa dari controller
						echo "<option value='".$data->id_kecamatan."'>".$data->kecamatan."</option>";
					}
					?>
          </select>
        </div>
			</td>
		</tr>
		<tr>
			<td><b>gampong</b></td>
			<td>
				<select name="id_gampong" id="id_gampong" style="width: 200px;">
					<option value="">Pilih</option>
				</select>

				<div id="loading" style="margin-top: 15px;">
					<img src="images/loading.gif" width="18"> <small>Loading...</small>
				</div>
			</td>
		</tr>
	</table>
	
	<!-- Load librari/plugin jquery nya -->
	<script src="<?php echo base_url("js/jquery.min.js"); ?>" type="text/javascript"></script>
	
	<script>
	$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
		// Kita sembunyikan dulu untuk loadingnya
		$("#loading").hide();
		
		$("#kecamatan").change(function(){ // Ketika user mengganti atau memilih data kecamatan
			$("#gampong").hide(); // Sembunyikan dulu combobox gampong nya
			$("#loading").show(); // Tampilkan loadingnya
		
			$.ajax({
				type: "POST", // Method pengiriman data bisa dengan GET atau POST
				url: "<?php echo base_url("index.php/form/listgampong"); ?>", // Isi dengan url/path file php yang dituju
				data: {id_kecamatan : $("#kecamatan").val()}, // data yang akan dikirim ke file yang dituju
				dataType: "json",
				beforeSend: function(e) {
					if(e && e.overrideMimeType) {
						e.overrideMimeType("application/json;charset=UTF-8");
					}
				},
				success: function(response){ // Ketika proses pengiriman berhasil
					$("#loading").hide(); // Sembunyikan loadingnya

					// set isi dari combobox gampong
					// lalu munculkan kembali combobox gampongnya
					$("#gampong").html(response.list_gampong).show();
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
				}
			});
		});
	});
	</script>


