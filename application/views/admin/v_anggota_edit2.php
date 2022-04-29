<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Edit Anggota</h4>
    </div>
    <div class="card-body">
    <script type='text/javascript'>
Swal.fire(
  'Maaf!',
  'Nomor Tersebut Telah Digunakan!',
  'error'
)			</script>
    
      <a href="<?php echo base_url().'admin/anggota_edit' ?>" class='btn btn-sm btn-light btn-outline-dark  pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <?php foreach($anggota as $a){ ?>
        <form method="post" action="<?php echo base_url().'admin/anggota_update'; 
      
      ?>">
        <input type="hidden"  name="id" value="<?php echo $a->id; ?>">
       <div class="row">

        		<div class="col-sm-2">
        			<div class="form-group">
              <label class="font-weight-bold" >Nomor Anggota</label>
						<input type="text" class="form-control text-center" readonly value='<?php echo $a->no_anggota; ?>'>
					</div>
        		</div>
	            <div class="col-sm-4">
	            	<div class="form-group">
                <label class="font-weight-bold" >Ingin Merubah Nomor anggota?? </label>
                <input type="text" name="no_anggota" class="form-control" >
					</div>
          </div>
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
        <div id="simpan">
          <input type="submit" name='simpan' class="btn btn-primary" value="Simpan">
          </div>     
<br>
      <label for="chkPassport">
    <input type="checkbox" id="chkPassport" />
    Jamaah Sudah Meniggal?
</label>
<hr />
<div id="dvPassport" style="display: none">
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
          <textarea type="text" class="form-control" name="alamat_duka" placeholder="Masukkan Keterangan Pengajian" rows="3" ></textarea>
        </div>
        <div id="mati">
        <input type="submit" name='simpan' class="btn btn-primary" value="Simpan">
          </div>   
</div>
<div id="AddPassport">
    *Checklist Jika Jamaah Sudah Meninggal
</div>
<?php } ?>
</form>
    </div>
  </div>
</div>


<script>
$(function () {
        $("#chkPassport").click(function () {
            if ($(this).is(":checked")) {
                $("#dvPassport").show();
                $("#AddPassport").hide();
                $("#simpan").hide();
                $("#simpan2").show();
            } else {
                $("#dvPassport").hide();
                $("#AddPassport").show();
                $("#simpan").show();
                $("#simpan2").hide();
            }
        });
    });
</script>
