<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Tambah Anggota Baru</h4>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url().'admin/anggota' ?>" class='btn btn-sm btn-light btn-outline-dark pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <form method="post" action="<?php echo base_url().'kelas/anggota_tambah_aksi'; ?>">
       <div class="form-group">
          <label class="font-weight-bold" for="no_anggota">Nomor Anggota</label>
          <input type="number" class="form-control" name="no_anggota" placeholder="Masukkan Nomor Anggota" required="required" >
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
          <input type="text" class="form-control" name="jenis_kelamin" readonly value="<?php echo $this->session->userdata('kelas'); ?>">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="kabupaten">Kabupaten</label>
          <input type="text" class="form-control" name="kabupaten" readonly value="Bireun">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="kecamatan">Kecamatan</label>
          <input type="text" class="form-control" name="kecamatan" readonly value="<?php echo $this->session->userdata('kecamatan'); ?>">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="gampong">Gampong</label>
          <input type="text" class="form-control" name="gampong" readonly value="<?php echo $this->session->userdata('gampong'); ?>">
        </div>
       

        <input type="submit" class="btn btn-primary" value="Simpan">
      </form>

    </div>
  </div>
</div>