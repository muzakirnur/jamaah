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
            $this->cell(100,6,'Laporan Data absensi Admin Kecamatan',0,1,'L',1); 
            
            $this->cell(25,6,'',0,0,'C',0); 
            $this->cell(100,6,"",0,1,'L',1);
           
            $this->cell(25,6,'',0,0,'C',0); 
            $this->cell(100,6,'',0,1,'L',1); 
            // Line break
            $this->Ln(5);
          
 
        }else{
            $this->setFont('Arial','I',9);
            $this->setFillColor(255,255,255);
            $this->cell(90,6,"Laporan Data absensi",0,0,'L',1); 
            $this->cell(100,6,"Printed date : " . date('d-M-Y'),0,1,'R',1); 
//            $this->Line(10,$this->GetY(),200,$this->GetY());
            $this->Ln(2);
            $this->setFont('Arial','B',9);
            $this->setFillColor(230,230,200);
            $this->cell(10,10,'No.',1,0,'C',1);
          $this->cell(36,10,'Masuk',1,0,'C',1);
          $this->cell(36,10,'Izin',1,0,'C',1);
          $this->cell(36,10,'Sakit',1,0,'C',1);
          $this->cell(36,10,'Alpa',1,0,'C',1);
          $this->cell(36,10,'Tidak Absen',1,1,'C',1);
        }
    }

    function Content($absensi,$masuk,$izin,$sakit,$alpa,$belum,$anggota){
        $ya = 46;
        $rw = 6;
        $no = 1;
        foreach ($anggota as $key) {
          if ($no < 2) {

            $this->setFont('Arial','B',9);
          $this->setFillColor(230,230,200);
          $this->cell(46,10,'Nomor Anggota',1,0,'C',1);
          $this->cell(36,10,'Nama ',1,0,'C',1);
          $this->cell(36,10,'Nama Orang Tua',1,0,'C',1);
          $this->cell(36,10,'Gampong',1,0,'C',1);
          $this->cell(36,10,'Kecamatan',1,1,'C',1);



          $this->setFillColor(255,255,255);	

          $this->cell(46,10,$key->no_anggota,1,0,'C',1); 
          $this->cell(36,10,$key->nama,1,0,'C',1);   
          $this->cell(36,10,$key->nama_ortu,1,0,'C',1);   
          $this->cell(36,10,$key->gampong,1,0,'C',1);   
          $this->cell(36,10,$key->kecamatan,1,1,'C',1); 
          $this->setFont('Arial','B',9);
          $this->setFillColor(230,230,200);
          $this->cell(10,10,'No.',1,0,'C',1);
          $this->cell(36,10,'Masuk',1,0,'C',1);
          $this->cell(36,10,'Izin',1,0,'C',1);
          $this->cell(36,10,'Sakit',1,0,'C',1);
          $this->cell(36,10,'Alpa',1,0,'C',1);
          $this->cell(36,10,'Tidak Absen',1,1,'C',1);
          } break;
        }       
          foreach ($absensi as $key) {
            
            $this->setFont('Arial','',7);
            $this->setFillColor(255,255,255);	
            $this->cell(10,10,$no,1,0,'C',1);
            
                if($key->absen == "1"){
                  echo $this->cell(36,10,'',1,0,'C',1);      
                  echo $this->cell(36,10,'',1,0,'C',1);               
                  echo $this->cell(36,10,date('d-m-Y',strtotime($key->tanggal_mulai)),1,0,'C',1);                 
                  echo $this->cell(36,10,'',1,0,'C',1);        
                  echo $this->cell(36,10,'',1,1,'C',1); 

                }else if($key->absen == "2"){
                  echo $this->cell(36,10,'',1,0,'C',1);      
                  echo $this->cell(36,10,'',1,0,'C',1);                
                  echo $this->cell(36,10,'',1,0,'C',1);                
                  echo $this->cell(36,10,'',1,0,'C',1);        
                  echo $this->cell(36,10,date('d-m-Y',strtotime($key->tanggal_mulai)),1,1,'C',1); 

                }else if($key->absen == "3"){
                  echo $this->cell(36,10,'',1,0,'C',1);      
                  echo $this->cell(36,10,date('d-m-Y',strtotime($key->tanggal_mulai)),1,0,'C',1);                
                  echo $this->cell(36,10,'',1,0,'C',1);                
                  echo $this->cell(36,10,'',1,0,'C',1);        
                  echo $this->cell(36,10,'',1,1,'C',1);                        
          
                }else if($key->absen == "4"){
                  echo $this->cell(36,10,date('d-m-Y',strtotime($key->tanggal_mulai)),1,0,'C',1);      
                  echo $this->cell(36,10,'',1,0,'C',1);                
                  echo $this->cell(36,10,'',1,0,'C',1);                
                  echo $this->cell(36,10,'',1,0,'C',1);        
                  echo $this->cell(36,10,'',1,1,'C',1); 

                }else if($key->absen == "5"){
                  echo $this->cell(36,10,'',1,0,'C',1);      
                  echo $this->cell(36,10,'',1,0,'C',1);                
                  echo $this->cell(36,10,'',1,0,'C',1);                
                  echo $this->cell(36,10,date('d-m-Y',strtotime($key->tanggal_mulai)),1,0,'C',1);        
                  echo $this->cell(36,10,'',1,1,'C',1);                
                }
               
            $ya = $ya + $rw;
            $no++;
        }  
        $this->setFont('Arial','B',9);
        $this->setFillColor(148,28,28);
        echo $this->cell(190,10,'TOTAL',1,1,'C',1);  
        $this->setFillColor(255,255,255);
        echo $this->cell(46,10,$masuk[0]['masuk'],1,0,'C',1);                
        echo $this->cell(36,10,$izin[0]['izin'],1,0,'C',1);      
        echo $this->cell(36,10,$sakit[0]['sakit'],1,0,'C',1);      
                           
                  echo $this->cell(36,10,$alpa[0]['alpa'],1,0,'C',1);        
                  echo $this->cell(36,10,$belum[0]['belum'],1,1,'C',1);   

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
$pdf->Content($absensi,$masuk,$izin,$sakit,$alpa,$belum,$anggota);
$pdf->Output();
