<!DOCTYPE html>
<html>
<head>
  <title>Cetak Laporan pengajian kelas</title>
</head>
<body>

  <style type="text/css">
  table{
    border-collapse: collapse;
  }

  table th,td{
    border: 1px solid #000;
  }
</style>

<center>
  <h3>Laporan pengajian kelas</h3>
</center>

<table>
  <tr>
    <th width="1%">No</th>
    <th>kelas</th>
    <th>Nama</th>
    <th>Mulai Pinjam</th>
    <th>Pinjam Sampai</th>
    <th>Status</th>
  </tr>
  <?php 
  $no = 1;
  foreach($pengajian as $p){
    ?>
    <tr>
      <td><?php echo $no++; ?></td>
      <td><?php echo $p->kelas; ?></td>
      <td><?php echo $p->nama; ?></td>
      <td><?php echo date('d-m-Y',strtotime($p->pengajian_tanggal_mulai)); ?></td>
      <td><?php echo date('d-m-Y',strtotime($p->pengajian_tanggal_sampai)); ?></td>
      <td>
       <center>
        <?php 
        if($p->pengajian_status == "1"){
          echo "<div class='badge badge-success'>Selesai</div>";
        }else if($p->pengajian_status == "2"){
          echo "<div class='badge badge-warning'>Dipinjam</div>";
        }
        ?>
      </center>
    </td>
  </tr>
  <?php 
}
?>
</table>

<script type="text/javascript">
  window.print();
</script>

</body>
</html>