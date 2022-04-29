<div class="container-fluid">


  <div class="card">
    <div class="card-header text-center">
      <h4>Data Ebook</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-bordered table-striped table-hover table-datatable">
          <thead>
            <tr>
                <th width="5%">No</th>
                <th>kelas E-book</th>
                <th width="20%">Action</th>
            </tr>
          </thead>
            <?php
                $no = 1;
                foreach($berkas as $row1)
                {
                    ?>
                    <tr>
                        <td><?php echo $no++; ?></td>
                        <td><?php echo $row1->ket; ?></td>



                        <td><a href="<?php echo base_url(); ?>ketua_gampong/download/<?php echo $row1->id; ?>" class="btn btn-sm btn-primary">Download</a>
                        </td>
                        </tr>
                    <?php

                }
            ?>
        </table>
      </div>


    </div>
  </div>
</div>

<!----------------------------------------------->
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">HAPUS</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        Apakah Anda yakin ingin menghapus
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <a href="<?php echo base_url().'guru/ebook_hapus/'.$row1->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>

      </div>
    </div>
  </div>
</div>
