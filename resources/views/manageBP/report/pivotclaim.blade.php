<?php

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;

	$year;
 	// $datefrom = $_POST[datefrom];
 	// $dateto = $_POST[dateto];
	
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
$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(16);
$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(13);
$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(8);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
$objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);



$objPHPExcel->getActiveSheet()->setCellValue('A1', 'เดือนที่รับเคลม');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'อนุมัตค่าเเรง');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'อนุมัตค่าอะไหล่');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'อนุมัตรวม');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'จำนวนการเคลม');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'รถCKY');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'รถWK');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'รถซื้อCKY');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'รถซื้อWK');
$objPHPExcel->getActiveSheet()->setCellValue('J1', "อิ่นๆ");



$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A1:J1')->applyFromArray(
		array(
			'font'    => array(
				'bold'      => true
			),
			
			'borders' => array(
				'allborders' => array(
					  'style' =>\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN
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
						
				// dd($year);

				for($i=1;$i<13;$i++){
                    $response = DB::table('tbl_claim')->selectRaw("SUM(firm_doit) AS doit ,SUM(firm_sparepart) AS sparepart,SUM(firm_all) AS total,
                    COUNT(no_claim) AS claim,SUM(car_type='รถCKY')AS cky,SUM(car_type='รถWK') AS wk,
                    SUM(car_type='รถซื้อCKY')AS b_cky,SUM(car_type='รถซื้อWK')AS b_wk,SUM(car_type='อื่นๆ')AS other")->whereRaw("DATE_FORMAT(date_cliam, '%Y-%c') = '".$year."-".$i."'")->get();

					
                    $res = $response[0];

		                   
					$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$marr[$i]."/".$year);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$res->doit);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$res->sparepart);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$res->total);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$res->claim);
					$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$res->cky);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$res->wk);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$res->b_cky);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$res->b_wk);
					$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$res->other);				
					
					
				$r++;
				}
		
					
				
					
				$objPHPExcel->getActiveSheet()->getStyle('A2'.':J'.($r+1))->getFont()->setName('Arial');
				$objPHPExcel->getActiveSheet()->getStyle('A2'.':J'.($r+1))->getFont()->setSize(8);
				$objPHPExcel->getActiveSheet()->getStyle('A2:J'.($r+2))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
				
											
				
				
			
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':J'.($r+2))->getFont()->setName('Candara');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':J'.($r+2))->getFont()->setSize(16);
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':J'.($r+2))->getFont()->setBold(true);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':J'.($r+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle('A2:J'.($r+2))->applyFromArray(
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

$fname = "tmp/pivotclaim.xlsx";


$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="pivotclaim.xlsx"');
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