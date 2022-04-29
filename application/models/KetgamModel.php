<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class ketgamModel extends CI_Model {
	
	public function view(){
		return $this->db->get('ketua_gampong')->result(); // Tampilkan semua data yang ada di tabel kecamatan
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
}
