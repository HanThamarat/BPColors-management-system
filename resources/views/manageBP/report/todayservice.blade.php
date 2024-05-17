<?php
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;
	
 	 $fromdate = '2024-04-14';
 	 $todate = '2024-04-20';
	
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

	

 
	$textTitle ="Pivot Claim ";		
					
				


$objPHPExcel = new Spreadsheet();

$objPHPExcel->getProperties()->setCreator("Poobate Khunthong")
							 ->setLastModifiedBy("Poobate Khunthong")
							 ->setTitle("Office 2007 XLSX ")
							 ->setSubject("Office 2007 XLSX ")
							 ->setDescription("document for Office 2007 XLSX")
							 ->setKeywords("office 2007 openxml php")
							 ->setCategory("result file");


// Create a first sheet, representing sales data

$objPHPExcel->setActiveSheetIndex(0);
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
;



$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'วันที่ปิด Job/วันที่ DMS');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'เลขที่ JOB');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ช่างผู้รับผิดชอบ');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'ป้ายทะเบียน');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'ประเภทงาน');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'ค่าแรง');







$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A1:G1')->applyFromArray(
		array(
			'font'    => array(
				'bold'      => true
			),
			
			'borders' => array(
				'allborders' => array(
					  'style' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
					)
			),
			'fill' => array(
	 			'type'       => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_GRADIENT_LINEAR,
	  			'rotation'   => 90,
	 			'startcolor' => array(
	 				'argb' => 'FFA0A0A0'
	 			),
	 			'endcolor'   => array(
	 				'argb' => 'FFFFFFFF'
	 			)
	 		)
		)
);

				// $objPHPExcel->getActiveSheet()->getStyle('B:B')->getNumberFormat()->setFormatCode('dd/mm/yyyy');
				// $objPHPExcel->getActiveSheet()->getStyle('C:C')->getNumberFormat()->setFormatCode('_-[$฿-41E]* #,##0.00_-;-[$฿-41E]* #,##0.00_-;_-[$฿-41E]* "-"??_-;_-@_-');
				// $objPHPExcel->getActiveSheet()->getStyle('D:D')->getNumberFormat()->setFormatCode('0.00%');
				// $objPHPExcel->getActiveSheet()->getStyle('E:E')->getNumberFormat()->setFormatCode('_-[$฿-41E]* #,##0.00_-;-[$฿-41E]* #,##0.00_-;_-[$฿-41E]* "-"??_-;_-@_-');
				// $objPHPExcel->getActiveSheet()->getStyle('F:F')->getNumberFormat()->setFormatCode('0.00');

    
 				$r = 0;
				$no = 1;
				$total = 0;
                $total2 = 0;
						
                    $response = DB::table('tbl_claim')->rightJoin('tbl_wip', 'tbl_claim.no_claim', '=' , 'tbl_wip.no_claimex')->whereRaw("SUBSTRING(tbl_claim.payment_st,1,1) in ('G','H','I','J','K') AND tbl_claim.date_dms BETWEEN '2024-04-14' AND '2024-04-22' ORDER BY tbl_claim.date_dms DESC")->get();
                    
                    foreach ($response as $res) {
                        $objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
                    	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$res->date_dms);
                    	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$res->no_job);
                    	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$res->respon_name);
                    	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$res->no_regiscar);
                    	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$res->type_doit);
                    	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$res->cal_doit);

                        $no++;	
                        $r++;
                    }
				
					
				$objPHPExcel->getActiveSheet()->getStyle('A2'.':G'.($r+1))->getFont()->setName('Arial');
				$objPHPExcel->getActiveSheet()->getStyle('A2'.':G'.($r+1))->getFont()->setSize(8);
				$objPHPExcel->getActiveSheet()->getStyle('A2:G'.($r+2))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
				
											
				
				
			
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':G'.($r+2))->getFont()->setName('Candara');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':G'.($r+2))->getFont()->setSize(16);
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':G'.($r+2))->getFont()->setBold(true);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':G'.($r+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle('A2:G'.($r+2))->applyFromArray(
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
$objPHPExcel->getActiveSheet()->setTitle('report BP');

$objPHPExcel->createSheet();	
$objPHPExcel->setActiveSheetIndex(1);

$date1=date_create($fromdate);
$date2=date_create($todate);

$diff=date_diff($date1,$date2);

// dd($diff);
$num =  $diff->format("%a days");
$num2 =  $diff->format("%a");

$row = 3;
$c1 = 2;
$m=0;
$t=1;
$start = intval(substr($fromdate,8,10));
// $objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((3),($row), 'nam');
$objPHPExcel->getActiveSheet()->setCellValue([ 3, $row ], 'Name');

	 


for($i=$start;$i<=$num;$i++){
    $objPHPExcel->getActiveSheet()->setCellValue([($row+$t) , (3) ], substr($fromdate,0,7).'-'.sprintf("%02d",$i));
	$work_n2 = DB::table('tbl_technician')->whereRaw("active ='yes'")->get();
	$n2 = 1;
    foreach ($work_n2 as $name) {
        $res = DB::table('tbl_claim')
		->rightJoin('tbl_wip', 'tbl_claim.no_claim', '=', 'tbl_wip.no_claimex')
		->selectRaw("tbl_claim.date_dms , SUM(tbl_wip.cal_doit) AS sum")
		->whereRaw("tbl_wip.respon_name = ? AND tbl_claim.date_dms = ? GROUP BY tbl_claim.date_dms", [
			$name->name, substr($fromdate,0,7).'-'.sprintf("%02d",$i)
		])->get();
        // $objPHPExcel->getActiveSheet()->setCellValue([($row+$t) , (3+$n2) ], $res->date_dms);
		$n2++;
    }

	$sumT_col3 = $objPHPExcel->getActiveSheet()->getCell([($row+$t),(3+$n2)])->getColumn();
	$objPHPExcel->getActiveSheet()->setCellValue([($row+$t),(3+$n2)], '=SUM('.$sumT_col3.'4:'.$sumT_col3.($n2+2).')');
    $t++;
}

$sumT_col4 = $objPHPExcel->getActiveSheet()->getCell([($row+$t),(3+$n2)])->getColumn();

$objPHPExcel->getActiveSheet()->setCellValue([($row+$t),(3+$n2)], '=SUM('.$sumT_col4.'4:'.$sumT_col4.($n2+2).')');


$objPHPExcel->getActiveSheet()->setCellValue([($row+$t),(3)],'TOTAL');  

	$response = DB::table('tbl_technician')->where(['active' => 'yes'])->get();
	$n=1;
	$sumT_col1 = $objPHPExcel->getActiveSheet()->getCell([(4),(4)])->getColumn();
    $sumT_col2 = $objPHPExcel->getActiveSheet()->getCell([(3+$num2),(4)])->getColumn();

	foreach ($response as $name) {
			$objPHPExcel->getActiveSheet()->setCellValue([(3),($row+$n)],$name->name);
			
            $sum = '= SUM('.$sumT_col1.($n+3).':'.$sumT_col2.($n+3).')';
			$objPHPExcel->getActiveSheet()->setCellValue([($row+$t),(3+$n)], $sum);
			
			$n++;
	}
			// while($name = mysql_fetch_array($query_n)){

			// 	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow((3),($row+$n),$name['name']);
			

            //  $sum = '=SUM('.$sumT_col1.($n+3).':'.$sumT_col2.($n+3).')';
			// 	$objPHPExcel->getActiveSheet()->setCellValueByColumnAndRow(($row+$t),(3+$n), $sum);
			
			// 	$n++;
			
			// }  

 
  $objPHPExcel->getActiveSheet()->setCellValue([(3),($row+$n)],'TOTAL'); 


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

$fname = "tmp/todayservice.xlsx";


$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="todayservice.xlsx"');
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