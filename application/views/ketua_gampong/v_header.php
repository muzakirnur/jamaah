<!DOCTYPE html>
<html>
<head>
  <title>Admin Gampong - Sistem Informasi Pengajian </title>
  <!-- css bootstrap -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/bootstrap.css' ?>">
  <meta name="viewport" content="initial-scale=1">


  <!-- css datatables -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/DataTables/datatables.css' ?>">

  <!-- icon font awesome -->
  <link rel="stylesheet" type="text/css" href="<?php echo base_url().'assets/css/awesome/css/font-awesome.css' ?>">

  <!-- jquery dan bootstrap js -->
  <script type="text/javascript" src="<?php echo base_url().'assets/js/jquery.js' ?>"></script>
  <script type="text/javascript" src="<?php echo base_url().'assets/js/bootstrap.js' ?>"></script>

  <!-- js datatables -->
  <script type="text/javascript" src="<?php echo base_url().'assets/DataTables/datatables.js' ?>"></script>
</head>
<body>

  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="<?php echo base_url().'ketua_gampong'; ?>">SI Pengajian</a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarText">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'ketua_gampong'; ?>"><i class="fa fa-home"></i> Dashboard</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo base_url().'ketua_gampong/anggota'; ?>"><i class="fa fa-users"></i> anggota</a>
          </li>
          <li class="nav-item dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fa fa-book"></i>
    Absen Dan Rekap
  </a>
  <div class="dropdown-menu" aria-labelledby="navbarDropdown">
         <a class="dropdown-item" href="<?php echo base_url().'ketua_gampong/absen_isi'; ?>"><i class="fa fa-hand-paper-o "></i> Absensi </a> 
          <a class="dropdown-item" href="<?php echo base_url().'ketua_gampong/absen_laporan'; ?>"><i class="fa fa-list-alt"></i> Rekap Absensi </a>
  </li>      
  <a class="nav-link" href="<?php echo base_url().'ketua_gampong/iuran_laporan'; ?>"><i class="fa fa-money"></i> IURAN</a>
  </li>
  <li class="nav-item">
          <a class="nav-link" href="<?php echo base_url().'ketua_gampong/ganti_password'; ?>"><i class="fa fa-key"></i> Ganti Password</a>
       </li>
        </ul>

        <span class="navbar-text mr-3 text-center">
          Halo, <?php echo $this->session->userdata('username'); ?> [Admin Gampong]
        </span>

        <a href="<?php echo base_url().'ketua_gampong/logout' ?>" class="btn btn-outline-light ml-1"><i class="fa fa-power-off"></i> KELUAR</a>

      </div>
    </div>
  </nav>

  <br/>
  <br/>
