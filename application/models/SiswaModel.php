<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class SiswaModel extends CI_Model {
	public function filter($search, $limit, $start, $order_field, $order_ascdesc){
		
		$this->db->like('no_anggota', $search); // Untuk menambahkan query where LIKE
		$this->db->or_like('nama', $search); // Untuk menambahkan query where OR LIKE
		$this->db->or_like('nama_ortu', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('ttg', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('jenis_kelamin', $search); // Untuk menambahkan query where OR LIKE
		$this->db->or_like('gampong', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('kecamatan', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('kabupaten', $search); // Untuk menambahkan query where OR LIKE
		$this->db->order_by($order_field, $order_ascdesc); // Untuk menambahkan query ORDER BY
		$this->db->limit($limit, $start); // Untuk menambahkan query LIMIT

		return $this->db->get('anggota')->result_array(); // Eksekusi query sql sesuai kondisi diatas
	}

	public function count_all(){
		return $this->db->count_all('anggota'); // Untuk menghitung semua data siswa
	}

	public function count_filter($search){
		$this->db->like('no_anggota', $search); // Untuk menambahkan query where LIKE
		$this->db->or_like('nama', $search); // Untuk menambahkan query where OR LIKE
		$this->db->or_like('nama_ortu', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('ttg', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('jenis_kelamin', $search); // Untuk menambahkan query where OR LIKE
		$this->db->or_like('gampong', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('kecamatan', $search); // Untuk menambahkan query where OR LIKE
        $this->db->or_like('kabupaten', $search); // Untuk menambahkan query where OR LIKE

		return $this->db->get('anggota')->num_rows(); // Untuk menghitung jumlah data sesuai dengan filter pada textbox pencarian
	}
}
