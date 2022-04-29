<?php 

class gampongModel extends CI_Model {
	
	public function viewBykecamatan($id_kecamatan){
		$this->db->order_by('gampong DESC');
		$this->db->where('id_kecamatan', $id_kecamatan);
		$result = $this->db->get('gampong')->result(); // Tampilkan semua data gampong berdasarkan id kecamatan
		
		return $result; 
	}

	public function viewBykec($id_kecamatan){
		$this->db->where('kecamatan', $id_kecamatan);
		$result = $this->db->get('kelas')->result(); // Tampilkan semua data gampong berdasarkan id kecamatan
		
		return $result; 
	}
	
	public function gampong_name($id_gampong)
	{	
     $this->db->select('gampong')->from('gampong')->where('id_gampong',$id_gampong);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->gampong;
     }
     return false;
	}

	public function data_no($id)
	{	
     $this->db->select('no_anggota')->from('baru')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->no_anggota;
     }
     return false;
	}

	public function data_nama($id)
	{	
     $this->db->select('nama')->from('baru')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->nama;
     }
     return false;
	}

	public function data_ortu($id)
	{	
     $this->db->select('nama_ortu')->from('baru')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->nama_ortu;
     }
     return false;
	}

	public function data_ttg($id)
	{	
     $this->db->select('ttg')->from('baru')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->ttg;
     }
     return false;
	}

	public function data_jk($id)
	{	
     $this->db->select('jenis_kelamin')->from('baru')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->jenis_kelamin;
     }
     return false;
	}

	

	public function data_gampong($id)
	{	
     $this->db->select('gampong')->from('baru')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->gampong;
     }
     return false;
	}

	public function data_kecamatan($id)
	{	
     $this->db->select('kecamatan')->from('baru')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->kecamatan;
     }
     return false;
	}


	public function data_no2($id)
	{	
     $this->db->select('no_anggota')->from('anggota')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->no_anggota;
     }
     return false;
	}

	public function data_nama2($id)
	{	
     $this->db->select('nama')->from('anggota')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->nama;
     }
     return false;
	}

	public function data_ortu2($id)
	{	
     $this->db->select('nama_ortu')->from('anggota')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->nama_ortu;
     }
     return false;
	}

	public function data_ttg2($id)
	{	
     $this->db->select('ttg')->from('anggota')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->ttg;
     }
     return false;
	}

	public function data_jk2($id)
	{	
     $this->db->select('jenis_kelamin')->from('anggota')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->jenis_kelamin;
     }
     return false;
	}

	

	public function data_gampong2($id)
	{	
     $this->db->select('gampong')->from('anggota')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->gampong;
     }
     return false;
	}

	public function data_kecamatan2($id)
	{	
     $this->db->select('kecamatan')->from('anggota')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->kecamatan;
     }
     return false;
     }
     
     public function data_berhenti2($id)
	{	
     $this->db->select('tgl_berhenti')->from('anggota')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->tgl_berhenti;
     }
     return false;
	}
     
     public function data_kelas($id)
	{	
     $this->db->select('id_kelas')->from('anggota')->where('id',$id);
     $query = $this->db->get();
	 
	 if ($query->num_rows() > 0) {
         return $query->row()->id_kelas;
     }
     return false;
	}
}
