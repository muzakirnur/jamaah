<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center">
      <h4>Data Anggota</h4>
    </div>
    <div class="card-body-inline">
 <div class="row mt-2">
            <div class="col-12">
            
            
      <br/>
      <br/>

      <div class="table-responsive">
        <table class="table-center text-center table-bordered table-striped table-hover table-datatable">
         <thead>
         <tr>
         
         <th rowspan="2">NO</th>
            <th rowspan="2">NOMOR ANGGOTA</th>
            <th rowspan="2">NAMA</th>
            <th rowspan="2">NAMA ORANG TUA</th>
            <th rowspan="2">TEMPAT/TGL.LAHIR</th>
            <th rowspan="2">JENIS KELAMIN</th> 
            <th colspan="3">Alamat</th>  
            <tr>
            <th>GAMPONG</th>
            <th>KECAMATAN</th>
            <th>KABUPATEN</th>
            
        </thead>
        <tbody>
          <?php
          $no = 1;
          foreach($anggota as $a){
            ?>
            <tr>
              <td><?php echo $no++; ?></td>
              <td><?php echo $a->no_anggota; ?></td>
              <td><?php echo $a->nama; ?></td>
              <td><?php echo $a->nama_ortu; ?></td>
              <td><?php echo $a->ttg; ?></td>
              <td><?php echo $a->jenis_kelamin; ?></td>
              <td><?php echo $a->gampong; ?></td>
              <td><?php echo $a->kecamatan; ?></td>
              <td><?php echo $a->kabupaten; ?></td>
             
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
