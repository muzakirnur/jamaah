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
         
        }
    }

    function Content($peringatan){
        $ya = 46;
        $rw = 6;
        $no = 1;
        foreach ($peringatan as $key) {
            $this->setFont('Times','B',11);
            $this->setFillColor(255,255,255);	
            $this->cell(126,5," SURAT PERINGATAN I " ,0,1,'R',1); 
            $this->cell(130,5,"  NOMOR : ...... / SMB / 20....... " ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 

            $this->setFont('Times','',11);
            $this->cell(142,5,"Surat peringatan ini dibuat oleh Majlis Ta'lim Sirul Mubtadin, ditujukan kepada :" ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 
            $this->cell(70,10,"  Nama                  :" ,0,0,'R',1); 
            $this->cell(27,10,"  $key->nama  " ,0,1,'R',1); 
            $this->cell(70,10,"  Alamat                :" ,0,0,'R',1); 
            $this->cell(35,10,"  $key->gampong  " ,0,1,'R',1); 
            $this->cell(70,10,"  Kecamatan             :" ,0,0,'R',1); 
            $this->cell(29,10,"  $key->kecamatan  " ,0,1,'R',1); 
            $this->cell(70,10,"  Kabupaten             :" ,0,0,'R',1); 
            $this->cell(30,10,"  $key->kabupaten  " ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 
            $this->cell(186,5," Surat peringatan ini diberikan kepada yang bersangkutan diatas sehubungan dengan tindakan" ,0,1,'R',1); 
            $this->cell(187,5," tidak disiplin dalam menjalankan rutinitas pengajian mingguan ditempat saudara dan ini pelanggaran terhadap" ,0,1,'R',1); 
            $this->cell(183,5," aturan yang telah dibuat oleh pengurus Majlis Ta'lim Sirul Mubtadin. Surat peringatan ini diberikan kepada" ,0,1,'R',1); 
            $this->cell(96,5," yang bersangkutan dengan kondisi sebagai berikut :" ,0,1,'R',1); 

            $this->cell(132,5,"" ,0,1,'R',1); 
            $this->cell(160,5," 1.   Surat peringatan ini berlaku selama satu bulan dihitung sejak tanggal diberikan." ,0,1,'R',1); 
            $this->cell(180,5," 2.   Apabila selama satu bulan saudara tidak melanjutkan pengajian rutinitas seperti biasa, maka " ,0,1,'R',1); 
            $this->cell(158,5," Pengurus Majlis Ta'lim Sirul Mubtadin akan mengambil tindakan selanjutnya." ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 

            $this->setFont('Times','',11);
            $this->cell(178,5,"  Demikian surat peringatan ini kami berikan kepada yang bersangkutan agar diindahkan dan dimengerti." ,0,1,'R',1); 
           
            $this->cell(132,20,"" ,0,1,'R',1); 
            $this->cell(162,5,"  $key->kecamatan, ". date('d-M-Y') ,0,0,'R',1); 
            $this->cell(170,5,"  Pada Tanggal             :   ". date('d-M-Y')   ,0,1,'R',1); 
            $this->cell(132,5,"" ,0,1,'R',1); 

            $this->cell(176,5," Ketua Koordinator Kabupaten Bireun " ,0,1,'R',1); 
            $this->cell(128,5,"" ,0,1,'R',1); 
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
$pdf->Content($peringatan);
$pdf->Output();
