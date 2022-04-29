$data['jeumpa'] = $this->db->query("SELECT sum(jumlah_iuran) as jeumpa from iuran WHERE (kecamatan= 'Jeumpa' AND MONTH(tanggal_iuran) = '01' AND YEAR(tanggal_iuran) = '$tahun')")->result_array();
