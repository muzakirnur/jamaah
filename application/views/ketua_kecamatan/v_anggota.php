<div class="container-fluid">
  <div class="card">
      
    <div class="card-header text-center">
      <h4>Data Anggota</h4>
    </div>
    <div class="card-body-inline">
 <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?= form_open_multipart('exportimport/uploaddata') ?>
                        <div class="form-row">
                            <div class="col-2">
                                <input type="file" class="form-control-file" id="importexcel" name="importexcel" accept=".xlsx,.xls">
                            </div>
                            <div class="col">
                                <button type="submit" class="btn btn-primary">Import</button>
                            </div>
                            <div class="col">
                                <?= $this->session->flashdata('pesan'); ?>
                            </div>
                        </div>
                        <?= form_close(); ?>
                   
    <a href="<?php echo base_url().'anggota/export_pdf_kecamatan' ?>" class='btn btn-sm btn-warning pull-right'><i class="fa fa-download"></i> Print Data</a>
    <a href="<?php echo base_url().'ketua_kecamatan/anggota_tambah' ?>" class='btn btn-sm btn-success pull-right'><i class="fa fa-plus"></i> Anggota Baru</a>
    <a href="<?php echo base_url().'ketua_kecamatan/anggota_udah_meninggal' ?>" class='btn btn-sm btn-danger pull-right'><i class="fa fa-user-times "></i> Data Wafat</a>

    </div>
</div>
<br/>
<br/>
<form method="post" action="<?php echo base_url('index.php/ketua_kecamatan/delete') ?>" id="form-delete">
<div class="table-responsive">
<table class="table-center text-center table-bordered table-striped table-hover table-datatable">
<thead>
<tr>
<th rowspan="2"><input type="checkbox" id="check-all"></th>
         <th rowspan="2">NO</th>
            <th rowspan="2">NOMOR ANGGOTA</th>
            <th rowspan="2">NAMA</th>
            <th rowspan="2">NAMA ORANG TUA</th>
            <th rowspan="2">TEMPAT/TGL.LAHIR</th>
            <th rowspan="2">JENIS KELAMIN</th> 
            <th colspan="3">Alamat</th>  
            <th rowspan="2">Opsi</th>
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
<td><input type='checkbox' class='check-item' name='id[]<?php echo $a->id; ?>' value='<?php echo $a->id; ?>'></td>
<td><?php echo $no++; ?></td>
<td><?php echo $a->no_anggota; ?></td>
<td><?php echo $a->nama; ?></td>
<td><?php echo $a->nama_ortu; ?></td>
<td><?php echo $a->ttg; ?></td>
<td><?php echo $a->jenis_kelamin; ?></td>
<td><?php echo $a->gampong; ?></td>
<td><?php echo $a->kecamatan; ?></td>
<td><?php echo $a->kabupaten; ?></td>
<td> 
               <a href="<?php echo base_url().'render/index/'.$a->id; ?>" class="btn btn-sm btn-primary"><i class="fa fa-id-card"></i></a>
                <a href="<?php echo base_url().'ketua_kecamatan/anggota_edit/'.$a->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i></a>
                <a href="<?php echo base_url().'ketua_kecamatan/anggota_hapus/'.$a->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
              </td>
            </tr>
            
            <?php
          }
          ?>
        </tbody>
      </table>     
    </div>
    <button type="button" id="btn-delete" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i> DELETE</button>

  </div>
</div>
</div>
<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
    $("#btn-delete").click(function(){ // Ketika user mengklik tombol delete
      var confirm = window.confirm("Apakah Anda yakin ingin menghapus data-data ini?"); // Buat sebuah alert konfirmasi
      
      if(confirm) // Jika user mengklik tombol "Ok"
        $("#form-delete").submit(); // Submit form
    });
  });
  </script>