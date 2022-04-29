<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PDF extends FPDF{
    // Page header
    function Header(){
        if ($this->PageNo() == 1){
            $this->setFont('Arial','I',9);
            $this->setFillColor(255,255,255);
            $this->cell(90,6,'',0,0,'L',1); 
            $this->cell(100,6,'',0,1,'R',1); 
            $this->cell(10,$this->GetY(),'',$this->GetY());
            // Logo
            $this->Image(base_url().'assets/image/picture1.png', 24, 17,'165','35','png');
            $this->Ln(27);
            $this->setFont('Arial','',14);
            $this->setFillColor(255,255,255);
           $this->cell(25,6,'',0,0,'C',0); 
            $this->cell(25,6,'',0,0,'C',0); 
            // Line break
            $this->Ln(13);

        }else{
            $this->setFont('Arial','I',9);
            $this->setFillColor(255,255,255);
            $this->cell(90,6,"Laporan Data Anggota",0,0,'L',1); 
            $this->cell(100,6,"Printed date : " . date('d-M-Y'),0,1,'R',1); 
//            $this->Line(10,$this->GetY(),200,$this->GetY());
            $this->Ln(2);
            $this->setFont('Arial','u',9);
            $this->setFillColor(230,230,200);
            $this->cell(10,10,'No.',1,0,'C',1);
            $this->cell(15,10,'NO. AGT',1,0,'C',1);
            $this->cell(30,10,'NAMA JAMAAH',1,0,'C',1);
            $this->cell(30,10,'NAMA ORTU',1,0,'C',1);
            $this->cell(30,10,'TTG',1,0,'C',1);
            $this->cell(10,10,'JK',1,0,'C',1);
            $this->cell(24,10,'GAMPONG',1,0,'C',1);
            $this->cell(24,10,'KECAMATAN',1,0,'C',1);
            $this->cell(24,10,'KABUPATEN',1,1,'C',1);
        }
    }

    function Content($pemberhentian){
        $ya = 46;
        $rw = 6;
        $no = 1;
        foreach ($pemberhentian as $key) {
            $this->setFont('Times','B',11);
            $this->setFillColor(255,255,255);	
            $this->cell(110,5,"  KEPUTUSAN  " ,0,1,'R',1); 
            $this->cell(123,5,"  NOMOR : ...... / SMB / 20....... " ,0,1,'R',1); 
            $this->cell(132,5,"  TENTANG PEMBERHENTIAN JAMAAH " ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 

            $this->setFont('Times','',11);
            $this->cell(177,5,"  Menimbang bahwa saudara yang bernama $key->nama Binti $key->nama_ortu. yang terdaftar " ,0,1,'R',1); 
            $this->cell(177,5," sebagai jamaah Sirul Mubtadin Bireuen terhitung sejak tanggal .....-....-....... sampai tanggal ....-....-....... " ,0,1,'R',1); 
            $this->cell(110,5," tidak mengikuti pengajian selama ..... minggu berturut-turut." ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 
            $this->cell(176,5," Berdasarkan keputusan Ketua Koordinator Sirul Mubtadin Bireuen sesuai dengan peraturan" ,0,1,'R',1); 
            $this->cell(38,5," yang berlaku." ,0,1,'R',1); 

            $this->cell(132,5,"" ,0,1,'R',1); 
            $this->setFont('Times','B',11);
            $this->cell(110,5,"  MEMUTUSKAN  " ,0,1,'R',1); 
            $this->cell(45,10," MENETAPKAN" ,0,1,'R',1); 
            $this->cell(132,3,"" ,0,1,'R',1); 

            $this->cell(38,5," PERTAMA :" ,0,0,'R',1); 
            $this->setFont('Times','',11);
            $this->cell(145,5,"Terhitung pada tanggal ....-....-......  pengurus telah mengirim surat teguran pertama atas :" ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 
            $this->setFont('Times','B',12);
            $this->cell(93,10,"  Nama                  :" ,0,0,'R',1); 
            $this->cell(36,10,"  $key->nama  " ,0,1,'R',1); 
            $this->cell(93,10,"  Alamat                :" ,0,0,'R',1); 
            $this->cell(29,10,"  $key->gampong  " ,0,1,'R',1); 
            $this->cell(93,10,"  Kecamatan             :" ,0,0,'R',1); 
            $this->cell(22,10,"  $key->kecamatan  " ,0,1,'R',1); 
            $this->cell(93,10,"  Kabupaten             :" ,0,0,'R',1); 
            $this->cell(23,10,"  $key->kabupaten  " ,0,1,'R',1); 

            $this->cell(132,5,"" ,0,1,'R',1); 

            $this->cell(38,5," KEDUA :" ,0,0,'R',1); 
            $this->setFont('Times','',11);
            $this->cell(145,5," Sejak tanggal berlakunya keputusan ini maka jamah yang bersangkutan  dihilangkan " ,0,1,'R',1); 
            $this->cell(172,5," hak-haknya (DIBERHENTIKAN) sebagai jamaah Sirul Mubtadin Kabupaten " ,0,1,'R',1); 
            $this->cell(65,5," Bireuen. " ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 

            $this->setFont('Times','',11);
            $this->cell(177,5,"  Demikian surat keputusan ini disampaikan kepada yang bersangkutan untuk diketahui dan " ,0,1,'R',1); 
            $this->cell(76,5," diindahkan sebagaimana mestinya." ,0,1,'R',1); 
           
            $this->cell(132,5,"" ,0,1,'R',1); 
            $this->cell(162,5,"  Ditetapkan di             :   $key->kecamatan  " ,0,1,'R',1); 
            $this->cell(170,5,"  Pada Tanggal             :   ". date('d-M-Y')   ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 

            $this->cell(187,5," Ketua Koordinator Sirul Mubtadin Kabupaten   " ,0,1,'R',1); 
            $this->cell(128,5," Bireuen.   " ,0,1,'R',1); 
            $this->cell(130,5,"", 0,1,'R',1);
            $this->Ln(17);
            $this->cell(132,5,"" ,0,1,'R',1); 
            $this->setFont('Times','B',11);
            $this->cell(164,5,"  (Tgk. Sulaiman Yusuf) " ,0,1,'R',1); 

            
            $ya = $ya + $rw;
            $no++;
        }            
    }

    // Page footer
    function Footer(){
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        //buat garis horizontal
        $this->cell(10,$this->GetY(),'',$this->GetY());
        //Arial italic 9
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'',0,0,'L');
        //nomor halaman
        $this->Cell(0,10,'',0,0,'R');
    }
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->SetFont('Times','',12);
//for($i=1;$i<=40;$i++)
//    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Content($pemberhentian);
$pdf->Output();
