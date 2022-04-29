<div class="container">
  <div class="jumbotron text-center">
    <div class="col-sm-8 mx-auto">
      <h1>Selamat datang!</h1>

      <p>
        Anda telah login sebagai <b><?php echo $this->session->userdata('nama'); ?></b> [Ketua Gampong].
      </p>
    </div>
  </div>

  <div class="row">
  <div class="col-md-3 ">
      <div class="card bg-danger text-white-center">
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data_ketua_gampong($this->session->userdata('ketua_gampong'))->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-users"></i>
            </div>
          </h1>
          Jumlah Anggota
        </div>
      </div>
    </div>

  </div>

</div>
