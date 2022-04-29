<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class Anggota extends CI_Controller {
    private $limit = 10;
    var $module_name = 'anggota';
	
    public function __construct(){
        parent::__construct();
        $this->load->model(array('M_pdfpemberhentian'=>'pemberhentian'));
        $this->load->model(array('M_pdfanggota'=>'anggota'));
        $this->load->model(array('persiswaModel'=>'persiswa'));

    }
	
    public function index($offset=0){
        $result                 = $this->anggota->get_list($this->limit, $offset);
        $data['anggota']           = $result['rows'];
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
        $this->load->view('admin/pdf/v_anggota',$data); //memanggil view 
    }
    
    public function export_pdf() {
        $this->load->library('f_pdf');
        $data['anggota'] = $this->anggota->export_pdf();
        $this->load->view('admin/pdf/v_anggota_pdf',$data); //memanggil view 
    }
    
    public function export_pdf_perkecamatan() {
        $id_kecamatan = $this->input->post('id_kecamatan');
        $kecamatan = $this->persiswa->kecamatan_nama($id_kecamatan);
        $this->load->library('f_pdf');
        $data['anggota'] = $this->anggota->export_pdf_kecamatan($kecamatan);
        $this->load->view('admin/pdf/v_anggota_pdf',$data); //memanggil view 
    }

    public function export_pdf_permajelis() {
        $table2 = $this->input->post('id_gampong');
        $this->load->library('f_pdf');
        $data['anggota'] = $this->anggota->export_pdf_permajelis($table2);
        $data['kelas'] = $this->m_data->get_data_kelas_id2($table2)->result();
        $this->load->view('admin/pdf/v_anggota_permajelis_pdf',$data); //memanggil view 
    }

    public function export_pdf_kecamatan() {
        $this->load->library('f_pdf');
        $data['anggota'] = $this->anggota->export_pdf_kecamatan($this->session->userdata('ketua_kecamatan'));
        $this->load->view('ketua_kecamatan/pdf/v_anggota_pdf',$data); //memanggil view 
    }

    public function export_pdf_gampong() {
        $this->load->library('f_pdf');
        $data['anggota'] = $this->anggota->export_pdf_gampong($this->session->userdata('ketua_gampong'));
        $this->load->view('ketua_gampong/pdf/v_anggota_pdf',$data); //memanggil view 
    }

    function export_pdf_pemberhentian_perbulan(){
        $tanggal = $this->input->post('tanggal');
        $tanggal1 = explode('-', $tanggal);
        $bulan = $tanggal1[0];
        $tahun   = $tanggal1[1];
        $this->load->library('f_pdf');
        $data["bulan"] =  $tanggal1[0];
        $data["tahun"] =  $tanggal1[1];
        $data['anggota'] = $this->db->query("SELECT  * from pemberhentian WHERE MONTH(tgl_berhenti) = '$bulan' AND YEAR(tgl_berhenti) = '$tahun'  order by id desc")->result();
        $this->load->view('admin/pdf/v_pemberhentian_perbulan_pdf',$data); //memanggil view 
    }

    function export_pdf_pemberhentian_pertahun(){
        $tanggal1 = $this->input->post('tanggal');
        $this->load->library('f_pdf');
        $data["tahun"] =  $tanggal1;

        $data['anggota'] = $this->db->query("SELECT  * from pemberhentian WHERE  YEAR(tgl_berhenti) = '$tanggal1'  order by id desc")->result();
        $this->load->view('admin/pdf/v_pemberhentian_pertahun_pdf',$data); //memanggil view 
    }

    function export_pdf_peringatan_perbulan(){
        $tanggal = $this->input->post('tanggal');
        $tanggal1 = explode('-', $tanggal);
        $bulan = $tanggal1[0];
        $tahun   = $tanggal1[1];
        $this->load->library('f_pdf');
        
        $data['anggota'] = $this->db->query("SELECT  anggota.id,anggota.nama,anggota.no_anggota, anggota.nama_ortu, anggota.jenis_kelamin, anggota.ttg, anggota.gampong, anggota.kecamatan,anggota.kabupaten, peringatan.tanggal from anggota inner join peringatan on anggota.id = peringatan.id_anggota WHERE MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun'  order by id desc")->result();
        $this->load->view('admin/pdf/v_peringatan_perbulan_pdf',$data); //memanggil view 
    }

    function export_pdf_peringatan_pertahun(){
        $tanggal1 = $this->input->post('tanggal');
        $this->load->library('f_pdf');
        
        $data['anggota'] = $this->db->query("SELECT  anggota.id,anggota.nama,anggota.no_anggota, anggota.nama_ortu, anggota.jenis_kelamin, anggota.ttg, anggota.gampong, anggota.kecamatan,anggota.kabupaten, peringatan.tanggal from anggota inner join peringatan on anggota.id = peringatan.id_anggota WHERE YEAR(tanggal) = '$tanggal1'  order by id desc")->result();
        $this->load->view('admin/pdf/v_peringatan_pertahun_pdf',$data); //memanggil view 
    }

    function export_pdf_baru_perbulan(){
        $tanggal = $this->input->post('tanggal');
        $tanggal1 = explode('-', $tanggal);
        $bulan = $tanggal1[0];
        $tahun   = $tanggal1[1];
        $this->load->library('f_pdf');
        $data["bulan"] =  $tanggal1[0];
        $data["tahun"] =  $tanggal1[1];
        $data['anggota'] = $this->db->query("SELECT * from anggota WHERE MONTH(tgl_diterima) = '$bulan' AND YEAR(tgl_diterima) = '$tahun'  order by id desc")->result();
        $this->load->view('admin/pdf/v_baru_perbulan_pdf',$data); //memanggil view 
    }

    function export_pdf_baru_pertahun(){
        $tanggal1 = $this->input->post('tanggal');
        $this->load->library('f_pdf');
        $data["tahun"] =  $tanggal1;

        $data['anggota'] = $this->db->query("SELECT * from anggota WHERE YEAR(tgl_diterima) = '$tanggal1'  order by id desc")->result();
        $this->load->view('admin/pdf/v_baru_pertahun_pdf',$data); //memanggil view 
    }


    
}
