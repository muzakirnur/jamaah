<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User extends CI_Controller {

	function __construct(){
		parent::__construct();
		$this->load->model('SiswaModel'); // Load model SiswaModel.php yang ada di folder models
	}

	function index(){
		// mengambil data dari database
		$this->load->view('user/v_header');
		$this->load->view('user/v_anggota');
		$this->load->view('user/v_footer');
	}

	public function view(){
		$search = $_POST['search']['value']; // Ambil data yang di ketik user pada textbox pencarian
		$limit = $_POST['length']; // Ambil data limit per page
		$start = $_POST['start']; // Ambil data start
		$order_index = $_POST['order'][0]['column']; // Untuk mengambil index yg menjadi acuan untuk sorting
		$order_field = $_POST['columns'][$order_index]['data']; // Untuk mengambil nama field yg menjadi acuan untuk sorting
		$order_ascdesc = $_POST['order'][0]['dir']; // Untuk menentukan order by "ASC" atau "DESC"

		$sql_total = $this->SiswaModel->count_all(); // Panggil fungsi count_all pada SiswaModel
		$sql_data = $this->SiswaModel->filter($search, $limit, $start, $order_field, $order_ascdesc); // Panggil fungsi filter pada SiswaModel
		$sql_filter = $this->SiswaModel->count_filter($search); // Panggil fungsi count_filter pada SiswaModel

		$callback = array(
		    'draw'=>$_POST['draw'], // Ini dari datatablenya
		    'recordsTotal'=>$sql_total,
		    'recordsFiltered'=>$sql_filter,
		    'data'=>$sql_data
		);

		header('Content-Type: application/json');
		echo json_encode($callback); // Convert array $callback ke json
	}


	// crud anggota


	

	function anggota_tambah(){
		$this->load->view('user/v_header');
		$this->load->view('user/anggota/v_anggota_tambah');
		$this->load->view('user/v_footer');
	}

	function anggota_tambah_aksi(){
		
		$no_anggota = $this->input->post('no_anggota');
		
		$nama = $this->input->post('nama');
		$nama_ortu = $this->input->post('nama_ortu');
		$ttg = $this->input->post('ttg');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$id_gampong = $this->input->post('gampong');
		$kecamatan = $this->input->post('kecamatan');
		$kabupaten = $this->input->post('kabupaten');

		$data = array(
			
			'no_anggota' => $no_anggota,
			'nama' => $nama,
			'nama_ortu' => $nama_ortu,
			'ttg' => $ttg,
			'jenis_kelamin' => $jenis_kelamin,
			'gampong' => $id_gampong,
			'kecamatan' => $kecamatan,
			'kabupaten' => $kabupaten
		);

		// insert data ke database
		$this->m_data->insert_data($data,'anggota');

		// mengalihkan halaman ke halaman data anggota
		
		redirect(base_url().'user/anggota');
	}

	function anggota_edit($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('user/v_header');
		$this->load->view('user/v_anggota_edit',$data);
		$this->load->view('user/v_footer');
	}

	function anggota_update(){
		$no_anggota = $this->input->post('no_anggota');
		
		$nama = $this->input->post('nama');
		$nama_ortu = $this->input->post('nama_ortu');
		$ttg = $this->input->post('ttg');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$id_gampong = $this->input->post('gampong');
		$kecamatan = $this->input->post('kecamatan');
		$kabupaten = $this->input->post('kabupaten');

		$where = array(
			'id' => $id
		);

		$data = array(
			
			'no_anggota' => $no_anggota,
			'nama' => $nama,
			'nama_ortu' => $nama_ortu,
			'ttg' => $ttg,
			'jenis_kelamin' => $jenis_kelamin,
			'gampong' => $id_gampong,
			'kecamatan' => $kecamatan,
			'kabupaten' => $kabupaten
		);

		// update data ke database
		$this->m_data->update_data($where,$data,'anggota');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'user/anggota');
	}


	function anggota_hapus($id){
		$where = array(
			'id' => $id
		);

		// menghapus data anggota dari database sesuai id
		$this->m_data->delete_data($where,'anggota');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'user/anggota');
	}

	// akhir anggota

	
	function anggota_udah_meninggal(){
		
		// mengambil data dari database
		$data['anggota'] = $this->m_data->get_data('meninggal')->result();
		$this->load->view('user/v_header');
		$this->load->view('user/v_anggota_meninggal',$data);
		$this->load->view('user/v_footer');
	}
	






	



}
