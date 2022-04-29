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
                        <a href="<?php echo base_url().'ketua_gampong/anggota_tambah' ?>" class='btn btn-sm btn-success pull-right'><i class="fa fa-plus"></i> Anggota Baru</a>
                    <a href="<?php echo base_url().'anggota/export_pdf_gampong' ?>" class='btn btn-sm btn-warning pull-right'><i class="fa fa-download"></i> Print Data</a>
    <a href="<?php echo base_url().'ketua_gampong/anggota_udah_meninggal' ?>" class='btn btn-sm btn-danger pull-right'><i class="fa fa-user-times"></i> Data Wafat</a>

    </div>
                </div>
      <br/>
      <br/>

      <div class="table-responsive">
        <table class="table-center text-center table-bordered table-striped table-hover table-datatable">
         <thead>
         <tr>
         <th >NO</th>
<th >NOMOR ANGGOTA</th>
<th >NAMA</th>
<th >NAMA ORANG TUA</th>
<th >TEMPAT/TGL.LAHIR</th>
<th >JENIS KELAMIN</th> 

<th>GAMPONG</th>
<th>KECAMATAN</th>
<th>KABUPATEN</th>
<th >Opsi</th>
            </tr>
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
              <td>
                <a href="<?php echo base_url().'ketua_gampong/anggota_edit/'.$a->id; ?>" class="btn btn-sm btn-warning"><i class="fa fa-wrench"></i></a>
                <a href="<?php echo base_url().'ketua_gampong/anggota_hapus/'.$a->id; ?>" class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></a>
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
</div>
