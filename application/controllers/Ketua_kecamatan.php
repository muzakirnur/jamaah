<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ketua_kecamatan extends CI_Controller {

	function __construct(){
		parent::__construct();

		// cek session yang login, jika session status tidak sama dengan session ketua_kecamatan_login,maka halaman akan di alihkan kembali ke halaman login.
		if($this->session->userdata('status')!="ketua_kecamatan_login"){
			redirect(base_url().'login?alert=belum_login');
		}
		$this->load->model('kecamatanModel');
		$this->load->model('ketgamModel');
		$this->load->model('persiswaModel');
		$this->load->model('gampongModel');
		$this->load->model(array('M_pdfanggota'=>'anggota'));
	}

	public function delete(){
        $id = $_POST['id']; // Ambil data NIS yang dikirim oleh view.php melalui form submit
        $this->m_data->delete($id); // Panggil fungsi delete dari model
        
        redirect('ketua_kecamatan/anggota');
    }

	function index(){
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_index');
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login/?alert=logout');
	}

	function ganti_password(){
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_ganti_password');
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function ganti_password_aksi(){
		$baru = $this->input->post('password_baru');
		$ulang = $this->input->post('password_ulang');

		$this->form_validation->set_rules('password_baru','Password Baru','required|matches[password_ulang]');
		$this->form_validation->set_rules('password_ulang','Ulangi Password','required');

		if($this->form_validation->run()!=false){
			$id = $this->session->userdata('id');

			$where = array('id' => $id);

			$data = array('password' => md5($baru));

			$this->m_data->update_data($where,$data,'ketua_kecamatan');

			redirect(base_url().'ketua_kecamatan/ganti_password/?alert=sukses');

		}else{
			$this->load->view('ketua_kecamatan/v_header');
			$this->load->view('ketua_kecamatan/v_ganti_password');
			$this->load->view('ketua_kecamatan/v_footer');
		}

	}
	
	function anggota_permajelis(){
	    
	// mengambil data dari database
	$data['id_gampong'] = $this->gampongModel->viewBykec($this->session->userdata('ketua_kecamatan'));
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/anggota/v_anggota_permajelis',$data);
	$this->load->view('ketua_kecamatan/v_footer');
}

	// crud anggota
	function anggota(){
		// mengambil data dari database
		$data['anggota'] = $this->m_data->get_data_jumlah_kecamatan($this->session->userdata('ketua_kecamatan'))->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_anggota',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function anggota_tambah(){
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/anggota/v_anggota_tambah');
		$this->load->view('ketua_kecamatan/v_footer');
	}
	
		function anggota_tambah2(){
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/anggota/v_anggota_tambah2');
		$this->load->view('ketua_kecamatan/v_footer');
	}
	
function anggota_tambah_aksi(){
		
		$no_anggota = $this->input->post('no_anggota');
		
		$nama = $this->input->post('nama');
		$nama_ortu = $this->input->post('nama_ortu');
		$ttg = $this->input->post('ttg');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$gampong = $this->input->post('gampong');
		$kecamatan = $this->input->post('kecamatan');
		$kabupaten = $this->input->post('kabupaten');
		
		$cek_anggota =  $this->db->query("SELECT * from anggota where no_anggota = '$no_anggota'");

	if($cek_anggota->num_rows() > 0){
			redirect(base_url().'ketua_kecamatan/anggota_tambah2');
		}else{

		$data = array(
			
			'no_anggota' => $no_anggota,
			'nama' => $nama,
			'nama_ortu' => $nama_ortu,
			'ttg' => $ttg,
			'jenis_kelamin' => $jenis_kelamin,
			'gampong' => $gampong,
			'kecamatan' => $kecamatan,
			'kabupaten' => $kabupaten
		);

		// insert data ke database
		$this->m_data->insert_data($data,'baru');
}
		
		// mengalihkan halaman ke halaman data anggota
		
		redirect(base_url().'ketua_kecamatan/anggota');
	}
	
		function data_meninggal_update(){
	    $id = $this->input->post('id');
		$hari_meninggal = $this->input->post('hari_meninggal');
		$tanggal_meninggal = $this->input->post('tanggal_meninggal');
		$alamat_duka = $this->input->post('alamat_duka');

		$where = array(
			'id' => $id
		);


			$data = array(
				'hari_meninggal' => $hari_meninggal,
				'tanggal_meninggal' => $tanggal_meninggal,
				'alamat_duka' => $alamat_duka
			);

			$this->m_data->update_data($where,$data,'meninggal');
		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'ketua_kecamatan/anggota_udah_meninggal');
	}

    function meninggal_edit($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'meninggal')->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_meninggal_edit',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}
	
	function anggota_edit($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_anggota_edit',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function anggota_edit2($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_anggota_edit2',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function anggota_update(){
		$id = $this->input->post('id');
		$no_anggota2 = $this->input->post('no_anggota2');
		$no_anggota = $this->input->post('no_anggota');
		$nama = $this->input->post('nama');
		$nama_ortu = $this->input->post('nama_ortu');
		$ttg = $this->input->post('ttg');
		$desa = $this->input->post('desa');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$id_gampong = $this->input->post('gampong');
		$kecamatan = $this->input->post('kecamatan');
		$hari_meninggal = $this->input->post('hari_meninggal');
		$tanggal_meninggal = $this->input->post('tanggal_meninggal');
		$alamat_duka = $this->input->post('alamat_duka');

		$where = array(
			'id' => $id
		);
		
		
		$cek_anggota =  $this->db->query("SELECT * from anggota where no_anggota = '$no_anggota'");

			if($no_anggota == '' && $hari_meninggal == '' && $tanggal_meninggal == '' && $alamat_duka == ''){
			$data = array(	
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $id_gampong,
				'kecamatan' => $kecamatan,
			);
		
			// update data ke database
			$this->m_data->update_data($where,$data,'anggota');
		}elseif($no_anggota == '' && $alamat_duka == ''){
			$data = array(
			
				'no_anggota' => $no_anggota2,
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $id_gampong,
				'kecamatan' => $kecamatan,
			);
		
			// update data ke database
			$this->m_data->update_data($where,$data,'anggota');
		}elseif($no_anggota == '' && $hari_meninggal != '' && $tanggal_meninggal != '' && $alamat_duka != ''){
			$data = array(
				'no_anggota' => $no_anggota2,
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $id_gampong,
				'kecamatan' => $kecamatan,
				'kabupaten' => 'Bireun',
				'hari_meninggal' => $hari_meninggal,
				'tanggal_meninggal' => $tanggal_meninggal,
				'alamat_duka' => $alamat_duka
			);

			$this->m_data->insert_meninggal($where,$data,'meninggal');

		}elseif($cek_anggota->num_rows() > 0 && $alamat_duka == ''){
			redirect(base_url().'ketua_kecamatan/anggota_edit2/'.$id);
		}else{
			$data = array(
			
				'no_anggota' => $no_anggota,
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $id_gampong,
				'kecamatan' => $kecamatan,
			);
		
			// update data ke database
			$this->m_data->update_data($where,$data,'anggota');
		}
		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'ketua_kecamatan/anggota');
	}


	function anggota_hapus($id){
		$where = array(
			'id' => $id
		);

		// menghapus data anggota dari database sesuai id
		$this->m_data->delete_data($where,'anggota');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'ketua_kecamatan/anggota');
	}

	function anggota_kartu($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('ketua_kecamatan/v_anggota_kartu',$data);
	}
	// akhir crud anggota

	


	/**************** start upload*******************************/


		function create()
		{
			$this->load->view('ketua_kecamatan/v_upload');
		}

		function proses()
		{
			$config['upload_path']          = './upload/pdf';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 10000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$config['encrypt_name']			= TRUE;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('berkas'))
			{
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('ketua_kecamatan/v_upload', $error);
			}
			else
			{
				$data['nama'] = $this->upload->data("file_name");
				$data['ket'] = $this->input->post('ket');
				$data['tipe'] = $this->upload->data('file_ext');
				$data['ukuran'] = $this->upload->data('file_size');
				$this->db->insert('berkas',$data);
				redirect(base_url().'ketua_kecamatan/ebook?pesan=berhasil');
			}
		}
	/*
		public function index()
		{
			$data['berkas'] = $this->db->get('berkas');
			$this->load->view('tampil_berkas',$data);
		}

	*/
	function download($id1)
	{
		$data = $this->db->get_where('berkas',['id'=>$id1])->row();
		force_download('upload/pdf/'.$data->nama,NULL);
	}
		/********************end upload******************************/


	// proses transaksi_pengajian
	function pengajian(){
		// mengambil data pengajian kelas dari database | dan mengurutkan data dari id pengajian terbesar ke terkecil (desc)
		$data['pengajian'] = $this->db->query("select * from pengajian,kelas,anggota where pengajian.pengajian_kelas=kelas.id and pengajian.pengajian_anggota=anggota.id order by pengajian_id desc")->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_pengajian',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function pengajian_tambah(){
		// mengambil data kelas yang berstatus 1 (tersedia) dari database
		$where = array('status'=>1);
		$data['kelas'] = $this->m_data->edit_data($where,'kelas')->result();
		// mengambil data anggota dari database
		$data['anggota'] = $this->m_data->get_data('anggota')->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_pengajian_tambah',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function pengajian_aksi(){
		$kelas = $this->input->post('kelas');
		$anggota = $this->input->post('anggota');
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$tanggal_sampai = $this->input->post('tanggal_sampai');

		$data = array(
			'pengajian_kelas' => $kelas,
			'pengajian_anggota' => $anggota,
			'pengajian_tanggal_mulai' => $tanggal_mulai,
			'pengajian_tanggal_sampai' => $tanggal_sampai,
			'pengajian_status' => 2
		);

		// insert data ke database
		$this->m_data->insert_data($data,'pengajian');


		// mengubah status kelas menjadi di pinjam (2)
		$w = array(
			'id' => $kelas
		);
		$d = array(
			'status' => 2
		);
		$this->m_data->update_data($w,$d,'kelas');

		// mengalihkan halaman ke halaman data pengajian
		redirect(base_url().'ketua_kecamatan/pengajian');
	}

	function pengajian_batalkan($id){
		$where = array(
			'pengajian_id' => $id
		);

		// mengambil data kelas pada pengajian ber id tersebut
		$data = $this->m_data->edit_data($where,'pengajian')->row();
		$kelas = $data->pengajian_kelas;

		// mengembalikan status kelas kembali ke tersedia (1)
		$w = array(
			'id' => $kelas
		);
		$d = array(
			'status' => 1
		);
		$this->m_data->update_data($w,$d,'kelas');

		// menghapus data pengajian dari database sesuai id
		$this->m_data->delete_data($where,'pengajian');

		// mengalihkan halaman ke halaman data kelas
		redirect(base_url().'ketua_kecamatan/pengajian');
	}

	function pengajian_selesai($id){
		$where = array(
			'pengajian_id' => $id
		);

		// mengambil data kelas pada pengajian ber id tersebut
		$data = $this->m_data->edit_data($where,'pengajian')->row();
		$kelas = $data->pengajian_kelas;

		// mengembalikan status kelas kembali ke tersedia (1)
		$w = array(
			'id' => $kelas
		);
		$d = array(
			'status' => 1
		);
		$this->m_data->update_data($w,$d,'kelas');

		// mengubah status pengajian menjadi selesai (1)
		$this->m_data->update_data($where,array('pengajian_status'=>1),'pengajian');


		// mengalihkan halaman ke halaman data kelas
		redirect(base_url().'ketua_kecamatan/pengajian');
	}

	function pengajian_laporan(){
		if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])){
			$mulai = $this->input->get('tanggal_mulai');
			$sampai = $this->input->get('tanggal_sampai');
			// mengambil data pengajian berdasarkan tanggal mulai sampai tanggal sampai
			$data['pengajian'] = $this->db->query("select * from pengajian,kelas,anggota where pengajian.pengajian_kelas=kelas.id and pengajian.pengajian_anggota=anggota.id and date(pengajian_tanggal_mulai) >= '$mulai' and date(pengajian_tanggal_mulai) <= '$sampai' order by pengajian_id desc")->result();
		}else{
			// mengambil data pengajian kelas dari database | dan mengurutkan data dari id pengajian terbesar ke terkecil (desc)
			$data['pengajian'] = $this->db->query("select * from pengajian,kelas,anggota where pengajian.pengajian_kelas=kelas.id and pengajian.pengajian_anggota=anggota.id order by pengajian_id desc")->result();
		}
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_pengajian_laporan',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function pengajian_cetak(){
		if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])){
			$mulai = $this->input->get('tanggal_mulai');
			$sampai = $this->input->get('tanggal_sampai');
			// mengambil data pengajian berdasarkan tanggal mulai sampai tanggal sampai
			$data['pengajian'] = $this->db->query("select * from pengajian,kelas,anggota where pengajian.pengajian_kelas=kelas.id and pengajian.pengajian_anggota=anggota.id and date(pengajian_tanggal_mulai) >= '$mulai' and date(pengajian_tanggal_mulai) <= '$sampai' order by pengajian_id desc")->result();
			$this->load->view('ketua_kecamatan/v_pengajian_cetak',$data);
		}else{
			redirect(base_url().'ketua_kecamatan/pengajian');
		}
	}



	////////////////////////////////////////////////////////////////////////////
//------- crud data guru---//

// crud guru
function guru(){
	// mengambil data dari database
	$data['guru'] = $this->m_data->get_data('guru')->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/v_guru',$data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function guru_tambah(){
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/v_guru_tambah');
	$this->load->view('ketua_kecamatan/v_footer');
}

function guru_tambah_aksi(){
	$nama = $this->input->post('nama');
	$username = $this->input->post('username');
	$password = $this->input->post('password');

	$data = array(
		'nama' => $nama,
		'username' => $username,
		'password' => md5($password)
	);

	// insert data ke database
	$this->m_data->insert_data($data,'guru');

	// mengalihkan halaman ke halaman data ketua_kecamatan
	redirect(base_url().'ketua_kecamatan/guru');
}

function guru_edit($id){
	$where = array('id' => $id);
	// mengambil data dari database sesuai id
	$data['guru'] = $this->m_data->edit_data($where,'guru')->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/v_guru_edit',$data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function guru_update(){
	$id = $this->input->post('id');
	$nama = $this->input->post('nama');
	$username = $this->input->post('username');
	$password = $this->input->post('password');

	$where = array(
		'id' => $id
	);

	// cek apakah form password di isi atau tidak
	if($password==""){
		$data = array(
			'nama' => $nama,
			'username' => $username
		);

		// update data ke database
		$this->m_data->update_data($where,$data,'guru');
	}else{
		$data = array(
			'nama' => $nama,
			'username' => $username,
			'password' => md5($password)
		);

		// update data ke database
		$this->m_data->update_data($where,$data,'guru');
	}

	// mengalihkan halaman ke halaman data guru
	redirect(base_url().'ketua_kecamatan/guru');
}


function guru_hapus($id){
	$where = array(
		'id' => $id
	);

	// menghapus data guru dari database sesuai id
	$this->m_data->delete_data($where,'guru');

	// mengalihkan halaman ke halaman data ketua_kecamatan
	redirect(base_url().'ketua_kecamatan/guru');
}
// akhir CRUD guru

////////////////////////////////////////////////////////////////////////////
//------- crud data ketua_pengajian---//


function ketua_kelas(){
	// mengambil data dari database
	$data['ketua_kelas'] = $this->m_data->get_data_tambah_kelas($this->session->userdata('ketua_kecamatan'))->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/v_ketua_kelas',$data);
	$this->load->view('ketua_kecamatan/v_footer');
	}
	
	function ketua_kelas_tambah(){
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/v_ketua_kelas_tambah');
	$this->load->view('ketua_kecamatan/v_footer');
	}
	
	function ketua_kelas_tambah_aksi(){
		$nama = $this->input->post('nama');
		$hp = $this->input->post('hp');
		$wali = $this->input->post('wali');
		$hp_wali = $this->input->post('hp_wali');
		$username = $this->input->post('username');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$majelis = $this->input->post('majelis');
		$kecamatan =  $this->session->userdata('ketua_kecamatan');
		$gampong = $this->input->post('gampong');
		$password = $this->input->post('password');
		
		$data = array(
			'nama' => $nama,
			'hp' => $hp,
			'majelis' => $majelis,
			'username' => $username,
			'gampong' => $gampong,
			'kecamatan' => $kecamatan,
			'kelas' => $jenis_kelamin,
			'wali' => $wali,
			'hp_wali' => $hp_wali,
			'password' => md5($password)
		);
		
		// insert data ke database
		$this->m_data->insert_data($data,'kelas');
		
		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'ketua_kecamatan/ketua_kelas');
		}
	
	function ketua_kelas_edit($id){
	$where = array('id' => $id);
	// mengambil data dari database sesuai id
	$data['ketua_kelas'] = $this->m_data->edit_data($where,'kelas')->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/v_ketua_kelas_edit',$data);
	$this->load->view('ketua_kecamatan/v_footer');
	}
	
	function ketua_kelas_update(){
		$id = $this->input->post('id');
		$wali = $this->input->post('wali');
		$hp_wali = $this->input->post('hp_wali');
		$nama = $this->input->post('nama');
		$hp = $this->input->post('hp');
		$majelis = $this->input->post('majelis');
		$username = $this->input->post('username');
		$kecamatan =  $this->session->userdata('ketua_kecamatan');
		$gampong = $this->input->post('gampong');
		$password = $this->input->post('password');
		
		$where = array(
			'id' => $id
		);
		
		// cek apakah form password di isi atau tidak
		if($password==""){
	$data = array(
		'nama' => $nama,
		'username' => $username,
		'hp' => $hp,
		'majelis' => $majelis,
		'wali' => $wali,
		'hp_wali' => $hp_wali,
	);

	// update data ke database
	$this->m_data->update_data($where,$data,'kelas');
}else{
	$data = array(
		'nama' => $nama,
		'username' => $username,
		'hp' => $hp,
		'majelis' => $majelis,
		'wali' => $wali,
		'hp_wali' => $hp_wali,
		'password' => md5($password)
	);

	// update data ke database
	$this->m_data->update_data($where,$data,'kelas');
}
	
	// mengalihkan halaman ke halaman data guru
	redirect(base_url().'ketua_kecamatan/ketua_kelas');
	}
	
	
	function ketua_kelas_hapus($id){
	$where = array(
		'id' => $id
	);
	
	// menghapus data guru dari database sesuai id
	$this->m_data->delete_data($where,'kelas');
	
	// mengalihkan halaman ke halaman data ketua_kecamatan
	redirect(base_url().'ketua_kecamatan/ketua_kelas');
	}




// crud ketua_gampong
function ketua_gampong(){
	// mengambil data dari database
	$data['ketua_gampong'] = $this->m_data->get_data_ketuakec($this->session->userdata('ketua_kecamatan'))->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/v_ketua_gampong',$data);
	$this->load->view('ketua_kecamatan/v_footer');
	}

	function ketua_gampong_tambah(){
		$data['kecamatan'] = $this->kecamatanModel->view();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/v_ketua_gampong_tambah', $data);
		$this->load->view('ketua_kecamatan/v_footer');
		}
	
	function ketua_gampong_tambah_aksi(){
	$id_kecamatan = $this->input->post('id_kecamatan');
	$kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
	$id_gampong = $this->input->post('id_gampong');
	$ketua_gampong =  $this->gampongModel->gampong_name($id_gampong);
	
	$data = array(
		'kecamatan' => $kecamatan,
		'ketua_gampong' => $ketua_gampong
	);
	
	// insert data ke database
	$this->m_data->insert_data($data,'ketua_gampong');
	
	// mengalihkan halaman ke halaman data ketua_kecamatan
	redirect(base_url().'ketua_kecamatan/ketua_gampong');
	}
	
	function ketua_gampong_edit($id){
	$where = array('id' => $id);
	$data['kecamatan'] = $this->kecamatanModel->view();
	// mengambil data dari database sesuai id
	$data['ketua_gampong'] = $this->m_data->edit_data($where,'ketua_gampong')->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/v_ketua_gampong_edit',$data);
	$this->load->view('ketua_kecamatan/v_footer');
	}
	
	function ketua_gampong_update(){
	$id = $this->input->post('id');
	$id_kecamatan = $this->input->post('id_kecamatan');
	$kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
	$id_gampong = $this->input->post('id_gampong');
	$ketua_gampong =  $this->gampongModel->gampong_name($id_gampong);
	
	$where = array(
		'id' => $id
	);
	
	// cek apakah form password di isi atau tidak
	if($kecamatan !='' && $ketua_gampong != ''){
		$data = array(
			'kecamatan' => $kecamatan,
			'ketua_gampong' => $ketua_gampong,
			); 
	
		// update data ke database
		$this->m_data->update_data($where,$data,'ketua_gampong');
	}elseif($kecamatan =='' && $ketua_gampong == ''){
		redirect(base_url().'ketua_kecamatan/ketua_gampong');
	
	}
	// mengalihkan halaman ke halaman data guru
	redirect(base_url().'ketua_kecamatan/ketua_gampong');
	}


function ketua_gampong_hapus($id){
$where = array(
	'id' => $id
);

// menghapus data guru dari database sesuai id
$this->m_data->delete_data($where,'ketua_gampong');

// mengalihkan halaman ke halaman data ketua_kecamatan
redirect(base_url().'ketua_kecamatan/ketua_gampong');
}

function absen(){
		// mengambil data absen admin dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
		$data['absensi'] = $this->m_data->get_data_kelas_tanggal($this->session->userdata('id_kelas'),$this->session->userdata('tanggal_mulai'))->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/absen/v_absen',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

function absen_isi(){
	$data['gampong'] = $this->gampongModel->viewBykec($this->session->userdata('ketua_kecamatan'));

	// mengambil data absen ketua_kecamatan dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/absen/v_absen_isi', $data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function absen_tidak(){
	$data['gampong'] = $this->gampongModel->viewBykec($this->session->userdata('ketua_kecamatan'));
	// mengambil data absen admin dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/absen/v_absen_tidak', $data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function absen_aksi_isi(){
		$kecamatan =  $this->session->userdata('ketua_kecamatan');
		$id_gampong = $this->input->post('id_gampong');
		$gampong =  $this->persiswaModel->gampong_name3($id_gampong);
		
$cek_anggota =  $this->db->query("SELECT * from anggota where id_kelas = '$id_gampong'");

		if($cek_anggota->num_rows() == 0){
			redirect(base_url(). 'ketua_kecamatan/absen_tidak');
		}else{
	$data = array(
		'id_gampong' => $id_gampong,
		'gampong' => $gampong,
	);

	$data_session = array(
		'id_gampong' => $id_gampong,
		'gampong' => $gampong
		);

	$this->session->set_userdata($data_session);
	// insert data ke database
	// mengalihkan halaman ke halaman data ketua_kecamatan
	redirect(base_url().'ketua_kecamatan/absen_tambah',$data);
		}
}

function absen_tambah(){
	$data['absensi'] =$this->m_data->get_data_kelas_id($this->session->userdata('id_gampong'))->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/absen/v_absen_tambah',$data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function absen_aksi(){
	$id = $this->input->post('id');
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$jam_pengajian = $this->input->post('jam_pengajian');
		$id_kelas = $this->input->post('id_kelas');
		$nama = $this->input->post('nama');
		$hari = $this->input->post('hari');
		$absen = $this->input->post('absen');
		$kelas = $this->input->post('kelas');
		$ket_pengajian = $this->input->post('ket_pengajian');
		$data = array();

		$cek_anggota =  $this->db->query("SELECT * from absensi where id_kelas = '$id_kelas' AND tanggal_mulai = '$tanggal_mulai' ");

		if($cek_anggota->num_rows() > 0){
			$data_session = array(
				'tanggal_mulai' => $tanggal_mulai,
				'id_kelas' => $id_kelas
			);
		
			$this->session->set_userdata($data_session);
			// mengalihkan halaman ke halaman data absen
			redirect(base_url(). 'ketua_kecamatan/absen', $this->session->userdata('tanggal_mulai'));
		}else{
		foreach($id as $id)
		array_push($data, array(
			'hari' => $hari,
			'id_anggota' => $id,
			'id_kelas' => $id_kelas,
			'tanggal_mulai' => $tanggal_mulai,
			'jam_pengajian' => $jam_pengajian,
			'ket_pengajian' => $ket_pengajian,
			'kelas' => $kelas,
			'absen' => $absen
		));

		$data_session = array(
			'tanggal_mulai' => $tanggal_mulai,
			'id_kelas' => $id_kelas
		);
	
		$this->session->set_userdata($data_session);

		$this->load->view('ketua_kecamatan/v_footer');
	
		// insert data ke database
		$this->m_data->save_batch($data,'absensi');

		// mengalihkan halaman ke halaman data absen
		redirect(base_url(). 'ketua_kecamatan/absen', $this->session->userdata('tanggal_mulai'));
	}
}


function absen_sakit($id){
	$where = array(
		'absensi_id' => $id
	);

	// mengambil data buku pada peminjaman ber id tersebut
	$data = $this->m_data->edit_data($where,'absensi')->row();
	
	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('absen'=>1),'absensi');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'ketua_kecamatan/absen');
}

function absen_izin($id){
	$where = array(
		'absensi_id' => $id
	);

	// mengambil data buku pada peminjaman ber id tersebut
	$data = $this->m_data->edit_data($where,'absensi')->row();
	
	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('absen'=>3),'absensi');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'ketua_kecamatan/absen');
}

function absen_masuk($id){
	$where = array(
		'absensi_id' => $id
	);

	// mengambil data buku pada peminjaman ber id tersebut
	$data = $this->m_data->edit_data($where,'absensi')->row();
	
	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('absen'=>4),'absensi');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'ketua_kecamatan/absen');
}

function absen_alpa($id){
	$where = array(
		'absensi_id' => $id
	);

	// mengambil data buku pada peminjaman ber id tersebut
	$data = $this->m_data->edit_data($where,'absensi')->row();
	
	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('absen'=>5),'absensi');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'ketua_kecamatan/absen');
}


// akhir CRUD ketua_gampong
function absen_laporan(){
	$data['gampong'] = $this->gampongModel->viewBykec($this->session->userdata('ketua_kecamatan'));
	if(isset($_GET['id_gampong']) && isset($_GET['tanggal_mulai'])){
		$table = $this->input->get('tanggal_mulai');
		$table2 = $this->input->get('id_gampong');
		$data['absensi'] = $this->db->query("SELECT * from absensi inner join anggota on absensi.id_anggota = anggota.id and absensi.id_kelas = '$table2'  AND tanggal_mulai = '$table' order by absensi_id DESC")->result();
	}else{
		$table = $this->session->userdata('ketua_kecamatan');
		$data['absensi'] = $this->db->query("SELECT * from absensi inner join anggota on absensi.id_anggota = anggota.id and anggota.kecamatan = '$table' order by absensi_id DESC")->result();
	}
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/absen/v_absen_laporan',$data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function absen_persiswa_laporan(){
	$data['gampong'] = $this->gampongModel->viewBykec($this->session->userdata('ketua_kecamatan'));
	if(isset($_GET['bulan']) && isset($_GET['tahun']) && isset($_GET['nama']) && isset($_GET['kelas']) && isset($_GET['gampong'])){
		$tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $nama = $this->input->get('nama');
        $gampong = $this->input->get('gampong');
		$data['absensi'] = $this->db->query("SELECT gampong = '$gampong' AND nama = '$nama' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' ) order by absensi_id desc")->result();
	}else{
		$data['absensi'] = $this->db->query("SELECT * from absensi order by absensi_id desc")->result();
	}
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/absen/v_absen_persiswa_laporan',$data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function iuran_laporan(){
	$data['gampong'] = $this->gampongModel->viewBykec($this->session->userdata('ketua_kecamatan'));
	if(isset($_GET['id_gampong']) && isset($_GET['tanggal_iuran'])){
		$mulai = $this->input->get('tanggal_iuran');
		$id_gampong = $this->input->get('id_gampong');
		$tanggal1 = explode('-', $mulai);
		$bulan = $tanggal1[0];
		$tahun   = $tanggal1[1];
		$data['iuran'] = $this->db->query("SELECT * from iuran WHERE (id_kelas = '$id_gampong'  AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun') order by iuran_id desc")->result();
	}else{
		$data['iuran'] = $this->db->query("SELECT * from iuran order by iuran_id desc")->result();
	}
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/iuran/v_iuran_laporan',$data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function anggota_udah_meninggal(){
	// mengambil data dari database
	$data['anggota'] = $this->m_data->get_data_meninggal_kecamatan($this->session->userdata('ketua_kecamatan'))->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/v_anggota_meninggal',$data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function meninggal_laporan(){
	$data['gampong'] =$this->m_data->get_data_ketua_gampong_iuran($this->session->userdata('ketua_kecamatan'))->result();
	if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai']) && isset($_GET['id_gampong'])){
		$id_gampong = $this->input->get('id_gampong');
		$gampong = $this->m_data->nama_gampong($id_gampong);
		$mulai = $this->input->get('tanggal_mulai');
		$sampai = $this->input->get('tanggal_sampai');
		$data['meninggal'] = $this->db->query("SELECT * from meninggal WHERE (gampong = '$gampong' AND date(tanggal_meninggal) >= '$mulai' and date(tanggal_meninggal) <= '$sampai' ) order by id asc")->result();
	}else{
		$table2 = $this->session->userdata('ketua_kecamatan');
		$data['meninggal'] = $this->db->query("SELECT * from meninggal WHERE (kecamatan = '$table2') order by id asc")->result();
	}
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/meninggal/v_meninggal_laporan',$data);
	$this->load->view('ketua_kecamatan/v_footer');
}

function iuran_aksi(){
		$tanggal_iuran = $this->input->post('tanggal_iuran');
		$persiswa = $this->input->post('persiswa');
		$nama = $this->m_data->nama_anggota($persiswa);
		$kelas = $this->input->post('kelas');
		$id_gampong = $this->input->post('gampong');
		$gampong = $this->persiswaModel->gampong_name4($id_gampong);
		$kecamatan = $this->session->userdata('ketua_kecamatan');
		$jumlah_iuran = $this->input->post('jumlah_iuran');
		$data = array();


		$data = array(
			'nama' => $nama,
			'tanggal_iuran' => $tanggal_iuran,
			'id_kelas' => $id_gampong,
			'gampong' => $gampong,
			'kecamatan' => $kecamatan,
			'jumlah_iuran' => $jumlah_iuran,
		);

		// insert data ke database
		$this->m_data->insert_data($data,'iuran');
		
		$data_session = array(
			'tanggal_iuran' => $tanggal_iuran,
		);
	
		$this->session->set_userdata($data_session);


		// mengalihkan halaman ke halaman data absen
		redirect(base_url(). 'ketua_kecamatan/iuran_laporan');
	}

	function iuran_hapus($iuran_id){
		$where = array(
			'iuran_id' => $iuran_id
		);

		// menghapus data anggota dari database sesuai id
		$this->m_data->delete_data($where,'iuran');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'ketua_kecamatan/iuran_laporan');
	}
	

function ketua_pengajian(){
		// mengambil data dari database
		$data['ketua_pengajian'] = $this->m_data->get_data_ketpen($this->session->userdata('ketua_kecamatan'))->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/anggota/v_ketua_pengajian',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function ketua_pengajian_tambah(){
		$data['kecamatan'] = $this->kecamatanModel->view();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/anggota/v_ketua_pengajian_tambah', $data);
		$this->load->view('ketua_kecamatan/v_footer');
	}
	
		function ketua_pengajian_tambah2(){
		$data['kecamatan'] = $this->kecamatanModel->view();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/anggota/v_ketua_pengajian_tambah2', $data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function ketua_pengajian_tambah_aksi(){
		$nama = $this->input->post('nama');
		$hp = $this->input->post('hp');
		$nama_majelis = $this->input->post('nama_majelis');
		$id_gampong = $this->input->post('id_gampong');
		$gampong =  $this->gampongModel->gampong_name($id_gampong);
		$id_kecamatan = $this->input->post('id_kecamatan');
		$kecamatan = $this->kecamatanModel->kecamatan_name($id_kecamatan);

        $cek_anggota =  $this->db->query("SELECT * from ketua_pengajian where gampong = '$gampong'");

		if($cek_anggota->num_rows() > 0){
			redirect(base_url().'ketua_kecamatan/ketua_pengajian_tambah2/');
		}else{
		$data = array(
			'nama' => $nama,
			'hp' => $hp,
			'nama_majelis' => $nama_majelis,
			'gampong' => $gampong,
			'kecamatan' => $kecamatan,
		);

		// insert data ke database
		$this->m_data->insert_data($data,'ketua_pengajian');
	
}
		// mengalihkan halaman ke halaman data ketua_pengajian
		redirect(base_url().'ketua_kecamatan/ketua_pengajian');
	}

	function ketua_pengajian_edit($id){
		$data['kecamatan'] = $this->kecamatanModel->view();

		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['ketua_pengajian'] = $this->m_data->edit_data($where,'ketua_pengajian')->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/anggota/v_ketua_pengajian_edit',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function pilah(){
	$data['gampong'] = $this->gampongModel->viewBykec($this->session->userdata('ketua_kecamatan'));
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/anggota/v_pilah', $data);
	$this->load->view('ketua_kecamatan/v_footer');
	}
	
	function pilah_aksi(){
		$kecamatan =  $this->session->userdata('ketua_kecamatan');
		$id_gampong = $this->input->post('id_gampong');
		$gampong =  $this->persiswaModel->gampong_name3($id_gampong);
	
		$data['pilah'] = array(
			'gampong' => $gampong,
		);
	
		$data_session = array(
			'kecamatan' => $kecamatan,
			'id_gampong' => $id_gampong,
			'kelas2' => $gampong
		);
	
		$this->session->set_userdata($data_session);
	
		$data['anggota'] = $this->m_data->get_data('anggota')->result();
	
		// insert data ke database
		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'ketua_kecamatan/pilah_mana',$data);
	}
	
	function pilah_mana(){
		$table = $this->session->userdata('id_gampong');
		$table2 = $this->kecamatanModel->jeka($table);
		$table3 = $this->kecamatanModel->gampong($table);
	$data['nama'] = $this->db->query("SELECT count(nama) as nama from anggota WHERE id_kelas = '$table'")->result_array();
	$data['pilah'] = $this->db->query("SELECT * from kelas where id = '$table'")->result();
	$data['anggota'] = $this->m_data->get_data_ketua_kecamatan($this->session->userdata('kecamatan'), $table2, $table3)->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/anggota/v_pilah_mana',$data);
	$this->load->view('ketua_kecamatan/v_footer');
	}
	
	function pilah_kembalikan(){
		$table = $this->session->userdata('id_gampong');
		$table2 = $this->kecamatanModel->jeka($table);
		$table3 = $this->kecamatanModel->gampong($table);
	$data['nama'] = $this->db->query("SELECT count(nama) as nama from anggota WHERE id_kelas = '$table'")->result_array();
	$data['pilah'] = $this->db->query("SELECT * from kelas where id = '$table'")->result();
	$data['anggota'] = $this->m_data->get_data_kelas_kembali($table)->result();
	$this->load->view('ketua_kecamatan/v_header');
	$this->load->view('ketua_kecamatan/anggota/v_pilah_kembalikan',$data);
	$this->load->view('ketua_kecamatan/v_footer');
	}


	function pilah_tambahkan($id){
		$where = array(
			'id' => $id
		);
	
		// mengambil data buku pada peminjaman ber id tersebut
		$data = $this->m_data->edit_data($where,'anggota')->row();
		
		// mengubah status peminjaman menjadi selesai (1)
		$this->m_data->update_data_absen($where,array('id_kelas'=>$this->session->userdata('id_gampong')),'anggota');
	
	
		// mengalihkan halaman ke halaman data buku
		redirect(base_url().'ketua_kecamatan/pilah_mana');
	}

	function pilah_kembali($id){
		$where = array(
			'id' => $id
		);
	
		// mengambil data buku pada peminjaman ber id tersebut
		$data = $this->m_data->edit_data($where,'anggota')->row();
		
		// mengubah status peminjaman menjadi selesai (1)
		$this->m_data->update_data_absen($where,array('id_kelas'=>0),'anggota');
	
	
		// mengalihkan halaman ke halaman data buku
		redirect(base_url().'ketua_kecamatan/pilah_kembalikan');
	}

	//absen 


	function absen_harian(){
		$id = $this->session->userdata('id');
		$data['absen'] = $this->db->query("SELECT COUNT(*) as hasil FROM absen_kecamatan where tanggal = CURDATE() 
											AND id_ketua_kecamatan = '$id' ;")->result();
		$this->load->view('ketua_kecamatan/v_header');
		$this->load->view('ketua_kecamatan/absen_ketua/v_absen_harian',$data);
		$this->load->view('ketua_kecamatan/v_footer');
	}

	function absen_sekarang(){
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->session->userdata('id');
		$tanggal =  date('Y-m-d');
		$jam = date('H:i:s');
		$status = 'Hadir';
	
		$data = array(
			'id_ketua_kecamatan' => $id,
			'tanggal' => $tanggal,
			'jam' => $jam,
			'status' => $status,
		);
	
		// insert data ke database
		$this->m_data->insert_data($data,'absen_kecamatan');
	
		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'ketua_kecamatan/absen_harian');
	}

}
