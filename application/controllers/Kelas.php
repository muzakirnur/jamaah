<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Kelas extends CI_Controller {

	function __construct(){
		parent::__construct();

		// cek session yang login, jika session status tidak sama dengan session guru_login,maka halaman akan di alihkan kembali ke halaman login.
		if($this->session->userdata('status')!="kelas_login"){
			redirect(base_url().'login?alert=belum_login');
		}
		$this->load->model(array('M_pdfanggota'=>'anggota'));
		$this->load->model(array('kecamatanModel'=>'kecamatan'));
		$this->load->model(array('M_pdfmeninggal'=>'meninggal'));

	}

	public function export_pdf() {
        $this->load->library('f_pdf');
        $data['absensi'] = $this->anggota->export_pd();
        $this->load->view('admin/pdf/v_anggota_pdf',$data); //memanggil view 
	}
	
	function index(){
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/v_index');
		$this->load->view('kelas/v_footer');
	}

	function absen2(){
		$this->load->view('kelas/guru/index.php');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login/?alert=logout');
	}

	function ganti_password(){
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/v_ganti_password');
		$this->load->view('kelas/v_footer');
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

			$this->m_data->update_data($where,$data,'kelas');

			redirect(base_url().'kelas/ganti_password/?alert=sukses');

		}else{
			$this->load->view('kelas/v_header');
			$this->load->view('kelas/v_ganti_password');
			$this->load->view('kelas/v_footer');
		}
}

	// crud anggota
	function anggota(){
		
		// mengambil data dari database
		$data['anggota'] = $this->m_data->get_data_kelas_id($this->session->userdata('id'))->result();
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/v_anggota',$data);
		$this->load->view('kelas/v_footer');
	}
	function anggota_tambah(){
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/anggota/v_anggota_tambah');
		$this->load->view('kelas/v_footer');
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
		
		redirect(base_url().'kelas/anggota');
	}

	function anggota_edit($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/v_anggota_edit',$data);
		$this->load->view('kelas/v_footer');
	}
	
		function anggota_edit2($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/v_anggota_edit2',$data);
		$this->load->view('kelas/v_footer');

	}

	function anggota_update(){
		$id = $this->input->post('id');
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

		if($no_anggota == ''){
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
		}elseif($cek_anggota->num_rows() > 0 && $alamat_duka == ''){
			redirect(base_url().'ketua_kecamatan/anggota_edit2/'.$id);
		}elseif($cek_anggota->num_rows() > 0 && $hari_meninggal != '' && $tanggal_meninggal != '' && $alamat_duka != ''){
			$data = array(
				'no_anggota' => $no_anggota,
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
		redirect(base_url().'kelas/anggota');
	}


	


	function anggota_hapus($id){
		$where = array(
			'id' => $id
		);

		// menghapus data anggota dari database sesuai id
		$this->m_data->delete_data($where,'anggota');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'kelas/anggota');
	}

	function anggota_meninggal_hapus($id){
		$where = array(
			'id' => $id
		);

		// menghapus data anggota dari database sesuai id
		$this->m_data->delete_data($where,'meninggal');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'kelas/anggota_udah_meninggal');
	}

	function iuran_hapus($iuran_id){
		$where = array(
			'iuran_id' => $iuran_id
		);

		// menghapus data anggota dari database sesuai id
		$this->m_data->delete_data($where,'iuran');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'kelas/iuran_laporan');
	}

	function anggota_kartu($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('kelas/v_anggota_kartu',$data);
	}

	function anggota_udah_meninggal(){
		
		// mengambil data dari database
		$data['anggota'] = $this->m_data->get_data_kelas_meninggal($this->session->userdata('kelas'), $this->session->userdata('gampong'))->result();
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/v_anggota_meninggal',$data);
		$this->load->view('kelas/v_footer');
	}
	// akhir anggota

// kelas
function kelas(){
	// mengambil data dari database
	$data['kelas'] = $this->m_data->get_data('kelas')->result();
	$this->load->view('kelas/v_header');
	$this->load->view('kelas/v_kelas',$data);
	$this->load->view('kelas/v_footer');
}

// akhir kelas


//--------------upload----------------------------///

function ebook(){
	// mengambil data dari database
	//$data['berkas'] = $this->m_data->get_data('berkas');
	$data['berkas']= $this->m_data->get_data('berkas')->result();
	$this->load->view('kelas/v_header');
	$this->load->view('kelas/v_upload',$data);

	//$data['berkas'] = $this->db->get('berkas');
	$this->load->view('kelas/v_tampilberkas');

	$this->load->view('kelas/v_footer');
}



function download($id1)
{
	$data = $this->db->get_where('berkas',['id'=>$id1])->row();
	force_download('upload/pdf/'.$data->nama,NULL);
}
	/********************end upload******************************/

	
	function absen(){
		// mengambil data absen kelas dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
		$data['absensi'] = $this->m_data->get_data_kelas_tanggal($this->session->userdata('id'),$this->session->userdata('tanggal_mulai'))->result();
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/absen/v_absen',$data);
		$this->load->view('kelas/v_footer');
	}


	function absen_tambah(){
		$data['absensi'] =$this->m_data->get_data_kelas_id($this->session->userdata('id'))->result();
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/absen/v_absen_tambah',$data);
		$this->load->view('kelas/v_footer');
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
		$gampong = $this->session->userdata('gampong');
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
			redirect(base_url(). 'kelas/absen', $this->session->userdata('tanggal_mulai'));
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
			'gampong' => $gampong,
			'absen' => $absen
		));

		$data_session = array(
			'tanggal_mulai' => $tanggal_mulai,
		);
	
		$this->session->set_userdata($data_session);

	
		// insert data ke database
		$this->m_data->save_batch($data,'absensi');

		// mengalihkan halaman ke halaman data absen
		redirect(base_url(). 'kelas/absen', $this->session->userdata('tanggal_mulai'));
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
		redirect(base_url().'kelas/absen');
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
		redirect(base_url().'kelas/absen');
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
		redirect(base_url().'kelas/absen');
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
		redirect(base_url().'kelas/absen');
	}
	// absen
	function absen_laporan(){
		if(isset($_GET['tanggal_mulai'])){
			$mulai = $this->input->get('tanggal_mulai');
			$table2 = $this->session->userdata('id');
			$data['absensi'] = $this->db->query("SELECT * from absensi WHERE (id_kelas = '$table2' AND tanggal_mulai = '$mulai') order by absensi_id desc")->result();
		}else{
			$table2 = $this->session->userdata('id');
			$data['absensi'] = $this->db->query("SELECT * from absensi WHERE (id_kelas = '$table2') order by absensi_id desc")->result();
		}
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/absen/v_absen_laporan',$data);
		$this->load->view('kelas/v_footer');
	}

	function meninggal_laporan(){
		if(isset($_GET['tanggal_mulai'])){
			$mulai = $this->input->get('tanggal_mulai');
			$sampai = $this->input->get('tanggal_sampai');
			$table = $this->session->userdata('kelas');
			$table2 = $this->session->userdata('gampong');
			$data['meninggal'] = $this->db->query("SELECT * from meninggal WHERE (jenis_kelamin= '$table' AND gampong = '$table2' AND date(tanggal_meninggal) >= '$mulai' and date(tanggal_meninggal) <= '$sampai' ) order by id asc")->result();
		}else{
			$table = $this->session->userdata('kelas');
			$table2 = $this->session->userdata('gampong');
			$data['meninggal'] = $this->db->query("SELECT * from meninggal WHERE (jenis_kelamin= '$table' AND gampong = '$table2') order by id desc")->result();
		}
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/meninggal/v_meninggal_laporan',$data);
		$this->load->view('kelas/v_footer');
	}

function iuran_laporan(){
		$data['anggota'] = $this->m_data->get_data_kelas_id( $this->session->userdata('id'))->result();
		if(isset($_GET['tanggal_iuran'])){
			$mulai = $this->input->get('tanggal_iuran');
			$id_gampong = $this->session->userdata('id');
			$tanggal1 = explode('-', $mulai);
            $bulan = $tanggal1[0];
            $tahun   = $tanggal1[1];
			$data['iuran'] = $this->db->query("SELECT * from iuran WHERE (id_kelas = '$id_gampong'  AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun') order by iuran_id desc")->result();
		}else{
			$table = $this->session->userdata('id');
			$data['iuran'] = $this->db->query("SELECT * from iuran where id_kelas = '$table' order by iuran_id desc")->result();
		}
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/iuran/v_iuran_laporan',$data);
		$this->load->view('kelas/v_footer');
	}
	

	function iuran_aksi(){
		$tanggal_iuran = $this->input->post('tanggal_iuran');
		$id_anggota= $this->input->post('id_anggota');
		$nama = $this->m_data->nama_anggota($id_anggota);
		$id_kelas = $this->session->userdata('id');
		$gampong = $this->session->userdata('gampong');
		$kecamatan = $this->session->userdata('kecamatan');
		$jumlah_iuran = $this->input->post('jumlah_iuran');
		$data = array();


		$data = array(
			'nama' => $nama,
			'tanggal_iuran' => $tanggal_iuran,
			'id_kelas' => $id_kelas,
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
		redirect(base_url(). 'kelas/iuran_laporan');
	}

	
	function anggota_meninggal_edit($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['meninggal'] = $this->m_data->edit_data($where,'meninggal')->result();
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/v_anggota_meninggal_edit',$data);
		$this->load->view('kelas/v_footer');
	}

	function anggota_meninggal_update(){
		$id = $this->input->post('id');
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

			$this->m_data->update_data($where,$data,'meninggal');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'kelas/anggota_udah_meninggal');
	}

	//absen 


	function absen_harian(){
		$id = $this->session->userdata('id');
		$data['absen'] = $this->db->query("SELECT COUNT(*) as hasil FROM absen_kelas where tanggal = CURDATE() 
											AND id_ketua_kelas = '$id' ;")->result();
		$this->load->view('kelas/v_header');
		$this->load->view('kelas/absen_ketua/v_absen_harian',$data);
		$this->load->view('kelas/v_footer');
	}

	function absen_sekarang(){
		date_default_timezone_set('Asia/Jakarta');
		$id = $this->session->userdata('id');
		$tanggal =  date('Y-m-d');
		$jam = date('H:i:s');
		$status = 'Hadir';
	
		$data = array(
			'id_ketua_kelas' => $id,
			'tanggal' => $tanggal,
			'jam' => $jam,
			'status' => $status,
		);
	
		// insert data ke database
		$this->m_data->insert_data($data,'absen_kelas');
	
		// mengalihkan halaman ke halaman data ketua_kelas
		redirect(base_url().'kelas/absen_harian');
	}

}
