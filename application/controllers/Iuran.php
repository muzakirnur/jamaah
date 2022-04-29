<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
 
class iuran extends CI_Controller {
    private $limit = 10;
    var $module_name = 'iuran';
	
    public function __construct(){
        parent::__construct();
        $this->load->model(array('M_pdfiuran'=>'iuran'));
    }
	
    public function index($offset=0){
        $result                 = $this->iuran->get_list($this->limit, $offset);
        $data['iuran']           = $result['rows'];
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
        $this->load->view('admin/pdf/v_iuran',$data); //memanggil view 
    }
    
    public function export_pdf() {
        $this->load->library('f_pdf');
        $data['iuran'] = $this->iuran->export_pdf();
        $this->load->view('admin/pdf/v_iuran_pdf',$data); //memanggil view 
    }

    public function export_pdf_kecamatan() {
        $this->load->library('f_pdf');
        $data['iuran'] = $this->iuran->export_pdf_kecamatan($this->session->userdata('ketua_kecamatan'));
        $this->load->view('ketua_kecamatan/pdf/v_iuran_pdf',$data); //memanggil view 
    }

    public function export_pdf_gampong() {
        $this->load->library('f_pdf');
        $data['iuran'] = $this->iuran->export_pdf_gampong($this->session->userdata('ketua_gampong'));
        $this->load->view('ketua_gampong/pdf/v_iuran_pdf',$data); //memanggil view 
    }

    function export_pdf_iuran_kelas(){
        if(isset($_GET['tanggal_iuran'])){
        $table = $this->session->userdata('kelas');
        $table2 = $this->session->userdata('gampong');
        $mulai = $this->input->get('tanggal_iuran');
        $this->db->query("SELECT sum(jumlah_iuran) as iuran from iuran WHERE (kelas= '$table' AND gampong = '$table2' AND tanggal_iuran = '$mulai')")->result_array();
        $this->load->library('f_pdf');
        $data['iuran'] = $this->iuran->export_pdf_iuran_kelas($this->session->userdata('kelas'), $this->session->userdata('gampong'), $mulai);
        $data['count'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran from iuran WHERE (kelas= '$table' AND gampong = '$table2' AND tanggal_iuran = '$mulai')")->result_array();
        $this->load->view('kelas/pdf/v_iuran_pdf',$data); //memanggil view 
    }}

    function export_pdf_iuran_ketua_gampong(){
        if(isset($_GET['kelas']) && isset($_GET['gampong']) && isset($_GET['tanggal_iuran'])){
            $mulai = $this->input->get('tanggal_iuran');
            $kelas = $this->input->get('kelas');
            $gampong = $this->input->get('gampong');
        $this->load->library('f_pdf');
        $data['iuran'] = $this->iuran->export_pdf_iuran_ketua_kecamatan($kelas,$gampong, $mulai);
        $data['count'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran from iuran WHERE (kelas= '$kelas' AND gampong = '$gampong' AND tanggal_iuran = '$mulai')")->result_array();
        $this->load->view('ketua_kecamatan/pdf/v_iuran_pdf',$data); //memanggil view 
    }}

    function export_pdf_iuran_admin(){
        if(isset($_GET['id_gampong']) && isset($_GET['tanggal_iuran'])){
            $mulai = $this->input->get('tanggal_iuran');
            $id_gampong = $this->input->get('id_gampong');
            $tanggal1 = explode('-', $mulai);
            $bulan = $tanggal1[0];
            $tahun   = $tanggal1[1];
        $this->load->library('f_pdf');
        $data['kelas'] = $this->m_data->get_data_kelas_id2($id_gampong)->result();
        $data['iuran'] = $this->iuran->export_pdf_iuran_admin($id_gampong, $bulan, $tahun);
        $data['count'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran from iuran WHERE (id_kelas= '$id_gampong' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $this->load->view('admin/pdf/v_iuran_pdf',$data); //memanggil view 
    }}

    function export_pdf_iuran()
    {
        if(isset($_GET['id_kecamatan']) && isset($_GET['id_gampong'])){
            $kecamatan = $this->input->get('id_kecamatan');
            $id_gampong = $this->input->get('id_gampong');
            $semester = $this->input->get('semester');
            $year = $this->input->get('year');
            if($semester == 1)
            {
                $start = $year . '-01-01';
                $end = $year . '-06-30';
            } else {
                $start = $year . '-07-01';
                $end = $year . '-12-30';
            }
            $this->load->library('f_pdf');
            $data['kelas'] = $this->m_data->get_data_kelas_id2($id_gampong)->result();
            $data['iuran'] = $this->iuran->export_pdf_iuran($kecamatan,$id_gampong,$semester);
            $data['count'] = $this->m_data->get_between($start, $end, $id_gampong)->result();
            $this->load->view('admin/pdf/v_iuran_pdf',$data); //memanggil view 

        }
    }



   function export_pdf_iuran_ketua_kecamatan(){
        if(isset($_GET['id_gampong']) && isset($_GET['tanggal_iuran'])){
            $mulai = $this->input->get('tanggal_iuran');
            $id_gampong = $this->input->get('id_gampong');
            $tanggal1 = explode('-', $mulai);
            $bulan = $tanggal1[0];
            $tahun   = $tanggal1[1];
        $this->load->library('f_pdf');
        $data['kelas'] = $this->m_data->get_data_kelas_id2($id_gampong)->result();
        $data['iuran'] = $this->iuran->export_pdf_iuran_admin($id_gampong, $bulan, $tahun);
        $data['count'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran from iuran WHERE (id_kelas= '$id_gampong' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $this->load->view('ketua_kecamatan/pdf/v_iuran_pdf',$data); //memanggil view 
    }}

   
    
    

    function export_pdf_meninggal_admin(){
        if(isset($_GET['tanggal_mulai']) && isset($_GET['gampong']) && isset($_GET['tanggal_sampai'])){
        $mulai = $this->input->get('tanggal_mulai');
        $sampai = $this->input->get('tanggal_sampai');
        $gampong = $this->input->get('gampong');
        $this->load->library('f_pdf');
        $data['meninggal'] = $this->meninggal->export_pdf_meninggal_ketua_gampong($gampong, $mulai, $sampai);
        $this->load->view('ketua_gampong/pdf/v_meninggal_pdf',$data); //memanggil view 
    }}

    function export_pdf_iuran_perbulan(){
        if(isset($_POST['tanggal'])){
        $mulai = $this->input->post('tanggal');
        $tanggal1 = explode('-', $mulai);
        $bulan = $tanggal1[0];
        $tahun   = $tanggal1[1];
        $this->load->library('f_pdf');
        $data["bulan"] =  $tanggal1[0];
        $data["tahun"] =  $tanggal1[1];
        $data['kecamatan'] = $this->m_data->get_data('ketua_kecamatan')->result();
        $data['samalanga'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['mamplam'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['pandrah'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['jeunieb'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['peulimbang'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['peudada'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['juli'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['jeumpa'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['juang'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['kuala'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['jangka'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['peusangan'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['selatan'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['krueng'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['makmur'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['gandapura'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['kutablang'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $data['count'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran from iuran WHERE (MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
        $this->load->view('admin/pdf/v_iuran_perbulan_pdf',$data); //memanggil 
        }}









        function export_pdf_iuran_pertahun(){
            if(isset($_POST['tanggal'])){
            $tahun = $this->input->post('tanggal');
            $this->load->library('f_pdf');
            $data["tahun"] =  $tahun;
            $data['kecamatan'] = $this->m_data->get_data('ketua_kecamatan')->result();
            $data['samalanga'] = $this->db->query("SELECT sum(jumlah_iuran) as samalanga from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam'] = $this->db->query("SELECT sum(jumlah_iuran) as mamplam from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah'] = $this->db->query("SELECT sum(jumlah_iuran) as pandrah from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb'] = $this->db->query("SELECT sum(jumlah_iuran) as jeunieb from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang'] = $this->db->query("SELECT sum(jumlah_iuran) as peulimbang from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada'] = $this->db->query("SELECT sum(jumlah_iuran) as peudada from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli'] = $this->db->query("SELECT sum(jumlah_iuran) as juli from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa'] = $this->db->query("SELECT sum(jumlah_iuran) as jeumpa from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka'] = $this->db->query("SELECT sum(jumlah_iuran) as jangka from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = 1 AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran from iuran WHERE (MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

           
            $data['samalanga2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga2' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam2' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah2' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb2' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang2' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada2' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli2' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa2' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang2' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala2' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka2' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan2' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan2' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng2' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur2' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura2' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang2'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang2' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count2'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran2 from iuran WHERE (MONTH(tanggal_iuran) = '02' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga3' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam3' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah3' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb3' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang3' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada3' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli3' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa3' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang3' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala3' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka3' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan3' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan3' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng3' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur3' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura3' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang3'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang3' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count3'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran3 from iuran WHERE (MONTH(tanggal_iuran) = '03' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga4' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam4' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah4' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb4' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang4' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada4' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli4' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa4' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang4' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala4' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka4' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan4' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan4' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng4' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur4' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura4' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang4'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang4' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count4'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran4 from iuran WHERE (MONTH(tanggal_iuran) = '04' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga5' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam5' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah5' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb5' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang5' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada5' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli5' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa5' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang5' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala5' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka5' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan5' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan5' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng5' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur5' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura5' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang5'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang5' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count5'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran5 from iuran WHERE (MONTH(tanggal_iuran) = '05' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga6' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam6' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah6' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb6' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang6' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada6' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli6' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa6' from iuran WHERE (kecamatan= 'Jeumpa6' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang6' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala6' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka6' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan6' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan6' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng6' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur6' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura6' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang6'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang6' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count6'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran6 from iuran WHERE (MONTH(tanggal_iuran) = '06' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga7' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam7' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah7' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb7' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang7' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada7' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli7' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa7' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang7' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala7' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka7' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan7' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan7' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng7' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur7' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura7' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang7'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang7' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count7'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran7 from iuran WHERE (MONTH(tanggal_iuran) = '07' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga8' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam8' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah8' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb8' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang8' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada8' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli8' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa8' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang8' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala8' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka8' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan8' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan8' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng8' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur8' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura8' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang8'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang8' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count8'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran8 from iuran WHERE (MONTH(tanggal_iuran) = '08' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga9' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam9' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah9' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb9' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang9' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada9' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli9' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa9' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang9' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala9' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka9' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan9' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan9' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng9' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur9' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura9' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang9'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang9' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count9'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran9 from iuran WHERE (MONTH(tanggal_iuran) = '09' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga10' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam10' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah10' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb10' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang10' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada10' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli10' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa10' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang10' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala10' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka10' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan10' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan10' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng10' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur10' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura10' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang10'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang10' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count10'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran10 from iuran WHERE (MONTH(tanggal_iuran) = '10' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga11' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam11' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah11' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb11' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang11' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada11' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli11' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa11' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang11' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala11' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka11' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan11' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan11' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng11' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur11' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura11' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang11'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang11' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count11'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran11 from iuran WHERE (MONTH(tanggal_iuran) = '11' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga12' from iuran WHERE (kecamatan= 'Samalanga' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam12' from iuran WHERE (kecamatan= 'Simpang Mamplam' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah12' from iuran WHERE (kecamatan= 'Pandrah' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb12' from iuran WHERE (kecamatan= 'Jeunieb' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang12' from iuran WHERE (kecamatan= 'Peulimbang' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada12' from iuran WHERE (kecamatan= 'Peudada' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli12' from iuran WHERE (kecamatan= 'Juli' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa12' from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang12' from iuran WHERE (kecamatan= 'Kota Juang' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala12' from iuran WHERE (kecamatan= 'Kuala' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka12' from iuran WHERE (kecamatan= 'Jangka' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan12' from iuran WHERE (kecamatan= 'Peusangan' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan12' from iuran WHERE (kecamatan= 'Peusangan Selatan' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng12' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur12' from iuran WHERE (kecamatan= 'Makmur' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura12' from iuran WHERE (kecamatan= 'Gandapura' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang12'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang12' from iuran WHERE (kecamatan= 'Kutablang' AND MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['count12'] = $this->db->query("SELECT sum(jumlah_iuran) as iuran12 from iuran WHERE (MONTH(tanggal_iuran) = '12' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['samalanga13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'samalanga13' from iuran WHERE (kecamatan= 'Samalanga'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['mamplam13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'mamplam13' from iuran WHERE (kecamatan= 'Simpang Mamplam'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['pandrah13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'pandrah13' from iuran WHERE (kecamatan= 'Pandrah'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeunieb13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeunieb13' from iuran WHERE (kecamatan= 'Jeunieb'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peulimbang13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peulimbang13' from iuran WHERE (kecamatan= 'Peulimbang'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peudada13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peudada13' from iuran WHERE (kecamatan= 'Peudada'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juli13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juli13' from iuran WHERE (kecamatan= 'Juli'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jeumpa13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jeumpa13' from iuran WHERE (kecamatan= 'Jeumpa'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['juang13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'juang13' from iuran WHERE (kecamatan= 'Kota Juang'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kuala13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kuala13' from iuran WHERE (kecamatan= 'Kuala'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['jangka13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'jangka13' from iuran WHERE (kecamatan= 'Jangka'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['peusangan13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'peusangan13' from iuran WHERE (kecamatan= 'Peusangan'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['selatan13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'selatan13' from iuran WHERE (kecamatan= 'Peusangan Selatan'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['krueng13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'krueng13' from iuran WHERE (kecamatan= 'Peusangan Siblah Krueng'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['makmur13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'makmur13' from iuran WHERE (kecamatan= 'Makmur'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['gandapura13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'gandapura13' from iuran WHERE (kecamatan= 'Gandapura'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
            $data['kutablang13'] = $this->db->query("SELECT sum(jumlah_iuran) as 'kutablang13' from iuran WHERE (kecamatan= 'Kutablang'  AND YEAR(tanggal_iuran) = '$tahun')")->result_array();

            $data['total_tahun'] = $this->db->query("SELECT sum(jumlah_iuran) as tahun1 from iuran WHERE YEAR(tanggal_iuran) = '$tahun'")->result_array();

            $this->load->view('admin/pdf/v_iuran_pertahun_pdf',$data); //memanggil 
            }}

























}