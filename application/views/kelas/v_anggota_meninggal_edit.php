<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Edit Anggota</h4>
    </div>
    <div class="card-body">
    
      <a href="<?php echo base_url().'kelas/anggota_edit' ?>" class='btn btn-sm btn-light btn-outline-dark  pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <?php foreach($meninggal as $a){ ?>
        <form method="post" action="<?php echo base_url().'kelas/anggota_meninggal_update'; 
      
      ?>">
        <input type="hidden"  name="id" value="<?php echo $a->id; ?>">
        <div class="form-group">
          <label class="font-weight-bold" for="no_anggota">Nomor Anggota</label>
          <input type="number" class="form-control" name="no_anggota" placeholder="Masukkan Nomor Anggota" required="required" value="<?php echo $a->no_anggota; ?>">
        </div>
        
        <div class="form-group">
          <label class="font-weight-bold" for="nama">Nama Lengkap</label>
          <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap" required="required" value="<?php echo $a->nama; ?>">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="nama_ortu">Nama Orang Tua</label>
          <input type="text" class="form-control" name="nama_ortu" placeholder="Masukkan nama orang tua" required="required" value="<?php echo $a->nama_ortu; ?>">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="ttg">Tempat/Tanggal Lahir</label>
          <input type="text" class="form-control" name="ttg" placeholder="Masukkan Tempat/Tanggal Lahir" required="required" value="<?php echo $a->ttg; ?>">
        </div>
        <div class="form-group">
        <label class="font-weight-bold" >Jenis Kelamin</label><br>
        <label><input type="radio" name="jenis_kelamin" value="L"<?php echo ($a->jenis_kelamin == 'L' ? ' checked' : ''); ?>> Laki-Laki</label>
          <label><input type="radio" name="jenis_kelamin" value="P"<?php echo ($a->jenis_kelamin == 'P' ? ' checked' : ''); ?>> Perempuan</label>
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="gampong">Gampong</label>
          <input type="text" class="form-control" name="gampong" placeholder="Masukkan Nama Gampong" required="required"  readonly value="<?php echo $a->gampong; ?>">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="kecamatan">Kecamatan</label>
          <input type="text" class="form-control" name="kecamatan" placeholder="Masukkan Nama Kecamatan" required="required" readonly value="<?php echo $a->kecamatan; ?>">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="kabupaten">Kabupaten</label>
          <input type="text" class="form-control" name="kabupaten" placeholder="Masukkan Nama Kabupaten" required="required" readonly value="<?php echo $a->kabupaten; ?>">
        </div>
        
 <div class="form-group">
    <label class="font-weight-bold" for="hari_meninggal">Hari Pengajian</label>
    <select class="form-control" id="hari" name='hari_meninggal'  >
      <option name='hari_meninggal' value="Senin"<?php echo ($a->hari_meninggal == 'Senin' ? ' selected' : ''); ?>>Senin</option>
      <option name='hari_meninggal' value='Selasa'<?php echo ($a->hari_meninggal == 'Selasa' ? ' selected' : ''); ?>>Selasa</option>
      <option name='hari_meninggal' value='Rabu'<?php echo ($a->hari_meninggal == 'Rabu' ? ' selected' : ''); ?>>Rabu</option>
      <option name='hari_meninggal' value='Kamis'<?php echo ($a->hari_meninggal == 'Kamis' ? ' selected' : ''); ?>>Kamis</option>
      <option name='hari_meninggal' value='Jumat'<?php echo ($a->hari_meninggal == 'Jumat' ? ' selected' : ''); ?>>Jum'at</option>
      <option name='hari_meninggal' value='Sabtu'<?php echo ($a->hari_meninggal == 'Sabtu' ? ' selected' : ''); ?>>Sabtu</option>
      <option name='hari_meninggal' value='Minggu'<?php echo ($a->hari_meninggal == 'Minggu' ? ' selected' : ''); ?>>Minggu</option>
    </select>
  </div>
			
        <div class="form-group">
          <label class="font-weight-bold" for="tanggal_meninggal">Tanggal Jamaah Meniggal</label>
          <input type="date" class="form-control" name="tanggal_meninggal" placeholder="Masukkan Nama Kecamatan"  value="<?php echo $a->tanggal_meninggal; ?>">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="alamat_duka">Alamat Rumah duka</label>
          <input type="text" class="form-control" name="alamat_duka"   placeholder="Masukkan Alamat Duka" required="required" value="<?php echo $a->alamat_duka; ?>">
        </div>
        <div id="mati">
        <input type="submit" name='simpan' class="btn btn-primary" value="Simpan">
          </div>   
</div>
<?php } ?>
</form>
    </div>
  </div>
</div>



