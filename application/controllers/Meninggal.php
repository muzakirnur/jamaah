<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class meninggal extends CI_Controller {
    private $limit = 10;
    var $module_name = 'meninggal';
	
    public function __construct(){
        parent::__construct();
        $this->load->model(array('M_pdfmeninggal'=>'meninggal'));
    }
	
    public function index($offset=0){
        $result                 = $this->meninggal->get_list($this->limit, $offset);
        $data['meninggal']           = $result['rows'];
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
        $this->load->view('admin/pdf/v_meninggal',$data); //memanggil view 
    }
    
    public function export_pdf() {
        $this->load->library('f_pdf');
        $data['meninggal'] = $this->meninggal->export_pdf();
        $this->load->view('admin/pdf/v_meninggal_pdf',$data); //memanggil view 
    }


    function export_pdf_meninggal_kelas(){
        if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])){
        $mulai = $_GET['tanggal_mulai'];
        $sampai = $_GET['tanggal_sampai'];
        $this->load->library('f_pdf');
        $data['meninggal'] = $this->meninggal->export_pdf_meninggal_kelas($this->session->userdata('kelas'), $this->session->userdata('gampong'), $mulai, $sampai);
        $this->load->view('kelas/pdf/v_anggota_meninggal_pdf',$data); //memanggil view 
    }}

    function export_pdf_meninggal_ketua_gampong(){
        if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])){
        $mulai = $_GET['tanggal_mulai'];
        $sampai = $_GET['tanggal_sampai'];
        $this->load->library('f_pdf');
        $data['meninggal'] = $this->meninggal->export_pdf_meninggal_ketua_gampong($this->session->userdata('ketua_gampong'), $mulai, $sampai);
        $this->load->view('ketua_gampong/pdf/v_meninggal_pdf',$data); //memanggil view 
    }}

    function export_pdf_meninggal_ketua_kecamatan(){
        if(isset($_GET['tanggal_mulai']) && isset($_GET['gampong']) && isset($_GET['tanggal_sampai'])){
        $mulai = $this->input->get('tanggal_mulai');
        $sampai = $this->input->get('tanggal_sampai');
        $gampong = $this->input->get('gampong');
        $this->load->library('f_pdf');
        $data['meninggal'] = $this->meninggal->export_pdf_meninggal_ketua_gampong($gampong, $mulai, $sampai);
        $this->load->view('ketua_kecamatan/pdf/v_meninggal_pdf',$data); //memanggil view 
    }}
    
    function export_pdf_meninggal_admin(){
        if(isset($_GET['tanggal_mulai']) && isset($_GET['gampong']) && isset($_GET['tanggal_sampai'])){
        $mulai = $this->input->get('tanggal_mulai');
        $sampai = $this->input->get('tanggal_sampai');
        $gampong = $this->input->get('gampong');
        $this->load->library('f_pdf');
        $data['meninggal'] = $this->meninggal->export_pdf_meninggal_ketua_gampong($gampong, $mulai, $sampai);
        $this->load->view('admin/pdf/v_meninggal_pdf',$data); //memanggil view 
    }}

}