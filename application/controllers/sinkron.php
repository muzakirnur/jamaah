<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class sinkron extends CI_Controller
{
    private $limit = 10;
    var $module_name = 'sinkron';

    public function __construct()
    {
        parent::__construct();
        $this->load->model(array('M_pdfabsensi' => 'absensi'));
        $this->load->model(array('persiswaModel' => 'persiswa'));
    }

    public function pemanggil()
    {
        $data['data'] = $this->M_data->get_data('absensi')->result();
        foreach ($data as $d) {
            $absensi_id = $d->absensi_id;
            $nama = $d->nama;
            $id_kelas = $d->id_kelas;
            $nama_ortu = $d->nama_ortu;
            $ket_pengajian = $d->ket_pengajian;
            $hari = $d->hari;
            $jam_pengajian = $d->jam_pengajian;
            $tanggal_mulai = $d->tanggal_mulai;
            $absen = $d->absen;
            $kelas = $d->kelas;
            $gampong = $d->gampong;
            $kecamatan = $d->kecamatan;

            $ins = array(
                'absensi_id' => $absensi_id,
                'nama' => $nama,
                'id_kelas' => $id_kelas,
                'nama_ortu' => $nama_ortu,
                'ket_pengajian' => $ket_pengajian,
                'hari' => $hari,
                'jam_pengajian' => $jam_pengajian,
                'tanggal_mulai' => $tanggal_mulai,
                'absen' => $absen,
                'kelas' => $kelas,
                'gampong' => $gampong,
                'kecamatan' => $kecamatan
            );

            $this->m_data->insert_data($ins, 'absensi');
        }
    }
}
