<?php
 
class M_pdfiuran extends CI_Model {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
    }
 
    function get_list($limit, $offset) {
        if ($offset > 0) {
            $offset = ($offset - 1) * $limit;
        }
        $this->db->order_by(' gampong DESC, kelas DESC');
        $result['rows'] = $this->db->get('iuran', $limit, $offset);
        $result['num_rows'] = $this->db->count_all_results('iuran');
        return $result;
    }
 

    function export_pdf_iuran_kelas($table, $table2, $table3){
        $this->db->order_by(' gampong DESC, kelas DESC');
        $query = $this->db->query("SELECT * from iuran WHERE (kelas= '$table' AND gampong = '$table2' AND tanggal_iuran = '$table3' ) order by iuran_id desc");
        return $query->result();
        
    }

    function export_pdf_iuran_ketua_gampong($table, $table2, $table3){
        $this->db->order_by(' tanggal_iuran DESC,gampong DESC, kelas DESC');
        $query = $this->db->query("SELECT * from iuran WHERE (kelas= '$table' AND gampong = '$table2' AND tanggal_iuran = '$table3'  ) order by iuran_id desc");
        return $query->result();
    }

    function export_pdf_iuran_ketua_kecamatan($table,$table3, $kec){
        $this->db->order_by(' tanggal_iuran DESC,gampong DESC, kelas DESC');
        $query = $this->db->query("SELECT * from iuran WHERE ( AND tanggal_iuran = '$table3' AND kecamatan = '$kec' ) order by iuran_id desc");
        return $query->result();
    }

    function export_pdf_iuran_admin($table,$bulan,$tahun){
        $this->db->order_by(' tanggal_iuran DESC,gampong DESC');
        $query = $this->db->query("SELECT * from iuran WHERE (id_kelas = '$table'  AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun') order by iuran_id desc");
        return $query->result();
    }

    function export_pdf_iuran_perbulan(){
        $this->db->order_by(' tanggal_iuran DESC,gampong DESC');
        $query = $this->db->query("SELECT * from iuran WHERE (id_kelas = '$table'  AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun') order by iuran_id desc");
        return $query->result();
    }
    
}
