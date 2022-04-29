<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <title><?= $title; ?></title>
</head>

<body>
    <div class="container-fluid">
        <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?= form_open_multipart('exportimport/uploaddata') ?>
                        <div class="form-row">
                            <div class="col-4">
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
                    </div>
                </div>
                <div class="card mt-2">
                <div class="table-responsive">
        <table class="table-center text-center table-bordered table-striped table-hover table-datatable">
                            <thead>
                                <tr>
                                <th rowspan="2">NO</th>
            <th rowspan="2">NOMOR ANGGOTA</th>
            <th rowspan="2">NAMA</th>
            <th rowspan="2">NAMA ORANG TUA</th>
            <th rowspan="2">TEMPAT/TGL.LAHIR</th>
            <th rowspan="2">JENIS KELAMIN</th> 
            <th colspan="3">Alamat</th>  
            <tr>
            <th>GAMPONG</th>
            <th>KECAMATAN</th>
            <th>KABUPATEN</th>
            </tr>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1;
                                foreach ($semuabarang as $barang) : ?>
                                    <tr>
                                        <td><?= $i++; ?></td>
                                        <td><?= $barang['no_anggota']; ?></td>
                                        <td><?= $barang['nama']; ?></td>
                                        <td><?= $barang['nama_ortu']; ?></td>
                                        <td><?= $barang['ttg']; ?></td>
                                        <td><?= $barang['jenis_kelamin']; ?></td>
                                        <td><?= $barang['gampong']; ?></td>
                                        <td><?= $barang['kecamatan']; ?></td>
                                        <td><?= $barang['kabupaten']; ?></td>
                                    </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>