<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center">
      <h4>Rekap Data Jamaah meninggal</h4>
    </div>
    <div class="card-body">

      <br/>

      <div class="row">
        <div class="col-md-4">
          <div class="card">
            <div class="card-header text-center">
              <h6>Filter Berdasarkan Tanggal</h6>
            </div>
            <div class="card-body">

              <form method="get" action="">
                <div class="form-group">
                  <label class="font-weight-bold" for="tanggal_mulai">Data Dari Tanggal</label>
                  <input type="date" class="form-control" name="tanggal_mulai" placeholder="Masukkan tanggal ">
                </div>
                <div class="form-group">
                  <label class="font-weight-bold" for="tanggal_sampai">Sampai</label>
                  <input type="date" class="form-control" name="tanggal_sampai" placeholder="Masukkan tanggal">
                </div>
                <input type="submit" class="btn btn-primary" value="Filter">
              </form>

            </div>
          </div>
        </div>
      </div>

      <br/>
      <?php 
      // membuat tombol cetak jika data sudah di filter
      if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])){
        $mulai = $_GET['tanggal_mulai'];
        $sampai = $_GET['tanggal_sampai'];
        ?>
        <a href="<?php echo base_url().'meninggal/export_pdf_meninggal_kelas/?tanggal_mulai='.$mulai.'&tanggal_sampai='.$sampai.'&kelas='.$this->session->userdata('kelas').'&gampong='.$this->session->userdata('gampong') ?>" class='btn btn-sm btn-warning pull-right'><i class="fa fa-print"></i> Print Data</a>
        <?php
      }
      ?>
      <br/>
      <br/>

      <div class="table-responsive">
        <table class="table table-bordered text-center table-striped table-hover table-datatable">
          <thead class='text-center'>
            <tr>
            <th rowspan="2">NO</th>
            <th rowspan="2">NOMOR ANGGOTA</th>
            <th rowspan="2">NAMA</th>
            <th rowspan="2">NAMA ORANG TUA</th>
            <th rowspan="2">TEMPAT/TGL.LAHIR</th>
            <th rowspan="2">JENIS KELAMIN</th> 
            <th colspan="3">Alamat</th>  
            <th rowspan="2">Hari Meninggal</th>
            <th rowspan="2">Tanggal Meninggal</th>
            <th rowspan="2">Alamat Duka</th>
            <tr>
            <th>GAMPONG</th>
            <th>KECAMATAN</th>
            <th>KABUPATEN</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach($meninggal as $a){
              ?>
              <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $a->no_anggota; ?></td>
              <td><?php echo $a->nama; ?></td>
              <td><?php echo $a->nama_ortu; ?></td>
              <td><?php echo $a->ttg; ?></td>
              <td><?php echo $a->jenis_kelamin; ?></td>
              <td><?php echo $a->gampong; ?></td>
              <td><?php echo $a->kecamatan; ?></td>
              <td><?php echo $a->kabupaten; ?></td>
              <td><?php echo $a->hari_meninggal; ?></td>
              <td><?php echo $a->tanggal_meninggal; ?></td>
              <td><?php echo $a->alamat_duka; ?></td>
                
                
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