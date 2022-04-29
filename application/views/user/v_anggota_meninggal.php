<div class="container-fluid">
  <div class="jumbotron text-center">

  <div class="row">
    

    <div class="col-md-3">
      <div class="card bg-danger text-white">
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data('meninggal')->num_rows(); ?>
            <div class="pull-right">

            
            </div>
          </h1><i class="fa fa-users"></i>
          Total Jamaah Menginggal
        </div>
      </div>
    </div>
    

   <div class="container-fluid">
   
<br>
<table id="example" class="display nowrap table-striped table-bordered table" style="width:100%">
<thead class="thead-dark">

     <tr>
     <th >NAMA</th>
<th >NOMOR ANGGOTA</th>
<th >NAMA ORANG TUA</th>
<th >TEMPAT/TGL.LAHIR</th>
<th >JENIS KELAMIN</th> 

<th>GAMPONG</th>
<th>KECAMATAN</th>
<th>KABUPATEN</th>
<th>HARI MENINGGAL</th>
<th>TANGGAL MENINGGAL</th>
<th>ALAMAT DUKA</th>
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
<td><?php echo $a->hari_meninggal; ?></td>
              <td><?php echo $a->tanggal_meninggal; ?></td>
              <td><?php echo $a->alamat_duka; ?></td>

            </tr>
            <?php
          }
          ?>
</body>

</table>