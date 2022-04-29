<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center">
      <h4>Rekapan iuran</h4>
    </div>
    <div class="card-body">

      <br/>
      <form method="post" action="<?php echo base_url().'kelas/iuran_aksi'; ?>">

<div class="row">
  <div class="col-md-4">
    <div class="card">
      <div class="card-header text-center">
        <h6>Tambah IURAN </h6></h6>
      </div>
      <div class="card-body">

      <div class="form-group">
          <label class="font-weight-bold" >Nama Anggota</label>
          <select name="id_anggota" id="anggota" class="form-control" required="required">
            <option value="">- Nama Anggota -</option>
            <?php
					foreach($anggota as $data){ // Lakukan looping pada variabel siswa dari controller
						echo "<option value='".$data->id."'>".$data->nama." Bin ".$data->nama_ortu."</option>";
					}
					?>
          </select>
        </div>

     <input type="hidden" class="form-control" name="kecamatan" value="<?php echo $this->session->userdata('ketua_kecamatan'); ?>" placeholder="Masukkan Tanggal Pengajian">


     <div class="form-group">
    <label class="font-weight-bold" for="tanggal_iuran">Tanggal Iuran</label>
    <input type="date" class="form-control" name="tanggal_iuran" placeholder="Masukkan Tanggal Pembayaran" required="required">
  </div>
  <div class="form-group">
    <label class="font-weight-bold" for="jumlah_iuran">Jumlah IURAN</label>
    <input type="number"  class="form-control" name="jumlah_iuran" placeholder="Masukkan Jumlah Iuran" required="required">
  </div>

  <input type="submit" class="btn btn-primary" value="Simpan">
  </form>

     
              </form>
            </div>
          </div>
        </div>
      </div>
      <br>

      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header text-center">
              <h6>Filter Berdasarkan Tanggal</h6>
            </div>
            <div class="card-body">

              <form method="get" action="">
          
        <div class="form-group">
              <label class="font-weight-bold" >Bulan dan Tahun</label>

              <input type="text" class="form-control" name="tanggal_iuran" id="datepicker" /> 
</div> 
              
                <input type="submit" class="btn btn-primary" value="Filter">


      </div>
    </div>
  </div>
</div>


<br/>
      <br/>
      <?php 
      // membuat tombol cetak jika data sudah di filter
      if(isset($_GET['tanggal_iuran'])){
        $mulai = $_GET['tanggal_iuran'];
        ?>
        <?php
      }
      ?>
      <br/>
      <br/>

      <div class="table-responsive">
        <table class="table table-bordered text-center table-striped table-hover table-datatable">
          <thead>
            <tr>
              <th width="1%">No</th>
              <th>Nama</th>
              <th>Gampong</th>
              <th>Tanggal IURAN</th>
              <th>Jumlah IURAN</th>
              <th>Hapus</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach($iuran as $p){
              ?>
              <tr>
              <td><?php echo $no++; ?></td>
                <td><?php echo $p->nama; ?></td>
                <td><?php echo $p->gampong; ?></td>
                <td><?php echo date('d-m-Y',strtotime($p->tanggal_iuran)); ?></td>
                <td><?php echo 'Rp. ', number_format($p->jumlah_iuran,0,',','.'); ?></td>
                <td width='1'>
                <a href="<?php echo base_url().'ketua_kecamatan/iuran_hapus/'.$p->iuran_id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
                </td>
                
                
              </tr>
              <?php 
            }
            ?>
          </tbody>
        </table>
      </div>

    </div>
  </div>
</div>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
  
  <script>
   $("#datepicker").datepicker( {
    format: "mm-yyyy",
    startView: "months", 
    minViewMode: "months"
});
</script>