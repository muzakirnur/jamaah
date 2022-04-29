<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class PDF extends FPDF{
    // Page header
    function Header(){
        if ($this->PageNo() == 1){
            
            $this->setFont('Arial','I',9);
            $this->setFillColor(255,255,255);
            $this->cell(90,6,'',0,0,'L',1); 
            $this->cell(190,6,"Printed date : " . date('d-M-Y'),0,1,'R',1); 
            $this->Line(10,$this->GetY(),290,$this->GetY());
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
            $this->cell(190,6,"Printed date : " . date('d-M-Y'),0,1,'R',1); 
//            $this->Line(10,$this->GetY(),200,$this->GetY());
            $this->Ln(2);
            $this->setFont('Arial','B',9);
            $this->setFillColor(230,230,200);
            $this->cell(10,10,'No.',1,0,'C',1);
            $this->cell(28,10,'Nama Kecamatan',1,0,'C',1);
            $this->cell(19,10,'JAN',1,0,'C',1);
            $this->cell(19,10,'FEB',1,0,'C',1);
            $this->cell(19,10,'MAR',1,0,'C',1);
            $this->cell(19,10,'APR',1,0,'C',1);
            $this->cell(19,10,'MAY',1,0,'C',1);
            $this->cell(19,10,'JUN',1,0,'C',1);
            $this->cell(19,10,'JUL',1,0,'C',1);
            $this->cell(19,10,'AUG',1,0,'C',1);
            $this->cell(19,10,'SEP',1,0,'C',1);
            $this->cell(19,10,'OKT',1,0,'C',1);
            $this->cell(19,10,'NOV',1,0,'C',1);
            $this->cell(19,10,'DES',1,0,'C',1);
            $this->cell(19,10,'TOTAL',1,1,'C',1);

            
        }
    }

    function Content($total_tahun, $tahun,$count,$kecamatan,$peudada,$samalanga,$mamplam,$pandrah,$jeunieb,$peulimbang,$juli,$juang,$kuala,$jangka,$peusangan,$selatan,$jeumpa,$krueng,$makmur,$gandapura,$kutablang,
    $count2,$peudada2,$samalanga2,$mamplam2,$pandrah2,$jeunieb2,$peulimbang2,$juli2,$juang2,$kuala2,$jeumpa2,$jangka2,$peusangan2,$selatan2,$krueng2,$makmur2,$gandapura2,$kutablang2,
    $count3,$peudada3,$samalanga3,$mamplam3,$pandrah3,$jeunieb3,$peulimbang3,$juli3,$juang3,$kuala3,$jeumpa3,$jangka3,$peusangan3,$selatan3,$krueng3,$makmur3,$gandapura3,$kutablang3,
    $count4,$peudada4,$samalanga4,$mamplam4,$pandrah4,$jeunieb4,$peulimbang4,$juli4,$juang4,$kuala4,$jeumpa4,$jangka4,$peusangan4,$selatan4,$krueng4,$makmur4,$gandapura4,$kutablang4,
    $count5,$peudada5,$samalanga5,$mamplam5,$pandrah5,$jeunieb5,$peulimbang5,$juli5,$juang5,$kuala5,$jeumpa5,$jangka5,$peusangan5,$selatan5,$krueng5,$makmur5,$gandapura5,$kutablang5,
    $count6,$peudada6,$samalanga6,$mamplam6,$pandrah6,$jeunieb6,$peulimbang6,$juli6,$juang6,$kuala6,$jeumpa6,$jangka6,$peusangan6,$selatan6,$krueng6,$makmur6,$gandapura6,$kutablang6,
    $count7,$peudada7,$samalanga7,$mamplam7,$pandrah7,$jeunieb7,$peulimbang7,$juli7,$juang7,$kuala7,$jeumpa7,$jangka7,$peusangan7,$selatan7,$krueng7,$makmur7,$gandapura7,$kutablang7,
    $count8,$peudada8,$samalanga8,$mamplam8,$pandrah8,$jeunieb8,$peulimbang8,$juli8,$juang8,$kuala8,$jeumpa8,$jangka8,$peusangan8,$selatan8,$krueng8,$makmur8,$gandapura8,$kutablang8,
    $count9,$peudada9,$samalanga9,$mamplam9,$pandrah9,$jeunieb9,$peulimbang9,$juli9,$juang9,$kuala9,$jeumpa9,$jangka9,$peusangan9,$selatan9,$krueng9,$makmur9,$gandapura9,$kutablang9,
    $count10,$peudada10,$samalanga10,$mamplam10,$pandrah10,$jeunieb10,$peulimbang10,$juli10,$juang10,$jeumpa10,$kuala10,$jangka10,$peusangan10,$selatan10,$krueng10,$makmur10,$gandapura10,$kutablang10,
    $count11,$peudada11,$samalanga11,$mamplam11,$pandrah11,$jeunieb11,$peulimbang11,$juli11,$juang11,$jeumpa11,$kuala11,$jangka11,$peusangan11,$selatan11,$krueng11,$makmur11,$gandapura11,$kutablang11,
    $count12,$peudada12,$samalanga12,$mamplam12,$pandrah12,$jeunieb12,$peulimbang12,$juli12,$juang12,$jeumpa12,$kuala12,$jangka12,$peusangan12,$selatan12,$krueng12,$makmur12,$gandapura12,$kutablang12,
    $peudada13,$samalanga13,$mamplam13,$pandrah13,$jeunieb13,$peulimbang13,$juli13,$juang13,$jeumpa13,$kuala13,$jangka13,$peusangan13,$selatan13,$krueng13,$makmur13,$gandapura13,$kutablang13
    ){
        $ya = 46;
        $rw = 6;
        $no = 1;
        $this->setFont('Arial','B',9);
        $this->setFillColor(255,255,255);
        $this->cell(19,10,'Iuran Tahun : ',0,0,'C',1);
        $this->cell(15,10,$tahun,0,1,'C',1);
        $this->setFont('Arial','B',9);
        $this->setFillColor(230,230,200);
        $this->cell(10,10,'No.',1,0,'C',1);
        $this->cell(28,10,'Nama Kecamatan',1,0,'C',1);
        $this->cell(19,10,'JAN',1,0,'C',1);
        $this->cell(19,10,'FEB',1,0,'C',1);
        $this->cell(19,10,'MAR',1,0,'C',1);
        $this->cell(19,10,'APR',1,0,'C',1);
        $this->cell(19,10,'MAY',1,0,'C',1);
        $this->cell(19,10,'JUN',1,0,'C',1);
        $this->cell(19,10,'JUL',1,0,'C',1);
        $this->cell(19,10,'AUG',1,0,'C',1);
        $this->cell(19,10,'SEP',1,0,'C',1);
        $this->cell(19,10,'OKT',1,0,'C',1);
        $this->cell(19,10,'NOV',1,0,'C',1);
        $this->cell(19,10,'DES',1,0,'C',1);
        $this->cell(19,10,'TOTAL',1,1,'C',1);


              $this->setFont('Arial','B',6);
              $this->setFillColor(230,230,200);
              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Samalanga',1,0,'C',1);
              $this->cell(19,10,number_format($samalanga[0]['samalanga'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga2[0]['samalanga2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga3[0]['samalanga3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga4[0]['samalanga4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga5[0]['samalanga5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga6[0]['samalanga6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga7[0]['samalanga7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga8[0]['samalanga8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga9[0]['samalanga9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga10[0]['samalanga10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga11[0]['samalanga11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga12[0]['samalanga12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($samalanga13[0]['samalanga13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Simpang Mamplam',1,0,'C',1);
              $this->cell(19,10,number_format($mamplam[0]['mamplam'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam2[0]['mamplam2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam3[0]['mamplam3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam4[0]['mamplam4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam5[0]['mamplam5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam6[0]['mamplam6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam7[0]['mamplam7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam8[0]['mamplam8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam9[0]['mamplam9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam10[0]['mamplam10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam11[0]['mamplam11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam12[0]['mamplam12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($mamplam13[0]['mamplam13'],0,',','.'),1,1,'C',1);


              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Pandrah',1,0,'C',1);
              $this->cell(19,10,number_format($pandrah[0]['pandrah'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah2[0]['pandrah2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah3[0]['pandrah3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah4[0]['pandrah4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah5[0]['pandrah5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah6[0]['pandrah6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah7[0]['pandrah7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah8[0]['pandrah8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah9[0]['pandrah9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah10[0]['pandrah10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah11[0]['pandrah11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah12[0]['pandrah12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($pandrah13[0]['pandrah13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Jeunieb',1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb[0]['jeunieb'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb2[0]['jeunieb2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb3[0]['jeunieb3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb4[0]['jeunieb4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb5[0]['jeunieb5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb6[0]['jeunieb6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb7[0]['jeunieb7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb8[0]['jeunieb8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb9[0]['jeunieb9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb10[0]['jeunieb10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb11[0]['jeunieb11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb12[0]['jeunieb12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeunieb13[0]['jeunieb13'],0,',','.'),1,1,'C',1);


              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Peulimbang',1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang[0]['peulimbang'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang2[0]['peulimbang2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang3[0]['peulimbang3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang4[0]['peulimbang4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang5[0]['peulimbang5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang6[0]['peulimbang6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang7[0]['peulimbang7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang8[0]['peulimbang8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang9[0]['peulimbang9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang10[0]['peulimbang10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang11[0]['peulimbang11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang12[0]['peulimbang12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peulimbang13[0]['peulimbang13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Peudada',1,0,'C',1);
              $this->cell(19,10,number_format($peudada[0]['peudada'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada2[0]['peudada2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada3[0]['peudada3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada4[0]['peudada4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada5[0]['peudada5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada6[0]['peudada6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada7[0]['peudada7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada8[0]['peudada8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada9[0]['peudada9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada10[0]['peudada10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada11[0]['peudada11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada12[0]['peudada12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peudada13[0]['peudada13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Juli',1,0,'C',1);
              $this->cell(19,10,number_format($juli[0]['juli'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli2[0]['juli2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli3[0]['juli3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli4[0]['juli4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli5[0]['juli5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli6[0]['juli6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli7[0]['juli7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli8[0]['juli8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli9[0]['juli9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli10[0]['juli10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli11[0]['juli11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli12[0]['juli12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juli13[0]['juli13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Jeumpa',1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa[0]['jeumpa'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa2[0]['jeumpa2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa3[0]['jeumpa3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa4[0]['jeumpa4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa5[0]['jeumpa5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa6[0]['jeumpa6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa7[0]['jeumpa7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa8[0]['jeumpa8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa9[0]['jeumpa9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa10[0]['jeumpa10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa11[0]['jeumpa11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa12[0]['jeumpa12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jeumpa13[0]['jeumpa13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Kota Juang',1,0,'C',1);
              $this->cell(19,10,number_format($juang[0]['juang'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang2[0]['juang2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang3[0]['juang3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang4[0]['juang4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang5[0]['juang5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang6[0]['juang6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang7[0]['juang7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang8[0]['juang8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang9[0]['juang9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang10[0]['juang10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang11[0]['juang11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang12[0]['juang12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($juang13[0]['juang13'],0,',','.'),1,1,'C',1);


              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Kuala',1,0,'C',1);
              $this->cell(19,10,number_format($kuala[0]['kuala'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala2[0]['kuala2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala3[0]['kuala3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala4[0]['kuala4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala5[0]['kuala5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala6[0]['kuala6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala7[0]['kuala7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala8[0]['kuala8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala9[0]['kuala9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala10[0]['kuala10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala11[0]['kuala11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala12[0]['kuala12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kuala13[0]['kuala13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Jangka',1,0,'C',1);
              $this->cell(19,10,number_format($jangka[0]['jangka'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka2[0]['jangka2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka3[0]['jangka3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka4[0]['jangka4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka5[0]['jangka5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka6[0]['jangka6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka7[0]['jangka7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka8[0]['jangka8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka9[0]['jangka9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka10[0]['jangka10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka11[0]['jangka11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka12[0]['jangka12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($jangka13[0]['jangka13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Peusangan',1,0,'C',1);
              $this->cell(19,10,number_format($peusangan[0]['peusangan'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan2[0]['peusangan2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan3[0]['peusangan3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan4[0]['peusangan4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan5[0]['peusangan5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan6[0]['peusangan6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan7[0]['peusangan7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan8[0]['peusangan8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan9[0]['peusangan9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan10[0]['peusangan10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan11[0]['peusangan11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan12[0]['peusangan12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($peusangan13[0]['peusangan13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Peusangan Selatan',1,0,'C',1);
              $this->cell(19,10,number_format($selatan[0]['selatan'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan2[0]['selatan2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan3[0]['selatan3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan4[0]['selatan4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan5[0]['selatan5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan6[0]['selatan6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan7[0]['selatan7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan8[0]['selatan8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan9[0]['selatan9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan10[0]['selatan10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan11[0]['selatan11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan12[0]['selatan12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($selatan13[0]['selatan13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Peusangan Siblah Krueng',1,0,'C',1);
              $this->cell(19,10,number_format($krueng[0]['krueng'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng2[0]['krueng2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng3[0]['krueng3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng4[0]['krueng4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng5[0]['krueng5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng6[0]['krueng6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng7[0]['krueng7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng8[0]['krueng8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng9[0]['krueng9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng10[0]['krueng10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng11[0]['krueng11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng12[0]['krueng12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($krueng13[0]['krueng13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Makmur',1,0,'C',1);
              $this->cell(19,10,number_format($makmur[0]['makmur'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur2[0]['makmur2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur3[0]['makmur3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur4[0]['makmur4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur5[0]['makmur5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur6[0]['makmur6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur7[0]['makmur7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur8[0]['makmur8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur9[0]['makmur9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur10[0]['makmur10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur11[0]['makmur11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur12[0]['makmur12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($makmur13[0]['makmur13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Gandapura',1,0,'C',1);
              $this->cell(19,10,number_format($gandapura[0]['gandapura'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura2[0]['gandapura2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura3[0]['gandapura3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura4[0]['gandapura4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura5[0]['gandapura5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura6[0]['gandapura6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura7[0]['gandapura7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura8[0]['gandapura8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura9[0]['gandapura9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura10[0]['gandapura10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura11[0]['gandapura11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura12[0]['gandapura12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($gandapura13[0]['gandapura13'],0,',','.'),1,1,'C',1);

              $this->cell(10,10,$no++,1,0,'C',1);
              $this->cell(28,10,'Kutablang',1,0,'C',1);
              $this->cell(19,10,number_format($kutablang[0]['kutablang'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang2[0]['kutablang2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang3[0]['kutablang3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang4[0]['kutablang4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang5[0]['kutablang5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang6[0]['kutablang6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang7[0]['kutablang7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang8[0]['kutablang8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang9[0]['kutablang9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang10[0]['kutablang10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang11[0]['kutablang11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang12[0]['kutablang12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($kutablang13[0]['kutablang13'],0,',','.'),1,1,'C',1);
              $this->cell(38,10,'Total',1,0,'C',1);
              $this->cell(19,10,number_format($count[0]['iuran'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count2[0]['iuran2'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count3[0]['iuran3'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count4[0]['iuran4'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count5[0]['iuran5'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count6[0]['iuran6'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count7[0]['iuran7'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count8[0]['iuran8'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count9[0]['iuran9'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count10[0]['iuran10'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count11[0]['iuran11'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,number_format($count12[0]['iuran12'],0,',','.'),1,0,'C',1);
              $this->cell(19,10,'Total',1,1,'C',1);

              $this->cell(38,10,'Total Keseluruhan',1,0,'C',1);
              $this->cell(247,10,number_format($total_tahun[0]['tahun1'],0,',','.'),1,0,'C',1);
              
            

        
  
    }

    // Page footer
    function Footer(){
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        //buat garis horizontal
        $this->Line(10,$this->GetY(),290,$this->GetY());
        //Arial italic 9
        $this->SetFont('Arial','I',9);
        $this->Cell(0,10,'Copyright@'.date('Y').' FA',0,0,'L');
        //nomor halaman
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'R');
    }
}

// Instanciation of inherited class
$pdf = new PDF('L');
$pdf->AliasNbPages();
$pdf->AddPage();
//$pdf->SetFont('Times','',12);
//for($i=1;$i<=28;$i++)
//    $pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Content($total_tahun,$tahun,$count,$kecamatan,$peudada,$samalanga,$mamplam,$pandrah,$jeunieb,$peulimbang,$juli,$juang,$kuala,$jangka,$peusangan,$selatan,$jeumpa,$krueng,$makmur,$gandapura,$kutablang,
$count2,$peudada2,$samalanga2,$mamplam2,$pandrah2,$jeunieb2,$peulimbang2,$juli2,$juang2,$kuala2,$jeumpa2,$jangka2,$peusangan2,$selatan2,$krueng2,$makmur2,$gandapura2,$kutablang2,
$count3,$peudada3,$samalanga3,$mamplam3,$pandrah3,$jeunieb3,$peulimbang3,$juli3,$juang3,$kuala3,$jeumpa3,$jangka3,$peusangan3,$selatan3,$krueng3,$makmur3,$gandapura3,$kutablang3,
$count4,$peudada4,$samalanga4,$mamplam4,$pandrah4,$jeunieb4,$peulimbang4,$juli4,$juang4,$kuala4,$jeumpa4,$jangka4,$peusangan4,$selatan4,$krueng4,$makmur4,$gandapura4,$kutablang4,
$count5,$peudada5,$samalanga5,$mamplam5,$pandrah5,$jeunieb5,$peulimbang5,$juli5,$juang5,$kuala5,$jeumpa5,$jangka5,$peusangan5,$selatan5,$krueng5,$makmur5,$gandapura5,$kutablang5,
$count6,$peudada6,$samalanga6,$mamplam6,$pandrah6,$jeunieb6,$peulimbang6,$juli6,$juang6,$kuala6,$jeumpa6,$jangka6,$peusangan6,$selatan6,$krueng6,$makmur6,$gandapura6,$kutablang6,
$count7,$peudada7,$samalanga7,$mamplam7,$pandrah7,$jeunieb7,$peulimbang7,$juli7,$juang7,$kuala7,$jeumpa7,$jangka7,$peusangan7,$selatan7,$krueng7,$makmur7,$gandapura7,$kutablang7,
$count8,$peudada8,$samalanga8,$mamplam8,$pandrah8,$jeunieb8,$peulimbang8,$juli8,$juang8,$kuala8,$jeumpa8,$jangka8,$peusangan8,$selatan8,$krueng8,$makmur8,$gandapura8,$kutablang8,
$count9,$peudada9,$samalanga9,$mamplam9,$pandrah9,$jeunieb9,$peulimbang9,$juli9,$juang9,$kuala9,$jeumpa9,$jangka9,$peusangan9,$selatan9,$krueng9,$makmur9,$gandapura9,$kutablang9,
$count10,$peudada10,$samalanga10,$mamplam10,$pandrah10,$jeunieb10,$peulimbang10,$juli10,$juang10,$jeumpa10,$kuala10,$jangka10,$peusangan10,$selatan10,$krueng10,$makmur10,$gandapura10,$kutablang10,
$count11,$peudada11,$samalanga11,$mamplam11,$pandrah11,$jeunieb11,$peulimbang11,$juli11,$juang11,$jeumpa11,$kuala11,$jangka11,$peusangan11,$selatan11,$krueng11,$makmur11,$gandapura11,$kutablang11,
$count12,$peudada12,$samalanga12,$mamplam12,$pandrah12,$jeunieb12,$peulimbang12,$juli12,$juang12,$jeumpa12,$kuala12,$jangka12,$peusangan12,$selatan12,$krueng12,$makmur12,$gandapura12,$kutablang12,
$peudada13,$samalanga13,$mamplam13,$pandrah13,$jeunieb13,$peulimbang13,$juli13,$juang13,$jeumpa13,$kuala13,$jangka13,$peusangan13,$selatan13,$krueng13,$makmur13,$gandapura13,$kutablang13
);
$pdf->Output();
