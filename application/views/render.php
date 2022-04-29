
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo $title ?></title>
  <link rel="stylesheet" href="">
  <style>
    body{
      text-align: center;
    }
  </style>
</head>
<body>
  <h1 align="center"><?php echo $title ?></h1>
  <?php $kode = "123456788934729473"; ?>
  <h3>Ini render QRcode</h3>
  <img src="<?php echo site_url('Render/QRcode/'.$kode); ?>" alt="">
  <br>

  <!-- <table style="width: 100%; border-collapse: collapse;" border="1">
    <tr>
      <th>No</th>
      <th>NIM</th>
      <th>QRcode</th>
      <th>Barcode</th>
    </tr>

  </table> -->
</body>
</html>