<!DOCTYPE html>
<html>

<head>
	<title>Admin - Sistem Informasi Pengajian </title>
	<!-- css bootstrap -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/bootstrap.css' ?>">
	<meta name="viewport" content="initial-scale=1">
	<!-- css datatables -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/DataTables/datatables.css' ?>">

	<!-- icon font awesome -->
	<link rel="stylesheet" type="text/css" href="<?php echo base_url() . 'assets/css/awesome/css/font-awesome.css' ?>">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.css">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
	<!-- CSS only -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
	<!-- JavaScript Bundle with Popper -->
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

	<!-- jquery dan bootstrap js -->
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.js' ?>"></script>
	<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/7.33.1/sweetalert2.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>


	<!-- js datatables -->
	<script type="text/javascript" src="<?php echo base_url() . 'assets/DataTables/datatables.js' ?>"></script>


	<script>
		var baseurl = "<?php echo base_url("index.php/"); ?>"; // Buat variabel baseurl untuk nanti di akses pada file config.js
	</script>
	<script src="<?php echo base_url("js/jquery.min.js"); ?>"></script> <!-- Load library jquery -->
	<script src="<?php echo base_url("js/config.js"); ?>"></script> <!-- Load file process.js -->
</head>

<body>

	<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
		<div class="container-fluid">
			<a class="navbar-brand" href="<?php echo base_url() . 'admink'; ?>">SI Pengajian</a>
			<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<div class="collapse navbar-collapse" id="navbarText">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item">
						<a class="nav-link" href="<?php echo base_url() . 'admink/gaji' ?>">Gaji</a>
					</li>
					<div class="dropdown">
						<a class="nav-link" href="#" role="button" id="dropdownMenuLink" data-bs-toggle="dropdown" aria-expanded="false">
							Iuran
						</a>

						<ul class="dropdown-menu" aria-labelledby="dropdownMenuLink">
							<li><a class="dropdown-item" href="<?php echo base_url() . 'admink/tambahiuran' ?>">Tambah Iuran</a></li>
							<li><a class="dropdown-item" href="<?php echo base_url() . 'admink/iuran_laporan' ?>">Data Iuran</a></li>
							<li><a class="dropdown-item" href="<?php echo base_url() . 'admink/iuranwajib' ?>">Jumlah Iuran Wajib</a></li>
						</ul>
					</div>

				</ul>
				<!-- </li> -->
				</ul>

				</li>

				<a href="<?php echo base_url() . 'admin/logout' ?>" class="btn btn-outline-light ml-1"><i class="fa fa-power-off"></i> KELUAR</a>

			</div>
		</div>
	</nav>

	<br />
	<br />