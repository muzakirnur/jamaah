<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center">
      <h4>Absen Tanggal </h4><?php echo $this->session->userdata('tanggal_mulai'); ?>
    </div>
    <div class="card-body">
     <br/>
     <br/>

     <div class="table-responsive">
      <table class="table table-bordered text-center table-striped table-hover table-datatable">
        <thead>
          <tr>
            <th width="1%">No</th>
                        <th>N.A.</th>
            <th>Nama</th>
                        <th>Nama Ortu</th>
              <th>Hari Pengajian</th>
              <th>Tanggal Pengajian</th>
              <th>Jam Pengajian</th>
              <th>Absen</th>
              <th>Absen Sekarang</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach($absensi as $p){
            if($p->absen == "2"){
            ?>
            <tr>
            <td><?php echo $no++; ?></td>
                            <td><?php echo $p->no_anggota; ?></td>
                <td><?php echo $p->nama; ?></td>
                                <td><?php echo $p->nama_ortu; ?></td>
                <td><?php echo $p->hari; ?></td>
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
              <td class="text-center">

                <?php
                if($p->absen=='1'){
                  echo "-";
                }else if($p->absen=='3' ){
                  echo "-";
                }else if($p->absen=='4' ){
                  echo "-";
                }else if($p->absen=='5' ){
                  echo "-";
                }
                else if($p->absen=='2' ){
                  ?>
                  <a href="<?php echo base_url().'kelas/absen_sakit/'.$p->absensi_id; ?>" class="btn btn-sm btn-secondary"><i class="fa fa-thermometer-quarter "></i> Sakit</a>
                  <a href="<?php echo base_url().'kelas/absen_izin/'.$p->absensi_id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-car"></i> Izin</a>
                  <a href="<?php echo base_url().'kelas/absen_masuk/'.$p->absensi_id; ?>" class="btn btn-sm btn-success"><i class="fa fa-hand-paper-o "></i> Masuk</a>
                  <a href="<?php echo base_url().'kelas/absen_alpa/'.$p->absensi_id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-eye-slash"></i> Alpa</a>
                  <?php
                }
            }else{

            
                ?>
              </td>
            </tr>
            <?php 
            }
          }
          ?>
        </tbody>
      </table>
    </div>

  </div>
</div>
</div>
