<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class sinkron extends CI_Controller
{
    private $limit = 10;
    var $module_name = 'sinkron';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_pdfabsensi' => 'absensi'));
        $this->load->model(array('persiswaModel' => 'persiswa'));
    }

    public function pemanggil()
    {
        $data['data'] = $this->M_data->get_data('absensi')->result();
        var_dump($data);
        $this->load->view('admink/v_header');
        $this->load->view('admink/dump');
        $this->load->view('admink/v_footer');
    }
}
