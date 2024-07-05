<?php
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;

$fromdate;
$todate;


 $origin = new DateTime($fromdate);
 $target = new DateTime($todate);
 $interval = $origin->diff($target);
 $date_diff =$interval->format('%a');
 $date_start = explode('-',$fromdate);

 $marr[1] = "January";
 $marr[2] = "February";
 $marr[3] = "March";
 $marr[4] = "April";
 $marr[5] = "May";
 $marr[6] = "June";
 $marr[7] = "July";
 $marr[8] = "August";
 $marr[9] = "September";
 $marr[10] = "October";
 $marr[11] = "November";
 $marr[12] = "December";


 $objPHPExcel = new Spreadsheet();

 $objPHPExcel->getProperties()->setCreator("Poobate Khunthong")
 ->setLastModifiedBy("Poobate Khunthong")
 ->setTitle("Office 2007 XLSX ")
 ->setSubject("Office 2007 XLSX ")
 ->setDescription("document for Office 2007 XLSX")
 ->setKeywords("office 2007 openxml php")
 ->setCategory("result file");

 $m1 = date_format($origin,"n");
 $m2 = date_format($origin,"m");

 $objPHPExcel->setActiveSheetIndex(0);

 $c_column = (($date_diff+1)*3);

 $sum_dms = DB::table('tbl_claim')->selectRaw("DATE_FORMAT(date_dms,'%e') as d_dms,SUM(firm_doit) AS total")->whereRaw("date_dms BETWEEN  ? AND ? GROUP BY date_dms ORDER BY date_dms", [$fromdate, $todate])->get();
 $arr_dms = array();

 foreach ($sum_dms as $rs_dms) {
    $arr_dms[$rs_dms->d_dms] = $rs_dms->total;
 }

// $sum_bill = "SELECT DATE_FORMAT(date_bill,'%e') as d_bill ,SUM(firm_doit) AS total FROM tbl_claim WHERE date_bill BETWEEN  '".$datefrom."' AND '".$dateto."' GROUP BY date_bill ORDER BY date_bill";
$sum_bill = DB::table('tbl_claim')->selectRaw("DATE_FORMAT(date_bill,'%e') as d_bill ,SUM(firm_doit) AS total")->whereRaw("date_bill BETWEEN  ? AND ? GROUP BY date_bill ORDER BY date_bill", [$fromdate, $todate])->get();
$arr_bill = array();

foreach ($sum_bill as $rs_bill) {
    $arr_bill[$rs_bill->d_bill] = $rs_bill->total;
}

$row = 3;
$c1 = 2;
$m=0;
$objPHPExcel->getActiveSheet()->setCellValue([(2),$row] ,"วันที่");  
$objPHPExcel->getActiveSheet()->setCellValue([(2),($row+1)] ,"ยอดส่งมอบ");
$objPHPExcel->getActiveSheet()->setCellValue([(2),($row+2)],"ยอดวางบิล");

for($i=1;$i<($date_diff+2);$i++){

 $objPHPExcel->getActiveSheet()->setCellValue([($c1+$i),($row)],$i);
 $objPHPExcel->getActiveSheet()->setCellValue([($c1+$i),($row+1)], empty($arr_dms[$i]) ? 0 : $arr_dms[$i]);
 $objPHPExcel->getActiveSheet()->setCellValue([($c1+$i),($row+2)], empty($arr_bill[$i]) ? 0 : $arr_bill[$i]);

$m++;
}
$sumT_col1 = $objPHPExcel->getActiveSheet()->getCell([($c1+$m),($row+1)])->getColumn();
$sumT_col2 = $objPHPExcel->getActiveSheet()->getCell([($c1+$m),($row+2)])->getColumn();
$objPHPExcel->getActiveSheet()->setCellValue([($c1+$m+1),$row],"TOTAL");  
$objPHPExcel->getActiveSheet()->setCellValue([($c1+$m+1),($row+1)],'=SUM(D4:'.$sumT_col2.($row+1).')');
$objPHPExcel->getActiveSheet()->setCellValue([($c1+$m+1),($row+2)],'=SUM(D5:'.$sumT_col2.($row+2).')');





       $default_style = array(
        'font' => array(
            'name' => 'Verdana',
            'color' => array('rgb' => '000000'),
            'size' => 11
        ),
        'alignment' => array(
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
            'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER
        ),
        'borders' => array(
            'allborders' => array(
                'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => array('rgb' => '000000')
            )
        )
    );

// Apply default style to whole sheet
//$objPHPExcel->getActiveSheet()->getDefaultStyle()->applyFromArray($default_style);

$last_col = $objPHPExcel->getActiveSheet()->getHighestColumn(); // Get last column, as a letter
$objPHPExcel->getActiveSheet()->getStyle('C2:'.$last_col.'3')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C2:'.$last_col.'3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('C3:'.$last_col.'3')->getAlignment()->setWrapText(true);
// Apply title style to titles

$objPHPExcel->getActiveSheet()->getStyle('C2:'.$last_col.'8')->applyFromArray(
    array(

        'borders' => array(
            'allborders' => array(
              'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
          )
        )
    )
);  


$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BInvoice&RPrinted on &D');
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

// Set page orientation and size
//echo date('H:i:s') . " Set page orientation and size\n";
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75); // กำหนดระยะขอบ บน
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.25); // กำหนดระยะขอบ ขวา
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.25); // กำหนดระยะขอบ ซ้าย
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75); // กำหนดระยะขอบ ล่าง
// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('Month');

$objPHPExcel->createSheet();    
$objPHPExcel->setActiveSheetIndex(1);

$objPHPExcel->getActiveSheet()->setCellValue('A4','A เปิดใบรับรถ');
$objPHPExcel->getActiveSheet()->setCellValue('A5', 'B รอประกันอนุมัติ');
$objPHPExcel->getActiveSheet()->setCellValue('A6','C ประกันอนุมัติ');
$objPHPExcel->getActiveSheet()->setCellValue('A7','D รออะไหล่');
$objPHPExcel->getActiveSheet()->setCellValue('A8','E อะไหล่ครบ');
$objPHPExcel->getActiveSheet()->setCellValue('A9','F ดำเนินการซ่อม');
$objPHPExcel->getActiveSheet()->setCellValue('A10','G รถเสร็จสมบูรณ์');
$objPHPExcel->getActiveSheet()->setCellValue('A11','H รถส่งออก');
$objPHPExcel->getActiveSheet()->setCellValue('A12','I ขออนุมัติวางบิล');
$objPHPExcel->getActiveSheet()->setCellValue('A13','J วางบิลเรียบร้อย');
$objPHPExcel->getActiveSheet()->setCellValue('A14','K ชำระเงินแล้ว');
$objPHPExcel->getActiveSheet()->setCellValue('A15','L ยกเลิกงานเคลม');


$objPHPExcel->getActiveSheet()->mergeCells('B2:E2');
$objPHPExcel->getActiveSheet()->mergeCells('F2:I2');
$objPHPExcel->getActiveSheet()->mergeCells('J2:M2');
$objPHPExcel->getActiveSheet()->setCellValue('B2', 'สถานปัจจุบัน');
// $objPHPExcel->getActiveSheet()->setCellValue('F2', 'สถานปัจจุบัน');
// $objPHPExcel->getActiveSheet()->setCellValue('J2', 'เดือนปัจจุบัน');

$objPHPExcel->getActiveSheet()->setCellValue('B3', 'จำนวน');
$objPHPExcel->getActiveSheet()->setCellValue('C3','ค่าแรง');
$objPHPExcel->getActiveSheet()->setCellValue('D3','ค่าอะไหล่');
$objPHPExcel->getActiveSheet()->setCellValue('E3','รวม');
// $objPHPExcel->getActiveSheet()->setCellValue('F3','จำนวน');
// $objPHPExcel->getActiveSheet()->setCellValue('G3','ค่าแรง');
// $objPHPExcel->getActiveSheet()->setCellValue('H3','ค่าอะไหล่');
// $objPHPExcel->getActiveSheet()->setCellValue('I3','รวม');
// $objPHPExcel->getActiveSheet()->setCellValue('J3','จำนวน');
// $objPHPExcel->getActiveSheet()->setCellValue('K3','ค่าแรง');
// $objPHPExcel->getActiveSheet()->setCellValue('L3','ค่าอะไหล่');
// $objPHPExcel->getActiveSheet()->setCellValue('M3','รวม');


$statusType = [		
    1 => "A เปิดใบรับรถ",
    2 =>	 "B รอประกันอนุมัติ",
    3 =>	 "C ประกันอนุมัติ",
    4 =>	 "D รออะไหล่",
    5 =>	 "E อะไหล่ครบ",
    6 =>	 "F ดำเนินการซ่อม",
    7 => "G รถเสร็จสมบูรณ์",
    8 =>	 "H รถส่งออก",
    9 => "I ขออนุมัติวางบิล",
    // 10 => "J วางบิลเรียบร้อย",
    // 11 =>"K ชำระเงินแล้ว",
    // 12 =>"L ยกเลิกงานเคลม" 
  ];



for($i=1;$i<10;$i++){
            $now = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) as b,SUM(cost_doit) as c,SUM(cost_sparepart) as d,SUM(cost_totel) as e")->whereRaw("payment_st = '". $statusType[$i] ."'  GROUP BY date_cliam ORDER BY date_cliam ASC")->get();

            $objPHPExcel->getActiveSheet()->setCellValue('B'.(3+$i), !empty($now->b) ? $now->b : 0);
            // $objPHPExcel->getActiveSheet()->setCellValue('C4', $qnow['c']);
            // $objPHPExcel->getActiveSheet()->setCellValue('D4', $qnow['d']);
            // $objPHPExcel->getActiveSheet()->setCellValue('E4', $qnow['e']);

}

    $dataA = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) as b,SUM(cost_doit) as c,SUM(cost_sparepart) as d,SUM(cost_totel) as e")->whereRaw("payment_st = 'A เปิดใบรับรถ'")->get();
    $dataA2 = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) as b,SUM(cost_doit) as c,SUM(cost_sparepart) as d,SUM(cost_totel) as e")->whereRaw("SUBSTR(date_cliam,1,7) = substr(?,0,7)", [$todate])->get();


    $objPHPExcel->getActiveSheet()->setCellValue('B4', empty($dataA->b) ? 0 : $dataA->b);
    $objPHPExcel->getActiveSheet()->setCellValue('C4', empty($dataA->c) ? 0 : $dataA->c);
    $objPHPExcel->getActiveSheet()->setCellValue('D4', empty($dataA->d) ? 0 : $dataA->d);
    $objPHPExcel->getActiveSheet()->setCellValue('E4', empty($dataA->e) ? 0 : $dataA->e);
    // $objPHPExcel->getActiveSheet()->setCellValue('J4', $dataA2['b']);
    // $objPHPExcel->getActiveSheet()->setCellValue('K4', $dataA2['c']);
    // $objPHPExcel->getActiveSheet()->setCellValue('L4', $dataA2['d']);
    // $objPHPExcel->getActiveSheet()->setCellValue('M4', $dataA2['e']);

    // $b = "SELECT SUBSTRING(payment_st,1,1) as a ,COUNT(no_claim) as b,SUM(cost_doit) as c,SUM(cost_sparepart) as d,SUM(cost_totel) as e FROM tbl_claim 
    // WHERE     SUBSTRING(payment_st,1,1) IN ('B') GROUP BY payment_st";
    // $b2 = "SELECT SUBSTRING(payment_st,1,1) as a ,COUNT(no_claim) as b,SUM(cost_doit) as c,SUM(cost_sparepart) as d,SUM(cost_totel) as e FROM tbl_claim 
    // WHERE  SUBSTRING(payment_st,1,1) IN ('B') AND date_firmins = '0000-00-00' GROUP BY payment_st";
    // $dataB = mysql_fetch_array(mysql_query($b));
    // $dataB2 = mysql_fetch_array(mysql_query($b2));

    $dataB = DB::table('tbl_claim')->selectRaw("SUBSTRING(payment_st,1,1) as a ,COUNT(no_claim) as b,SUM(cost_doit) as c,SUM(cost_sparepart) as d,SUM(cost_totel) as e")->whereRaw("SUBSTRING(payment_st,1,1) IN ('B') GROUP BY payment_st")->get();
    $dataB2 = DB::table('tbl_claim')->selectRaw("SUBSTRING(payment_st,1,1) as a ,COUNT(no_claim) as b,SUM(cost_doit) as c,SUM(cost_sparepart) as d,SUM(cost_totel) as e")->whereRaw("SUBSTRING(payment_st,1,1) IN ('B') AND date_firmins = 0000-00-00 OR date_firmins is null GROUP BY payment_st")->get();

    $objPHPExcel->getActiveSheet()->setCellValue('B5', empty($dataB) ? 0 : $dataB[0]->b);
    $objPHPExcel->getActiveSheet()->setCellValue('C5', empty($dataB) ? 0 : $dataB[0]->c);
    $objPHPExcel->getActiveSheet()->setCellValue('D5', empty($dataB) ? 0 : $dataB[0]->d);
    $objPHPExcel->getActiveSheet()->setCellValue('E5', empty($dataB) ? 0 : $dataB[0]->e);
    // $objPHPExcel->getActiveSheet()->setCellValue('J5', $dataB2['b']);
    // $objPHPExcel->getActiveSheet()->setCellValue('K5', $dataB2['c']);
    // $objPHPExcel->getActiveSheet()->setCellValue('L5', $dataB2['d']);
    // $objPHPExcel->getActiveSheet()->setCellValue('M5', $dataB2['e']);
    
    $c_h = DB::table('tbl_claim')->selectRaw("SUBSTRING(payment_st,1,1) as a,count(no_claim) as b,sum(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("SUBSTRING(payment_st,1,1) in ('C','D','E','F','G','H') group by payment_st")->get();

    // dd($c_h);

    $c = DB::table('tbl_claim')->selectRaw("'C' as a,count(no_claim) as b,sum(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("DATE_FORMAT(date_firmins, '%Y-%m') = substr('". $todate ."',0,7)")->get();
    // dd($c);

    $d_h = DB::table('tbl_claim')->selectRaw(" SUBSTRING(payment_st,1,1) as a,count(no_claim) as b,sum(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("SUBSTRING(payment_st,1,1) IN ('D','E','F','G') GROUP BY payment_st")->get();
    // dd($d_h);

    $h = DB::table('tbl_claim')->selectRaw("'H' as a,count(no_claim) as b,sum(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("SUBSTRING(payment_st,1,1) = 'H'")->get();
    // dd($h);


    $dataG = DB::table('tbl_claim')->selectRaw("'G' as a,count(no_claim) as b,sum(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("DATE_FORMAT(date_send_next, '%Y-%m-%d') = '". $todate ."'")->get();
    // dd($dataG);
    $dataG2 = DB::table('tbl_claim')->selectRaw("'G' as a,count(no_claim) as b,sum(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("DATE_FORMAT(date_send_next, '%Y-%m') = substr('". $todate ."',0,7)")->get();
    // dd($dataG2);

    // $objPHPExcel->getActiveSheet()->setCellValue('B10', $dataG['b']);
    // $objPHPExcel->getActiveSheet()->setCellValue('C10', $dataG['c']);
    // $objPHPExcel->getActiveSheet()->setCellValue('D10', $dataG['d']);
    // $objPHPExcel->getActiveSheet()->setCellValue('E10', $dataG['e']);
    // $objPHPExcel->getActiveSheet()->setCellValue('J10', $dataG2['b']);
    // $objPHPExcel->getActiveSheet()->setCellValue('K10', $dataG2['c']);
    // $objPHPExcel->getActiveSheet()->setCellValue('L10', $dataG2['d']);
    // $objPHPExcel->getActiveSheet()->setCellValue('M10', $dataG2['e']);

    $pay_st = array('C','D','E','F','G','H');
    $pay_key = array_keys($pay_st);

    $arr_ch = array();
    $arr_dh = array();
    $arr_c = array();
    // $q_CH = mysql_query($c_h) or die(mysql_error());

    foreach ($c_h as $datac_h) {
        $arr = array();
        $arr[]= $datac_h->b;
        $arr[]= $datac_h->c;
        $arr[] = $datac_h->d;
        $arr[] = $datac_h->e;

        $arr_ch[$datac_h->a] = $arr;
    }

    $dataC2 = $c[0];
    $dataH = $h[0];
    $arr_c = array();
    $arr_h = array();
    $arr_c[$dataC2->a] = [$dataC2->b,$dataC2->c,$dataC2->d,$dataC2->e];
    $arr_h[$dataH->a] = [$dataH->b,$dataH->c,$dataH->d,$dataH->e];
    
    // $q_DH = mysql_query($d_h)or die(mysql_error());

    foreach ($d_h as $datad_h) {
        $arr2 = array();
        $arr2[]= $datad_h->b;
        $arr2[]= $datad_h->c;
        $arr2[] = $datad_h->d;
        $arr2[] = $datad_h->e;
        $arr_dh[$datad_h->a] = $arr2;
    }

    $arr_ch_key = array_keys($arr_ch);

    $month_ch = array_merge($arr_c,$arr_dh,$arr_h);

   
    // dd( $pay_st[5][0]);
    // dd( $pay_key);
    // dd($arr_ch_key);
    for($i=0;$i<count($pay_st);$i++){
        if($arr_ch[$pay_st[$i]][0] != ""){
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(5+($i+1)),$arr_ch[$pay_st[$i]][0]);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(5+($i+1)),$arr_ch[$pay_st[$i]][1]);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(5+($i+1)),$arr_ch[$pay_st[$i]][2]);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(5+($i+1)),$arr_ch[$pay_st[$i]][3]);
        }else{
            $objPHPExcel->getActiveSheet()->setCellValue('B'.(5+($i+1)),0);
            $objPHPExcel->getActiveSheet()->setCellValue('C'.(5+($i+1)),0);
            $objPHPExcel->getActiveSheet()->setCellValue('D'.(5+($i+1)),0);
            $objPHPExcel->getActiveSheet()->setCellValue('E'.(5+($i+1)),0);
        }
        // if($month_ch[$pay_st[$i]][0]!=""){
        //     $objPHPExcel->getActiveSheet()->setCellValue('J'.(5+($i+1)),$month_ch[$pay_st[$i]][0]);
        //     $objPHPExcel->getActiveSheet()->setCellValue('K'.(5+($i+1)),$month_ch[$pay_st[$i]][1]);
        //     $objPHPExcel->getActiveSheet()->setCellValue('L'.(5+($i+1)),$month_ch[$pay_st[$i]][2]);
        //     $objPHPExcel->getActiveSheet()->setCellValue('M'.(5+($i+1)),$month_ch[$pay_st[$i]][3]);  
        // }else{
        //     $objPHPExcel->getActiveSheet()->setCellValue('J'.(5+($i+1)),0);
        //     $objPHPExcel->getActiveSheet()->setCellValue('K'.(5+($i+1)),0);
        //     $objPHPExcel->getActiveSheet()->setCellValue('L'.(5+($i+1)),0);
        //     $objPHPExcel->getActiveSheet()->setCellValue('M'.(5+($i+1)),0); 
        // }
       
   }

    $dataI = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) AS b,SUM(firm_doit) AS c,SUM(firm_sparepart) AS d,SUM(firm_all) AS e")->whereRaw("payment_st = 'I ขออนุมัติวางบิล'")->get();
    // dd($dataI);

    $dataI2 = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) AS b,SUM(firm_doit) AS c,SUM(firm_sparepart) AS d,SUM(firm_all) AS e")->whereRaw("DATE_FORMAT(date_ecliam, '%Y-%m') = substr('". $todate ."',0,7)")->get()[0];
    // dd($dataI2);


    $objPHPExcel->getActiveSheet()->setCellValue('B12', $dataI[0]->b === null ? 0 : $dataI[0]->b);
    $objPHPExcel->getActiveSheet()->setCellValue('C12', $dataI[0]->c === null ? 0 : $dataI[0]->c);
    $objPHPExcel->getActiveSheet()->setCellValue('D12',  $dataI[0]->d === null ? 0 : $dataI[0]->d);
    $objPHPExcel->getActiveSheet()->setCellValue('E12', $dataI[0]->e === null ? 0 : $dataI[0]->e);
    // $objPHPExcel->getActiveSheet()->setCellValue('J12',$dataI2['b']);
    // $objPHPExcel->getActiveSheet()->setCellValue('K12',$dataI2['c']);
    // $objPHPExcel->getActiveSheet()->setCellValue('L12',$dataI2['d']);
    // $objPHPExcel->getActiveSheet()->setCellValue('M12',$dataI2['e']);

    $dataJ = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) as b,SUM(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("date_bill = '". $todate ."'")->get()[0];
    // dd($dataJ);

    $dataJ2 = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) as b,SUM(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("payment_st = 'J วางบิลเรียบร้อย' AND DATE_FORMAT(date_transfer, '%Y-%m') = DATE_FORMAT('". $todate ."', '%Y-%m')")->get()[0];
    // dd($dataJ2);

    // $objPHPExcel->getActiveSheet()->setCellValue('B13', $dataJ['b']);
    // $objPHPExcel->getActiveSheet()->setCellValue('C13',$dataJ['c']);
    // $objPHPExcel->getActiveSheet()->setCellValue('D13',$dataJ['d']);
    // $objPHPExcel->getActiveSheet()->setCellValue('E13',$dataJ['e']);
    $objPHPExcel->getActiveSheet()->setCellValue('B13',$dataJ2->b === null ? 0 : $dataJ2->b);
    $objPHPExcel->getActiveSheet()->setCellValue('C13',$dataJ2->c === null ? 0 : $dataJ2->c);
    $objPHPExcel->getActiveSheet()->setCellValue('D13',$dataJ2->d === null ? 0 : $dataJ2->d);
    $objPHPExcel->getActiveSheet()->setCellValue('E13',$dataJ2->e === null ? 0 : $dataJ2->e);

    $dataK = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) as b,SUM(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("date_transfer = '". $todate ."'")->get();
    // dd($dataK);

    $dataK2 = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) as b,SUM(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("payment_st = 'K ชำระเงินแล้ว' AND DATE_FORMAT(date_transfer, '%Y-%m') = DATE_FORMAT('". $todate ."', '%Y-%m')")->get();
    // dd($dataK2);

    // $objPHPExcel->getActiveSheet()->setCellValue('B14', $dataK['b']);
    // $objPHPExcel->getActiveSheet()->setCellValue('C14',$dataK['c']);
    // $objPHPExcel->getActiveSheet()->setCellValue('D14',$dataK['d']);
    // $objPHPExcel->getActiveSheet()->setCellValue('E14',$dataK['e']);
    $objPHPExcel->getActiveSheet()->setCellValue('B14', $dataK2[0]->b === null ? 0 : $dataK2[0]->b);
    $objPHPExcel->getActiveSheet()->setCellValue('C14', $dataK2[0]->c === null ? 0 : $dataK2[0]->c);
    $objPHPExcel->getActiveSheet()->setCellValue('D14', $dataK2[0]->d === null ? 0 : $dataK2[0]->d);
    $objPHPExcel->getActiveSheet()->setCellValue('E14', $dataK2[0]->e === null ? 0 : $dataK2[0]->e);

    $dataL = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) as b,SUM(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("DATE_FORMAT(date_status, '%Y-%m-%d') = '". $todate ."' AND SUBSTRING(payment_st,1,1) IN ('L') GROUP BY payment_st")->get();
    // dd($dataL);

    $dataL2 = DB::table('tbl_claim')->selectRaw("COUNT(no_claim) as b,SUM(firm_doit) as c,SUM(firm_sparepart) as d,SUM(firm_all) as e")->whereRaw("DATE_FORMAT(date_status, '%Y-%m') = substr('". $todate ."',0,7) AND SUBSTRING(payment_st,1,1) IN ('L') GROUP BY payment_st")->get();
    // dd($dataL2);

    // $objPHPExcel->getActiveSheet()->setCellValue('B15', $dataL['b']);
    // $objPHPExcel->getActiveSheet()->setCellValue('C15',$dataL['c']);
    // $objPHPExcel->getActiveSheet()->setCellValue('D15',$dataL['d']);
    // $objPHPExcel->getActiveSheet()->setCellValue('E15',$dataL['e']);
    $objPHPExcel->getActiveSheet()->setCellValue('B15', empty($dataL->b) ? 0 : $dataL[0]->b);
    $objPHPExcel->getActiveSheet()->setCellValue('C15', empty($dataL->c) ? 0 : $dataL[0]->c);
    $objPHPExcel->getActiveSheet()->setCellValue('D15', empty($dataL->d) ? 0 : $dataL[0]->d);
    $objPHPExcel->getActiveSheet()->setCellValue('E15', empty($dataL->e) ? 0 : $dataL[0]->e);

$objPHPExcel->getActiveSheet()->getStyle('A2:M15')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A2:M15')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $objPHPExcel->getActiveSheet()->getStyle('A2:M15')->applyFromArray(
        array(
    
            'borders' => array(
                'allborders' => array(
                  'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
              )
            )
        )
    );  

$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddHeader('&L&BInvoice&RPrinted on &D');
$objPHPExcel->getActiveSheet()->getHeaderFooter()->setOddFooter('&L&B' . $objPHPExcel->getProperties()->getTitle() . '&RPage &P of &N');

// Set page orientation and size
//echo date('H:i:s') . " Set page orientation and size\n";
$objPHPExcel->getActiveSheet()->getPageSetup()->setOrientation(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::ORIENTATION_LANDSCAPE);
$objPHPExcel->getActiveSheet()->getPageSetup()->setPaperSize(\PhpOffice\PhpSpreadsheet\Worksheet\PageSetup::PAPERSIZE_A4);
$objPHPExcel->getActiveSheet()->getPageMargins()->setTop(0.75); // กำหนดระยะขอบ บน
$objPHPExcel->getActiveSheet()->getPageMargins()->setRight(0.25); // กำหนดระยะขอบ ขวา
$objPHPExcel->getActiveSheet()->getPageMargins()->setLeft(0.25); // กำหนดระยะขอบ ซ้าย
$objPHPExcel->getActiveSheet()->getPageMargins()->setBottom(0.75); // กำหนดระยะขอบ ล่าง
// Rename sheet
//echo date('H:i:s') . " Rename sheet\n";
$objPHPExcel->getActiveSheet()->setTitle('StatusAuditDoc');

$fname = "tmp/monthreport.xlsx";


$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="monthreport.xlsx"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');
for ($i = 0; $i < ob_get_level(); $i++) {
   ob_end_flush();
}
ob_implicit_flush(1);
ob_clean();
$xlsxWriter->save($fname);

exit($xlsxWriter->save('php://output'));


?>