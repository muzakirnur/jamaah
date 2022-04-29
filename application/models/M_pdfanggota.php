<?php
 
class M_pdfanggota extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
 
    function get_list($limit, $offset) {
        if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }
        $this->db->order_by('no_anggota ASC, gampong ASC, kecamatan ASC, jenis_kelamin ASC');
        $result['rows'] = $this->db->get('anggota', $limit, $offset);
        $result['num_rows'] = $this->db->count_all_results('anggota');
        return $result;
    }
 
    function export_pdf(){
        $this->db->order_by('no_anggota ASC, gampong ASC, kecamatan ASC, jenis_kelamin ASC');
        $query = $this->db->get('anggota');
        return $query->result();
    }
    
    function export_pdf_kecamatan($table){
        $this->db->order_by('no_anggota ASC, gampong ASC, kecamatan ASC, jenis_kelamin ASC');
        $query = $this->db->query("SELECT * from anggota WHERE kecamatan IN('$table')");
        return $query->result();
    }

    function export_pdf_gampong($table){
        $this->db->order_by('no_anggota ASC, gampong ASC, kecamatan ASC, jenis_kelamin ASC');
        $query = $this->db->query("SELECT * from anggota WHERE gampong IN('$table')");
        return $query->result();
    }

    function export_pdf_permajelis($table){
        $this->db->order_by('no_anggota ASC, gampong ASC, kecamatan ASC, jenis_kelamin ASC');
        $query = $this->db->query("SELECT * from anggota WHERE id_kelas IN('$table')");
        return $query->result();
    }
}
