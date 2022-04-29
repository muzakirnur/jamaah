<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Data Gampong</h4>
    </div>
    <div class="card-body">

      <a href="<?php echo base_url().'ketua_kecamatan/ketua_gampong_tambah' ?>" class='btn btn-sm btn-success pull-right'><i class="fa fa-plus"></i> Admin gampong Baru</a>
      <br/>
      <br/>
      
<div class="table-responsive">

      <table class="table table-bordered table-striped table-hover">
        <tr>
          <th width="1%">No</th>
          <th>Kecamatan</th>
          <th>Gampong</th>
          <th width="16%">Opsi</th>
        </tr>
        <?php 
        $no = 1;
        foreach($ketua_gampong as $p){
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $p->kecamatan; ?></td>
            <td><?php echo $p->ketua_gampong; ?></td>
            <td>
              <a href="<?php echo base_url().'ketua_kecamatan/ketua_gampong_edit/'.$p->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i> Edit</a>
              <a href="<?php echo base_url().'ketua_kecamatan/ketua_gampong_hapus/'.$p->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
            </td>
          </tr>
          <?php 
        }
        ?>
      </table>

    </div>
  </div>
</div>