<div class="container">
  <div class="jumbotron text-center">
    <div class="col-sm-8 mx-auto">
      <h1>Selamat datang!</h1>

      <p>
        Anda telah login sebagai <b><?php echo $this->session->userdata('username'); ?></b> [admin].
      </p>
    </div>
  </div>

  <div class="row">
    <div class="col-md-3">
      <div class="card border-primary text-center">
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
    <div class="card border-danger mb-3">
      <div class="card text-danger text-center">
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
    </div>
   
    <div class="col-md-3">
      <div class="card bg-dark text-white text-center" >
        <div class="card-body">
          <h1>
            <?php echo $this->m_data->get_data('ketua_kecamatan')->num_rows(); ?>
            <div class="pull-right">

            <i class="fa fa-user"></i>
            </div>
          </h1>
          Jumlah Kecamatan
        </div>
      </div>
    </div>
   
  </div>


</div>
