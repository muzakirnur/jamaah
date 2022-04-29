<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ketua_Gampong extends CI_Controller {

	function __construct(){
		parent::__construct();

		// cek session yang login, jika session status tidak sama dengan session guru_login,maka halaman akan di alihkan kembali ke halaman login.
		if($this->session->userdata('status')!="ketua_gampong_login"){
			redirect(base_url().'login?alert=belum_login');
		}
	}


	function index(){
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/v_index');
		$this->load->view('ketua_gampong/v_footer');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login/?alert=logout');
	}

	function ganti_password(){
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/v_ganti_password');
		$this->load->view('ketua_gampong/v_footer');
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

			$this->m_data->update_data($where,$data,'ketua_gampong');

			redirect(base_url().'ketua_gampong/ganti_password/?alert=sukses');

		}else{
			$this->load->view('ketua_gampong/v_header');
			$this->load->view('ketua_gampong/v_ganti_password');
			$this->load->view('ketua_gampong/v_footer');
		}
}

	// crud anggota
	function anggota(){
		
		// mengambil data dari database
		$data['anggota'] = $this->m_data->get_data_ketua_gampong($this->session->userdata('ketua_gampong'))->result();

		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/v_anggota',$data);
		$this->load->view('ketua_gampong/v_footer');
	}
	function anggota_tambah(){
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/anggota/v_anggota_tambah');
		$this->load->view('ketua_gampong/v_footer');
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
		$gampong = $this->input->post('gampong');
		$data = array(
			
			'no_anggota' => $no_anggota,
			'nama' => $nama,
			'nama_ortu' => $nama_ortu,
			'ttg' => $ttg,
			'jenis_kelamin' => $jenis_kelamin,
			'gampong' => $id_gampong,
			'kecamatan' => $kecamatan,
			'kabupaten' => $kabupaten,
			'gampong' => $gampong
		);

		// insert data ke database
		$this->m_data->insert_data($data,'anggota');

		// mengalihkan halaman ke halaman data anggota
		
		redirect(base_url().'ketua_gampong/anggota');
	}

	function anggota_edit($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/v_anggota_edit',$data);
		$this->load->view('ketua_gampong/v_footer');
	}

	function anggota_update(){
		$no_anggota = $this->input->post('no_anggota');
		$nama = $this->input->post('nama');
		$nama_ortu = $this->input->post('nama_ortu');
		$ttg = $this->input->post('ttg');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$gampong = $this->input->post('gampong');
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
			'gampong' => $gampong,
			'kecamatan' => $kecamatan,
			'kabupaten' => $kabupaten,
		);

		// update data ke database
		$this->m_data->update_data($where,$data,'anggota');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'ketua_gampong/anggota');
	}


	function anggota_hapus($id){
		$where = array(
			'id' => $id
		);

		// menghapus data anggota dari database sesuai id
		$this->m_data->delete_data($where,'anggota');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'ketua_gampong/anggota');
	}

	function anggota_kartu($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('ketua_gampong/v_anggota_kartu',$data);
	}
	// akhir anggota

// ketua_gampong
function ketua_gampong(){
	// mengambil data dari database
	$data['ketua_gampong'] = $this->m_data->get_data('ketua_gampong')->result();
	$this->load->view('ketua_gampong/v_header');
	$this->load->view('ketua_gampong/v_ketua_gampong',$data);
	$this->load->view('ketua_gampong/v_footer');
}

// akhir ketua_gampong


//--------------upload----------------------------///

function ebook(){
	// mengambil data dari database
	//$data['berkas'] = $this->m_data->get_data('berkas');
	$data['berkas']= $this->m_data->get_data('berkas')->result();
	$this->load->view('ketua_gampong/v_header');
	$this->load->view('ketua_gampong/v_upload',$data);

	//$data['berkas'] = $this->db->get('berkas');
	$this->load->view('ketua_gampong/v_tampilberkas');

	$this->load->view('ketua_gampong/v_footer');
}



function download($id1)
{
	$data = $this->db->get_where('berkas',['id'=>$id1])->row();
	force_download('upload/pdf/'.$data->nama,NULL);
}
	/********************end upload******************************/


	function absen(){
		// mengambil data absen ketua_gampong dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
		$data['absensi'] = $this->m_data->get_data_tanggal($this->session->userdata('tanggal_mulai'))->result();
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/absen/v_absen',$data);
		$this->load->view('ketua_gampong/v_footer');
	}

	function absen_isi(){
		// mengambil data absen admin dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/absen/v_absen_isi');
		$this->load->view('ketua_gampong/v_footer');
	}

	function absen_aksi_isi(){
			$ketua_gampong = $this->input->post('ketua_gampong');

		$data = array(
			'ketua_gampong' => $ketua_gampong
		);

		$data_session = array(
			'ketua_gampong' => $ketua_gampong
		);
	
		$this->session->set_userdata($data_session);
		// insert data ke database
		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'ketua_gampong/absen_tambah',$data);
	}

	

	function absen_tambah_laki(){
		$data['absensi'] =$this->m_data->get_data_ketua_gampong('L', $this->session->userdata('ketua_gampong'))->result();
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/absen/v_absen_tambah',$data);
		$this->load->view('ketua_gampong/v_footer');
	}

	function absen_tambah_perempuan(){
		$data['absensi'] =$this->m_data->get_data_ketua_gampong('P', $this->session->userdata('ketua_gampong'))->result();
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/absen/v_absen_tambah',$data);
		$this->load->view('ketua_gampong/v_footer');
	}

	function absen_aksi(){
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$jam_pengajian = $this->input->post('jam_pengajian');
		$nama = $this->input->post('nama');
		$hari = $this->input->post('hari');
		$absen = $this->input->post('absen');
		$ketua_gampong = $this->input->post('ketua_gampong');
		$gampong = $this->input->post('gampong');
		$ket_pengajian = $this->input->post('ket_pengajian');
		$data = array();

		
		foreach($nama as $nama)
		array_push($data, array(
			'nama' => $nama,
			'hari' => $hari,
			'tanggal_mulai' => $tanggal_mulai,
			'jam_pengajian' => $jam_pengajian,
			'ket_pengajian' => $ket_pengajian,
			'ketua_gampong' => $ketua_gampong,
			'gampong' => $this->session->userdata('ketua_gampong'),
			'absen' => $absen
		));

		$data_session = array(
			'tanggal_mulai' => $tanggal_mulai
		);
	
		$this->session->set_userdata($data_session);

	
		// insert data ke database
		$this->m_data->save_batch($data,'absensi');

		// mengalihkan halaman ke halaman data absen
		redirect(base_url(). 'ketua_gampong/absen', $this->session->userdata('tanggal_mulai'));
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
		redirect(base_url().'ketua_gampong/absen');
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
		redirect(base_url().'ketua_gampong/absen');
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
		redirect(base_url().'ketua_gampong/absen');
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
		redirect(base_url().'ketua_gampong/absen');
	}
	// absen
	function absen_laporan(){
		if(isset($_GET['tanggal_mulai']) && isset($_GET['ketua_gampong'])){
			$mulai = $this->input->get('tanggal_mulai');
			$ketua_gampong = $this->input->get('ketua_gampong');
			$table2 = $this->session->userdata('ketua_gampong');
			// mengambil data absen berdasarkan tanggal mulai sampai tanggal sampai
			$data['absensi'] = $this->db->query("SELECT * from absensi WHERE (ketua_gampong= '$ketua_gampong' AND gampong = '$table2' AND tanggal_mulai = '$mulai' )order by absensi_id desc")->result();
		}else{
			$table2 = $this->session->userdata('ketua_gampong');
			// mengambil data absen ketua_gampong dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
			$data['absensi'] = $this->db->query("SELECT * from absensi WHERE gampong IN ('$table2') order by absensi_id desc")->result();
		}
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/absen/v_absen_laporan',$data);
		$this->load->view('ketua_gampong/v_footer');
	}

	function anggota_meninggal(){
		$no_anggota = $this->input->post('no_anggota');
		$nama = $this->input->post('nama');
		$nama_ortu = $this->input->post('nama_ortu');
		$ttg = $this->input->post('ttg');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$gampong = $this->input->post('gampong');
		$kecamatan = $this->input->post('kecamatan');
		$kabupaten = $this->input->post('kabupaten');
		$hari_meninggal = $this->input->post('hari_meninggal');
		$tanggal_meninggal = $this->input->post('tanggal_meninggal');
		$alamat_duka = $this->input->post('alamat_duka');
		$id = $this->input->post('id');

		$where = array(
			'id' => $id
		);

		$data = array(
			'no_anggota' => $no_anggota,
			'nama' => $nama,
			'nama_ortu' => $nama_ortu,
			'ttg' => $ttg,
			'jenis_kelamin' => $jenis_kelamin,
			'gampong' => $gampong,
			'kecamatan' => $kecamatan,
			'kabupaten' => $kabupaten,
			'hari_meninggal' => $hari_meninggal,
			'tanggal_meninggal' => $tanggal_meninggal,
			'alamat_duka' => $alamat_duka
		);

		// update data ke database
		$this->m_data->insert_meninggal($where,$data,'meninggal');
		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'ketua_gampong/anggota');
	}


	function anggota_udah_meninggal(){
		
		// mengambil data dari database
		$data['anggota'] = $this->m_data->get_data_meninggal_gampong($this->session->userdata('ketua_gampong'))->result();
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/v_anggota_meninggal',$data);
		$this->load->view('ketua_gampong/v_footer');
	}

	function meninggal_laporan(){
		if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])&& isset($_GET['kelas'])){
			$mulai = $this->input->get('tanggal_mulai');
			$sampai = $this->input->get('tanggal_sampai');
			$table = $this->input->get('kelas');
			$table2 = $this->session->userdata('ketua_gampong');
			$data['meninggal'] = $this->db->query("SELECT * from meninggal WHERE (jenis_kelamin= '$table' AND gampong = '$table2' AND date(tanggal_meninggal) >= '$mulai' and date(tanggal_meninggal) <= '$sampai' ) order by id asc")->result();
		}else{
			$table2 = $this->session->userdata('ketua_gampong');
			$data['meninggal'] = $this->db->query("SELECT * from meninggal WHERE (gampong = '$table2') order by id asc")->result();
		}
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/meninggal/v_meninggal_laporan',$data);
		$this->load->view('ketua_gampong/v_footer');
	}

	function iuran_laporan(){
		if(isset($_GET['kelas']) && isset($_GET['tanggal_iuran'])){
			$mulai = $this->input->get('tanggal_iuran');
			$table = $this->input->get('kelas');
			$table2 = $this->session->userdata('ketua_gampong');
			$data['iuran'] = $this->db->query("SELECT * from iuran WHERE (kelas= '$table' AND gampong = '$table2' AND tanggal_iuran = '$mulai') order by iuran_id desc")->result();
		}else{
			$table2 = $this->session->userdata('ketua_gampong');
			$data['iuran'] = $this->db->query("SELECT * from iuran WHERE (gampong = '$table2') order by iuran_id desc")->result();
		}
		$this->load->view('ketua_gampong/v_header');
		$this->load->view('ketua_gampong/iuran/v_iuran_laporan',$data);
		$this->load->view('ketua_gampong/v_footer');
	}



}
