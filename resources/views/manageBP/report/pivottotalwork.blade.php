<?php
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;
	$year;
	
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

// $work_n = "SELECT * FROM tbl_technician WHERE";
$work_n = DB::table('tbl_technician')->whereRaw("active ='yes'")->get();



$row = 1;
$c1 = 2;
$m=0;
$n_m=1;

$objPHPExcel->getActiveSheet()->setCellValue([(1), $row],"ชื่อช่าง");

foreach ($work_n as $res_name) {
    $row++;
    $objPHPExcel->getActiveSheet()->setCellValue([(1),($row)],$res_name->name);
}

for($i=2;$i<13;$i++){
	$objPHPExcel->getActiveSheet()->setCellValue([($i),(1)],$marr[$i].' '.$year);

	$y_m = $year.'-'.sprintf("%02d",$i);
	$emp=2;

	foreach ($work_n as $res_name2) {
        $work_a = DB::table('tbl_wip')->selectRaw("SUM(cal_doit) as doit")->whereRaw("respon_name= ? AND no_claimex IN (SELECT no_claim  FROM tbl_claim WHERE SUBSTRING(payment_st,1,1) in ('G','H','I','J','K') AND DATE_FORMAT(date_dms,'%Y-%m')= ? ) GROUP BY tbl_wip.respon_name", [$res_name2->name, $y_m])->get();
		foreach ($work_a as $res) {
			$objPHPExcel->getActiveSheet()->setCellValue([($i),($emp)],$res->doit);
        	$emp++;
		}
    }
	$n_m++;	
}
// $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
// $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

// $objPHPExcel->getActiveSheet()->getStyle('A1:H1')->applyFromArray(
// 		array(
// 			'font'    => array(
// 				'bold'      => true
// 			),
			
// 			'borders' => array(
// 				'allborders' => array(
// 					  'style' => PHPExcel_Style_Border::BORDER_THIN
// 					)
// 			),
// 			'fill' => array(
// 	 			'type'       => PHPExcel_Style_Fill::FILL_GRADIENT_LINEAR,
// 	  			'rotation'   => 90,
// 	 			'startcolor' => array(
// 	 				'argb' => 'FFA0A0A0'
// 	 			),
// 	 			'endcolor'   => array(
// 	 				'argb' => 'FFFFFFFF'
// 	 			)
// 	 		)
// 		)
// );

		
    
 			
					
				
					
		// 		$objPHPExcel->getActiveSheet()->getStyle('A2'.':H'.($r+1))->getFont()->setName('Arial');
		// 		$objPHPExcel->getActiveSheet()->getStyle('A2'.':H'.($r+1))->getFont()->setSize(8);
		// 		$objPHPExcel->getActiveSheet()->getStyle('A2:H'.($r+2))->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_TOP);
				
											
				
				
			
		// 		$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':H'.($r+2))->getFont()->setName('Candara');
		// 		$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':H'.($r+2))->getFont()->setSize(16);
		// 		$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':H'.($r+2))->getFont()->setBold(true);
				
		// 		$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':H'.($r+2))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
				
		// 		$objPHPExcel->getActiveSheet()->getStyle('A2:H'.($r+2))->applyFromArray(
		// array(
			
		// 	'borders' => array(
		// 		'allborders' => array(
		// 			  'style' => PHPExcel_Style_Border::BORDER_THIN
		// 			)
		// 		)
	 // 		)
		// );

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

$fname = "tmp/pivottotalwork.xlsx";


$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pivottotalwork.xlsx"');
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