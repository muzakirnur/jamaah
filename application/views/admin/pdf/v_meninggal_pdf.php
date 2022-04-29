<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PDF extends FPDF{
    // Page header
    function Header(){
        if ($this->PageNo() == 1){
            $this->setFont('Arial','I',9);
            $this->setFillColor(255,255,255);
            $this->cell(90,6,'',0,0,'L',1); 
            $this->cell(100,6,"Printed date : " . date('d-M-Y'),0,1,'R',1); 
            $this->Line(10,$this->GetY(),200,$this->GetY());
            
            // Logo
            $this->Image(base_url().'assets/image/mub.png', 10, 17,'30','30','png');
            $this->Ln(12);
            $this->setFont('Arial','',14);
            $this->setFillColor(255,255,255);
            $this->cell(25,6,'',0,0,'C',0); 
            $this->cell(100,6,'Laporan Data Jamaah Meninggal Admin ',0,1,'L',1); 
            $this->cell(25,6,'',0,0,'C',0); 
            $this->cell(100,6,"",0,1,'L',1); 
            $this->cell(25,6,'',0,0,'C',0); 
            $this->cell(100,6,'',0,1,'L',1); 
            // Line break
            $this->Ln(5);
            $this->setFont('Arial','B',4);
            $this->setFillColor(230,230,200);
            $this->cell(5,10,'No.',1,0,'C',1);
            $this->cell(10,10,'NO. AGT',1,0,'C',1);
            $this->cell(20,10,'NAMA JAMAAH',1,0,'C',1);
            $this->cell(10,10,'NAMA ORTU',1,0,'C',1);
            $this->cell(25,10,'TTG',1,0,'C',1);
            $this->cell(5,10,'JK',1,0,'C',1);
            $this->cell(20,10,'GAMPONG',1,0,'C',1);
            $this->cell(15,10,'KECAMATAN',1,0,'C',1);
            $this->cell(10,10,'KABUPATEN',1,0,'C',1);
            $this->cell(15,10,'HARI MENINGGAL',1,0,'C',1);
            $this->cell(15,10,'TGL MENINGGAL',1,0,'C',1);
            $this->cell(45,10,'ALAMAT DUKA',1,1,'C',1);

        }else{
            $this->setFont('Arial','B',4);
            $this->setFillColor(230,230,200);
            $this->cell(5,10,'No.',1,0,'C',1);
            $this->cell(10,10,'NO. AGT',1,0,'C',1);
            $this->cell(20,10,'NAMA JAMAAH',1,0,'C',1);
            $this->cell(10,10,'NAMA ORTU',1,0,'C',1);
            $this->cell(25,10,'TTG',1,0,'C',1);
            $this->cell(5,10,'JK',1,0,'C',1);
            $this->cell(20,10,'GAMPONG',1,0,'C',1);
            $this->cell(15,10,'KECAMATAN',1,0,'C',1);
            $this->cell(10,10,'KABUPATEN',1,0,'C',1);
            $this->cell(15,10,'HARI MENINGGAL',1,0,'C',1);
            $this->cell(15,10,'TGL MENINGGAL',1,0,'C',1);
            $this->cell(45,10,'ALAMAT DUKA',1,1,'C',1);
        }
    }

    function Content($meninggal){
        $ya = 46;
        $rw = 6;
        $no = 1;
        foreach ($meninggal as $key) {
            $this->setFont('Arial','',5);
            $this->setFillColor(255,255,255);	
            $this->cell(5,10,$no,1,0,'C',1);
            $this->cell(10,10,$key->no_anggota,1,0,'C',1);
            $this->cell(20,10,$key->nama,1,0,'C',1);
            $this->cell(10,10,$key->nama_ortu,1,0,'C',1);
            $this->cell(25,10,$key->ttg,1,0,'C',1);
            $this->cell(5,10,$key->jenis_kelamin,1,0,'C',1);
            $this->cell(20,10,$key->gampong,1,0,'C',1);
            $this->cell(15,10,$key->kecamatan,1,0,'C',1);
            $this->cell(10,10,$key->kabupaten,1,0,'C',1);
            $this->cell(15,10,$key->hari_meninggal,1,0,'C',1);
            $this->cell(15,10,$key->tanggal_meninggal,1,0,'C',1);
            $this->cell(45,10,$key->alamat_duka,1,1,'C',1);
            $ya = $ya + $rw;
            $no++;
        }            
    }

    // Page footer
    function Footer(){
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        //buat garis horizontal
        $this->Line(10,$this->GetY(),200,$this->GetY());
        //Arial italic 9
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Copyright@'.date('Y').' FA',0,0,'L');
        //nomor halaman
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->SetFont('Times','',12);
//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Content($meninggal);
$pdf->Output();
