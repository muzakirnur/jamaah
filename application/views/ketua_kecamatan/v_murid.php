<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Data Ketua Gampong</h4>
    </div>
    <div class="card-body">

      <a href="<?php echo base_url().'ketua_kecamatan/ketua_gampong_tambah' ?>" class='btn btn-sm btn-success pull-right'><i class="fa fa-plus"></i> Ketua Gampong Baru</a>
      <br/>
      <br/>


      <table class="table table-bordered table-striped table-hover">
        <tr>
          <th width="1%">No</th>
          <th>Nama</th>
          <th>Username</th>
          <th width="16%">Opsi</th>
        </tr>
        <?php
        $no = 1;
        foreach($ketua_gampong as $m){
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $m->nama; ?></td>
            <td><?php echo $m->username; ?></td>
            <td>
              <a href="<?php echo base_url().'ketua_kecamatan/ketua_gampong_edit/'.$m->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
              <a href="<?php echo base_url().'ketua_kecamatan/ketua_gampong_hapus/'.$m->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
            </td>
          </tr>
          <?php
        }
        ?>
      </table>

    </div>
  </div>
</div>
