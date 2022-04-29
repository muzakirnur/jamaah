<div class="container">
  <div class="card ">
    <div class="card-header text-center">
      <h4>Rekapan Absensi Pengajian Ketua Kecamatan</h4>
    </div>
    <div class="card-body ">

      <br/>

      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card ">
            <div class="card-header  text-center">
              <h6>Filter Berdasarkan Tanggal</h6>
            </div>
            <div class="card-body">

            <form method="post" action="<?php echo base_url().'absensi/rekapan_absen_ketua_kecamatan'?>">
              <div class="form-group">
              <label class="font-weight-bold" >Bulan dan Tahun</label>

              <input type="text" class="form-control" name="tanggal" id="datepicker" /> 
</div> 
                     <div class="form-group">
          <label class="font-weight-bold" >Kecamatan</label>
          <select name="id_kecamatan" id="kecamatan" class="form-control">
            <option value="">- Pilih Kecamatan</option>
            <?php
					foreach($kecamatan as $data){ // Lakukan looping pada variabel siswa dari controller
						echo "<option value='".$data->id."'>".$data->nama."</option>";
					}
					?>
          </select>
        </div>

				<input type="submit" class="btn btn-primary" value="Filter">
              </form>
				</div>

      </div>

      <br/>
      <br/>
      <br/>

      
    	<script>
	$(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
		// Kita sembunyikan dulu untuk loadingnya
		$("#loading").hide();
		
		$("#kecamatan").change(function(){ // Ketika user mengganti atau memilih data kecamatan
			$("#gampong").hide(); // Sembunyikan dulu combobox gampong nya
			$("#loading").show(); // Tampilkan loadingnya
		
			$.ajax({
				type: "POST", // Method pengiriman data bisa dengan GET atau POST
				url: "<?php echo base_url("index.php/form/listpilahgampong"); ?>", // Isi dengan url/path file php yang dituju
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
					$("#gampong").html(response.listpilah).show();
				},
				error: function (xhr, ajaxOptions, thrownError) { // Ketika ada error
					alert(xhr.status + "\n" + xhr.responseText + "\n" + thrownError); // Munculkan alert error
				}
			});

      
		});
	});

	</script>
  <!-- Bootstrap Date-Picker Plugin -->
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  
<script>
   $("#datepicker").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});
</script>
