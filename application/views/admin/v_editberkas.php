<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>E-book</h4>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url().'admin/ebook' ?>" class='btn btn-sm btn-light btn-outline-dark pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <?php foreach($berkas as $row1){ ?>
        <form method="post" action="<?php echo base_url().'admin/ebook_update'; ?>">
          <div class="form-group">
            <label class="font-weight-bold" for="kelas">Kelas</label>
            <input type="hidden" name="id" value="<?php echo $row1->id; ?>">
            <input type="text" class="form-control" name="ket" placeholder="Masukkan Kelas" required="required" value="<?php echo $row1->ket; ?>">
          </div>

          <input type="submit" class="btn btn-primary" value="Simpan">
        </form>
      <?php } ?>

    </div>
  </div>
</div>
