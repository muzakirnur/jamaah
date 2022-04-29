<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center">
    <?php
          foreach($pilah as $p){
            ?>
      <h4 class='font-weight-bold'>Pemilahan Anggota Untuk Kelas </h4>
      <h5> Ketua Kelas : <?php echo $p->nama; ?><h5>
<h5>Wali Kelas      : <?php echo $p->wali; ?><h5>
      <h5>Majelis      : <?php echo $p->majelis; ?><h5>
      <h5>Gampong      : <?php echo $p->gampong; ?><h5>
      <h5>Kecamatan      : <?php echo $p->kecamatan; ?><h5>
      <h5>Kecamatan      : <?php echo $p->kecamatan; ?><h5>
      <h5>Total Anggota     : <?php echo $nama[0]['nama']; ?><h5>

      <?php
          }
            ?>
    </div>
    <a href="<?php echo base_url().'ketua_kecamatan/pilah_mana' ?>" class='btn btn-sm btn-light btn-outline-success pull-right'><i class="fa fa-plus"></i> Tambahkan Jamaah</a>

    <div class="card-body">
     <br/>
     <br/>

     <div class="table-responsive">
      <table class="table table-bordered text-center table-striped table-hover table-datatable">
      
        <thead>
          <tr>
            <th width="1%">No</th>
            <th>No Anggota</th>
            <th>Nama</th>
            <th>Nama Ortu</th>
            <th width="1%">JK</th>
            <th>Gampong</th>
            <th>Kecamatan</th>

            <th width="1%">OPSI</th>
          </tr>
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach($anggota as $p){
            


            ?>
            <?php
            if($p->id_kelas !='0' ){
              ?>
            <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $p->no_anggota; ?></td>
                <td><?php echo $p->nama; ?></td>
                <td><?php echo $p->nama_ortu; ?></td>
                <td><?php echo $p->jenis_kelamin; ?></td>
                <td><?php echo $p->gampong; ?></td>
                <td><?php echo $p->kecamatan; ?></td>


           

              

              <td class="text-center">

                <?php
            if($p->id_kelas !='0' ){
                  ?>
                  <a href="<?php echo base_url().'ketua_kecamatan/pilah_kembali/'.$p->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-history"></i> Kembalikan</a>
                  <?php      
                } 
                ?>
  

<?php
                }else{

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
