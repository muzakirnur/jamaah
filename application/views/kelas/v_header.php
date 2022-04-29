<!DOCTYPE html>
<html>
<head>
  <title>Ketua Kelas - Sistem Informasi Pengajian </title>
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
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo base_url().'kelas'; ?>">SI Pengajian</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'kelas'; ?>"><i class="fa fa-home"></i> Dashboard</a>
          </li>
					<li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'kelas/absen_harian'; ?>"><i class="fa fa-hand-paper-o"></i> Absen Pengajian</a>
       </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'kelas/anggota'; ?>"><i class="fa fa-users"></i> anggota</a>
          </li>
					
         
          <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'kelas/absen_tambah'; ?>"><i class="fa fa-sticky-note "></i> Absensi </a>
       </li>
       <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'kelas/iuran_laporan'; ?>"><i class="fa fa-money"></i> IURAN</a>
       </li>
       <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'kelas/ganti_password'; ?>"><i class="fa fa-key"></i> Ganti Password</a>
       </li>

        </ul>

        <span class="navbar-text mr-3 text-center">
          Halo, <?php echo $this->session->userdata('username'); ?> [Ketua Kelas]
        </span>

        <a href="<?php echo base_url().'kelas/logout' ?>" class="btn btn-outline-light ml-1"><i class="fa fa-power-off"></i> KELUAR</a>

      </div>
    </div>
  </nav>

  <br/>
  <br/>
