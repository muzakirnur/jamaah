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
            $this->cell(25,7,'',0,0,'C',0); 
            $this->cell(100,6,'Laporan Data Iuran Perbulan',0,1,'L',1); 
            
            $this->cell(25,6,'',0,0,'C',0); 
            $this->cell(100,6,"",0,1,'L',1);
           
            $this->cell(25,6,'',0,0,'C',0); 
            $this->cell(100,6,'',0,1,'L',1); 
            // Line break
            $this->Ln(5);

 
        }else{
            $this->setFont('Arial','I',9);
            $this->setFillColor(255,255,255);
            $this->cell(90,6,"Laporan Data Iuran Perbulan",0,0,'L',1); 
            $this->cell(100,6,"Printed date : " . date('d-M-Y'),0,1,'R',1); 
//            $this->Line(10,$this->GetY(),200,$this->GetY());
            $this->Ln(2);
            $this->setFont('Arial','B',9);
            $this->setFillColor(230,230,200);
            $this->cell(10,10,'No.',1,0,'C',1);
            $this->cell(100,10,'Nama Kecamatan',1,0,'C',1);
            $this->cell(80,10,'Jumlah Iuran',1,1,'C',1);
        }
    }

    function Content($tahun, $bulan, $count,$kecamatan,$peudada,$samalanga,$mamplam,$pandrah,$jeunieb,$peulimbang,$juli,$jeumpa,$juang,$kuala,$jangka,$peusangan,$selatan,$krueng,$makmur,$gandapura,$kutablang){
        $ya = 46;
        $rw = 6;
        $no = 1;
        $this->setFont('Arial','B',9);
        $this->setFillColor(255,255,255);
        $this->cell(20,10,'Iuran Bulan : ',0,0,'C',1);
        $this->cell(15,10,$tahun,0,0,'C',1);
        $this->cell(15,10,'Tahun : ',0,0,'C',1);
        $this->cell(15,10,$bulan,0,1,'C',1);
        $this->setFont('Arial','B',9);
        $this->setFillColor(230,230,200);
        $this->cell(10,10,'No.',1,0,'C',1);
        $this->cell(100,10,'Nama Kecamatan',1,0,'C',1);
        $this->cell(80,10,'Jumlah Iuran',1,1,'C',1);
              $this->setFont('Arial','B',9);
              $this->setFillColor(230,230,200);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Samalanga',1,0,'C',1);
              $this->cell(80,10,number_format($samalanga[0]['samalanga'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Simpang Mamplam',1,0,'C',1);
              $this->cell(80,10,number_format($mamplam[0]['mamplam'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Pandrah',1,0,'C',1);
              $this->cell(80,10,number_format($pandrah[0]['pandrah'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Jeunieb',1,0,'C',1);
              $this->cell(80,10,number_format($jeunieb[0]['jeunieb'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Peulimbang',1,0,'C',1);
              $this->cell(80,10,number_format($peulimbang[0]['peulimbang'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Peudada',1,0,'C',1);
              $this->cell(80,10,number_format($peudada[0]['peudada'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Juli',1,0,'C',1);
              $this->cell(80,10,number_format($juli[0]['juli'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Jeumpa',1,0,'C',1);
              $this->cell(80,10,number_format($jeumpa[0]['jeumpa'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Kota Juang',1,0,'C',1);
              $this->cell(80,10,number_format($juang[0]['juang'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Kuala',1,0,'C',1);
              $this->cell(80,10,number_format($kuala[0]['kuala'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Jangka',1,0,'C',1);
              $this->cell(80,10,number_format($jangka[0]['jangka'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Peusangan',1,0,'C',1);
              $this->cell(80,10,number_format($peusangan[0]['peusangan'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Peusangan Selatan',1,0,'C',1);
              $this->cell(80,10,number_format($selatan[0]['selatan'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Peusangan Siblah Krueng',1,0,'C',1);
              $this->cell(80,10,number_format($krueng[0]['krueng'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Makmur',1,0,'C',1);
              $this->cell(80,10,number_format($makmur[0]['makmur'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Gandapura',1,0,'C',1);
              $this->cell(80,10,number_format($gandapura[0]['gandapura'],0,',','.'),1,1,'C',1);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(100,10,'Kutablang',1,0,'C',1);
              $this->cell(80,10,number_format($kutablang[0]['kutablang'],0,',','.'),1,1,'C',1);
              $this->cell(110,10,'Total',1,0,'C',1);
              $this->cell(80,10,number_format($count[0]['iuran'],0,',','.'),1,1,'C',1);
              
            

        
  
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
$pdf->Content($bulan, $tahun, $count,$kecamatan,$peudada,$samalanga,$mamplam,$pandrah,$jeunieb,$peulimbang,$juli,$jeumpa,$juang,$kuala,$jangka,$peusangan,$selatan,$krueng,$makmur,$gandapura,$kutablang);
$pdf->Output();
