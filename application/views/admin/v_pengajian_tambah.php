<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Proses Transaksi pengajian kelas</h4>
    </div>
    <div class="card-body">
      <a href="<?php echo base_url().'admin/pengajian' ?>" class='btn btn-sm btn-light btn-outline-dark pull-right'><i class="fa fa-arrow-left"></i> Kembali</a>
      <br/>
      <br/>

      <form method="post" action="<?php echo base_url().'admin/pengajian_aksi'; ?>">
        <div class="form-group">
          <label class="font-weight-bold" for="kelas">kelas</label>
          <select name="kelas" class="form-control">
            <option value="">- Pilih kelas</option>
            <?php foreach($kelas as $b){ ?>
              <option value="<?php echo $b->id; ?>"><?php echo $b->kelas; ?></option>
            <?php } ?>
          </select>
        </div>
       
        <div class="form-group">
          <label class="font-weight-bold" for="tanggal_mulai">Tanggal Mulai Pinjam</label>
          <input type="date" class="form-control" name="tanggal_mulai" placeholder="Masukkan tanggal mulai pinjam">
        </div>
        <div class="form-group">
          <label class="font-weight-bold" for="tanggal_sampai">Tanggal Pinjam Sampai</label>
          <input type="date" class="form-control" name="tanggal_sampai" placeholder="Masukkan tanggal pinjam sampai">
        </div>


        <input type="submit" class="btn btn-primary" value="Simpan">
      </form>

    </div>
  </div>
</div>
