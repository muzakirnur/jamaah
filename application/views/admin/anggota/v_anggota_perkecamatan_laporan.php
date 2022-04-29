<div class="container">
  <div class="card ">
    <div class="card-header text-center">
      <h4>Rekapan Absensi</h4>
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

            <form method="post" action="<?php echo base_url().'anggota/export_pdf_perkecamatan'?>">
                <div class="form-group">
                <label class="font-weight-bold" >Nama kecamatan</label>
          <select name="id_kecamatan" id="kecamatan" class="form-control">
            <option value="">- Nama kecamatan -</option>
            <?php
					foreach($gampong as $data){ // Lakukan looping pada variabel siswa dari controller
						echo "<option value='".$data->id."'>".$data->ketua_kecamatan."</option>";
					}
					?>
          </select>
        </div>
        
              
                <input type="submit" class="btn btn-primary" value="Filter">
              </form>

            </div>
          </div>
        </div>
      </div>

      <br/>
      <br/>
      <br/>
      