<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class pemberhentian extends CI_Controller {
    private $limit = 10;
    var $module_name = 'pemberhentian';
	
    public function __construct(){
        parent::__construct();
        $this->load->model(array('M_pdfpemberhentian'=>'pemberhentian'));
        $this->load->model(array('gampongModel'=>'gampongModel'));

    }
	
    public function index($offset=0){
        $result                 = $this->pemberhentian->get_list($this->limit, $offset);
        $data['pemberhentian']           = $result['rows'];
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
        $this->load->view('admin/pdf/v_pemberhentian',$data); //memanggil view 
    }
    
    public function export_pdf($id){
        $this->load->library('f_pdf');
        $data['pemberhentian'] = $this->pemberhentian->export_pdf($id);
        $this->load->view('ketua_kecamatan/pdf/v_pemberhentian_pdf',$data); //memanggil view 
    }

    
    function minta_pemberhentian($id){
		$where = array(
			'id' => $id
		);

		// mengubah status peminjaman menjadi selesai (1)
		$this->m_data->update_data_absen($where,array('pemberhentian'=>1),'anggota');


		// mengalihkan halaman ke halaman data buku
		redirect(base_url().'ketua_kecamatan/anggota_edit/'.$id);
    }
    
    function hapus_anggota($id){
            $kelas = $this->gampongModel->data_kelas($id);
            $no = $this->gampongModel->data_no2($id);
            $nama = $this->gampongModel->data_nama2($id);
            $nama_ortu = $this->gampongModel->data_ortu2($id);
            $ttg = $this->gampongModel->data_ttg2($id);
            $jenis_kelamin = $this->gampongModel->data_jk2($id);
            $id_gampong = $this->gampongModel->data_gampong2($id);
            $kecamatan = $this->gampongModel->data_kecamatan2($id);
            $berhenti = $this->gampongModel->data_berhenti2($id);
    
    
        $where = array(
            'id' => $id
        );
    
                    $data = array(
                    'id_kelas' => $kelas,
                    'no_anggota' => $no,
                    'nama' => $nama,
                    'nama_ortu' => $nama_ortu,
                    'ttg' => $ttg,
                    'jenis_kelamin' => $jenis_kelamin,
                    'gampong' => $id_gampong,
                    'kecamatan' => $kecamatan,
                    'kabupaten' => 'Bireuen',
                    'tgl_berhenti' => $berhenti  
                    );
    
        $this->m_data->insert_hapus($where,$data,'pemberhentian');
    
    
        // mengalihkan halaman ke halaman data buku
        redirect(base_url().'ketua_kecamatan/anggota/');
    }
}