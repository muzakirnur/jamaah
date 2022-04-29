    <?php

defined('BASEPATH') OR exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

use Restserver\Libraries\REST_Controller;

class GoummatApi extends REST_Controller {

	private $limit = 10;
	var $module_name = 'anggota';
    function __construct()
    {
        parent::__construct();
		$this->load->model('MNotif');
		
		$this->load->model('kecamatanModel');
		$this->load->model('ketgamModel');
		$this->load->model('gampongModel');
		$this->load->model('persiswaModel');
		$this->load->helper('rupiah_helper');
		$this->load->model('SiswaModel'); // Load model SiswaModel.php yang ada di folder models
		$this->load->model(array('M_pdfanggota' => 'anggota'));
		$this->load->model('Modelanggota', 'anggota2');
    }
    //balikan data jika hasil nya true
    public function getDataTrue($data)
    {
        $message = [
            'status' => true,
            'data' => $data,
            'message' => 'Data Berhasil Didapat'
        ];
        $this->set_response($message, REST_Controller::HTTP_OK);
    }
    //return message jika hasil nya true
    public function getMessageTrue($data)
    {
        $message = [
            'status' => true,
            'message' => $data
        ];
        $this->set_response($message, REST_Controller::HTTP_OK);
    }
    public function getMessageFalse()
    {
        $message = [
            'status' => false,
            'message' => 'Data Gagal Didapat'
        ];
        $this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
    }
    //balikan data jika hasil nya false
    public function getDataFalse($data)
    {
        $message = [
            'status' => false,
            'message' => $data
        ];
        return $this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
    }

    public function cekLogin_post(){
        // get inputan
        $username = $this->input->post('username');
		$password = $this->input->post('password');

        // validate inputan
		$this->form_validation->set_rules('username','Username','required');
		$this->form_validation->set_rules('password','Password','required');

        // cek login
        if($this->form_validation->run()){
            $where = array(
				'username' => $username,
				'password' => md5($password)
			);
            //cek data di database
            $data = $this->m_data->cek_login_mobile($where)->row();
            if($data){
                //jika data ada
                    $message = [
                        'id' => $data->id,
                        'username' => $data->username,
                        'id_jabatan' => $data->id_jabatan,
                        'jabatan' => $data->jabatan,
                        'id_kecamatan' => $data->id_kec,
                        'kecamatan' => $data->kecamatan,
                        'gampong' => $data->gampong,
                        'id_kelas' => $data->id_kelas,
                        'nama' => $data->nama,
                        'nama_ortu' => $data->nama_ortu,
                        'jenis_kelamin' => $data->jenis_kelamin,
                    ];                
                    return $this->getDataTrue($message);
                }
                //jika data tidak ada
                else{
                    return $this->getDataFalse('Username atau password anda salah');
                }
        }
    }
    // public function cekLogin_post()
    // {
    //     //get inputan
    //     $username = $this->input->post('username');
	// 	$password = $this->input->post('password');
	// 	$sebagai = $this->input->post('sebagai');

    //     // validate inputan
	// 	$this->form_validation->set_rules('username','Username','required');
	// 	$this->form_validation->set_rules('password','Password','required');
	// 	if($this->form_validation->run()){
	// 		$where = array(
	// 			'username' => $username,
	// 			'password' => md5($password)
	// 		);
    //     }
        
    //     //jika jabatan sebagai ketua_kecamatan
    //     if($sebagai == "ketua kecamatan"){
    //         $data = $this->m_data->cek_login('ketua_kecamatan',$where)->row();

    //         //jika data berhasil didapat
    //         if($data){
    //             $message = [
    //                 'id' => $data->id,
    //                 'nama' => $data->username,
    //                 'jabatan' => 'ketua kecamatan',
    //                 'ketua' => $data->ketua_kecamatan,
    //             ];                
    //             return $this->getDataTrue($message);
    //         }
    //         //jika data gagal didapat
    //         else{
    //             return $this->getDataFalse('Username atau password anda salah');
    //         }

    //     }
    //     //jika jabatan sebagai ketua kelas
    //     else if($sebagai == "ketua kelas"){
    //         $data = $this->m_data->cek_login('kelas',$where)->row();

    //         //jika data berhasil didapat
    //         if($data){
    //             $message = [
    //                 'id' => $data->id,
    //                 'nama' => $data->username,
    //                 'jabatan' => 'ketua kelas',
    //                 'ketua' => $data->gampong,
    //             ];                
    //             return $this->getDataTrue($message);
    //         }
    //         //jika data gagal didapat
    //         else{
    //             return $this->getDataFalse('Username atau password anda salah');
    //         }

    //     }
    //     else{
    //         return $this->getDataFalse('Akun Anda Tidak Terdafar');
    //     }


    // }
    public function countJamaah_get()
    // public function countJamaah_get($where)
    {
        $jamaah_total =  $this->m_data->count_jamaah();
        $jamaah_baru =  $this->m_data->count_jamaah_baru();
        $jamaah_meninggal =  $this->m_data->count_jamaah_meniggal();
        $data = array(
            "jamaah_total" => $jamaah_total,
            "jamaah_baru" => $jamaah_baru,
            "jamaah_meninggal" => $jamaah_meninggal,
        );
        return $this->getDataTrue($data);
    }
    // public function countJamaahBaru_get($where)
    // {
    //     $data =  $this->m_data->count_jamaah_baru($where);
    //     return $this->getDataTrue($data);
    // }
    // public function countJamaahMeniggal_get($where)
    // {
    //     $data =  $this->m_data->count_jamaah_meniggal($where);
    //     return $this->getDataTrue($data);
    // }
    public function getAllPresensi_get()
    // public function getAllPresensi_get($where)
    {
        $data = $this->m_data->get_all_presensi()->result_array();
        // $data = $this->m_data->get_all_presensi($where)->result_array();
        return $this->getDataTrue($data);
    }
    public function getAllJamaah_post()
    {
        
        //get inputan
//         $idJabatan = $this->input->post('idJabatan');
// 		$kecamatan = $this->input->post('kecamatan');
		$idKelas = $this->input->post('idKelas');

        // validate inputan
// 		$this->form_validation->set_rules('idJabatan','idJabatan','required');
// 		$this->form_validation->set_rules('kecamatan','kecamatan','required');
		$this->form_validation->set_rules('idKelas','idKelas','required');
		
            $filter = [
                'id_kelas' => $idKelas,
            ]; 
            $data = $this->m_data->get_all_jamaah($filter)->result_array();
            return $this->getDataTrue($data);

        // if ($idJabatan == 2) { //kecamatan
        //     $filter = [
        //         'kecamatan' => $kecamatan,
        //     ]; 
        //     $data = $this->m_data->get_all_jamaah($filter)->result_array();
        //     return $this->getDataTrue($data);
        // }elseif ($idJabatan == 3) { //ketua kelas
        //     $filter = [
        //         'id_kelas' => $idKelas,
        //     ]; 
        //     $data = $this->m_data->get_all_jamaah($filter)->result_array();
        //     return $this->getDataTrue($data);
        // }else{ //admin
        //     $filter = [
        //         'kabupaten' => 'bireun',
        //     ]; 
        //     $data = $this->m_data->get_all_jamaah($filter)->result_array();
        //     return $this->getDataTrue($data);
        // }
    }
    public function savePresensi_post()
    {   
        //get inputan
        $where = $this->input->post('where');
        $id_anggota = $this->input->post('id_anggota');
		$absen = $this->input->post('absen');
		$keterangan = $this->input->post('keterangan');
		$hari = $this->input->post('hari');
		$jam_pengajian = $this->input->post('jam_pengajian');
		$tanggal_pengajian = $this->input->post('tanggal_pengajian');

        
        $panjang = $this->db->where('gampong',$where)->count_all_results('absensi');
        for ($i=1; $i < $panjang; $i++) { 
            $cek = $this->db->where('id_anggota',$id_anggota)->where('ket_pengajian',$keterangan)->count_all_results('absensi');
            $data = [
                'id_anggota' => $id_anggota, 
                'absen' => $absen, 
                'ketrangan' => $keterangan, 
                'hari' => $hari, 
                'jam_pengajian' => $jam_pengajian,
                'tanggal_pengajian' => $tanggal_pengajian
            ];
            if ($cek > 0) {
                $this->db
                ->where('id_anggota', $id_anggota)
                ->where('ket_pengajian', $keterangan)
                ->update('absensi', $data);
            } else {
                $this->db->insert('absensi', $data);
            }
        }
        return $this->getDataTrue('Data Berhasil Disimpan');
    }
    public function CreateIuranJamaah()
    {
        //get inputan
        $nama = $this->input->post('nama');
		$jumlahIuran = $this->input->post('jumlahIuran');
        // tangga iuran diambil otomatis dari sini

        return $this->getDataTrue('Data Berhasil Disimpan');
    }
    
    //add presensi
    public function addPresensi_post()
    {
        // get inputan
        $id_karyawan = $this->input->post('id_karyawan');
		$id_status = $this->input->post('id_status');
		$ket = $this->input->post('ket');
		$date = $this->input->post('time');

        // validate inputan
		$this->form_validation->set_rules('id_karyawan','id_karyawan','required');
		$this->form_validation->set_rules('id_status','id_status','required');
		$this->form_validation->set_rules('ket','ket','required');
		$this->form_validation->set_rules('time','time','required');

        // //get current date and time
        // $date = date('Y-m-d H:i:s');

        if ($this->form_validation->run()) {
            $check = array(
                'id_karyawan' => $id_karyawan,
                'ket' => $ket,
            );
            $dateOnly = substr($date, 0, 10);
            $hasil = $this->m_data->checkPresensi('th_karyawan', $check,$dateOnly)->result_array();
            if ($hasil) {
                return $this->getMessageTrue("anda sudah melakukan presensi hari ini");
            }
            $data = array(
                'id_karyawan' => $id_karyawan,
                'time' => $date,
                'id_status' => $id_status,
                'lokasi' => 'none',
                'ket' => $ket,
            );
            $this->m_data->addData('th_karyawan', $data);
            return $this->getMessageTrue("Presensi Berhasil Disimpan");
        }
        else{
            return $this->getDataFalse('Data Gagal Disimpan');
        }
    }

    //check presensi
    public function checkPresensi_post()
    {
        // get inputan
        $id_karyawan = $this->input->post('id_karyawan');
        $ket = $this->input->post('ket');
        $time = $this->input->post('time');

        $data = array(
            'id_karyawan' => $id_karyawan,
            'ket' => $ket,
        );
        $check = $this->m_data->checkPresensi('th_karyawan', $data,$time)->result_array();
        if ($check != null) {
            return $this->getMessageTrue("anda sudah melakukan presensi");
        }else{
            return $this->getMessageFalse();
        }
    }

    public function jamaahMeninggal_get()
    {
        $data = $this->m_data->get_all_jamaah_meninggal()->result_array();
        return $this->getDataTrue($data);
    }
    
    //get detail presensi
    public function getDetailPresensi_post()
    {
        // get inputan
        $keterangan = $this->input->post('keterangan');
		$tanggal = $this->input->post('tanggal');
		$jam = $this->input->post('jam');

        // validate inputan
		$this->form_validation->set_rules('keterangan','keterangan','required');
		$this->form_validation->set_rules('tanggal','tanggal','required');
		$this->form_validation->set_rules('jam','jam','required');

        
        $data = $this->m_data->get_detail_presensi($keterangan,$tanggal,$jam)->result_array();
        return $this->getDataTrue($data);
    }

    public function detailIuran_post()
    {
        // get inputan
        $nama = $this->input->post('nama');

        // validate inputan
		$this->form_validation->set_rules('nama','nama','required');

                
        $data = $this->m_data->get_detail_iuran($nama)->result_array();
        if ($data) {
            return $this->getDataTrue($data);
        }else{
            return $this->getDataFalse("Anda Belum Melakukan pembayaran");
        }
    }

    public function addIuran_post()
    {
        // get inputan
        $nama = $this->input->post('nama');
        $idKelas = $this->input->post('idKelas');
        $nominal = $this->input->post('nominal');
        $tanggal = date('Y-m-d');

        // validate inputan
		$this->form_validation->set_rules('nama','nama','required');
		$this->form_validation->set_rules('idKelas','idKelas','required');
		$this->form_validation->set_rules('nominal','nominal','required');

                
        $array =[ 
            "nama"=> $nama,
            "id_kelas"=> $idKelas,
            "jumlah_iuran"=> $nominal,
            "tanggal_iuran"=> $tanggal,
            "gampong" => "-",
            "kecamatan" => "-",
        ];
        $data = $this->m_data->addData("iuran",$array);
        if ($data) {
            return $this->getMessageTrue("Iuran Berhasil Ditambah");
        }else{
            return $this->getMessageFalse("Anda Belum Melakukan pembayaran");
        }
    }

    public function addNewEvent_post()
    {
        // get inputan
        $judul = $this->input->post('judul');
        $tanggal = $this->input->post('tanggal');
        $jamMulai = $this->input->post('jam_mulai');
        $jamSelesai = $this->input->post('jam_selesai');
        $lokasi = $this->input->post('lokasi');

        // validate inputan
		$this->form_validation->set_rules('judul','judul','required');
		$this->form_validation->set_rules('tanggal','tanggal','required');
		$this->form_validation->set_rules('jam_mulai','jam_mulai','required');
		$this->form_validation->set_rules('jam_selesai','jam_selesai','required');
		$this->form_validation->set_rules('lokasi','lokasi','required');

                
        $array =[ 
            "judul"=> $judul,
            "tanggal"=> $tanggal,
            "jam_mulai"=> $jamMulai,
            "jam_selesai"=> $jamSelesai,
            "lokasi" => $lokasi,
        ];
        $data = $this->m_data->addData("th_event",$array);
        if ($data) {
            return $this->getMessageTrue("Acara Berhasil Ditambahkan");
        }else{
            return $this->getMessageFalse("Acara Gagal Ditambahkan");
        }
    }

    public function presensiEvent_post()
    {
        // get inputan
        $idEvent = $this->input->post('id_event');
        $idKaryawan = $this->input->post('id_karyawan');
        $idStatus = $this->input->post('id_status');
        $tanggalAbsen = $this->input->post('tanggal_absen');
        $jamAbsen = $this->input->post('jam_absen');

        // validate inputan
		$this->form_validation->set_rules('id_event','id_event','required');
		$this->form_validation->set_rules('id_karyawan','id_karyawan','required');
		$this->form_validation->set_rules('id_status','id_status','required');
		$this->form_validation->set_rules('tanggal_absen','tanggal_absen','required');
		$this->form_validation->set_rules('jam_absen','jam_absen','required');

        //cek data sudah pernah ada atau tidak
        $where=[ 
            "id_event"=> $idEvent,
            "id_karyawan"=> $idKaryawan,
        ];
        $check = $this->m_data->checkPresensiEvent('th_presensi_event', $where)->result_array();
        if ($check != null) {
            return $this->getMessageTrue("anda sudah melakukan presensi");
        }
                
        $array =[ 
            "id_event"=> $idEvent,
            "id_karyawan"=> $idKaryawan,
            "id_Status"=> $idStatus,
            "tanggal_absen"=> $tanggalAbsen,
            "jam_absen" => $jamAbsen,
        ];
        $data = $this->m_data->addData("th_presensi_event",$array);
        if ($data) {
            return $this->getMessageTrue("Presensi Berhasil Dilakukan");
        }else{
            return $this->getMessageFalse("Presensi Gagal Dilakukan");
        }
    }

    public function getAllEvent_post()
    {
        $data = $this->m_data->get_all_event()->result_array();
        return $this->getDataTrue($data);
    }

    public function getAllPresensiEvent_post()
    {
        // get inputan
        $idEvent = $this->input->post('id_event');
        $data = $this->m_data->get_all_presensi_event($idEvent)->result_array();
        if ($data) {
            return $this->getDataTrue($data);
        }else{
            return $this->getDataFalse("Tidak Ada Peserta");
        }
    }

    public function getJamaah_get()
    {
        // get inputan
        $current_page = $this->get('current');
        $like = $this->get('like');

        $limit = 20;
        $page = (($current_page * $limit ) - $limit) + 1; //ngambil page 
        $last = ceil($this->m_data->max_pages('anggota') / $limit);
        $data = $this->m_data->pages('anggota',$page,$limit,$like)->result_array();
        $message = [
            'status' => true,
            'current_page' => $current_page,
            'last_page' => $last,
            'data' => $data,
            'message' => 'Data Berhasil Didapat'
        ];
        return $this->set_response($message, REST_Controller::HTTP_OK);
    }

    public function getJamaahMeniggal_post()
    {
        $check = $this->m_data->get_all('meninggal')->result_array();
        return $this->getDataTrue($check);
    }

    public function getJamaahBaru_post()
    {
        $check = $this->m_data->get_all('baru')->result_array();
        return $this->getDataTrue($check);
    }

    public function getAllNews_post()
    {
        $check = $this->m_data->get_all('news')->result_array();
        return $this->getDataTrue($check);
    }

    public function getAllPengumuman_post()
    {
        $check = $this->m_data->get_all('th_pengumuman')->result_array();
        return $this->getDataTrue($check);
    }

    public function getPengumuman_post()
    {
        $check = $this->m_data->get_single('th_pengumuman')->result();
        return $this->getDataTrue($check);
    }

    public function addJamaah_post()
    {
        // get inputan
        $nama = $this->input->post('nama');
        $namaOrtu = $this->input->post('namaOrtu');
        $ttg = $this->input->post('ttg');
        $jk = $this->input->post('jk');
        $gampong = $this->input->post('gampong');
        $kecamatan = $this->input->post('kecamatan');

        $max = $this->m_data->get_max('baru','no_anggota')->row();

        $array =[ 
            "nama"=> $nama,
            "no_anggota"=> sprintf("%05d", $max->max +1),
            "nama_ortu"=> $namaOrtu,
            "ttg"=> $ttg,
            "jenis_kelamin"=> $jk,
            "gampong" => $gampong,
            "kecamatan" => $kecamatan,
            "kabupaten" => "Bireun",
        ];
        $data = $this->m_data->addData("baru",$array);
        if ($data) {
            return $this->getMessageTrue("Jamaah Baru Berhasil Ditambahkan");
        }else{
            return $this->getMessageFalse("Jamaah Baru Gagal Ditambahkan");
        }
    }
    
    
    public function jamaahPerKelas_post()
    {
        // get inputan
        $kecamatan = $this->input->post('kecamatan');

        $data = $this->m_data->get_jamaahPerKelas($kecamatan)->result_array();
        if ($data) {
            return $this->getDataTrue($data);
        }else{
            return $this->getMessageFalse("JData Gagal Didapat");
        }
    }
    
    public function jamaahKelas_post()
    {
        // get inputan
        $id_kelas = $this->input->post('id_kelas');

        $data = $this->m_data->get_jamaahKelas($id_kelas)->result_array();
        if ($data) {
            return $this->getDataTrue($data);
        }else{
            return $this->getMessageFalse("Data Gagal Didapat");
        }
    }
    
    public function jamaahPerKecamatan_post()
    {
        // get inputan
        $kecamatan = $this->input->post('kecamatan');

        $data = $this->m_data->get_jamaahPerKecamatan($kecamatan)->result_array();
        if ($data) {
            return $this->getDataTrue($data);
        }else{
            return $this->getMessageFalse("Data Gagal Didapat");
        }
    }
    
    public function allGampong_post()
    {
        $data = $this->m_data->get_allGampong()->result_array();
        if ($data) {
            return $this->getDataTrue($data);
        }else{
            return $this->getMessageFalse("Data Gagal Didapat");
        }
    }
    
    public function allAdminKecamatan_post()
    {
        $data = $this->m_data->get_allAdminKecamatan()->result_array();
        if ($data) {
            return $this->getDataTrue($data);
        }else{
            return $this->getMessageFalse("Data Gagal Didapat");
        }
    }
    
    //alih fungsi untuk management user
    public function allKetuaKelas_post()
    {
        $data = $this->m_data->allKetuaKelas()->result_array();
        if ($data) {
            return $this->getDataTrue($data);
        }else{
            return $this->getMessageFalse("Data Gagal Didapat");
        }
    }
    
    public function allKecamatan_post()
    {
        $data = $this->m_data->allKecamatan()->result_array();
        if ($data) {
            return $this->getDataTrue($data);
        }else{
            return $this->getMessageFalse("Data Gagal Didapat");
        }
    }
    public function testnotif_get()
    {
		return $this->MNotif->sendNotifAndroid("Jamaah Meninggal","oke","okeee");
    }
    public function addMeninggal_post()
    {
        // get inputan
		$no_anggota = $this->input->post('no_anggota');
		$nama = $this->input->post('nama');
		$nama_ortu = $this->input->post('nama_ortu');
		$ttg = $this->input->post('ttg');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$gampong = $this->input->post('gampong');
		$kecamatan = $this->input->post('kecamatan');
		$kabupaten = $this->input->post('kabupaten');
		$hari_meninggal = $this->input->post('hari_meninggal');
		$tanggal_meninggal = $this->input->post('tanggal_meninggal');
		$alamat_duka = $this->input->post('alamat_duka');

                
        $array =[ 
				'no_anggota' => $no_anggota,
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $gampong,
				'kecamatan' => $kecamatan,
				'kabupaten' => 'Bireun',
				'hari_meninggal' => $hari_meninggal,
				'tanggal_meninggal' => $tanggal_meninggal,
				'alamat_duka' => $alamat_duka
        ];
        $data = $this->m_data->addData("meninggal",$array);
        if ($data) {
			$this->MNotif->sendNotifAndroid("Jamaah Meninggal", $jenis_kelamin == "L" ? $nama ." Bin " .$nama_ortu: $nama ." Binti ".$nama_ortu,$array);
            return $this->getMessageTrue("Jamaah Meninggal Berhasil Ditambahkan");
        }else{
            return $this->getMessageFalse("Jamaah Meninggal Gagal Ditambahkan");
        }
    }
    
    public function registrasi_post()
    {
        // get inputan
        $id = $this->input->post('id');
        $nama = $this->input->post('nama');
        $password = $this->input->post('password');

        $where = array(
			'no_anggota' => $id,
			'nama' => $nama,
		);
		
		//cek datanya ada di table anggota apa enggak
        $data = $this->m_data->reg_mobile($where)->result_array();
        if ($data) {
            
    		//cek datanya ada di table tm_karyawan apa enggak
            $check = $this->m_data->check_regis($id)->result_array();
            if($check){
                $message = [
                    'status' => false,
                    'message' => 'Anda sudah terdaftar, silahkan login'
                ];
                return $this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
            }else{
                 //insert karyawan
        		$max = $this->db->query('SELECT MAX(id) AS id FROM `tm_karyawan`')->row();
                $where_karyawan = array(
        			'id' => $max->id +1,
        			'id_anggota' => $id,
        			'username' => $id.'_'.$nama,
        			'password' => md5($password),
        			'id_jabatan' => 4,
        			'ket' => 'ket:'.$password,
        		);
                $result = $this->m_data->action_reg_mobile($where_karyawan);
                if($result){
                    return $this->getMessageTrue("Registrasi berhasil, silahkan");
                }
            }                   
        }else{
            $message = [
                'status' => false,
                'message' => "Nomor jamaah dan nama Anda tidak terdaftar di database kami"
            ];
            $this->set_response($message, REST_Controller::HTTP_NOT_FOUND);
                return $message;
        }
    }
    public function addNews_post()
    {
        // get inputan
        $judul = $this->input->post('judul');
        $tanggal = $this->input->post('tanggal');
        $isi = $this->input->post('isi');

        // validate inputan
		$this->form_validation->set_rules('judul','judul','required');
		$this->form_validation->set_rules('tanggal','tanggal','required');
		$this->form_validation->set_rules('isi','isi','required');

                
        $array =[ 
            "judul"=> $judul,
            "tanggal"=> $tanggal,
            "isi"=> $isi,
        ];
        $data = $this->m_data->addData("news",$array);
        if ($data) {
            return $this->getMessageTrue("Berita Berhasil Ditambahkan");
        }else{
            return $this->getMessageFalse("Berita Gagal Ditambahkan");
        }
    }
    public function addAbsensiJamaah_post() //add absen jamaah ngukti web
    {
        // get inputan
        $array = $this->input->post('data');
        $hasil = json_decode($array);
        $data = $this->m_data->addBulkData("absensi",$hasil);
        if ($data) {
            return $this->getMessageTrue("Berhasil Ditambahkan");
        }else{
            return $this->getMessageFalse("Gagal Ditambahkan");
        }
    }
    public function updateJabatan_post()
    {
        // get inputan
        $id = $this->input->post('id');
        $id_jabatan = $this->input->post('id_jabatan');
        $where=['id_anggota'=>$id];
        $hasil=['id_jabatan'=>$id_jabatan];
        $data = $this->m_data->update_data_jabatan("tm_karyawan",$where,$hasil);
        if ($data) {
            // $array=[
            //     'id_karyawan'=>$id,
            //     'id_kecamatan'=>$id,
            //     'id_gampong'=>$id,
            //     'id_kelas'=>$id,
            //     'ket'=>date("Y-m-d H:i:s"),
            //     ];
            // $this->m_data->addData("th_jabatan",$array);
            return $this->getMessageTrue("Berhasil Ditambahkan");
        }else{
            return $this->getMessageFalse("Gagal Ditambahkan");
        }
    }
    
    // controller yang sama kayak di admink beda return aja
	function tambahiuranaksi_post()
	{

		$id_kecamatan = $this->input->post('kecamatan');
		$id_gampong = $this->input->post('gampong');
		$id_anggota = $this->input->post('persiswa');
		$kecamatan = $this->kecamatanModel->kecamatan_name($id_kecamatan);
		$gampong = $this->persiswaModel->gampong_name4($id_gampong);
		$persiswa = $this->input->post('persiswa');
		$tanggal_iuran = $this->input->post('tanggal_iuran');
		$nama = $this->m_data->nama_anggota($persiswa);
		$kelas = $this->input->post('kelas');
		$jumlah_iuran = $this->input->post('jumlah_iuran');
		$data = array();


		$data = array(
			'nama' => $nama,
			'id_anggota' => $id_anggota,
			'tanggal_iuran' => $tanggal_iuran,
			'id_kelas' => $kelas,
			'gampong' => $gampong == null ? $id_gampong : $gampong ,
			'kecamatan' => $kecamatan,
			'jumlah_iuran' => $jumlah_iuran,
		);

		// insert data ke database
		$this->m_data->insert_data($data, 'iuran');
		$this->session->set_flashdata('success', 'Data Berhasil ditambahkan');

		return $this->getMessageTrue("Berhasil Ditambahkan");
	}
    
    
    public function getAllJamaahInKecamatan_post()
    {
		$key = $this->input->post('kecamatan');
		
        $where = ['kecamatan'=>$key];
        $check = $this->m_data->get_where('anggota',$where)->result_array();
        return $this->getDataTrue($check);
    }
    
    public function getAllJamaahInGampong_post()
    {
		$key = $this->input->post('gampong');
		
        $where = ['gampong'=>$key];
        $check = $this->m_data->get_where('anggota',$where)->result_array();
        return $this->getDataTrue($check);
    }
    
    // public function anggotaKelas_post()
    // {
    //     // get inputan
    //     $idKetuaKelas = $this->input->post('idKetua');

    //     $data = $this->m_data->get_anggotaKelas($idKetuaKelas)->result_array();
    //     if ($data) {
    //         return $this->getDataTrue($data);
    //     }else{
    //         return $this->getMessageFalse("Jamaah Gagal didapat");
    //     }
    // }
    // public function allAdminKecamata_post()
    // {
    //     // get inputan
    //     $kecamatan = $this->input->post('kecamatan');

    //     $data = $this->m_data->get_jamaahPerKecamatan($kecamatan)->result_array();
    //     if ($data) {
    //         return $this->getDataTrue($data);
    //     }else{
    //         return $this->getMessageFalse("Jamaah Baru Gagal Ditambahkan");
    //     }
    // }

}