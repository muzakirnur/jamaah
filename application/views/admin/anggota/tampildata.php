<div class="container-fluid">
  <div class="card">
    <div class="card-header text-center">
      <h4>Data Anggota</h4>
    </div>
    <div class="card-body-inline">
 <div class="row mt-2">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <?= form_open_multipart('exportimport/uploaddata') ?>
                        <div class="form-row">
                            <div class="col-2">
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
                   
    <a href="<?php echo base_url().'anggota/export_pdf' ?>" class='btn btn-sm btn-warning pull-right'><i class="fa fa-download"></i> Print Data</a>
    <a href="<?php echo base_url().'admin/anggota_tambah' ?>" class='btn btn-sm btn-success pull-right'><i class="fa fa-plus"></i> Anggota Baru</a>
    <a href="<?php echo base_url().'admin/anggota_udah_meninggal' ?>" class='btn btn-sm btn-danger pull-right'><i class="fa fa-user-times "></i> Data Wafat</a>

    </div>
</div>
<br/>
<br/>
        <?= form_open('admin/deletemultiple', ['class' => 'formhapus']) ?>
        <div class="card-body">

            <button type="submit" class="btn btn-sm btn-danger tombolHapusBanyak">
                <i class="fa fa-trash"></i> Hapus Banyak
            </button>

            <p class="card-text">
                <div class="table-responsive text-center">

                <table class="table table-bordered table-striped display nowrap" style="width:100%;" id="dataanggota">
                    <thead>
                        <tr>
                            <th rowspan="2">
                                <input  type="checkbox" id="centangSemua">
                            </th>
                            <th rowspan="2">NO</th>
            <th rowspan="2">NOMOR ANGGOTA</th>
            <th rowspan="2">NAMA</th>
            <th rowspan="2">NAMA ORANG TUA</th>
            <th rowspan="2">TEMPAT/TGL.LAHIR</th>
            <th rowspan="2">JENIS KELAMIN</th> 
            <th colspan="3">Alamat</th>  
            <th rowspan="2">Opsi</th>
            
            <tr>
            <th>GAMPONG</th>
            <th>KECAMATAN</th>
            <th>KABUPATEN</th> 
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </p>
        </div>
        <?= form_close(); ?>
    </div>
</div>
<div class="viewmodal" style="display: none;"></div>
<script>
function tampildatamahasiswa() {
    table = $('#dataanggota').DataTable({
        responsive: true,
        "destroy": true,
        "processing": true,
        "serverSide": true,
        "order": [],

        "ajax": {
            "url": "<?= site_url('admin/ambildata') ?>",
            "type": "POST"
        },


        "columnDefs": [{
            "targets": [0],
            "orderable": false,
            "width": 5
        }],

    });
}
$(document).ready(function() {

    $('#centangSemua').click(function(e) {
        if ($(this).is(":checked")) {
            $('.centangId').prop('checked', true);
        } else {
            $('.centangId').prop('checked', false);
        }
    });

    tampildatamahasiswa();

    $('#centangSemua').click(function(e) {
        if ($(this).is(':checked')) {
            $(".centangItem").prop("checked", true);
        } else {
            $(".centangItem").prop("checked", false);
        }
    });

    $('#tomboltambah').click(function(e) {
        $.ajax({
            url: "<?= site_url('admin/formtambah') ?>",
            dataType: "json",
            success: function(response) {
                if (response.sukses) {
                    $('.viewmodal').html(response.sukses).show();
                    $('#modaltambah').on('shown.bs.modal', function(e) {
                        $('#id').focus();
                    })
                    $('#modaltambah').modal('show');
                }
            }
        });
    });

    $('.formhapus').submit(function(e) {
        e.preventDefault();

        let jmldata = $('.centangId:checked');

        if (jmldata.length === 0) {
            Swal.fire({
                icon: 'warning',
                title: 'Perhatian',
                text: 'Maaf tidak ada yang bisa dihapus, silahkan dicentang !'
            })
        } else {
            Swal.fire({
                title: 'Hapus Data',
                text: `Ada ${jmldata.length} data anggota yang akan dihapus, yakin ?`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus',
                cancelButtonText: 'Tidak'
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        type: "post",
                        url: $(this).attr('action'),
                        data: $(this).serialize(),
                        dataType: "json",
                        success: function(response) {
                            if (response.sukses) {
                                Swal.fire({
                                    icon: 'success',
                                    title: 'Berhasil',
                                    text: response.sukses
                                })
                                tampildatamahasiswa();
                            }
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            alert(xhr.status + "\n" + xhr.responseText + "\n" +
                                thrownError);
                        }
                    });
                }
            })
        }
        return false;
    });
});



function hapus(id) {
    Swal.fire({
        title: 'Hapus',
        text: `Yakin menghapus ingin menghapus anggota ini?`,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, Hapus',
        cancelButtonText: 'Tidak'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: "post",
                url: "<?= site_url('admin/hapus') ?>",
                data: {
                    id: id,
                },
                dataType: "json",
                success: function(response) {
                    if (response.sukses) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Konfirmasi',
                            text: response.sukses
                        });
                        tampildatamahasiswa();
                    }
                }
            });
        }
    })
}
</script>