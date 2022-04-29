<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Form extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		
		$this->load->model('ketua_gampongModel');
		$this->load->model('gampongModel');
	}

	public function index(){
		$data['ketua_gampong'] = $this->ketgamModel->view();
		$this->load->view('admin/anggota/v_anggota_tambah', $data);
	}
	
	public function listgampong(){
		// Ambil data ID ketua_gampong yang dikirim via ajax post
		$id_ketua_gampong = $this->input->post('id_ketua_gampong');
		
		$id_gampong = $this->persiswaModel->viewByketgam($id_ketua_gampong);
		
		// Buat variabel untuk menampung tag-tag option nya
		// Set defaultnya dengan tag option Pilih
		$lists = "<option value=''>Pilih</option>";
		
		foreach($id_gampong as $data){
			$lists .= "<option value='".$data->id_gampong."'>".$data->gampong."</option>"; // Tambahkan tag option ke variabel $lists
		}
		
		$callback = array('list_gampong'=>$lists); // Masukan variabel lists tadi ke dalam array $callback dengan index array : list_gampong

		echo json_encode($callback); // konversi varibael $callback menjadi JSON
	}
}
