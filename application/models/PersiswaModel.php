<?php 

class persiswaModel extends CI_Model {
	
	public function viewBypersiswa($id_gampong){
		$this->db->where('gampong', $id_gampong);
		$result = $this->db->get('anggota')->result(); // Tampilkan semua data gampong berdasarkan id kecamatan
		
		return $result; 
	}

	public function viewBypersiswa2($id_gampong){
		$this->db->where('id_kelas', $id_gampong);
		$result = $this->db->get('anggota')->result(); // Tampilkan semua data gampong berdasarkan id kecamatan
		
		return $result; 
	}
	
	public function gampong_name2($id_gampong)
	{	
     $this->db->select('ketua_gampong')->from('ketua_gampong')->where('id',$id_gampong);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->ketua_gampong;
     }
     return false;
	}


	public function gampong_name3($id_gampong)
	{	
     $this->db->select('nama')->from('kelas')->where('id',$id_gampong);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->nama;
     }
     return false;
	}

	public function gampong_name4($id_gampong)
	{	
     $this->db->select('gampong')->from('kelas')->where('id',$id_gampong);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->gampong;
     }
     return false;
	}

	public function anggota_nama($persiswa)
	{	
     $this->db->select('nama')->from('anggota')->where('id',$persiswa);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->nama;
     }
     return false;
	}
	
	public function kecamatan_nama($id_kecamatan)
	{	
     $this->db->select('ketua_kecamatan')->from('ketua_kecamatan')->where('id',$id_kecamatan);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->ketua_kecamatan;
     }
     return false;
	}


}
