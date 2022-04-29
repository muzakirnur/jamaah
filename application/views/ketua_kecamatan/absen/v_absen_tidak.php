<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Proses Absensi</h4>
    </div>
    <div class="card-body">


      <form method="post" action="<?php echo base_url().'ketua_kecamatan/absen_aksi_isi'; ?>">
      <div class="form-group">
          <label class="font-weight-bold" >Gampong</label>
          <select name="id_gampong" id="gampong" class="form-control">
            <option value="">- Pilih Gampong</option>
            <?php
					foreach($gampong as $data){
			echo "<option value='".$data->id."'>Nama Ketua Kelas :  ".$data->nama." || Kelas  :  ".$data->kelas." || Gampong  :  ".$data->gampong."</option>"; // Tambahkan tag option ke variabel $lists
		}
					?>
          </select>
        </div>

        <input type="submit" class="btn btn-primary" value="Simpan">
      </form>

    </div>
  </div>
  
</div>
<script type='text/javascript'>
Swal.fire(
  'Maaf!',
  'Kelas Ini Tidak Memiliki Anggota!',
  'error'
)			</script>
