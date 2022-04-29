<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class peringatan extends CI_Controller {
    private $limit = 10;
    var $module_name = 'peringatan';
	
    public function __construct(){
        parent::__construct();
        $this->load->model(array('M_pdfperingatan'=>'peringatan'));
    }
	
    public function index($offset=0){
        $result                 = $this->peringatan->get_list($this->limit, $offset);
        $data['peringatan']           = $result['rows'];
        $data['num_results']    = $result['num_rows'];
        // load pagination library
        $this->load->library('pagination');
        $config = array(
            'base_url'          => site_url($this->module_name.'/index'),
            'total_rows'        => $data['num_results'],
            'per_page'          => $this->limit,
            'uri_segment'       => 3,
            'use_page_numbers'  => TRUE,
            'num_links'         => 5,
        );
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('admin/pdf/v_peringatan',$data); //memanggil view 
    }
    
    public function export_pdf($id){
        $this->load->library('f_pdf');
        $data['peringatan'] = $this->peringatan->export_pdf($id);
        $this->load->view('ketua_kecamatan/pdf/v_peringatan_pdf',$data); //memanggil view 
    }

    function minta_peringatan($id){
		$where = array(
			'id' => $id
		);

		// mengubah status peminjaman menjadi selesai (1)
		$this->m_data->update_data_absen($where,array('peringatan'=>1),'anggota');


		// mengalihkan halaman ke halaman data buku
		redirect(base_url().'ketua_kecamatan/anggota_edit/'.$id);
	}
    

}