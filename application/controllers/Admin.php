<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Admin extends CI_Controller {
	private $limit = 10;
	var $module_name = 'anggota';
	
	function __construct(){
		parent::__construct();

		// cek session yang login, jika session status tidak sama dengan session admin_login,maka halaman akan di alihkan kembali ke halaman login.
		if($this->session->userdata('status')!="admin_login"){
			redirect(base_url().'login?alert=belum_login');
		}
		$this->load->model('MNotif');
		$this->load->model('kecamatanModel');
		$this->load->model('ketgamModel');
		$this->load->model('gampongModel');
		$this->load->model('persiswaModel');
		$this->load->model('SiswaModel'); // Load model SiswaModel.php yang ada di folder models
		$this->load->model(array('M_pdfanggota'=>'anggota'));
		$this->load->model('Modelanggota', 'anggota2');


	}

	public function index1($offset=0){
        $result                 = $this->anggota->get_list($this->limit, $offset);
        $data['anggota']           = $result['rows'];
        $data['num_results']    = $result['num_rows'];
        // load pagination library
        $this->load->library('pagination');
        $config = array(
            'base_url'          => site_url($this->module_name.'/index'),
            'total_rows'        => $data['num_results'],
            'per_page'          => $this->limit,
            'uri_segment'       => 3,
            'use_page_numbers'  => TRUE,
            'num_links'         => 5,
        );
        $this->pagination->initialize($config);
        $data['pagination'] = $this->pagination->create_links();
        $this->load->view('v_anggota',$data); //memanggil view 
    }
    
    public function export_pdf() {
        $this->load->library('f_pdf');
        $data['anggota'] = $this->anggota->export_pdf();
        $this->load->view('admin/pdf/v_anggota_pdf',$data); //memanggil view 
	}
	
	function index(){
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_index');
		$this->load->view('admin/v_footer');
	}

	function logout(){
		$this->session->sess_destroy();
		redirect(base_url().'login/?alert=logout');
	}

	function ganti_password(){
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_ganti_password');
		$this->load->view('admin/v_footer');
	}

	function reset_hal(){
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_reset_hal');
		$this->load->view('admin/v_footer');
	}

	function ganti_password_aksi(){
		$baru = $this->input->post('password_baru');
		$ulang = $this->input->post('password_ulang');

		$this->form_validation->set_rules('password_baru','Password Baru','required|matches[password_ulang]');
		$this->form_validation->set_rules('password_ulang','Ulangi Password','required');

		if($this->form_validation->run()!=false){
			$id = $this->session->userdata('id');

			$where = array('id' => $id);

			$data = array('password' => md5($baru));

			$this->m_data->update_data($where,$data,'admin');

			redirect(base_url().'admin/ganti_password/?alert=sukses');

		}else{
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_ganti_password');
			$this->load->view('admin/v_footer');
		}

	}

	public function delete(){
        $id = $_POST['id']; // Ambil data NIS yang dikirim oleh view.php melalui form submit
        $this->m_data->delete($id); // Panggil fungsi delete dari model
        
        redirect('admin/anggota');
    }

	function reset(){

		$where = array(
			'id_hapus' => 0
		);
		// insert data ke database
		$this->m_data->delete_data($where, 'anggota');

		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'admin/anggota');
	}


	// CRUD ketua_kecamatan
	function ketua_kecamatan(){
		// mengambil data dari database
		$data['ketua_kecamatan'] = $this->m_data->get_data('ketua_kecamatan')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_ketua_kecamatan',$data);
		$this->load->view('admin/v_footer');
	}

	function ketua_kecamatan_tambah(){
		$data['kecamatan'] = $this->kecamatanModel->view();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_ketua_kecamatan_tambah', $data);
		$this->load->view('admin/v_footer');
	}

	function ketua_kecamatan_tambah_aksi(){
		$nama = $this->input->post('nama');
		$username = $this->input->post('username');
		$id_kecamatan = $this->input->post('id_kecamatan');
		$ketua_kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
		$password = $this->input->post('password');

		$data = array(
			'nama' => $nama,
			'username' => $username,
			'ketua_kecamatan' => $ketua_kecamatan,
			'password' => md5($password)
		);

		// insert data ke database
		$this->m_data->insert_data($data,'ketua_kecamatan');

		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'admin/ketua_kecamatan');
	}

	function ketua_kecamatan_edit($id){
		$data['kecamatan'] = $this->kecamatanModel->view();

		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['ketua_kecamatan'] = $this->m_data->edit_data($where,'ketua_kecamatan')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_ketua_kecamatan_edit',$data);
		$this->load->view('admin/v_footer');
	}

	function form_alamat(){
		$this->load->view('admin/v_header');
		$this->load->view('admin/form');
		$this->load->view('admin/v_footer');
	}


	function ketua_kecamatan_update(){
		$id = $this->input->post('id');
		$nama = $this->input->post('nama');
		$id_kecamatan = $this->input->post('id_kecamatan');
		$ketua_kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
		$username = $this->input->post('username');
		$password = $this->input->post('password');

		$where = array(
			'id' => $id
		);

		// cek apakah form password di isi atau tidak
		if($password==""){
			$data = array(
				'nama' => $nama,
				'ketua_kecamatan' => $ketua_kecamatan,
				'username' => $username
			);

			// update data ke database
			$this->m_data->update_data($where,$data,'ketua_kecamatan');
		}elseif($ketua_kecamatan==""){
			$data = array(
				'nama' => $nama,
				'username' => $username,
				'password' => md5($password)
			);

			// update data ke database
			$this->m_data->update_data($where,$data,'ketua_kecamatan');
		}elseif($username==""){
			$data = array(
				'nama' => $nama,
				'ketua_kecamatan' => $ketua_kecamatan,
				'password' => md5($password)
			);

			// update data ke database
			$this->m_data->update_data($where,$data,'ketua_kecamatan');
		}elseif($nama==""){
			$data = array(
				'username' => $username,
				'ketua_kecamatan' => $ketua_kecamatan,
				'password' => md5($password)
			);

			// update data ke database
			$this->m_data->update_data($where,$data,'ketua_kecamatan');
		}elseif($nama=="" && $username==""){
			$data = array(
				'ketua_kecamatan' => $ketua_kecamatan,
				'password' => md5($password)
			);

			// update data ke database
			$this->m_data->update_data($where,$data,'ketua_kecamatan');
		}elseif($password=="" && $ketua_kecamatan==""){
				$data = array(
					'nama' => $nama,
					'username' => $username
				);
	
				// update data ke database
				$this->m_data->update_data($where,$data,'ketua_kecamatan');
			}else{
			$data = array(
				'nama' => $nama,
				'username' => $username,
				'ketua_kecamatan' => $ketua_kecamatan,
				'password' => md5($password)
			);

			// update data ke database
			$this->m_data->update_data($where,$data,'ketua_kecamatan');
		}

		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'admin/ketua_kecamatan');
	}


	function ketua_kecamatan_hapus($id){
		$where = array(
			'id' => $id
		);

		// menghapus data ketua_kecamatan dari database sesuai id
		$this->m_data->delete_data($where,'ketua_kecamatan');

		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'admin/ketua_kecamatan');
	}

	function render($id){
		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'render/index/'.$id);
	}



	function rekap_pemberhentian(){
		
		// mengambil data dari database
		$data['anggota'] = $this->m_data->get_data_anggota()->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/surat/v_rekap_pemberhentian',$data);
		$this->load->view('admin/v_footer');
	}
	
	function rekap_anggota_baru(){
		
		// mengambil data dari database
		$this->load->view('admin/v_header');
		$this->load->view('admin/surat/v_rekap_anggota_baru');
		$this->load->view('admin/v_footer');
	}

	function rekap_peringatan(){
		
		// mengambil data dari database
		$data['anggota'] = $this->m_data->get_data_anggota()->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/surat/v_rekap_peringatan',$data);
		$this->load->view('admin/v_footer');
	}

	
	// crud anggota
	function anggota(){
		// mengambil data dari database
		$this->load->view('admin/v_header');
		$this->load->view('admin/anggota/tampildata');
		$this->load->view('admin/v_footer');
	}
	

    public function ambildata()
    {
        if ($this->input->is_ajax_request() == true) {

            $list = $this->anggota2->get_datatables();
            $data = array();
            $no = $_POST['start'];
            foreach ($list as $field) {

                $no++;
                $row = array();

				// Membuat Tombol
				$tombolkartu = "<a href=\"render/" . $field->id . "\"> <button type=\"button\" class=\" btn btn-outline-warning\" title=\"Edit Data\"\">
                    <i class=\"fa fa-id-card\"></i>
                </button></a>";
                $tomboledit = "<a href=\"anggota_edit/" . $field->id . "\"> <button type=\"button\" class=\" btn btn-outline-info\" title=\"Edit Data\"\">
                    <i class=\"fa fa-tags\"></i>
                </button></a>";
                $tombolhapus = "<button type=\"button\" class=\"btn btn-outline-danger\" title=\"Hapus Data\" onclick=\"hapus('" . $field->id . "')\">
                    <i class=\"fa fa-trash\"></i>
                </button>";

                $row[] = "<input type=\"checkbox\" class=\"centangId\" value=\"$field->id\" name=\"id[]\">";
                $row[] = $no;
                $row[] = $field->no_anggota;
                $row[] = $field->nama;
                $row[] = $field->nama_ortu;
                $row[] = $field->ttg;
                $row[] = $field->jenis_kelamin;
                $row[] = $field->gampong;
				$row[] = $field->kecamatan;
				$row[] = $field->kabupaten;
                $row[] = $tombolkartu . ' '.$tomboledit . ' ' . $tombolhapus;
                $data[] = $row;
            }

            $output = array(
                "draw" => $_POST['draw'],
                "recordsTotal" => $this->anggota2->count_all(),
                "recordsFiltered" => $this->anggota2->count_filtered(),
                "data" => $data,
            );
            //output dalam format JSON
            echo json_encode($output);
        } else {
            exit('Maaf data tidak bisa ditampilkan');
        }
    }

    public function formtambah()
    {
        if ($this->input->is_ajax_request() == true) {
            $msg = [
                'sukses' => $this->load->view('admin/anggota/modaltambah', '', true)
            ];
            echo json_encode($msg);
        }
	}
	


    public function simpandata()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $nama = $this->input->post('nama', true);
            $tempat = $this->input->post('tempat', true);
            $tgl = $this->input->post('tgl', true);
            $jenkel = $this->input->post('jenkel', true);

            $this->form_validation->set_rules(
                'id',
                'No.BP',
                'trim|required|is_unique[anggota.id]',
                [
                    'required' => '%s tidak boleh kosong',
                    'is_unique' => '%s sudah ada didalam database'
                ]
            );

            $this->form_validation->set_rules(
                'nama',
                'Nama anggota',
                'trim|required',
                [
                    'required' => '%s tidak boleh kosong',
                ]
            );


            if ($this->form_validation->run() == TRUE) {
                $this->anggota2->simpan($id,$no_anggota,$nama,$jenis_kelamin,$nama_ortu, $ttg,$gampong,$kecamatan);

                $msg = [
                    'sukses' => 'data anggota berhasil disimpan'
                ];
            } else {
                $msg = [
                    'error' => '<div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    ' . validation_errors() . '
                </div>'
                ];
            }

            echo json_encode($msg);
        }
    }

    public function formedit()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);

            $ambildata = $this->anggota2->ambildata($id);

            if ($ambildata->num_rows() > 0) {
                $row = $ambildata->row_array();
                $data = [
                    'id' => $id,
                    'no_anggota' => $row['no_anggota'],
			'nama' => $row['nama'],
			'nama_ortu' => $row['nama_ortu'],
			'ttg' => $row['ttg'],
			'jenis_kelamin' => $row['jenis_kelamin'],
			'gampong' => $row['gampong'],
			'kecamatan' => $row['kecamatan'],
			'kabupaten' => $row['kabupaten']
                ];
            }
            $msg = [
                'sukses' => $this->load->view('admin/anggota/modaledit', $data, true)
            ];

            echo json_encode($msg);
        }
    }

    public function updatedata()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);
            $no_anggota = $this->input->post('no_anggota', true);
            $nama = $this->input->post('nama', true);
            $nama_ortu = $this->input->post('nama_ortu', true);
            $ttg = $this->input->post('ttg', true);
            $jenis_kelamin = $this->input->post('jenis_kelamin', true);
            $id_gampong = $this->input->post('id_gampong', true);
            $gampong =  $this->gampongModel->gampong_name($id_gampong);
            $id_kecamatan = $this->input->post('id_kecamatan', true);
            $kecamatan = $this->kecamatanModel->kecamatan_name($id_kecamatan);
            $kabupaten = $this->input->post('kabupaten', true);


            $this->anggota2->update($id,$no_anggota,$nama,$jenis_kelamin,$nama_ortu, $ttg,$gampong,$kecamatan);

            $msg = [
                'sukses' => 'data anggota berhasil di-update'
            ];
            echo json_encode($msg);
        }
	}
	

    
	
	public function hapus()
    {
        if ($this->input->is_ajax_request() == true) {
            $id = $this->input->post('id', true);

            $hapus = $this->anggota2->hapus($id);

            if ($hapus) {
                $msg = [
                    'sukses' => 'Anggota berhasil terhapus'
                ];
            }
            echo json_encode($msg);
        }
    }

    public function deletemultiple()
    {
        if ($this->input->is_ajax_request() == true) {

            $id = $this->input->post('id', true);
            $jmldata = count($id);

            $hapusdata = $this->anggota2->hapusbanyak($id, $jmldata);

            if ($hapusdata == true) {
                $msg = [
                    'sukses' => "$jmldata data anggota berhasil terhapus"
                ];
            }
            echo json_encode($msg);
        } else {
            exit('Maaf tidak bisa dilanjutkan');
        }
    }
	

	
	function anggota_tambah(){
$data['kecamatan'] = $this->kecamatanModel->view();
		$this->load->view('admin/v_header');
		$this->load->view('admin/anggota/v_anggota_tambah', $data);
		$this->load->view('admin/v_footer');
	}
	
	function anggota_tambah2(){
$data['kecamatan'] = $this->kecamatanModel->view();
		$this->load->view('admin/v_header');
		$this->load->view('admin/anggota/v_anggota_tambah2', $data);
		$this->load->view('admin/v_footer');
	}

	function anggota_tambah_aksi(){
    	$tgl = date('Y-m-d');
		$no_anggota = $this->input->post('no_anggota');
		$nama = $this->input->post('nama');
		$nama_ortu = $this->input->post('nama_ortu');
		$ttg = $this->input->post('ttg');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$id_gampong = $this->input->post('id_gampong');
		$gampong =  $this->gampongModel->gampong_name($id_gampong);
		$id_kecamatan = $this->input->post('id_kecamatan');
		$kecamatan = $this->kecamatanModel->kecamatan_name($id_kecamatan);
		$kabupaten = $this->input->post('kabupaten');

$cek_anggota =  $this->db->query("SELECT * from anggota where no_anggota = '$no_anggota'");

		if($cek_anggota->num_rows() > 0){
		    $data['anggota'] = array(
			'no_anggota' => $no_anggota,
			'nama' => $nama,
			'nama_ortu' => $nama_ortu,
			'ttg' => $ttg,
			'jenis_kelamin' => $jenis_kelamin,
			'gampong' => $gampong,
			'kecamatan' => $kecamatan,
			'kabupaten' => $kabupaten
		);
			redirect(base_url().'admin/anggota_tambah2/', $data);
		}else{
		$data = array(
			'no_anggota' => $no_anggota,
			'nama' => $nama,
			'nama_ortu' => $nama_ortu,
			'ttg' => $ttg,
			'jenis_kelamin' => $jenis_kelamin,
			'gampong' => $gampong,
			'kecamatan' => $kecamatan,
			'tgl_diterima' => $tgl,
			'kabupaten' => $kabupaten
		);

		// insert data ke database
		$this->m_data->insert_data($data,'anggota');
	
}
		// mengalihkan halaman ke halaman data anggota
		
		redirect(base_url().'admin/anggota');
	}
	
	function meninggal_edit($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'meninggal')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_meninggal_edit',$data);
		$this->load->view('admin/v_footer');
	}
	

	function anggota_edit($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_anggota_edit',$data);
		$this->load->view('admin/v_footer');
	}

	function anggota_edit2($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_anggota_edit2',$data);
		$this->load->view('admin/v_footer');

	}

	function anggota_update(){
	    $id = $this->input->post('id');
		$no_anggota = $this->input->post('no_anggota');
		$no_anggota2 = $this->input->post('no_anggota2');
		$nama = $this->input->post('nama');
		$nama_ortu = $this->input->post('nama_ortu');
		$ttg = $this->input->post('ttg');
		$jenis_kelamin = $this->input->post('jenis_kelamin');
		$hari_meninggal = $this->input->post('hari_meninggal');
		$tanggal_meninggal = $this->input->post('tanggal_meninggal');
		$alamat_duka = $this->input->post('alamat_duka');
		$id_gampong = $this->input->post('gampong');
		$kecamatan = $this->input->post('kecamatan');
		$kabupaten = $this->input->post('kabupaten');

		$where = array(
			'id' => $id
		);

		$cek_anggota =  $this->db->query("SELECT * from anggota where no_anggota = '$no_anggota'");

		if($no_anggota == '' && $hari_meninggal == '' && $tanggal_meninggal == '' && $alamat_duka == ''){
			$data = array(	
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $id_gampong,
				'kecamatan' => $kecamatan,
			);
		
			// update data ke database
			$this->m_data->update_data($where,$data,'anggota');
		}elseif($no_anggota == '' && $alamat_duka == ''){
			$data = array(
			
				'no_anggota' => $no_anggota2,
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $id_gampong,
				'kecamatan' => $kecamatan,
			);
		
			// update data ke database
			$this->m_data->update_data($where,$data,'anggota');
		}elseif($no_anggota == '' && $hari_meninggal != '' && $tanggal_meninggal != '' && $alamat_duka != ''){
			$data = array(
				'no_anggota' => $no_anggota2,
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $id_gampong,
				'kecamatan' => $kecamatan,
				'kabupaten' => 'Bireun',
				'hari_meninggal' => $hari_meninggal,
				'tanggal_meninggal' => $tanggal_meninggal,
				'alamat_duka' => $alamat_duka
			);
			$this->MNotif->sendNotifAndroid("Jamaah Meninggal", $jenis_kelamin == "L" ? $nama ." Bin " .$nama_ortu: $nama ." Binti ".$nama_ort,$data);
			$this->m_data->insert_meninggal($where,$data,'meninggal');

		}elseif($cek_anggota->num_rows() > 0 && $alamat_duka == ''){
			redirect(base_url().'admin/anggota_edit2/'.$id);
		}else{
			$data = array(
			
				'no_anggota' => $no_anggota,
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $id_gampong,
				'kecamatan' => $kecamatan,
			);
		
			// update data ke database
			$this->m_data->update_data($where,$data,'anggota');
		}
		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'admin/anggota');
	}


	function data_meninggal_update(){
	    $id = $this->input->post('id');
		$hari_meninggal = $this->input->post('hari_meninggal');
		$tanggal_meninggal = $this->input->post('tanggal_meninggal');
		$alamat_duka = $this->input->post('alamat_duka');

		$where = array(
			'id' => $id
		);


			$data = array(
				'hari_meninggal' => $hari_meninggal,
				'tanggal_meninggal' => $tanggal_meninggal,
				'alamat_duka' => $alamat_duka
			);

			$this->m_data->update_data($where,$data,'meninggal');
		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'admin/anggota_udah_meninggal');
	}


	function anggota_hapus($id){
		$where = array(
			'id' => $id
		);

		// menghapus data anggota dari database sesuai id
		$this->m_data->delete_data($where,'anggota');

		// mengalihkan halaman ke halaman data anggota
		redirect(base_url().'admin/anggota');
	}

	function anggota_kartu($id){
		$where = array('id' => $id);
		// mengambil data dari database sesuai id
		$data['anggota'] = $this->m_data->edit_data($where,'anggota')->result();
		$this->load->view('admin/v_anggota_kartu',$data);
	}
	// akhir anggota

	// crud kelas
	function kelas(){
		// mengambil data dari database
		$data['kelas'] = $this->m_data->get_data('kelas')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_kelas',$data);
		$this->load->view('admin/v_footer');
	}

		function kelas_tambah(){
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_kelas_tambah');
			$this->load->view('admin/v_footer');
		}

		function kelas_tambah_aksi(){
			$kelas = $this->input->post('kelas');
		

			$data = array(
				'kelas' => $kelas,
				
				'status' => $status
			);

			// insert data ke database
			$this->m_data->insert_data($data,'kelas');

			// mengalihkan halaman ke halaman data kelas
			redirect(base_url().'admin/kelas');
		}

		function kelas_edit($id){
			$where = array('id' => $id);
			// mengambil data dari database sesuai id
			$data['kelas'] = $this->m_data->edit_data($where,'kelas')->result();
			$this->load->view('admin/v_header');
			$this->load->view('admin/v_kelas_edit',$data);
			$this->load->view('admin/v_footer');
		}

		function kelas_update(){
			$id = $this->input->post('id');
			$kelas = $this->input->post('kelas');
		
			$status = $this->input->post('status');

			$where = array(
				'id' => $id
			);

			$data = array(
				'kelas' => $kelas,
				
				'status' => $status
			);

			// update data ke database
			$this->m_data->update_data($where,$data,'kelas');

			// mengalihkan halaman ke halaman data kelas
			redirect(base_url().'admin/kelas');
		}


		function kelas_hapus($id){
			$where = array(
				'id' => $id
			);

			// menghapus data kelas dari database sesuai id
			$this->m_data->delete_data($where,'kelas');

			// mengalihkan halaman ke halaman data kelas
			redirect(base_url().'admin/kelas');
		}
		// akhir crud kelas
	
	// akhir crud Ebook

	/**************** start upload*******************************/


		function create()
		{
			$this->load->view('admin/v_upload');
		}

		function proses()
		{
			$config['upload_path']          = './upload/pdf';
			$config['allowed_types']        = 'pdf';
			$config['max_size']             = 10000;
			$config['max_width']            = 1024;
			$config['max_height']           = 768;
			$config['encrypt_name']			= TRUE;
			$this->load->library('upload', $config);
			if ( ! $this->upload->do_upload('berkas'))
			{
					$error = array('error' => $this->upload->display_errors());
					$this->load->view('admin/v_upload', $error);
			}
			else
			{
				$data['nama'] = $this->upload->data("file_name");
				$data['ket'] = $this->input->post('ket');
				$data['tipe'] = $this->upload->data('file_ext');
				$data['ukuran'] = $this->upload->data('file_size');
				$this->db->insert('berkas',$data);
				redirect(base_url().'admin/ebook?pesan=berhasil');
			}
		}
	/*
		public function index()
		{
			$data['berkas'] = $this->db->get('berkas');
			$this->load->view('tampil_berkas',$data);
		}

	*/
	function download($id1)
	{
		$data = $this->db->get_where('berkas',['id'=>$id1])->row();
		force_download('upload/pdf/'.$data->nama,NULL);
	}
/********************end upload******************************/
	// proses transaksi_pengajian
	function pengajian(){
		// mengambil data pengajian kelas dari database | dan mengurutkan data dari id pengajian terbesar ke terkecil (desc)
		$data['pengajian'] = $this->db->query("select * from pengajian,kelas,anggota where pengajian.pengajian_kelas=kelas.id and pengajian.pengajian_anggota=anggota.id order by pengajian_id desc")->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_pengajian',$data);
		$this->load->view('admin/v_footer');
	}

	function pengajian_tambah(){
		// mengambil data kelas yang berstatus 1 (tersedia) dari database
		$where = array('status'=>1);
		$data['kelas'] = $this->m_data->edit_data($where,'kelas')->result();
		// mengambil data anggota dari database
		$data['anggota'] = $this->m_data->get_data('anggota')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_pengajian_tambah',$data);
		$this->load->view('admin/v_footer');
	}

	function pengajian_aksi(){
		$kelas = $this->input->post('kelas');
		$anggota = $this->input->post('anggota');
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$tanggal_sampai = $this->input->post('tanggal_sampai');

		$data = array(
			'pengajian_kelas' => $kelas,
			'pengajian_anggota' => $anggota,
			'pengajian_tanggal_mulai' => $tanggal_mulai,
			'pengajian_tanggal_sampai' => $tanggal_sampai,
			'pengajian_status' => 2
		);

		// insert data ke database
		$this->m_data->insert_data($data,'pengajian');


		// mengubah status kelas menjadi di pinjam (2)
		$w = array(
			'id' => $kelas
		);
		$d = array(
			'status' => 2
		);
		$this->m_data->update_data($w,$d,'kelas');

		// mengalihkan halaman ke halaman data pengajian
		redirect(base_url().'admin/pengajian');
	}

	function pengajian_batalkan($id){
		$where = array(
			'pengajian_id' => $id
		);

		// mengambil data kelas pada pengajian ber id tersebut
		$data = $this->m_data->edit_data($where,'pengajian')->row();
		$kelas = $data->pengajian_kelas;

		// mengembalikan status kelas kembali ke tersedia (1)
		$w = array(
			'id' => $kelas
		);
		$d = array(
			'status' => 1
		);
		$this->m_data->update_data($w,$d,'kelas');

		// menghapus data pengajian dari database sesuai id
		$this->m_data->delete_data($where,'pengajian');

		// mengalihkan halaman ke halaman data kelas
		redirect(base_url().'admin/pengajian');
	}

	function pengajian_selesai($id){
		$where = array(
			'pengajian_id' => $id
		);

		// mengambil data kelas pada pengajian ber id tersebut
		$data = $this->m_data->edit_data($where,'pengajian')->row();
		$kelas = $data->pengajian_kelas;

		// mengembalikan status kelas kembali ke tersedia (1)
		$w = array(
			'id' => $kelas
		);
		$d = array(
			'status' => 1
		);
		$this->m_data->update_data($w,$d,'kelas');

		// mengubah status pengajian menjadi selesai (1)
		$this->m_data->update_data($where,array('pengajian_status'=>1),'pengajian');


		// mengalihkan halaman ke halaman data kelas
		redirect(base_url().'admin/pengajian');
	}

	// pengajian
	function pengajian_laporan(){
		if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])){
			$mulai = $this->input->get('tanggal_mulai');
			$sampai = $this->input->get('tanggal_sampai');
			// mengambil data pengajian berdasarkan tanggal mulai sampai tanggal sampai
			$data['pengajian'] = $this->db->query("select * from pengajian,kelas,anggota where pengajian.pengajian_kelas=kelas.id and pengajian.pengajian_anggota=anggota.id and date(pengajian_tanggal_mulai) >= '$mulai' and date(pengajian_tanggal_mulai) <= '$sampai' order by pengajian_id desc")->result();
		}else{
			// mengambil data pengajian kelas dari database | dan mengurutkan data dari id pengajian terbesar ke terkecil (desc)
			$data['pengajian'] = $this->db->query("select * from pengajian,kelas,anggota where pengajian.pengajian_kelas=kelas.id and pengajian.pengajian_anggota=anggota.id order by pengajian_id desc")->result();
		}
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_pengajian_laporan',$data);
		$this->load->view('admin/v_footer');
	}

	function pengajian_cetak(){
		if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai'])){
			$mulai = $this->input->get('tanggal_mulai');
			$sampai = $this->input->get('tanggal_sampai');
			// mengambil data pengajian berdasarkan tanggal mulai sampai tanggal sampai
			$data['pengajian'] = $this->db->query("select * from pengajian,kelas,anggota where pengajian.pengajian_kelas=kelas.id and pengajian.pengajian_anggota=anggota.id and date(pengajian_tanggal_mulai) >= '$mulai' and date(pengajian_tanggal_mulai) <= '$sampai' order by pengajian_id desc")->result();
			$this->load->view('admin/v_pengajian_cetak',$data);
		}else{
			redirect(base_url().'admin/pengajian');
		}
	}
	// akhir pengajian
	////////////////////////////////////////////////////////////////////////////
//------- crud data guru---//

// crud guru
function guru(){
	// mengambil data dari database
	$data['guru'] = $this->m_data->get_data('guru')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/v_guru',$data);
	$this->load->view('admin/v_footer');
}

function guru_tambah(){
	$this->load->view('admin/v_header');
	$this->load->view('admin/v_guru_tambah');
	$this->load->view('admin/v_footer');
}

function guru_tambah_aksi(){
	$nama = $this->input->post('nama');
	$username = $this->input->post('username');
	$password = $this->input->post('password');

	$data = array(
		'nama' => $nama,
		'username' => $username,
		'password' => md5($password)
	);

	// insert data ke database
	$this->m_data->insert_data($data,'guru');

	// mengalihkan halaman ke halaman data ketua_kecamatan
	redirect(base_url().'admin/guru');
}

function guru_edit($id){
	$where = array('id' => $id);
	// mengambil data dari database sesuai id
	$data['guru'] = $this->m_data->edit_data($where,'guru')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/v_guru_edit',$data);
	$this->load->view('admin/v_footer');
}

function guru_update(){
	$id = $this->input->post('id');
	$nama = $this->input->post('nama');
	$username = $this->input->post('username');
	$password = $this->input->post('password');

	$where = array(
		'id' => $id
	);

	// cek apakah form password di isi atau tidak
	if($password==""){
		$data = array(
			'nama' => $nama,
			'username' => $username
		);

		// update data ke database
		$this->m_data->update_data($where,$data,'guru');
	}else{
		$data = array(
			'nama' => $nama,
			'username' => $username,
			'password' => md5($password)
		);

		// update data ke database
		$this->m_data->update_data($where,$data,'guru');
	}

	// mengalihkan halaman ke halaman data guru
	redirect(base_url().'admin/guru');
}


function guru_hapus($id){
	$where = array(
		'id' => $id
	);

	// menghapus data guru dari database sesuai id
	$this->m_data->delete_data($where,'guru');

	// mengalihkan halaman ke halaman data ketua_kecamatan
	redirect(base_url().'admin/guru');
}
// akhir CRUD guru

////////////////////////////////////////////////////////////////////////////
//------- crud data ketua_gampong---//

// crud ketua_gampong
function ketua_gampong(){
// mengambil data dari database
$data['ketua_gampong'] = $this->m_data->get_data('ketua_gampong')->result();
$this->load->view('admin/v_header');
$this->load->view('admin/v_ketua_gampong',$data);
$this->load->view('admin/v_footer');
}



function ketua_gampong_tambah(){
$data['kecamatan'] = $this->kecamatanModel->view();
$this->load->view('admin/v_header');
$this->load->view('admin/v_ketua_gampong_tambah', $data);
$this->load->view('admin/v_footer');
}

function ketua_gampong_tambah_aksi(){
$id_kecamatan = $this->input->post('id_kecamatan');
$kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
$id_gampong = $this->input->post('id_gampong');
$ketua_gampong =  $this->gampongModel->gampong_name($id_gampong);

$data = array(
	'kecamatan' => $kecamatan,
	'ketua_gampong' => $ketua_gampong
);

// insert data ke database
$this->m_data->insert_data($data,'ketua_gampong');

// mengalihkan halaman ke halaman data ketua_kecamatan
redirect(base_url().'admin/ketua_gampong');
}

function ketua_gampong_edit($id){
$where = array('id' => $id);
$data['kecamatan'] = $this->kecamatanModel->view();
// mengambil data dari database sesuai id
$data['ketua_gampong'] = $this->m_data->edit_data($where,'ketua_gampong')->result();
$this->load->view('admin/v_header');
$this->load->view('admin/v_ketua_gampong_edit',$data);
$this->load->view('admin/v_footer');
}

function ketua_gampong_update(){
$id = $this->input->post('id');
$id_kecamatan = $this->input->post('id_kecamatan');
$kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
$id_gampong = $this->input->post('id_gampong');
$ketua_gampong =  $this->gampongModel->gampong_name($id_gampong);

$where = array(
	'id' => $id
);

// cek apakah form password di isi atau tidak
if($kecamatan !='' && $ketua_gampong != ''){
	$data = array(
		'kecamatan' => $kecamatan,
		'ketua_gampong' => $ketua_gampong,
		); 

	// update data ke database
	$this->m_data->update_data($where,$data,'ketua_gampong');
}elseif($kecamatan =='' && $ketua_gampong == ''){
	redirect(base_url().'admin/ketua_gampong');

}
// mengalihkan halaman ke halaman data guru
redirect(base_url().'admin/ketua_gampong');
}


function ketua_gampong_hapus($id){
$where = array(
	'id' => $id
);

// menghapus data guru dari database sesuai id
$this->m_data->delete_data($where,'ketua_gampong');

// mengalihkan halaman ke halaman data ketua_kecamatan
redirect(base_url().'admin/ketua_gampong');
}
// akhir CRUD ketua_gampong


// crud ketua_kelas
function ketua_kelas(){
// mengambil data dari database
$data['ketua_kelas'] = $this->m_data->get_data('kelas')->result();
$this->load->view('admin/v_header');
$this->load->view('admin/v_ketua_kelas',$data);
$this->load->view('admin/v_footer');
}

function ketua_kelas_tambah(){
	$data['kecamatan'] = $this->kecamatanModel->view();
$this->load->view('admin/v_header');
$this->load->view('admin/v_ketua_kelas_tambah', $data);
$this->load->view('admin/v_footer');
}

function pilah(){
	$data['kecamatan'] = $this->kecamatanModel->view();
$this->load->view('admin/v_header');
$this->load->view('admin/anggota/v_pilah', $data);
$this->load->view('admin/v_footer');
}

function pilah_aksi(){
	$id_kecamatan = $this->input->post('id_kecamatan');
	$kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
	$id_gampong = $this->input->post('id_gampong');
	$gampong =  $this->persiswaModel->gampong_name3($id_gampong);

	$data['pilah'] = array(
		'gampong' => $gampong
	);

	$data_session = array(
		'kecamatan' => $kecamatan,
		'id_gampong' => $id_gampong,
		'kelas2' => $gampong
	);

	$this->session->set_userdata($data_session);

	$data['anggota'] = $this->m_data->get_data('anggota')->result();

	// insert data ke database
	// mengalihkan halaman ke halaman data ketua_kecamatan
	redirect(base_url().'admin/pilah_mana',$data);
}

function pilah_mana(){
	$table = $this->session->userdata('id_gampong');
	$table2 = $this->kecamatanModel->jeka($table);
	$table3 = $this->kecamatanModel->gampong($table);
		$data['nama'] = $this->db->query("SELECT count(nama) as nama from anggota WHERE id_kelas = '$table'")->result_array();
$data['pilah'] = $this->db->query("SELECT * from kelas where id = '$table'")->result();
$data['anggota'] = $this->m_data->get_data_ketua_kecamatan($this->session->userdata('kecamatan'), $table2, $table3)->result();
$this->load->view('admin/v_header');
$this->load->view('admin/anggota/v_pilah_mana',$data);
$this->load->view('admin/v_footer');
}


function pilah_tambahkan($id){
	$where = array(
		'id' => $id
	);

	// mengambil data buku pada peminjaman ber id tersebut
	$data = $this->m_data->edit_data($where,'anggota')->row();
	
	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('id_kelas'=>$this->session->userdata('id_gampong')),'anggota');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'admin/pilah_mana');
}

function ketua_kelas_tambah_aksi(){
$nama = $this->input->post('nama');
$hp = $this->input->post('hp');
$wali = $this->input->post('wali');
$hp_wali = $this->input->post('hp_wali');
$username = $this->input->post('username');
$jenis_kelamin = $this->input->post('jenis_kelamin');
$majelis = $this->input->post('majelis');
$id_kecamatan = $this->input->post('id_kecamatan');
$kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
$id_gampong = $this->input->post('id_gampong');
$gampong =  $this->gampongModel->gampong_name($id_gampong);
$password = $this->input->post('password');

$data = array(
	'nama' => $nama,
	'hp' => $hp,
	'majelis' => $majelis,
	'username' => $username,
	'gampong' => $gampong,
	'kecamatan' => $kecamatan,
	'kelas' => $jenis_kelamin,
	'wali' => $wali,
	'hp_wali' => $hp_wali,
	'password' => md5($password)
);

// insert data ke database
$this->m_data->insert_data($data,'kelas');

// mengalihkan halaman ke halaman data ketua_kecamatan
redirect(base_url().'admin/ketua_kelas');
}

function ketua_kelas_edit($id){
	$data['kecamatan'] = $this->kecamatanModel->view();

$where = array('id' => $id);
// mengambil data dari database sesuai id
$data['ketua_kelas'] = $this->m_data->edit_data($where,'kelas')->result();
$this->load->view('admin/v_header');
$this->load->view('admin/v_ketua_kelas_edit',$data);
$this->load->view('admin/v_footer');
}

function ketua_kelas_update(){
$id = $this->input->post('id');
$wali = $this->input->post('wali');
$hp_wali = $this->input->post('hp_wali');
$nama = $this->input->post('nama');
$hp = $this->input->post('hp');
$majelis = $this->input->post('majelis');
$username = $this->input->post('username');
$id_kecamatan = $this->input->post('id_kecamatan');
$kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
$id_gampong = $this->input->post('id_gampong');
$gampong =  $this->gampongModel->gampong_name($id_gampong);
$password = $this->input->post('password');

$where = array(
	'id' => $id
);

// cek apakah form password di isi atau tidak
if($password==""){
	$data = array(
		'nama' => $nama,
		'username' => $username,
		'hp' => $hp,
		'majelis' => $majelis,
		'wali' => $wali,
		'hp_wali' => $hp_wali,
	);

	// update data ke database
	$this->m_data->update_data($where,$data,'kelas');
}else{
	$data = array(
		'nama' => $nama,
		'username' => $username,
		'hp' => $hp,
		'majelis' => $majelis,
		'wali' => $wali,
		'hp_wali' => $hp_wali,
		'password' => md5($password)
	);

	// update data ke database
	$this->m_data->update_data($where,$data,'kelas');
}

// mengalihkan halaman ke halaman data guru
redirect(base_url().'admin/ketua_kelas');
}


function ketua_kelas_hapus($id){
$where = array(
	'id' => $id
);

// menghapus data guru dari database sesuai id
$this->m_data->delete_data($where,'kelas');

// mengalihkan halaman ke halaman data ketua_kecamatan
redirect(base_url().'admin/ketua_kelas');
}

function surat_peringatan(){
	// mengambil data absen admin dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
	$data['peringatan'] = $this->m_data->get_data_peringatan()->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/v_surat_peringatan',$data);
	$this->load->view('admin/v_footer');
}

function surat_pemberhentian(){
	// mengambil data absen admin dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
	$data['pemberhentian'] = $this->m_data->get_data_pemberhentian()->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/v_surat_pemberhentian',$data);
	$this->load->view('admin/v_footer');
}

function verifikasi(){
	// mengambil data absen admin dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
	$data['verifikasi'] = $this->m_data->get_data('baru')->result();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/v_verifikasi',$data);
	$this->load->view('admin/v_footer');
}
	

	
	function absen(){
		// mengambil data absen admin dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
		$data['absensi'] = $this->m_data->get_data_kelas_tanggal($this->session->userdata('id_kelas'),$this->session->userdata('tanggal_mulai'))->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/absen/v_absen',$data);
		$this->load->view('admin/v_footer');
	}

	function absen_isi(){
		$data['kecamatan'] = $this->kecamatanModel->view();
		// mengambil data absen admin dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
		$this->load->view('admin/v_header');
		$this->load->view('admin/absen/v_absen_isi', $data);
		$this->load->view('admin/v_footer');
	}
	
	function absen_tidak(){
		$data['kecamatan'] = $this->kecamatanModel->view();
		// mengambil data absen admin dari database | dan mengurutkan data dari id absen terbesar ke terkecil (desc)
		$this->load->view('admin/v_header');
		$this->load->view('admin/absen/v_absen_tidak', $data);
		$this->load->view('admin/v_footer');
	}

	function absen_aksi_isi(){
		$id_kecamatan = $this->input->post('id_kecamatan');
		$kecamatan =  $this->kecamatanModel->kecamatan_name($id_kecamatan);
		$id_gampong = $this->input->post('id_gampong');
		$gampong =  $this->persiswaModel->gampong_name3($id_gampong);
	
	$cek_anggota =  $this->db->query("SELECT * from anggota where id_kelas = '$id_gampong'");

		if($cek_anggota->num_rows() == 0){
			redirect(base_url(). 'admin/absen_tidak');
		}else{
		$data['pilah'] = array(
			'gampong' => $gampong,
		);
	
		$data_session = array(
			'kecamatan3' => $kecamatan,
			'id_gampong3' => $id_gampong,
			'kelas3' => $gampong
		);
	
		$this->session->set_userdata($data_session);
		// insert data ke database
		// mengalihkan halaman ke halaman data ketua_kecamatan
		redirect(base_url().'admin/absen_tambah',$data);
		}
	}

	function absen_tambah(){
		$data['absensi'] =$this->m_data->get_data_kelas_id($this->session->userdata('id_gampong3'))->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/absen/v_absen_tambah',$data);
		$this->load->view('admin/v_footer');
	}

	function absen_aksi(){
		$id = $this->input->post('id');
		$tanggal_mulai = $this->input->post('tanggal_mulai');
		$jam_pengajian = $this->input->post('jam_pengajian');
		$id_kelas = $this->input->post('id_kelas');
		$nama = $this->input->post('nama');
		$hari = $this->input->post('hari');
		$absen = $this->input->post('absen');
		$kelas = $this->input->post('kelas');
		$gampong = $this->session->userdata('gampong');
		$ket_pengajian = $this->input->post('ket_pengajian');
		$data = array();

		$cek_anggota =  $this->db->query("SELECT * from absensi where id_kelas = '$id_kelas' AND tanggal_mulai = '$tanggal_mulai' ");

		if($cek_anggota->num_rows() > 0){
			$data_session = array(
				'tanggal_mulai' => $tanggal_mulai,
				'id_kelas' => $id_kelas
			);
		
			$this->session->set_userdata($data_session);
			// mengalihkan halaman ke halaman data absen
			redirect(base_url(). 'admin/absen', $this->session->userdata('tanggal_mulai'));
		}else{
		foreach($id as $id)
		array_push($data, array(
			'hari' => $hari,
			'id_anggota' => $id,
			'id_kelas' => $id_kelas,
			'tanggal_mulai' => $tanggal_mulai,
			'jam_pengajian' => $jam_pengajian,
			'ket_pengajian' => $ket_pengajian,
			'kelas' => $kelas,
			'gampong' => $gampong,
			'absen' => $absen
		));

		$data_session = array(
			'tanggal_mulai' => $tanggal_mulai,
			'id_kelas' => $id_kelas
		);
	
		$this->session->set_userdata($data_session);

		$this->load->view('admin/v_footer');
	
		// insert data ke database
		$this->m_data->save_batch($data,'absensi');

		// mengalihkan halaman ke halaman data absen
		redirect(base_url(). 'admin/absen', $this->session->userdata('tanggal_mulai'));
	}
}


	function absen_sakit($id){
		$where = array(
			'absensi_id' => $id
		);

		// mengambil data buku pada peminjaman ber id tersebut
		$data = $this->m_data->edit_data($where,'absensi')->row();
		
		// mengubah status peminjaman menjadi selesai (1)
		$this->m_data->update_data_absen($where,array('absen'=>1),'absensi');


		// mengalihkan halaman ke halaman data buku
		redirect(base_url().'admin/absen');
	}

	function absen_izin($id){
		$where = array(
			'absensi_id' => $id
		);

		// mengambil data buku pada peminjaman ber id tersebut
		$data = $this->m_data->edit_data($where,'absensi')->row();
		
		// mengubah status peminjaman menjadi selesai (1)
		$this->m_data->update_data_absen($where,array('absen'=>3),'absensi');


		// mengalihkan halaman ke halaman data buku
		redirect(base_url().'admin/absen');
	}

	function absen_masuk($id){
		$where = array(
			'absensi_id' => $id
		);

		// mengambil data buku pada peminjaman ber id tersebut
		$data = $this->m_data->edit_data($where,'absensi')->row();
		
		// mengubah status peminjaman menjadi selesai (1)
		$this->m_data->update_data_absen($where,array('absen'=>4),'absensi');


		// mengalihkan halaman ke halaman data buku
		redirect(base_url().'admin/absen');
	}

	function absen_alpa($id){
		$where = array(
			'absensi_id' => $id
		);

		// mengambil data buku pada peminjaman ber id tersebut
		$data = $this->m_data->edit_data($where,'absensi')->row();
		
		// mengubah status peminjaman menjadi selesai (1)
		$this->m_data->update_data_absen($where,array('absen'=>5),'absensi');


		// mengalihkan halaman ke halaman data buku
		redirect(base_url().'admin/absen');
	}
	// absen
	function absen_laporan(){
		$data['kecamatan'] = $this->kecamatanModel->view();
	if(isset($_GET['id_gampong']) && isset($_GET['tanggal_mulai'])){
		$table = $this->input->get('tanggal_mulai');
		$table2 = $this->input->get('id_gampong');
		$data['absensi'] = $this->db->query("SELECT * from absensi inner join anggota on absensi.id_anggota = anggota.id and absensi.id_kelas = '$table2'  AND tanggal_mulai = '$table' order by absensi_id DESC")->result();
	}else{
		$data['absensi'] = $this->db->query("SELECT * from absensi inner join anggota on absensi.id_anggota = anggota.id order by absensi_id desc")->result();
	}
		$this->load->view('admin/v_header');
		$this->load->view('admin/absen/v_absen_laporan',$data);
		$this->load->view('admin/v_footer');
	}

	
	
	function iuran_laporan(){
		$data['kecamatan'] = $this->kecamatanModel->view();
		if(isset($_GET['id_gampong']) && isset($_GET['tanggal_iuran'])){
			$mulai = $this->input->get('tanggal_iuran');
			$id_gampong = $this->input->get('id_gampong');
			$tanggal1 = explode('-', $mulai);
            $bulan = $tanggal1[0];
            $tahun   = $tanggal1[1];
			$data['iuran'] = $this->db->query("SELECT * from iuran WHERE (id_kelas = '$id_gampong'  AND MONTH(tanggal_iuran) = '$bulan' AND YEAR(tanggal_iuran) = '$tahun') order by iuran_id desc")->result();
		}else{
			$data['iuran'] = $this->db->query("SELECT * from iuran order by iuran_id desc")->result();
		}
		$this->load->view('admin/v_header');
		$this->load->view('admin/iuran/v_iuran_laporan',$data);
		$this->load->view('admin/v_footer');
	}

	function iuran_laporan_perbulan(){
		$kecamatan = $this->m_data->get_data('ketua_kecamatan')->result();
		$data['gampong'] = $this->m_data->get_data('ketua_kecamatan')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/iuran/v_iuran_perbulan_laporan',$data);
		$this->load->view('admin/v_footer');
		
	}

	function iuran_laporan_pertahun(){
		$data['gampong'] = $this->m_data->get_data('ketua_kecamatan')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/iuran/v_iuran_pertahun_laporan',$data);
		$this->load->view('admin/v_footer');
	}

	function anggota_udah_meninggal(){
		// mengambil data dari database
		$data['anggota'] = $this->m_data->get_data('meninggal')->result();
		$this->load->view('admin/v_header');
		$this->load->view('admin/v_anggota_meninggal',$data);
		$this->load->view('admin/v_footer');
	}

	function meninggal_laporan(){
		$data['gampong'] =$this->m_data->get_data('ketua_gampong')->result();
		if(isset($_GET['tanggal_mulai']) && isset($_GET['tanggal_sampai']) && isset($_GET['id_gampong'])){
			$id_gampong = $this->input->get('id_gampong');
			$gampong = $this->m_data->nama_gampong($id_gampong);
			$mulai = $this->input->get('tanggal_mulai');
			$sampai = $this->input->get('tanggal_sampai');
			$data['meninggal'] = $this->db->query("SELECT * from meninggal WHERE (gampong = '$gampong' AND date(tanggal_meninggal) >= '$mulai' and date(tanggal_meninggal) <= '$sampai' ) order by id asc")->result();
		}else{
			$data['meninggal'] = $this->db->query("SELECT * from meninggal order by id asc")->result();
		}
		$this->load->view('admin/v_header');
		$this->load->view('admin/meninggal/v_meninggal_laporan',$data);
		$this->load->view('admin/v_footer');
	}

function absen_persiswa_laporan(){
	$data['kecamatan'] = $this->kecamatanModel->view();
	$data['gampong'] = $this->ketgamModel->view();
	if(isset($_GET['bulan']) && isset($_GET['tahun']) && isset($_GET['nama']) && isset($_GET['kelas']) && isset($_GET['gampong'])){
		$tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $nama = $this->input->get('nama');
        $gampong = $this->input->get('gampong');
		$data['absensi'] = $this->db->query("SELECT gampong = '$gampong' AND nama = '$nama' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' ) order by absensi_id desc")->result();
	}else{
		$data['absensi'] = $this->db->query("SELECT * from absensi order by absensi_id desc")->result();
	}
	$this->load->view('admin/v_header');
	$this->load->view('admin/absen/v_absen_persiswa_laporan',$data);
	$this->load->view('admin/v_footer');
}

function rekap_anggota_baru_perbulan(){
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/v_rekap_anggota_baru_perbulan');
	$this->load->view('admin/v_footer');
}

function rekap_anggota_baru_pertahun(){
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/v_rekap_anggota_baru_pertahun');
	$this->load->view('admin/v_footer');
}

function rekap_pemberhentian_perbulan(){
	$data['kecamatan'] = $this->kecamatanModel->view();
	$data['gampong'] = $this->ketgamModel->view();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/v_rekap_pemberhentian_perbulan',$data);
	$this->load->view('admin/v_footer');
}

function rekap_pemberhentian_pertahun(){
	$data['kecamatan'] = $this->kecamatanModel->view();
	$data['gampong'] = $this->ketgamModel->view();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/v_rekap_pemberhentian_pertahun',$data);
	$this->load->view('admin/v_footer');
}

function rekap_peringatan_perbulan(){
	$data['kecamatan'] = $this->kecamatanModel->view();
	$data['gampong'] = $this->ketgamModel->view();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/v_rekap_peringatan_perbulan',$data);
	$this->load->view('admin/v_footer');
}

function rekap_peringatan_pertahun(){
	$data['kecamatan'] = $this->kecamatanModel->view();
	$data['gampong'] = $this->ketgamModel->view();
	$this->load->view('admin/v_header');
	$this->load->view('admin/surat/v_rekap_peringatan_pertahun',$data);
	$this->load->view('admin/v_footer');
}

		function anggota_perkecamatan(){
	$data['gampong'] = $this->m_data->get_data('ketua_kecamatan')->result();
	if(isset($_GET['bulan']) && isset($_GET['tahun']) && isset($_GET['nama']) && isset($_GET['kelas']) && isset($_GET['gampong'])){
		$tahun = $this->input->get('tahun');
        $bulan = $this->input->get('bulan');
        $nama = $this->input->get('nama');
        $gampong = $this->input->get('gampong');
		$data['absensi'] = $this->db->query("SELECT gampong = '$gampong' AND nama = '$nama' AND MONTH(tanggal_mulai) = '$bulan' AND YEAR(tanggal_mulai) = '$tahun' ) order by absensi_id desc")->result();
	}else{
		$data['absensi'] = $this->db->query("SELECT * from absensi order by absensi_id desc")->result();
	}
	$this->load->view('admin/v_header');
	$this->load->view('admin/anggota/v_anggota_perkecamatan_laporan',$data);
	$this->load->view('admin/v_footer');
}


function anggota_permajelis(){
	// mengambil data dari database
	$data['kecamatan'] = $this->kecamatanModel->view();
	$this->load->view('admin/v_header');
	$this->load->view('admin/anggota/v_anggota_permajelis',$data);
	$this->load->view('admin/v_footer');
}

function terima_verifikasi($id){
	$tgl = date('Y-m-d');
	
		$no = $this->gampongModel->data_no($id);
		$nama = $this->gampongModel->data_nama($id);
		$nama_ortu = $this->gampongModel->data_ortu($id);
		$ttg = $this->gampongModel->data_ttg($id);
		$jenis_kelamin = $this->gampongModel->data_jk($id);
		$id_gampong = $this->gampongModel->data_gampong($id);
		$kecamatan = $this->gampongModel->data_kecamatan($id);


	$where = array(
		'id' => $id
	);

	            $data = array(
				'no_anggota' => $no,
				'nama' => $nama,
				'nama_ortu' => $nama_ortu,
				'ttg' => $ttg,
				'jenis_kelamin' => $jenis_kelamin,
				'gampong' => $id_gampong,
				'kecamatan' => $kecamatan,
				'kabupaten' => 'Bireuen',
				'tgl_diterima' => $tgl
				
				);

	$this->m_data->insert_baru($where,$data,'anggota');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'admin/verifikasi/');
}

function tolak_verifikasi($id){
	$where = array(
		'id' => $id
	);



	// mengubah status peminjaman menjadi selesai (1)
		$this->m_data->delete_data($where,'baru');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'admin/verifikasi/');
}


function terima_peringatan($id){
	$tgl = date('Y-m-d');

	$where = array(
		'id' => $id
	);

	$data = array(
		'id_anggota' => $id,
		'tanggal' => $tgl
	);

	$this->m_data->insert_data($data,'peringatan');

	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('peringatan'=>2),'anggota');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'admin/surat_peringatan/');
}

function tolak_peringatan($id){
	$where = array(
		'id' => $id
	);



	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('peringatan'=>0),'anggota');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'admin/surat_peringatan/');
}


function terima_pemberhentian($id){
	$tgl = date('Y-m-d');

	$where = array(
		'id' => $id
	);

	$data = array(
		'id_anggota' => $id,
		'tanggal' => $tgl
	);

	$data = $this->m_data->edit_data($where,'anggota')->row();
	
	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('tgl_berhenti'=>$tgl),'anggota');
	$this->m_data->update_data_absen($where,array('pemberhentian'=>2),'anggota');
	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'admin/surat_pemberhentian/');
}

function tolak_pemberhentian($id){
	$where = array(
		'id' => $id
	);



	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('pemberhentian'=>0),'anggota');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'admin/surat_pemberhentian/');
}

function pilah_kembalikan(){
	$table = $this->session->userdata('id_gampong');
	$table2 = $this->kecamatanModel->jeka($table);
	$table3 = $this->kecamatanModel->gampong($table);
$data['nama'] = $this->db->query("SELECT count(nama) as nama from anggota WHERE id_kelas = '$table'")->result_array();
$data['pilah'] = $this->db->query("SELECT * from kelas where id = '$table'")->result();
$data['anggota'] = $this->m_data->get_data_kelas_kembali($table)->result();
$this->load->view('admin/v_header');
$this->load->view('admin/anggota/v_pilah_kembalikan',$data);
$this->load->view('admin/v_footer');
}

function pilah_kembali($id){
	$where = array(
		'id' => $id
	);

	// mengambil data buku pada peminjaman ber id tersebut
	$data = $this->m_data->edit_data($where,'anggota')->row();
	
	// mengubah status peminjaman menjadi selesai (1)
	$this->m_data->update_data_absen($where,array('id_kelas'=>0),'anggota');


	// mengalihkan halaman ke halaman data buku
	redirect(base_url().'admin/pilah_kembalikan');
}

public function hapus2($id)
{
	return $this->db->delete('anggota', ['id' => $id]);
}

public function hapusbanyak($id, $jmldata)
{
	for ($i = 0; $i < $jmldata; $i++) {
		$this->db->delete('anggota', ['id' => $id[$i]]);
	}

	return true;
}

	function absen_kelas(){
		$data['kecamatan'] = $this->kecamatanModel->view();
	$this->load->view('admin/v_header');
	$this->load->view('admin/absen_ketua/v_absen_kelas',$data);
	$this->load->view('admin/v_footer');
	}

	function absen_kecamatan(){
		$data['kecamatan'] = $this->db->query("SELECT * from ketua_kecamatan")->result();	
		$this->load->view('admin/v_header');
	$this->load->view('admin/absen_ketua/v_absen_kecamatan',$data);
	$this->load->view('admin/v_footer');
	}
}
