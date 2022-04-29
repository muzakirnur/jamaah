<div class="container">

  <div class="row justify-content-md-center">
    <div class="col-md-6">
      <div class="card">
        <div class="card-header text-center">
          <h4>Hapus Semua Anggota</h4>
        </div>
        <div class="card-body">

          <?php 
          if(isset($_GET['alert'])){
            if($_GET['alert']=="sukses"){
              echo "<div class='alert alert-success'>Password berhasil diganti.</div>";
            }
          }
          ?>
          <?php echo validation_errors(); ?>
          <form method="post" action="<?php echo base_url().'admin/reset'; ?>">

          <center><a href="<?php echo base_url().'admin/reset' ?>" class="btn btn-danger"><i class="fa fa-trash"></i> Reset Data</a></center>
          </form>

        </div>
      </div>
    </div>
  </div>

</div>