<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class absensi extends CI_Controller
{
    private $limit = 10;
    var $module_name = 'absensi';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_pdfabsensi' => 'absensi'));
        $this->load->model(array('persiswaModel' => 'persiswa'));
    }

    public function index($offset = 0)
    {
        $result                 = $this->absensi->get_list($this->limit, $offset);
        $data['absensi']           = $result['rows'];
        $data['num_results']    = $result['num_rows'];
        // load pagination library
        $this->load->library('pagination');
        $config = array(
            'base_url'          => site_url($this->module_name . '/index'),
            'total_rows'        => $data['num_results'],
            'per_page'          => $this->limit,
            'uri_segment'       => 3,
            'use_page_numbers'  => TRUE,
            'num_links'         => 5,
        );
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('admin/pdf/v_absensi', $data); //memanggil view 
    }

    public function export_pdf()
    {
        $this->load->library('f_pdf');
        $data['absensi'] = $this->absensi->export_pdf();
        $this->load->view('admin/pdf/v_absensi_pdf', $data); //memanggil view 
    }

    public function export_pdf_kecamatan()
    {
        $this->load->library('f_pdf');
        $data['absensi'] = $this->absensi->export_pdf_kecamatan($this->session->userdata('ketua_kecamatan'));
        $this->load->view('ketua_kecamatan/pdf/v_absensi_pdf', $data); //memanggil view 
    }

    public function export_pdf_gampong()
    {
        $this->load->library('f_pdf');
        $data['absensi'] = $this->absensi->export_pdf_gampong($this->session->userdata('ketua_gampong'));
        $this->load->view('ketua_gampong/pdf/v_absensi_pdf', $data); //memanggil view 
    }

    function export_pdf_absen_kelas()
    {
        if (isset($_GET['tanggal_mulai'])) {
            $mulai = $this->input->get('tanggal_mulai');
            $this->load->library('f_pdf');
            $data['absensi'] = $this->absensi->export_pdf_absen_kelas($this->session->userdata('kelas'), $this->session->userdata('gampong'), $mulai);
            $this->load->view('kelas/pdf/v_absensi_pdf', $data); //memanggil view 
        }
    }

    function export_pdf_absen_ketua_gampong()
    {
        if (isset($_GET['tanggal_mulai']) && isset($_GET['kelas'])) {
            $mulai = $this->input->get('tanggal_mulai');
            $kelas = $this->input->get('kelas');
            $this->load->library('f_pdf');
            $data['absensi'] = $this->absensi->export_pdf_absen_ketua_gampong($kelas, $this->session->userdata('ketua_gampong'), $mulai);
            $this->load->view('ketua_gampong/pdf/v_absensi_pdf', $data); //memanggil view 
        }
    }

    function export_pdf_absen_ketua_kecamatan()
    {
        if (isset($_GET['tanggal_mulai']) &&  isset($_GET['id_gampong'])) {
            $mulai = $this->input->get('tanggal_mulai');
            $gampong = $this->input->get('id_gampong');
            $this->load->library('f_pdf');
            $data['kelas'] = $this->m_data->get_data_kelas_id2($gampong)->result();
            $data['absensi'] = $this->absensi->export_pdf_absen_ketua_gampong($gampong, $mulai);
            $this->load->view('ketua_kecamatan/pdf/v_absensi_pdf', $data); //memanggil view 
        }
    }



    function export_pdf_absenpersiswa_ketua_kecamatan()
    {
        $tanggal = $this->input->post('tanggal');
        $tanggal1 = explode('-', $tanggal);
        $bulan = $tanggal1[0];
        $tahun   = $tanggal1[1];
        $persiswa = $this->input->post('persiswa');
        $nama = $this->persiswa->anggota_nama($persiswa);
        $id_gampong = $this->input->post('gampong');
        $gampong = $this->persiswa->gampong_name2($id_gampong);
        $this->load->library('f_pdf');

        $data['anggota'] = $this->m_data->anggotadariid($persiswa)->result();


        $data['sakit'] = $this->db->query("SELECT count(absen) as sakit from absensi WHERE (gampong = '$gampong' AND nama = '$nama' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=1)")->result_array();
        $data['belum'] = $this->db->query("SELECT count(absen) as belum from absensi WHERE (gampong = '$gampong' AND nama = '$nama' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=2)")->result_array();
        $data['izin'] = $this->db->query("SELECT count(absen) as izin from absensi WHERE (gampong = '$gampong' AND nama = '$nama' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=3)")->result_array();
        $data['masuk'] = $this->db->query("SELECT count(absen) as masuk from absensi WHERE (gampong = '$gampong' AND nama = '$nama' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=4)")->result_array();
        $data['alpa'] = $this->db->query("SELECT count(absen) as alpa from absensi WHERE (gampong = '$gampong' AND nama = '$nama' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=5)")->result_array();
        $data['absensi'] = $this->db->query("SELECT * from absensi WHERE (gampong = '$gampong' AND nama = '$nama' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' ) order by absensi_id desc")->result();
        $this->load->view('ketua_kecamatan/pdf/v_absensi_persiswa_pdf', $data); //memanggil view 
    }

    function export_pdf_absenpersiswa_admin()
    {
        $tanggal = $this->input->post('tanggal');
        $tanggal1 = explode('-', $tanggal);
        $bulan = $tanggal1[0];
        $tahun   = $tanggal1[1];
        $persiswa = $this->input->post('persiswa');
        $this->load->library('f_pdf');

        $data['anggota'] = $this->m_data->anggotadariid($persiswa)->result();


        $data['sakit'] = $this->db->query("SELECT count(absen) as sakit from absensi WHERE (id_anggota = '$persiswa' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=1)")->result_array();
        $data['belum'] = $this->db->query("SELECT count(absen) as belum from absensi WHERE (id_anggota = '$persiswa' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=2)")->result_array();
        $data['izin'] = $this->db->query("SELECT count(absen) as izin from absensi WHERE (id_anggota = '$persiswa' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=3)")->result_array();
        $data['masuk'] = $this->db->query("SELECT count(absen) as masuk from absensi WHERE (id_anggota = '$persiswa' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=4)")->result_array();
        $data['alpa'] = $this->db->query("SELECT count(absen) as alpa from absensi WHERE (id_anggota = '$persiswa' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' AND absen=5)")->result_array();
        $data['absensi'] = $this->db->query("SELECT * from absensi WHERE (id_anggota = '$persiswa' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' ) order by absensi_id desc")->result();
        $this->load->view('admin/pdf/v_absensi_persiswa_pdf', $data); //memanggil view 
    }



    function export_pdf_absen_admin()
    {
        if (isset($_GET['tanggal_mulai']) && isset($_GET['id_gampong'])) {
            $mulai = $this->input->get('tanggal_mulai');
            $id_gampong = $this->input->get('id_gampong');
            $this->load->library('f_pdf');
            $data['absensi'] = $this->absensi->export_pdf_absen_ketua_gampong($id_gampong, $mulai);
            $data['kelas'] = $this->m_data->get_data_kelas_id2($id_gampong)->result();
            $this->load->view('admin/pdf/v_absensi_pdf', $data); //memanggil view 
        }
    }


    //absensi ketua kelas dan ketua tahun 2022/12/1





    function rekapan_absen_ketua_kelas()
    {
        $tanggal = $this->input->post('tanggal');
        $tanggal1 = explode('-', $tanggal);
        $bulan = $tanggal1[0];
        $tahun   = $tanggal1[1];
        $id_ketua_kelas = $this->input->post('gampong');


        $this->load->library('f_pdf');

        $data['kehadiran'] = $this->db->query("SELECT * FROM th_karyawan inner join tm_karyawan on th_karyawan.id_karyawan = tm_karyawan.id WHERE (id_ketua_kelas = '$id_ketua_kelas' AND MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun')")->result();
        $this->load->view('admin/pdf/v_absensi_ketua_kelas', $data); //memanggil view 
    }

    function rekapan_absen_ketua_kecamatan()
    {
        $tanggal = $this->input->post('tanggal');
        $tanggal1 = explode('-', $tanggal);
        $bulan = $tanggal1[0];
        $tahun   = $tanggal1[1];
        $id_kecamatan = $this->input->post('id_kecamatan');


        $this->load->library('f_pdf');

        $data['kehadiran'] = $this->db->query("SELECT * FROM absen_kecamatan inner join ketua_kecamatan on absen_kecamatan.id_ketua_kecamatan = ketua_kecamatan.id WHERE (id_ketua_kecamatan = '$id_kecamatan' AND MONTH(tanggal) = '$bulan' AND YEAR(tanggal) = '$tahun')")->result();
        $this->load->view('admin/pdf/v_absensi_ketua_kecamatan', $data); //memanggil view 
    }
}
