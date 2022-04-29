<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('kecamatanModel');
		$this->load->model('ketgamModel');
		$this->load->model('persiswaModel');
		$this->load->model('gampongModel');
	}

	public function index(){
		$data['kecamatan'] = $this->kecamatanModel->view();
		$this->load->view('admin/anggota/v_anggota_tambah', $data);
	}
	
	public function listgampong(){
		// Ambil data ID kecamatan yang dikirim via ajax post
		$id_kecamatan = $this->input->post('id_kecamatan');
		
		$id_gampong = $this->gampongModel->viewBykecamatan($id_kecamatan);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>Pilih</option>";
		
		foreach($id_gampong as $data){
			$lists .= "<option value='".$data->id_gampong."'>".$data->gampong."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('list_gampong'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_gampong

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}

	public function listpilahgampong(){
		// Ambil data ID kecamatan yang dikirim via ajax post
		$id_kecamatan = $this->input->post('id_kecamatan');
		$gampong = $this->kecamatanModel->kecamatan_name($id_kecamatan);
		$id_gampong = $this->gampongModel->viewBykec($gampong);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>Pilih</option>";
		
		foreach($id_gampong as $data){
			$lists .= "<option value='".$data->id."'>Nama Ketua Kelas :  ".$data->nama." || Kelas  :  ".$data->kelas." || Majelis  :  ".$data->majelis." || Gampong  :  ".$data->gampong." </option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('listpilah'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_gampong

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
	
	
	

	public function listpersiswa(){
		// Ambil data ID kecamatan yang dikirim via ajax post
		$gampong = $this->input->post('gampong');
		$id_gampong = $this->persiswaModel->gampong_name2($gampong);
		
		$persiswa = $this->persiswaModel->viewBypersiswa($id_gampong);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>Pilih Anggota</option>";
		
		foreach($persiswa as $data){
			$lists .= "<option value='".$data->id."'>".$data->nama."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('list_persiswa'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_gampong

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}

	public function listpersiswa2(){
		// Ambil data ID kecamatan yang dikirim via ajax post
		$gampong = $this->input->post('gampong');
		
		$persiswa = $this->persiswaModel->anggota_nama($gampong);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>Pilih Anggota</option>";
		
		foreach($persiswa as $data){
			$lists .= "<option value='".$data->id."'>".$data->nama."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('list_persiswa'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_gampong

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}

	public function listpersiswa3(){
		// Ambil data ID kecamatan yang dikirim via ajax post
		$gampong = $this->input->post('gampong');
		$persiswa = $this->persiswaModel->viewBypersiswa2($gampong);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>Pilih Anggota</option>";
		
		foreach($persiswa as $data){
			$lists .= "<option value='".$data->id."'>".$data->nama." Bin ".$data->nama_ortu."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('list_persiswa'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_gampong

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
}
