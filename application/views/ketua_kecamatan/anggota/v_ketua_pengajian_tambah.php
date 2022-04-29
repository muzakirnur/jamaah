<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Tambah Ketua Pengajian Baru</h4>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url().'ketua_kecamatan/ketua_pengajian' ?>" class='btn btn-sm btn-light btn-outline-dark pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <form method="post" action="<?php echo base_url().'ketua_kecamatan/ketua_pengajian_tambah_aksi'; ?>">
        <div class="form-group">
          <label class="font-weight-bold" for="nama">Nama Lengkap</label>
          <input type="text" class="form-control" name="nama" placeholder="Masukkan Nama Lengkap" required="required">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="hp">Masukkan Nomor Hp</label>
          <input type="text" class="form-control" name="hp" placeholder="Masukkan Nomor HP" required="required">
        </div>

         <div class="form-group">
          <label class="font-weight-bold" for="nama_majelis">Nama Majelis</label>
          <input type="text" class="form-control" name="nama_majelis" placeholder="Masukkan Nama Majelis" required="required">
        </div>

        <div class="form-group">

        <label class="font-weight-bold" >Kecamatan</label>
          <select name="id_kecamatan" id="kecamatan" class="form-control">
            <option value="">- Pilih Kecamatan</option>
            <?php
					foreach($kecamatan as $data){ // Lakukan looping pada variabel siswa dari controller
						echo "<option value='".$data->id_kecamatan."'>".$data->kecamatan."</option>";
					}
					?>
          </select>
        </div>
        <div class="form-group">
        
      <label class="font-weight-bold">Gampong</label>
      <select name="id_gampong" id="gampong" class="form-control">
					<option value="">Pilih Gampong</option>
				</select>
		
           </div>

        <input type="submit" class="btn btn-primary" value="Simpan">
      </form>

    </div>
  </div>
</div>
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