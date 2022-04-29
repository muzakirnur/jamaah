<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Proses Absensi</h4>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url().'kelas' ?>" class='btn btn-sm btn-light btn-outline-dark pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      
      <br/>
      <br/>

      <form method="post" action="<?php echo base_url().'kelas/absen_aksi'; ?>">
      <div class="form-group">
    <label class="font-weight-bold" for="hari">Hari Pengajian</label>
    <select class="form-control" id="hari" name='hari' >
      <option name='hari' value='Senin'>Senin</option>
      <option name='hari' value='Selasa'>Selasa</option>
      <option name='hari' value='Rabu'>Rabu</option>
      <option name='hari' value='Kamis'>Kamis</option>
      <option name='hari' value='Jumat'>Jum'at</option>
      <option name='hari' value='Sabtu'>Sabtu</option>
      <option name='hari' value='Minggu'>Minggu</option>
    </select>
  </div>
			
  <input type="hidden" class="form-control" name="kelas" value="<?php echo $this->session->userdata('kelas'); ?>" placeholder="Masukkan Tanggal Pengajian">

  <input type="hidden" class="form-control" name="gampong" value="<?php echo $this->session->userdata('gampong'); ?>" placeholder="Masukkan Tanggal Pengajian">
  <input type="hidden" class="form-control" name="kecamatan" value="<?php echo $this->session->userdata('kecamatan'); ?>" placeholder="Masukkan Tanggal Pengajian">

  <div class="form-group">
          <label class="font-weight-bold" for="tanggal_mulai">Tanggal Pengajian</label>
          <input type="date" class="form-control" name="tanggal_mulai" placeholder="Masukkan Tanggal Pengajian">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="jam_pengajian">Jam Pengajian</label>
          <input type="time"  class="form-control" name="jam_pengajian" placeholder="Masukkan Jam Pengajian">
        </div>

        <div class="form-group">
          <label class="font-weight-bold" for="ket_pengajian">Keterangan Pengajian</label>
          <textarea type="text" class="form-control" name="ket_pengajian" placeholder="Masukkan Keterangan Pengajian" rows="3" ></textarea>
        </div>
        
    
        <div class="table-responsive" >
        <table class="table-text-center table-bordered table-striped table-hover table-datatable" style="display:none" >
        <div class="form-group" >
        
         <thead>
          <tr>
            <th rowspan='2' width="1%">No</th>
            <th rowspan='2'  >Nama</th>
            <th colspan='4' >Absensi</th>
            <tr>
            <th style="width: 0.1%">A</th>
            <th style="width: 0.1%">I</th>
            <th style="width: 0.1%">S</th>
            <th style="width: 0.1%">M</th>
          </tr>
        </thead>
        <tbody>
        
        <?php
          $no = 1;
          foreach($absensi as $a){
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td ><input type="hidden" name="id[]<?php echo $a->id; ?>" value="<?php echo $a->id; ?>"><?php echo $a->id; ?></td>
              <td ><input type="hidden" name="nama" value="<?php echo $a->nama; ?>"><?php echo $a->nama; ?></td>
              <td ><input type="hidden" name="id_kelas" value="<?php echo $a->id_kelas; ?>"><?php echo $a->id_kelas; ?></td>
              <td style="width: 0.1%"><input name="absen" value="2"></td>
              
            </tr>
            <?php
          }
          ?>
          </select>
        </div>
        </div>
       


        <input type="submit" class="btn btn-primary" value="Simpan">
      </form>

    </div>
  </div>
  
</div>
