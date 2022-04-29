<?php
 
class M_pdfperingatan extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
 
    function get_list($limit, $offset) {
        if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }
        $this->db->order_by(' gampong DESC, kelas DESC');
        $result['rows'] = $this->db->get('peringatan', $limit, $offset);
        $result['num_rows'] = $this->db->count_all_results('peringatan');
        return $result;
    }
 

    function export_pdf($table){
        $this->db->order_by('no_anggota ASC, gampong ASC, kecamatan ASC, jenis_kelamin ASC');
        $query = $this->db->query("SELECT * from anggota WHERE id IN('$table')");
        return $query->result();
    }
}
