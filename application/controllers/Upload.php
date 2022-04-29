<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Upload extends CI_Controller {

	function create()
	{
		$this->load->view('form_upload');
	}

	function proses()
	{
		$config['upload_path']          = './uploads/';
		$config['allowed_types']        = 'gif|jpg|png';
		$config['max_size']             = 100;
		$config['max_width']            = 1024;
		$config['max_height']           = 768;
		$config['encrypt_name']			= TRUE;
		$this->load->library('upload', $config);
		if ( ! $this->upload->do_upload('berkas'))
		{
				$error = array('error' => $this->upload->display_errors());
				$this->load->view('form_upload', $error);
		}
		else
		{
			$data['nama'] = $this->upload->data("file_name");
			$data['ket'] = $this->input->post('ket');
			$data['tipe'] = $this->upload->data('file_ext');
			$data['ukuran'] = $this->upload->data('file_size');
			$this->db->insert('berkas',$data);
			redirect('upload');
		}
	}

	public function ebook()
	{
		$data['berkas'] = $this->db->get('berkas');
		$this->load->view('guru/v_tampilberkas',$data);
	}


	function download($id)
	{
		$data = $this->db->get_where('berkas',['id'=>$id])->row();
		force_download('upload/'.$data->nama,"berkas");
	}
}
