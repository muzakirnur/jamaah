<div class="container">
  <div class="jumbotron text-center">
    <div class="col-sm-8 mx-auto">
      <h1>Selamat datang!</h1>

        Anda telah login sebagai <b><?php echo $this->session->userdata('username'); ?></b> [ketua Kecamatan].
      </p>
    </div>
  </div>

  <div class="row justify-content-center">
    <div class="col-md-3">
      <div class="card border-primary text-center">
        <div class="card-body">
          <h1>
             <?php echo $this->m_data->get_data_tambah_kelas($this->session->userdata('ketua_kecamatan'))->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-book"></i>
            </div>
          </h1>
        Jumlah kelas
        </div>
      </div>
    </div>
   
    <div class="col-md-3">
    <div class="card border-danger mb-3">
      <div class="card text-danger text-center">
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data_jumlah_kecamatan($this->session->userdata('ketua_kecamatan'))->num_rows(); ?>
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
