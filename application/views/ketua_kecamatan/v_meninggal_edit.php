<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Edit Anggota</h4>
    </div>
    <div class="card-body">
    
      <a href="<?php echo base_url().'ketua_kecamatan/anggota' ?>" class='btn btn-sm btn-light btn-outline-dark  pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <?php foreach($anggota as $a){ ?>
        <form method="post" action="<?php echo base_url().'ketua_kecamatan/data_meninggal_update'; 
      
      ?>">
       <input type="hidden"  name="id" value="<?php echo $a->id; ?>">
               		  <center>    <small class="text-muted h1">JANGAN DIISI BILA TIDAK INGIN DI UBAH!!</small></center>

       <div class="row">


          </div>


        
<br>
      
<hr />
 <div class="form-group">
    <label class="font-weight-bold" for="hari_meninggal">Hari Pengajian</label>
    <select class="form-control" id="hari" name='hari_meninggal' >
      <option name='hari_meninggal' value='Senin'>Senin</option>
      <option name='hari_meninggal' value='Selasa'>Selasa</option>
      <option name='hari_meninggal' value='Rabu'>Rabu</option>
      <option name='hari_meninggal' value='Kamis'>Kamis</option>
      <option name='hari_meninggal' value='Jumat'>Jum'at</option>
      <option name='hari_meninggal' value='Sabtu'>Sabtu</option>
      <option name='hari_meninggal' value='Minggu'>Minggu</option>
    </select>
  </div>
  
			
        <div class="form-group">
          <label class="font-weight-bold" for="tanggal_meninggal">Tanggal Jamaah Meniggal</label>
          <input type="date" class="form-control" name="tanggal_meninggal" placeholder="Masukkan Nama Kecamatan" value="">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="alamat_duka">Alamat Rumah duka</label>
          <textarea type="text" class="form-control" name="alamat_duka" placeholder="Masukkan Keterangan Pengajian" rows="3"  ></textarea>
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



