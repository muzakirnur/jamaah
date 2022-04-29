<!DOCTYPE html>
<html>
<head>
  <title>Admin Kecamatan - Sistem Informasi Pengajian </title>
  <!-- css bootstrap -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css' ?>">
  <meta name="viewport" content="initial-scale=1">

  <!-- css datatables -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/DataTables/datatables.css' ?>">

  <!-- icon font awesome -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/awesome/css/font-awesome.css' ?>">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">

<!-- jquery dan bootstrap js -->
  <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js' ?>"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>

  <!-- js datatables -->
  <script type="text/javascript" src="<?php echo base_url().'assets/DataTables/datatables.js' ?>"></script>


  <script>
    var baseurl = "<?php echo base_url("index.php/"); ?>"; // Buat variabel baseurl untuk nanti di akses pada file config.js
    </script>
    <script src="<?php echo base_url("js/jquery.min.js"); ?>"></script> <!-- Load library jquery -->
    <script src="<?php echo base_url("js/config.js"); ?>"></script> <!-- Load file process.js -->
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo base_url().'ketua_kecamatan'; ?>">SI Pengajian</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
				<li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'ketua_kecamatan/absen_harian'; ?>"><i class="fa fa-hand-paper-o"></i> Absen Harian</a>
       </li>
        
        <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-user"></i>
    Data Admin Dan Anggota
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="<?php echo base_url().'ketua_kecamatan/ketua_kelas'; ?>"><i class="fa fa-child"></i> Admin Kelas</a>
        <a class="dropdown-item" href="<?php echo base_url().'ketua_kecamatan/anggota'; ?>"><i class="fa fa-users"></i> Anggota</a>
                <a class="dropdown-item" href="<?php echo base_url().'ketua_kecamatan/anggota_permajelis'; ?>"><i class="fa fa-mosque"></i> Anggota Permajelis</a>

         </li> 
         
         <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-list-alt"></i>
    Data Absensi
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
           <a class="dropdown-item" href="<?php echo base_url().'ketua_kecamatan/absen_isi'; ?>"><i class="fa fa-hand-paper-o "></i> Absensi </a> 

         <a class="dropdown-item" href="<?php echo base_url().'ketua_kecamatan/absen_laporan'; ?>"><i class="fa fa-list-alt"></i> Rekap Absensi </a>
        <a class="dropdown-item" href="<?php echo base_url().'ketua_kecamatan/absen_persiswa_laporan'; ?>"><i class="fa fa-child"></i> Rekap Absensi Persiswa</a>
         </li> 

          <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'ketua_kecamatan/iuran_laporan'; ?>"><i class="fa fa-money"></i> IURAN</a>
       </li>
			
       <li >
            <a href="<?php echo base_url().'ketua_kecamatan/pilah' ?>" class="nav-link"><i class="fa fa-bookmark"></i> Pilih Anggota</a>
          </li>
       <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'ketua_kecamatan/ganti_password'; ?>"><i class="fa fa-key"></i> Ganti Password</a>
       </li>
        
</ul>
<!-- </li> -->

</ul>

</li>

         

        <span class="navbar-text mr-3 text-center">
          Halo, <?php echo $this->session->userdata('username'); ?> [Admin Kecamatan]
        </span>

        <a href="<?php echo base_url().'ketua_kecamatan/logout' ?>" class="btn btn-outline-light ml-1"><i class="fa fa-power-off"></i> KELUAR</a>

      </div>
    </div>
  </nav>

  <br/>
  <br/>
