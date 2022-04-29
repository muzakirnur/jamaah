<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Edit Ketua Kelas</h4>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url().'ketua_kecamatan/ketua_kelas' ?>" class='btn btn-sm btn-light btn-outline-dark pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <?php foreach($ketua_kelas as $p){ ?>
        <form method="post" action="<?php echo base_url().'ketua_kecamatan/ketua_kelas_update'; ?>">
        <div class="row">
        <input type="hidden" name="id" class="form-control" required="true" value="<?php echo $p->id; ?>">
      <div class="col-sm-6">
        <div class="form-group">
        <label class="font-weight-bold" >Nama Ketua Kelas</label>
      <input type="text" name="nama" id="nama" class="form-control" required="true" value="<?php echo $p->nama; ?>">
    </div>
      </div>
        <div class="col-sm-6">
          <div class="form-group">
          <label class="font-weight-bold" >Nomor HP</label>
          <input type="text" name="hp" id="hp" class="form-control" required="true" value="<?php echo $p->hp; ?>">
    </div>
    </div>


    <div class="col-sm-3">
        <div class="form-group">
        <label class="font-weight-bold" >Username</label>
      <input type="text" name="username" id="username" class="form-control" required="true" value="<?php echo $p->username; ?>">
    </div>
      </div>
        <div class="col-sm-3">
          <div class="form-group">
          <label class="font-weight-bold" >Password</label>
          <input type="text" name="password" id="password" class="form-control" >
          <small class="form-text text-muted">Kosongkan jika tidak ingin mengubah password.</small>
    </div>

    </div>

    
    <div class="col-sm-6">
          <div class="form-group">
          <label class="font-weight-bold" >Nama Majelis</label>
          <input type="text" name="majelis" id="majelis" class="form-control" required="true" value="<?php echo $p->majelis; ?>">
    </div>

        </div>
        <div class="col-sm-6">
        <div class="form-group">
        <label class="font-weight-bold" >Nama Wali Kelas</label>
      <input type="text" name="wali" id="wali" class="form-control" required="true" value="<?php echo $p->wali; ?>">
    </div>
      </div>
        <div class="col-sm-6">
          <div class="form-group">
          <label class="font-weight-bold" >Nomor HP</label>
          <input type="text" name="hp_wali" id="hp_wali" class="form-control" required="true" value="<?php echo $p->hp_wali; ?>">
    </div>
    </div>          
</div>




          <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
      <?php } ?>

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