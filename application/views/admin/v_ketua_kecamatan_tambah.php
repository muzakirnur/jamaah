<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Tambah Admin Kecamatan Baru</h4>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url().'admin/ketua_kecamatan' ?>" class='btn btn-sm btn-light btn-outline-dark pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <form method="post" action="<?php echo base_url().'admin/ketua_kecamatan_tambah_aksi'; ?>">
        <div class="form-group">
          <label class="font-weight-bold" for="nama">Nama Lengkap</label>
          <input type="text" class="form-control" name="nama" placeholder="Masukkan nama lengkap" required="required">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="username">Username</label>
          <input type="text" class="form-control" name="username" placeholder="Masukkan username" required="required">
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
          <label class="font-weight-bold" for="password">Password</label>
          <input type="password" class="form-control" name="password" placeholder="Masukkan password" required="required">
        </div>

        <input type="submit" class="btn btn-primary" value="Simpan">
      </form>

    </div>
  </div>
</div>