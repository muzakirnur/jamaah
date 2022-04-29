<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admink extends CI_Controller
{
	private $limit = 10;
	var $module_name = 'anggota';

	function __construct()
	{
		parent::__construct();

		// cek session yang login, jika session status tidak sama dengan session admin_login,maka halaman akan di alihkan kembali ke halaman login.
		if ($this->session->userdata('status') != "admink") {
			redirect(base_url() . 'login?alert=belum_login');
		}
		$this->load->model('kecamatanModel');
		$this->load->model('ketgamModel');
		$this->load->model('gampongModel');
		$this->load->model('persiswaModel');
		$this->load->helper('rupiah_helper');
		$this->load->model('SiswaModel'); // Load model SiswaModel.php yang ada di folder models
		$this->load->model(array('M_pdfanggota' => 'anggota'));
		$this->load->model('Modelanggota', 'anggota2');
	}

	function index()
	{
		$this->load->view('admink/v_header');
		$this->load->view('admink/dashboard');
		$this->load->view('admink/v_footer');
	}

	function gaji()
	{
		$data['jabatan'] = $this->m_data->get_data('tm_jabatan')->result();
		$this->load->view('admink/v_header');
		$this->load->view('admink/v_gaji', $data);
		$this->load->view('admink/v_footer');
	}
	
	function gaji_jabatan($id)
	{
		$where = array('id_jabatan' => $id);
		$data['jabatan'] = $this->m_data->get_data('tm_jabatan')->result();
		$data['karyawan'] = $this->m_data->get_data('tm_karyawan')->result();		
		$year = date('Y');
		$start = $year.'-01-01';
		$end = $year.'-12-31';
		if ($this->uri->segment('3') == 3)
		{
		$data['jabatan'] = $this->m_data->get_data('tm_jabatan')->result();
			$data['gaji'] = $this->m_data->iuran_kelas($start,$end)->result();
		} else {
			$data['gaji'] = $this->m_data->gajikaryawan($where)->result();
		}
		// var_dump($data['jabatan']['2']->gaji);
		$this->load->view('admink/v_header');
		$this->load->view('admink/v_jabatan_gaji', $data);
		$this->load->view('admink/v_footer');
	}


	function editgaji($id)
	{
		$where = array('id' => $id);
		$data['jabatan'] = $this->m_data->edit_data($where, 'tm_jabatan')->result();
		$this->load->view('admink/v_header');
		$this->load->view('admink/v_edit_gaji', $data);
		$this->load->view('admink/v_footer');
	}

	function updategaji()
	{
		$id = $this->input->post('id');
		$jabatan = $this->input->post('jabatan');

		$gaji = $this->input->post('gaji');

		$where = array(
			'id' => $id
		);

		$data = array(
			'jabatan' => $jabatan,

			'gaji' => $gaji
		);

		// update data ke database
		$this->m_data->update_data($where, $data, 'tm_jabatan');

		// mengalihkan halaman ke halaman data kelas
		redirect(base_url() . 'admink/gaji');
	}

	function karyawan()
	{
		$data['jabatan'] = $this->m_data->get_data('tm_jabatan')->result();
		$data['karyawan'] = $this->m_data->get_data('tm_karyawan')->result();
		$data['gaji'] = $this->m_data->gajikaryawan()->result();
		$this->load->view('admink/v_header');
		$this->load->view('admink/gaji_karyawan', $data);
		$this->load->view('admink/v_footer');
	}

	function admin_pusat()
	{
		$data['jabatan'] = $this->m_data->get_data('tm_jabatan')->result();
		$data['karyawan'] = $this->m_data->get_data('tm_karyawan')->result();
		$data['gaji'] = $this->m_data->gajikaryawan(1)->result();
		$this->load->view('admink/v_header');
		$this->load->view('admink/admin_pusat', $data);
		$this->load->view('admink/v_footer');
	}

	function tambahiuran()
	{
		$data['gampong'] = $this->gampongModel->viewBykec($this->session->userdata('ketua_kecamatan'));
		$data['kecamatan'] = $this->kecamatanModel->view();
		$this->load->view('admink/v_header');
		$this->load->view('admink/v_tambah_iuran', $data);
		$this->load->view('admink/v_footer');
	}
	function tambahiuranaksi()
	{

		$id_kecamatan = $this->input->post('kecamatan');
		$id_gampong = $this->input->post('gampong');
		$id_anggota = $this->input->post('persiswa');
		$kecamatan = $this->kecamatanModel->kecamatan_name($id_kecamatan);
		$gampong = $this->persiswaModel->gampong_name4($id_gampong);
		$persiswa = $this->input->post('persiswa');
		$tanggal_iuran = $this->input->post('tanggal_iuran');
		$nama = $this->m_data->nama_anggota($persiswa);
		$kelas = $this->input->post('kelas');
		$jumlah_iuran = $this->input->post('jumlah_iuran');
		$data = array();


		$data = array(
			'nama' => $nama,
			'id_anggota' => $id_anggota,
			'tanggal_iuran' => $tanggal_iuran,
			'id_kelas' => $id_gampong,
			'gampong' => $gampong,
			'kecamatan' => $kecamatan,
			'jumlah_iuran' => $jumlah_iuran,
		);

		// insert data ke database
		$this->m_data->insert_data($data, 'iuran');
		$this->session->set_flashdata('success', 'Data Berhasil ditambahkan');

		// $this->session->set_userdata($data_session);
		// mengalihkan halaman ke halaman data absen
		redirect(base_url() . 'admink/tambahiuran');
	}

	function dataiuran()
	{
		$data['kecamatan'] = $this->kecamatanModel->view();
		$this->load->view('admink/v_header');
		$this->load->view('admink/v_data_iuran', $data);
		$this->load->view('admink/v_footer');
	}

	function iuran_laporan()
	{
		$data['kecamatan'] = $this->kecamatanModel->view();
		if (isset($_GET['id_gampong']) && isset($_GET['tanggal_iuran'])) {
			$mulai = $this->input->get('tanggal_iuran');
			$id_gampong = $this->input->get('id_gampong');
			$tanggal1 = explode('-', $mulai);
			$bulan = $tanggal1[0];
			$tahun   = $tanggal1[1];
			$data['iuran'] = $this->db->query("SELECT * from iuran WHERE (id_kelas = '$id_gampong'  AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun') order by iuran_id desc")->result();
		} else {
			$data['iuran'] = $this->db->query("SELECT * from iuran order by iuran_id desc")->result();
		}
		$this->load->view('admink/v_header');
		$this->load->view('admink/v_iuran_laporan', $data);
		$this->load->view('admink/v_footer');
	}


	function listdataiuran()
	{
		$this->load->helper('rupiah_helper');
		// if (isset($_GET['id_gampong']) && isset($_GET['tanggal_iuran'])) {
		// 	$mulai = $this->input->get('tanggal_iuran');
		// 	$id_gampong = $this->input->get('id_gampong');
		// 	$tanggal1 = explode('-', $mulai);
		// 	$bulan = $tanggal1[0];
		// 	$tahun   = $tanggal1[1];
		// 	$data['iuran'] = $this->db->query("SELECT * from iuran WHERE (id_kelas = '$id_gampong'  AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun') order by iuran_id desc")->result();
		// } else {
		// 	$data['iuran'] = $this->db->query("SELECT * from iuran order by iuran_id desc")->result();
		// }
		$year = $this->input->get('year');
		if ($_REQUEST['semester'] == '1') {
			$start = $year . '-01-01';
			$end = $year . '-06-30';
		} else {
			$start = $year . '-07-01';
			$end = $year . '-12-31';
		}
		$id_gampong = $this->input->get('id_gampong');
		$data['iuran_wajib'] = $this->m_data->get_data('tm_iuran_wajib')->result_array();
		$data['dtiuran'] = $this->m_data->get_between($start, $end, $id_gampong)->result();
		$this->load->view('admink/v_header');
		$this->load->view('admink/v_list_data_iuran', $data);
		$this->load->view('admink/v_footer');
	}

	function export()
	{
		$this->load->helper('rupiah_helper');
		$year = $this->input->get('year');
		$semester = $this->input->get('semester');
		$id_gampong = $this->input->get('id_gampong');
		if ($semester == 1) {
			$start = $year . '-01-01';
			$end = $year . '-06-30';
		} else {
			$start = $year . '-07-01';
			$end = $year . '-12-31';
		}
		$this->load->library('f_pdf');
		$data['iuran_wajib'] = $this->m_data->get_data('tm_iuran_wajib')->result_array();
		$data['dtiuran'] = $this->m_data->get_between2($start, $end, $id_gampong)->result();
		var_dump($data['dtiuran']);
		$this->load->view('admin/pdf/iuran_export',$data); //memanggil view 
	}



	function iuranwajib()
	{
		$data['iuran'] = $this->m_data->select_data('tm_iuran_wajib')->result_array();
		$this->load->view('admink/v_header');
		$this->load->view('admink/v_iuran_wajib', $data);
		$this->load->view('admink/v_footer');
	}

	function editiuranwajib($id)

	{
		$where = array('id' => $id);
		$data['iuran'] = $this->m_data->edit_data($where, 'tm_iuran_wajib')->result();
		$this->load->view('admink/v_header');
		$this->load->view('admink/v_edit_iuran_wajib', $data);
		$this->load->view('admink/v_footer');
	}

	function editiuranwajibaksi()
	{
		$id = $this->input->post('id');
		$tahapsatu = $this->input->post('smt_satu');
		$tahapdua = $this->input->post('smt_dua');
		$where = array(
			'id' => $id
		);

		$data = array(
			'smt_satu' => $tahapsatu,

			'smt_dua' => $tahapdua
		);

		// update data ke database
		$this->m_data->update_data($where, $data, 'tm_iuran_wajib');

		// mengalihkan halaman ke halaman data kelas
		redirect(base_url() . 'admink/iuranwajib');
	}
}