<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Tambah Anggota Baru</h4>
    </div>
    <div class="card-body">
                <script type='text/javascript'>
Swal.fire(
  'Maaf!',
  'Nomor Tersebut Telah Digunakan!',
  'error'
)			</script>
      <a href="<?php echo base_url().'admin/anggota' ?>" class='btn btn-sm btn-light btn-outline-dark pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>
      

      <form method="post" action="<?php echo base_url().'admin/anggota_tambah_aksi'; ?>">
  
       <div class="form-group">
          <label class="font-weight-bold" for="no_anggota">Nomor Anggota</label>
          <input type="text" class="form-control" name="no_anggota" placeholder="Masukkan Nomor Anggota" required="required" >
        </div>
       
        <div class="form-group">
          <label class="font-weight-bold" for="nama">Nama Lengkap</label>
          <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap" required="required" >
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="nama_ortu">Nama Orang Tua</label>
          <input type="text" class="form-control" name="nama_ortu" placeholder="Masukkan nama orang tua" required="required" >
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="ttg">Tempat/Tanggal Lahir</label>
          <input type="text" class="form-control" name="ttg" placeholder="Masukkan Tempat/Tanggal Lahir" required="required" >
        </div>
        <div class="form-group">
          <label class="font-weight-bold"for="jenis_kelamin" required="required">Jenis Kelamin</label><br>
        <p><input type='radio' name='jenis_kelamin' value='L' checked='checked' />Laki-Laki</p>
      <p><input type='radio' name='jenis_kelamin' value='P' />Perempuan</p>
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="kabupaten">Kabupaten</label>
          <input type="text" class="form-control" name="kabupaten" readonly value="Bireun">
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

