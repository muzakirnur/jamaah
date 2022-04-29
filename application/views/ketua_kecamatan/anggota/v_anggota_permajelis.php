<div class="container">
  <div class="card ">
    <div class="card-header text-center">
      <h4>Rekapan Anggota Permajelis</h4>
    </div>
    <div class="card-body ">

      <br/>

      <div class="row justify-content-center">
        <div class="col-md-4">
          <div class="card ">
            <div class="card-header  text-center">
              <h6>Anggota Permajelis</h6>
            </div>
            <div class="card-body">

            <form method="post" action="<?php echo base_url().'anggota/export_pdf_permajelis'?>">
            <div class="form-group">
          <label class="font-weight-bold" >Pilih Majelis</label>
          <select name="id_gampong" id="gampong" class="form-control">
            <option value="">- Pilih Majelis</option>
            <?php
					foreach($id_gampong as $data){ // Lakukan looping pada variabel siswa dari controller
		echo	"<option value='".$data->id."'>Nama Ketua Kelas :  ".$data->nama." || Kelas  :  ".$data->kelas." || Majelis  :  ".$data->majelis." || Gampong  :  ".$data->gampong." </option>"; // Tambahkan tag option ke variabel $lists
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
     