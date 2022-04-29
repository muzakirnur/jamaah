<div class="container-fluid">
  <div class="jumbotron text-center">

  <div class="row">
    <div class="col-md-3">
      <div class="card bg-dark text-white">
        <div class="card-body" >
          <h1>
            <?php echo $this->m_data->get_data('kelas')->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-book"></i>
            </div>
          </h1>
          Jumlah Ketua Kelas
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-danger text-white">
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data('anggota')->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-users"></i>
            </div>
          </h1>
          Total Jamaah
        </div>
      </div>
    </div>
    </div>
   
<br>
<br>
<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center">
      <h4>Data Anggota</h4>
    </div>
    <div class="card-body-inline">
 <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                   
</div>
<div>
<br/>
<br/>

<div class="table-responsive">
<table id="example" class="display nowrap table-striped table-bordered table" style="width:100%">
<thead>
     <tr>
     <th >NAMA</th>
<th >NOMOR ANGGOTA</th>
<th >NAMA ORANG TUA</th>
<th >TEMPAT/TGL.LAHIR</th>
<th >JENIS KELAMIN</th> 

<th>GAMPONG</th>
<th>KECAMATAN</th>
<th>KABUPATEN</th>
     </tr>
 </thead>
<tbody>
<?php
$no = 1;
foreach($anggota as $a){
?>
<tr>
<td><?php echo $a->nama; ?></td>
<td><?php echo $a->no_anggota; ?></td>
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
</body>

</table>
    </div>

  </div>
</div>
</div>
<script>
$(document).ready(function() {
    var table = $('#example').DataTable( {
        rowReorder: {
            selector: 'td:nth-child(2)'
        },
        responsive: true
    } );
} );
</script>