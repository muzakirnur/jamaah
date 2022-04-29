<div class="container">
  <div class="jumbotron text-center">
    <div class="col-sm-8 mx-auto">
      <h1>Selamat datang!</h1>
      <p>Ini merupakan contoh sistem informasi Pengajian hasil dari tutorial <b>ebook tutorial codeigniter lengkap dengan studi kasus membuat sistem informasi Pengajian</b>.</p>
      <p>
        Anda telah login sebagai <b><?php echo $this->session->userdata('username'); ?></b> [user].
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data('kelas')->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-book"></i>
            </div>
          </h1>
          Jumlah kelas
        </div>
      </div>
    </div>

    <div class="col-md-3">
      <div class="card bg-danger text-white">
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data('anggota')->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-users"></i>
            </div>
          </h1>
          Jumlah Anggota
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-warning text-white">
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data('pengajian')->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-book"></i>
            </div>
          </h1>
          Jumlah Total pengajian
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-primary text-white">
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data('ketua_kecamatan')->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-user"></i>
            </div>
          </h1>
          Jumlah Ketua Kecamatan
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="card bg-info text-white">
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data('berkas')->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-book"></i>
            </div>
          </h1>
          Jumlah E-book
        </div>
      </div>
    </div>

  </div>


</div>

