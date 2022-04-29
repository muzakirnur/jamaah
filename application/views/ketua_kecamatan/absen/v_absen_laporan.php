<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center">
      <h4>Rekapan Absensi</h4>
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
                  <label class="font-weight-bold" for="tanggal_mulai">Tanggal Absen</label>
                  <input type="date" class="form-control" name="tanggal_mulai" placeholder="Masukkan tanggal mulai pinjam">
                </div>
                <div class="form-group">
          <label class="font-weight-bold" >Gampong</label>
          <select name="id_gampong" id="gampong" class="form-control">
            <option value="">- Pilih Gampong</option>
            <?php
					foreach($gampong as $data){
			echo "<option value='".$data->id."'>Nama Ketua Kelas :  ".$data->nama." || Kelas  :  ".$data->kelas." || Gampong  :  ".$data->gampong."</option>"; // Tambahkan tag option ke variabel $lists
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
      <?php 
      // membuat tombol cetak jika data sudah di filter
      if(isset($_GET['tanggal_mulai']) && isset($_GET['id_gampong'])){
        $mulai = $_GET['tanggal_mulai'];
        $id_gampong = $_GET['id_gampong'];
        ?>
        <a href="<?php echo base_url().'absensi/export_pdf_absen_ketua_kecamatan/?tanggal_mulai='.$mulai.'&id_gampong='.$id_gampong ?>" class='btn btn-sm btn-warning pull-right'><i class="fa fa-print"></i> Print Data</a>
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
              <th>Hari Pengajian</th>
              <th>Gampong</th>
              <th>Kelas</th>
              <th>Tanggal Pengajian</th>
              <th>Jam Pengajian</th>
              
              <th>Absen</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach($absensi as $p){
              ?>
              <tr>
              <td><?php echo $no++; ?></td>
                <td><?php echo $p->nama; ?></td>
                <td><?php echo $p->hari; ?></td>
                <td><?php echo $p->gampong; ?></td>
                <td><?php echo $p->jenis_kelamin; ?></td>
                <td><?php echo date('d-m-Y',strtotime($p->tanggal_mulai)); ?></td>
                <td><?php echo date('h:i:sa',strtotime($p->jam_pengajian)); ?></td>
                <td>
                <?php
                if($p->absen == "1"){
                  echo "<div class='badge badge-secondary'>Sakit</div>";
                }else if($p->absen == "2"){
                  echo "<div class='badge badge-primary'>Belum Diabsen</div>";
                }else if($p->absen == "3"){
                  echo "<div class='badge badge-warning'>Izin</div>";
                }else if($p->absen == "4"){
                  echo "<div class='badge badge-success'>Masuk</div>";
                }else if($p->absen == "5"){
                  echo "<div class='badge badge-danger'>Alpa</div>";
                }
                ?>
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
