<style>

.col-md-3 {
    width: 100%;
}
</style>
<div class="container-fluid">
<div class="jumbotron text-center">
<div class="col-md-3">
      <div class="card bg-dark text-white">
        <div class="card-body" >
          <h1>
            <?php echo $this->m_data->get_data('kelas')->num_rows(); ?>
            <div class="pull-right">

            
            </div>
          </h1><i class="fa fa-book"></i>
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

            
            </div>
          </h1><i class="fa fa-users"></i>
          Total Jamaah
        </div>
      </div>
    </div>

   
    <br>


   <br>

   <br>
<br>
<div class="container-fluid">
    <div class="card-body-inline">
    <a href="<?php echo base_url().'user/anggota_udah_meninggal' ?>" class='btn btn-sm btn-danger pull-center'><i class="fa fa-user-times"></i> Data Wafat</a>

    <br>
<br>

<br>
<br>
<div class="table-responsive">
<table id="table-siswa" class="display nowrap table-striped text-center table-bordered table" >
<thead class="thead-dark">

<tr>
<th >NO</th>
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
</thead>
					<tbody>

                    </tbody>
				</table>
                
			</div>
		</div>

		<!-- Load Jquery & Datatable JS -->
		<script>
		var tabel = null;
    var no = 1; 
		$(document).ready(function() {
		    tabel = $('#table-siswa').DataTable({
          
		        "processing": true,
		        "serverSide": true,
		        "ordering": true, // Set true agar bisa di sorting
		        "order": [[ 0, 'asc' ]], // Default sortingnya berdasarkan kolom / field ke 0 (paling pertama)
		        "ajax":
		        {
		            "url": "<?php echo base_url('index.php/jamaah/user/view') ?>", // URL file untuk proses select datanya
		            "type": "POST"
		        },
		        "deferRender": true,
		        "aLengthMenu": [[25, 50, 100],[ 25, 50, 10]], // Combobox Limit
		        "columns": [
              { "render": function ( data, type, row ) { // Tampilkan kolom aksi
		                    var html  =  no++;
		                    return html
		                }
		            },					{ "data": "no_anggota" },  // Tampilkan nama
		            { "data": "nama" }, // Tampilkan telepon
                { "data": "nama_ortu" }, // Tampilkan telepon
		            { "data": "ttg" }, // Tampilkan alamat
                { "data": "jenis_kelamin" }, // Tampilkan alamat
		            { "data": "gampong" }, // Tampilkan alamat
		            { "data": "kecamatan" }, // Tampilkan alamat
                { "data": "kabupaten" }, // Tampilkan alamat
		            
		        ],
		    });
        
		});

 
		</script>
	
