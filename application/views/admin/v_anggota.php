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
                   
    <a href="<?php echo base_url().'anggota/export_pdf' ?>" class='btn btn-sm btn-warning pull-right'><i class="fa fa-download"></i> Print Data</a>
    <a href="<?php echo base_url().'admin/anggota_tambah' ?>" class='btn btn-sm btn-success pull-right'><i class="fa fa-plus"></i> Anggota Baru</a>
    <a href="<?php echo base_url().'admin/anggota_udah_meninggal' ?>" class='btn btn-sm btn-danger pull-right'><i class="fa fa-user-times "></i> Data Wafat</a>

    </div>
</div>
<br/>
<br>

<form method="post" action="<?php echo base_url('index.php/admin/delete') ?>" id="form-delete">

<div class="table-responsive text-center">
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
                  </tbody>
				</table>
                
			</div>
            </div>



		<!-- Load Jquery & Datatable JS -->
		<script type="text/javascript" src="<?php echo base_url('js/jquery.min.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('datatables/datatables.min.js') ?>"></script>
		<script type="text/javascript" src="<?php echo base_url('datatables/lib/js/dataTables.bootstrap.min.js') ?>"></script>
		<script>
		var tabel = null;
        var no = 1;
		$(document).ready(function() {
		    tabel = $('#table-siswa').DataTable({
		        "processing": true,
		        "serverSide": true,  
		        "ordering": true, // Set true agar bisa di sorting
		        "order": [[ 2, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		        "ajax":
		        {
		            "url": "<?php echo base_url('index.php/admin/view') ?>", // URL file untuk proses select datanya
		            "type": "POST"
		        },
		        "deferRender": true,
		        "aLengthMenu": [[25, 50, 100],[ 25, 50, 10]], // Combobox Limit
		        "columns": [
                    { "render": function ( data, type, row ) { // Tampilkan kolom aksi
		                    var html  = "<input type='checkbox' class='check-item' >"
		                    return html
		                }
		            },
                    { "render": function ( data, type, row ) { // Tampilkan kolom aksi
                            var html  = no++;
		                    return html
		                }
		            },
					{ "data": "no_anggota" },  // Tampilkan nama
		            { "data": "nama" }, // Tampilkan telepon
                    { "data": "nama_ortu" }, // Tampilkan telepon
		            { "data": "ttg" }, // Tampilkan alamat
                { "data": "jenis_kelamin" }, // Tampilkan alamat
		            { "data": "gampong" }, // Tampilkan alamat
		            { "data": "kecamatan" }, // Tampilkan alamat
                { "data": "kabupaten" }, // Tampilkan alamat
		            { "render": function ( data, type, row ) { // Tampilkan kolom aksi
		                    var html  = "<a href='' id='btnEdit' >EDIT</a> | "
		                    html += "<a href=''id='btnDelete' >DELETE</a>"

		                    return html
		                }
		            },
		        ],
		    });
            
		});
        
		</script>
      </div></div>
