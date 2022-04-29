<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH . 'third_party/Spout/Autoloader/autoload.php';

use Box\Spout\Reader\Common\Creator\ReaderEntityFactory;

class Exportimport extends CI_Controller
{

    public function __construct()
    {
        parent::__construct();
        $this->load->model('Barang_model');
    }



    public function index()
    {
        $data['title'] = 'Export Import';
        $data['semuabarang'] = $this->Barang_model->getDataBarang();
        $this->load->view('index', $data);
    }

    public function uploaddata()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();

            $reader->open('uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        $databarang = array(
                            'no_anggota'  => $row->getCellAtIndex(1),
                            'nama'       => $row->getCellAtIndex(2),
                            'nama_ortu'  => $row->getCellAtIndex(3),
                            'ttg'  => $row->getCellAtIndex(4),
                            'jenis_kelamin'       => $row->getCellAtIndex(5),
                            'gampong'  => $row->getCellAtIndex(6),
                            'kecamatan'  => $row->getCellAtIndex(7),
                            'kabupaten'       => $row->getCellAtIndex(8),
                        );
                        $this->Barang_model->import_data($databarang);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata('pesan', 'import Data Berhasil');
                redirect($this->session->userdata('redir'));
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }

    public function uploaddata_kelas()
    {
        $config['upload_path'] = './uploads/';
        $config['allowed_types'] = 'xlsx|xls';
        $config['file_name'] = 'doc' . time();
        $this->load->library('upload', $config);
        if ($this->upload->do_upload('importexcel')) {
            $file = $this->upload->data();
            $reader = ReaderEntityFactory::createXLSXReader();

            $reader->open('uploads/' . $file['file_name']);
            foreach ($reader->getSheetIterator() as $sheet) {
                $numRow = 1;
                foreach ($sheet->getRowIterator() as $row) {
                    if ($numRow > 1) {
                        $databarang = array(
                            'no_anggota'  => $row->getCellAtIndex(1),
                            'nama'       => $row->getCellAtIndex(2),
                            'nama_ortu'  => $row->getCellAtIndex(3),
                            'ttg'  => $row->getCellAtIndex(4),
                            'jenis_kelamin'       => $row->getCellAtIndex(5),
                            'gampong'  => $row->getCellAtIndex(6),
                            'kecamatan'  => $row->getCellAtIndex(7),
                            'kabupaten'       => $row->getCellAtIndex(8),
                            'id_kelas'       => $this->session->userdata('id'),
                        );
                        $this->Barang_model->import_data($databarang);
                    }
                    $numRow++;
                }
                $reader->close();
                unlink('uploads/' . $file['file_name']);
                $this->session->set_flashdata('pesan', 'import Data Berhasil');
                redirect($this->session->userdata('redir'));
            }
        } else {
            echo "Error :" . $this->upload->display_errors();
        };
    }
}
