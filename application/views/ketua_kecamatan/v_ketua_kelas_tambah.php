<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Tambah Ketua Kelas Baru</h4>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url().'ketua_kecamatan/ketua_kelas' ?>" class='btn btn-sm btn-light btn-outline-dark pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <form method="post" action="<?php echo base_url().'ketua_kecamatan/ketua_kelas_tambah_aksi'; ?>">
      <div class="row">
      
        		<div class="col-sm-6">
        			<div class="form-group">
              <label class="font-weight-bold" >Nama Ketua Kelas</label>
						<input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan Nama Ketua Kelas" required="true">
					</div>
        		</div>
	            <div class="col-sm-3">
	            	<div class="form-group">
                <label class="font-weight-bold" >Nomor HP</label>
                <input type="text" name="hp" id="hp" class="form-control" placeholder="Masukkan Nomor Hp Ketua Kelas" required="true">
					</div>
					</div>

					<div class="col-sm-3">
	            	<div class="form-group">
					<label class="font-weight-bold" >Jenis Kelamin</label><br>
						<input type="radio" name="jenis_kelamin" id="jenkel1" value="L" required="true"> Laki-laki
						<input type="radio" name="jenis_kelamin" id="jenkel2" value="P"> Perempuan
					</div>
					<p class="text-danger" id="err_jenkel"></p>
	            </div>

          <div class="col-sm-3">
        			<div class="form-group">
              <label class="font-weight-bold" >Username</label>
						<input type="text" name="username" id="username" placeholder="Masukkan Username" class="form-control" required="true">
					</div>
        		</div>
	            <div class="col-sm-3">
	            	<div class="form-group">
                <label class="font-weight-bold" >Password</label>
                <input type="text" name="password" id="password" class="form-control" placeholder="Masukkan Password" required="true">
          </div>

          </div>

          
          <div class="col-sm-6">
	            	<div class="form-group">
                <label class="font-weight-bold" >Nama Majelis</label>
                <input type="text" name="majelis" id="majelis" class="form-control" placeholder="Masukkan Nama Majelis" required="true">
          </div>

	            </div>
              <div class="col-sm-6">
        			<div class="form-group">
              <label class="font-weight-bold" >Nama Wali Kelas</label>
						<input type="text" name="wali" id="wali" class="form-control" placeholder="Masukkan Nama Wali Kelas" required="true">
					</div>
        		</div>
	            <div class="col-sm-6">
	            	<div class="form-group">
                <label class="font-weight-bold" >Nomor HP</label>
                <input type="text" name="hp_wali" id="hp_wali" class="form-control" placeholder="Masukkan Nomor HP Wali Kelas" required="true">
					</div>
          </div>          
			</div>
      
      <div class="col-sm-14">
	            	<div class="form-group">
                <label class="font-weight-bold" >Nama Gampong</label>
                <input type="text" name="gampong" class="form-control" placeholder="Masukkan Nama Gampong" required="true">
					</div>
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