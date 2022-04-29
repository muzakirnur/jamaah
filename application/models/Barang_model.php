<?php


class Barang_model extends CI_Model
{
    public function import_data($databarang)
    {
        $jumlah = count($databarang);
        if ($jumlah > 0) {
            $this->db->replace('anggota', $databarang);
        }
    }

    public function getDataBarang()
    {
        return $this->db->get('anggota')->result_array();
    }
}
