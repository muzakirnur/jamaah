<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Data Admin Kecamatan</h4>
    </div>
    <div class="card-body">

      <a href="<?php echo base_url().'ketua_kecamatan/ketua_pengajian_tambah' ?>" class='btn btn-sm btn-success pull-right'><i class="fa fa-plus"></i> Ketua Pengajian Baru</a>
      <br/>
      <br/>
      
<div class="table-responsive">

      <table class="table table-bordered table-striped table-hover">
        <tr>
          <th width="1%">No</th>
          <th>Nama</th>
          <th>Nomor Hp</th>
                    <th>Nama Majelis</th>
                              <th>Gampong</th>
          <th>Kecamatan</th>
          <th width="16%">Opsi</th>
        </tr>
        <?php 
        $no = 1;
        foreach($ketua_pengajian as $p){
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $p->nama; ?></td>
            <td><?php echo $p->hp; ?></td>
            <td><?php echo $p->nama_majelis; ?></td>
            <td><?php echo $p->gampong; ?></td>
            <td><?php echo $p->kecamatan; ?></td>
            <td>
              <a href="<?php echo base_url().'ketua_kecamatan/ketua_pengajian_edit/'.$p->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
              <a href="<?php echo base_url().'ketua_kecamatan/ketua_pengajian_hapus/'.$p->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
            </td>
          </tr>
          <?php 
        }
        ?>
      </table>

    </div>
  </div>
</div>