<?php defined('BASEPATH') OR exit('No direct script access allowed');
 
class M_pdfabsensi extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
 
    function get_list($limit, $offset) {
        if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }
        $this->db->order_by(' gampong DESC, kelas DESC');
        $result['rows'] = $this->db->get('absensi', $limit, $offset);
        $result['num_rows'] = $this->db->count_all_results('absensi');
        return $result;
    }
 

    function export_pdf_absen_kelas($table, $table2, $table3){
        $this->db->order_by(' gampong DESC, kelas DESC');
        $query = $this->db->query("SELECT * from absensi WHERE (kelas= '$table' AND gampong = '$table2' AND tanggal_mulai = '$table3' ) order by absensi_id desc");
        return $query->result();
    }

    function export_pdf_absen_ketua_gampong($table, $table2){
        $this->db->order_by(' gampong DESC, kelas DESC');
        $query = $this->db->query("SELECT * from absensi inner join anggota on absensi.id_anggota = anggota.id and absensi.id_kelas = '$table'  AND tanggal_mulai = '$table2' order by absensi_id desc");
        return $query->result();
    }


}
