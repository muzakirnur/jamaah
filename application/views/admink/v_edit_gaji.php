<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Edit Jabatan</h4>
    </div>
    <div class="card-body">
      <br/>
      <br/>

      <?php foreach($jabatan as $row1){ ?>
        <form method="post" action="<?php echo base_url().'admink/updategaji'; ?>">
          <div class="form-group">
            <input type="hidden" name="id" value="<?php echo $row1->id; ?>">
            <label for="jabatan" class="form-label">
                Jabatan
            </label>
            <input type="text" class="form-control mb-3" name="jabatan" required="required" value="<?php echo $row1->jabatan; ?>">
            <label for="jabatan" class="form-label">
                Gaji
            </label>
            <input type="number" class="form-control" name="gaji" required="required" value="<?php echo $row1->gaji; ?>">
          </div>

          <input type="submit" class="btn btn-primary" value="Simpan">
          <button type="button" onclick="history.back(-1)" class="btn btn-dark">Kembali</button>
          
        </form>

      <?php } ?>

    </div>
  </div>
</div>
