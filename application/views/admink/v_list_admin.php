<div class="container">
    <div class="card">
        <div class="card-header">
            <h2 class="card-title">Daftar Gaji Admin Pusat</h2>
        </div>
        <div class="card-body">
        <table class="table">
  <thead>
    <tr>
      <th scope="col">No</th>
      <th scope="col">Nama</th>
      <th scope="col">Jabatan</th>
      <th scope="col">Gaji</th>
    </tr>
  </thead>
  <tbody>
  <?php
        $no = 1;
        foreach($admin as $row){
          ?>
          <tr>
            <td><?php echo $no++; ?></td>
            <td><?php echo $row->username; ?></td>
            <td>
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