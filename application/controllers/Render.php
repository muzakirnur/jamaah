<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Render extends CI_Controller {

  public function __construct()
  {
    parent::__construct();
    $this->load->library('Zend');
    $this->load->library('Ciqrcode');
    $this->load->database();
  }

  public function index($id)
  {
    $this->load->library('f_pdf');
    $data['anggota'] = $this->m_data->get_anggota($id)->result();
    $this->load->view('admin/pdf/v_kartu_pdf',$data); //memanggil view 
  }

  public function QRcode($kodenya)
  {
    //render  qr code dengan format gambar PNG
    QRcode::png(
      $kodenya,
      $outfile = false,
      $level = QR_ECLEVEL_H,
      $size  = 6,
      $margin = 2
    );
  }

  public function Barcode($kodenya)
  {
    $this->zend->load('Zend/Barcode');
    Zend_Barcode::render('code128', 'image', array('text' => $kodenya));
  }
}
