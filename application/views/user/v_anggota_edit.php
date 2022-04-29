<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Edit Anggota</h4>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url().'user/anggota' ?>" class='btn btn-sm btn-light btn-outline-dark  pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <?php foreach($anggota as $a){ ?>
        <form method="post" action="<?php echo base_url().'user/anggota_update'; ?>">
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
          <input type="text" class="form-control" name="gampong" placeholder="Masukkan Nama Gampong" required="required" value="<?php echo $a->gampong; ?>">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="kecamatan">Kecamatan</label>
          <input type="text" class="form-control" name="kecamatan" placeholder="Masukkan Nama Kecamatan" required="required" value="<?php echo $a->kecamatan; ?>">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="kabupaten">Kabupaten</label>
          <input type="text" class="form-control" name="kabupaten" placeholder="Masukkan Nama Kabupaten" required="required" value="<?php echo $a->kabupaten; ?>">
        </div>

          <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
      <?php } ?>

    </div>
  </div>
</div>
