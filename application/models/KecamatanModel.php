<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class kecamatanModel extends CI_Model {
	
	public function view(){
		return $this->db->get('kecamatan')->result(); // Tampilkan semua data yang ada di tabel kecamatan
	}

	public function kecamatan_name($id_kecamatan)
	{	
     $this->db->select('kecamatan')->from('kecamatan')->where('id_kecamatan',$id_kecamatan);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->kecamatan;
     }
     return false;
	}

	public function jeka($id)
	{	
     $this->db->select('kelas')->from('kelas')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->kelas;
     }
     return false;
	}

	public function gampong($id)
	{	
     $this->db->select('gampong')->from('kelas')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->gampong;
     }
     return false;
	}
}
