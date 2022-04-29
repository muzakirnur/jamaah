<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center">
      <h4>Rekapan iuran</h4>
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
    <label class="font-weight-bold" for="kelas" required="required">Kelas</label>
    <select class="form-control" id="kelas" name='kelas' >
      <option name='kelas' value='L'>Laki-Laki</option>
      <option name='kelas' value='P'>Perempuan</option>
    </select>
  </div>
                
                <div class="form-group">
                  <label class="font-weight-bold" for="tanggal_iuran">Kelas</label>
                  <input type="date" class="form-control" name="tanggal_iuran" placeholder="Masukkan tanggal mulai pinjam">
                </div>
                <input type="submit" class="btn btn-primary" value="Filter">
              </form>

            </div>
          </div>
        </div>
      </div>
      <br>

      <br/>
      <?php 
      // membuat tombol cetak jika data sudah di filter
      if(isset($_GET['kelas']) && isset($_GET['tanggal_iuran'])){
        $kelas = $_GET['kelas'];
        $mulai = $_GET['tanggal_iuran'];
        ?>
        <a href="<?php echo base_url().'iuran/export_pdf_iuran_ketua_gampong/?tanggal_iuran='.$mulai.'&kelas='.$kelas.'&gampong='.$this->session->userdata('ketua_gampong') ?>" class='btn btn-sm btn-warning pull-right'><i class="fa fa-print"></i> Print Data</a>
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
              <th>Tanggal IURAN</th>
               <th>Gampong</th>
              <th>Kelas</th>
              <th>Jumlah IURAN</th>
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
                <td><?php echo date('d-m-Y',strtotime($p->tanggal_iuran)); ?></td>
              <td><?php echo $p->gampong; ?></td>

                <td><?php echo $p->kelas; ?></td>
                <td><?php echo number_format($p->jumlah_iuran,0,',','.'); ?></td>
               
                
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