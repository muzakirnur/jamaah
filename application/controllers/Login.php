<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Login extends CI_Controller {

	function __construct(){
		parent::__construct();

	}

	public function index(){
		$this->load->view('v_login');
	}

	function login_aksi(){
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$sebagai = $this->input->post('sebagai');

		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

		if($this->form_validation->run() != false){
			$where = array(
				'username' => $username,
				'password' => md5($password)
			);

			if($sebagai == "admin"){
				$cek = $this->m_data->cek_login('admin',$where)->num_rows();
				$data = $this->m_data->cek_login('admin',$where)->row();

				if($cek > 0){
					$data_session = array(
						'id' => $data->id,
						'username' => $data->username,
						'status' => 'admin_login',
						'redir' => 'admin/anggota'

					);

					$this->session->set_userdata($data_session);

					redirect(base_url().'admin');
				}else{
					redirect(base_url().'login?alert=gagal');
				}

			}else if($sebagai == "k_perpus"){
			$cek = $this->m_data->cek_login('k_perpus',$where)->num_rows();
			$data = $this->m_data->cek_login('k_perpus',$where)->row();

			if($cek > 0){
			$data_session = array(
				'id' => $data->id,
				'username' => $data->username,
				'status' => 'k_perpus_login',
			);

			$this->session->set_userdata($data_session);

			redirect(base_url().'k_perpus');
			}else{
			redirect(base_url().'login?alert=gagal');
			}

			}	else if($sebagai == "ketua_kecamatan"){
				$cek = $this->m_data->cek_login('ketua_kecamatan',$where)->num_rows();
				$data = $this->m_data->cek_login('ketua_kecamatan',$where)->row();

				if($cek > 0){
					$data_session = array(
						'id' => $data->id,
						'nama' => $data->nama,
						'username' => $data->username,
						'ketua_kecamatan' => $data->ketua_kecamatan,
						'status' => 'ketua_kecamatan_login',
						'redir' => 'ketua_kecamatan/anggota'
					);

					$this->session->set_userdata($data_session);

					redirect(base_url().'ketua_kecamatan');
				}else{
					redirect(base_url().'login?alert=gagal');
				}
//--tambah aktor anngota 22-09-2020--//
			

	}
	else if($sebagai == "ketua_gampong"){
$cek = $this->m_data->cek_login('ketua_gampong',$where)->num_rows();
$data = $this->m_data->cek_login('ketua_gampong',$where)->row();

if($cek > 0){
	$data_session = array(
		'id' => $data->id,
		'nama' => $data->nama,
		'username' => $data->username,
		'ketua_gampong' => $data->ketua_gampong,
		'status' => 'ketua_gampong_login',
		'redir' => 'ketua_gampong/anggota'
	);

	$this->session->set_userdata($data_session);

	redirect(base_url().'ketua_gampong');
}else{
	redirect(base_url().'login?alert=gagal');
}

}
else if($sebagai == "kelas"){
	$cek = $this->m_data->cek_login('kelas',$where)->num_rows();
	$data = $this->m_data->cek_login('kelas',$where)->row();
	
	if($cek > 0){
		$data_session = array(
			'id' => $data->id,
			'nama' => $data->nama,
			'username' => $data->username,
			'gampong' => $data->gampong,
			'kecamatan' => $data->kecamatan,
			'kelas' => $data->kelas,
			'status' => 'kelas_login'
		);
	
		$this->session->set_userdata($data_session);
	
		redirect(base_url().'kelas');
	}else{
		redirect(base_url().'login?alert=gagal');
	}

		}
		else if ($sebagai = "admink") {
			$cek = $this->m_data->cek_login('admin_keuangan', $where)->num_rows();
			$data = $this->m_data->cek_login('admin_keuangan',$where)->row();
	
			if ($cek > 0 ) {
				$data_session = array(
					'id' => $data->id,
					'username' => $data->username,
					'status' => 'admink',
					'redir' => 'admink/keuangan'
				);	
				$this->session->set_userdata($data_session);
				redirect(base_url().'admink');
			}else{
				redirect(base_url().'login?alert=gagal');
			}
			}
		}
		else{
			$this->load->view('v_login');
		}

	}
}
