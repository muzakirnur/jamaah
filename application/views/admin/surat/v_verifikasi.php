<div class="container-fluid">
  <div class="card ">
    <div class="card-header text-center">
      <h4>Verifikasi Anggota Baru</h4>
      </div>
    <div class="card-body ">
    <div class="table-responsive">
        <table class="table-center table-bordered text-center table-striped table-hover table-datatable">
          <thead >
            <tr>
              <th width="1%" rowspan='2'>No</th>
              <th rowspan='2'>No Anggota</th>
              <th rowspan='2'>Nama</th>
              <th rowspan='2'>Nama Ortu</th>
              <th width="1%" rowspan='2'>JK</th>
              <th rowspan='2'>Gampong</th>
              <th rowspan='2'>Kecamatan</th>
              <th rowspan='2' >Kabupaten</th>
              <th colspan='2'>Opsi</th>
              
              <tr>
              <th >Terima</th>
              <th>Tolak</th>

          </thead>
          <tbody>
            <?php 
            $no = 1;
            foreach($verifikasi as $p){
              ?>
              <tr>
              <td><?php echo $no++; ?></td>
                <td><?php echo $p->no_anggota; ?></td>
                <td><?php echo $p->nama; ?></td>
                <td><?php echo $p->nama_ortu; ?></td>
                <td><?php echo $p->jenis_kelamin; ?></td>
                <td><?php echo $p->gampong; ?></td>
                <td><?php echo $p->kecamatan; ?></td>
                <td><?php echo $p->kabupaten; ?></td>
                <td> <a href="<?php echo base_url().'admin/terima_verifikasi/'.$p->id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-check"></i></a></td>
                <td> <a href="<?php echo base_url().'admin/tolak_verifikasi/'.$p->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-times"></i></a></td>


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
	