<!DOCTYPE html>
<html>
<head>
  <title>Cetak Kartu Anggota</title>
</head>
<body>

  <style type="text/css">
    .card{
      border: 1px solid #000;
      width: 450px;
    }

    .card-header{
      border-bottom: 1px solid #000;
      text-align: center;
      font-weight: bold;
      padding: 10px;

    }

    .card-body{
      padding: 20px;
    }

    .uppercase { 
        text-transform: uppercase; 
        font-weight: bold;
    }

    .ok {
    text-align: justify;
    margin-left: 270px;
}

  </style>

  <div class="card">
    <div class="card-header">
    <img src="<?php echo site_url('assets/image/mub.png'); ?>" style="width:50px;height:50px;" align='center' alt=""> FORUM MAJELIS TA'LIM <br>
       SIRUL MUBTADIN
    </div>
    <div class="card-body">
      <div class="container">
        <table class="table table-borderless table-sm fs-4">
          <?php
          $no = 1;
          foreach($anggota as $a){
            ?>
            
            <tr>
            <td><img src="<?php echo site_url('Render/QRcode/'.$a->no_anggota); ?>" style="width:100px;height:100px;" align='left' alt=""></td>
            </tr>
            <tr>
              <td>Nama</td>
              <td>:</td>
              <td class='uppercase'><?php echo $a->nama , ' BINTI ', $a->nama_ortu; ?></td>
            </tr>
            <tr>
              <td>Tempat/Tgl.Lahir</td>
              <td>:</td>
              <td ><?php echo $a->ttg; ?></td>
            </tr>
            <tr>
              <td>Jenis Kelamin </td>
              <td>:</td>
              <td>
              <?php
                if($a->jenis_kelamin == "P"){
                  echo "Perempuan";
                }else if($a->jenis_kelamin == "L"){
                  echo "Laki - Laki";
                }
                ?>
                </td>
            </tr>
            <tr>
              <td>Alamat</td>
              <td>:</td>
              <td><?php echo $a->gampong; ?>
              </td>

            </tr>

           
            <tr>
              <td>Kabupaten</td>
              <td>:</td>
              <td ><?php echo $a->kabupaten; ?></td>
            </tr>
            <tr>
              <td>Berlaku</td>
              <td>:</td>
              <td ><?php echo 'Selama Masih Berstatus Anggota Pengajian'; ?></td>
            </tr>

            <?php
          }
          ?>
        </table>
      </div>
    </div>
  </div>

  <script type="text/javascript">
  </script>

</body>
</html>
