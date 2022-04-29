<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_pdfmeninggal extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
 
    function get_list($limit, $offset) {
        if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }
        $this->db->order_by(' gampong DESC, kelas DESC');
        $result['rows'] = $this->db->get('meninggal', $limit, $offset);
        $result['num_rows'] = $this->db->count_all_results('meninggal');
        return $result;
    }
 

    function export_pdf_meninggal_kelas($table, $table2, $table3, $table4){
        $this->db->order_by('id ASC, gampong DESC, kelas DESC');
        $query = $this->db->query("SELECT * from meninggal WHERE (jenis_kelamin= '$table' AND gampong = '$table2' AND date(tanggal_meninggal) >= '$table3' and date(tanggal_meninggal) <= '$table4' )");
        return $query->result();
    }

    function export_pdf_meninggal_ketua_gampong($table2, $table3, $table4){
        $this->db->order_by('id ASC, gampong DESC, kelas DESC');
        $query = $this->db->query("SELECT * from meninggal WHERE (gampong = '$table2' AND date(tanggal_meninggal) >= '$table3' and date(tanggal_meninggal) <= '$table4' )");
        return $query->result();
    }

}
