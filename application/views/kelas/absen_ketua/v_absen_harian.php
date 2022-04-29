<div class="container">
  <div class="card">
    <div class="card-header text-center">
      <h4>Absen Pengajian</h4>
    </div>
    <div class="card-body">

      <form method="post" >
        <div class="form-group text-center">
		<?php

foreach($absen as $a){

	if($a->hasil == 0){
?>
<p class="text-center font-weight-bold h5"> Wahh!! Anda Belum Melakukan Absensi Hari Ini!!</p><br>
        <a href="<?php echo base_url().'kelas/absen_sekarang' ?>" class='btn btn-outline-primary col-sm-4 row-sm-4'><i class="fa fa-hand-paper-o"></i> Absensi Sekarang</button><a>

            <?php
	}else{
          ?>
			
      <a href="" class='btn btn-outline-success col-sm-4 row-sm-4'><i class="fa fa-check"></i> Hore!! Anda Sudah Absen Hari Ini</button><a>
		  
		  <?php
			}
	}
          ?>
			
        
		

      </form>

    </div>
  </div>
  
</div>
