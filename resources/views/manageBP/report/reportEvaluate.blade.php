<?php
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;
	

 	// $date = $_REQUEST['res'];   
 	// $s_date = explode('-', $date); 
 	$fromdate;
 	$todate;
	
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
//งานซ่อม
$objPHPExcel->setActiveSheetIndex(0);



$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'เลขเครม');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'วันที่รับเครม');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'วันที่ประกันอนุมัติ');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'จำนวนวัน');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'สถานะวัน');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'ประเภทงาน');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ป้ายทะเบียน');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'รุ่นรถ');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'ประกัน');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'ประเภทประกัน');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'สถานะ');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'วันที่ BILL');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'พนักงาน');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'อนุมัติค่าเเรง');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'อนุมัติค่าอะไหล่');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'อนุมัติทั้งหมด');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'ค่า Excess');
// $objPHPExcel->getActiveSheet()->setCellValue('N1', 'หมายเหตุ');





$objPHPExcel->getActiveSheet()->getStyle('A1:W1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:W1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A1:W1')->applyFromArray(
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

				

    
 				$r = 0;
				$no = 1;
				$total = 0;
                $total2 = 0;
				$timeTxt = '';
						


				//for($i=1;$i<13;$i++){


				//  $claimS = "SELECT no_claim,date_cliam,date_firmins ,car_job,no_regiscar,insure_name,insure_type,payment_st,car_brand,car_model,date_bill,user_con
				//  		 FROM tbl_claim WHERE  date_bill BETWEEN '".$fromdate."' AND '".$todate."' ";
	            // $q_claims = mysql_query($claimS);

                $response = DB::table('tbl_claim')->selectRaw("no_claim,date_cliam,date_firmins ,car_job,no_regiscar,insure_name,insure_type,payment_st,car_brand,car_model,date_bill,user_con")->whereRaw("date_bill BETWEEN '". $fromdate ."' AND '". $todate ."' ")->get();

                foreach ($response as $res) {
                                       
					$objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('############');
					$objPHPExcel->getActiveSheet()->getStyle('C:D')->getNumberFormat()->setFormatCode('yyyy-mm-dd');
					$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$res->no_claim);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$res->date_cliam);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$res->date_firmins);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),'=IF(D'.($r+2).'="0000-00-00",NOW()-C'.($r+2).',D'.($r+2).'-C'.($r+2).')');

					if($res->date_firmins === "0000-00-00" || $res->date_firmins === "" ){
						$dateNow=date_create(date('Y-m-d'));
					}else{
						$dateNow=date_create($res->date_firmins);
					}
					
					$dateCli=date_create($res->date_cliam);
					$diff=date_diff($dateCli,$dateNow);							
					$dateFirm = $diff->format("%R%a days");

					if(substr($res->car_job,0,1) === "H"){
						if($dateFirm>11){
							$timeTxt = "เลยกำหนด";
						}else{
							$timeTxt = "ปกติ";
						}

					}elseif(substr($res->car_job,0,1) === "M"){
						if($dateFirm>6){
							$timeTxt = "เลยกำหนด";
						}else{
							$timeTxt = "ปกติ";
						}

					}elseif(substr($res->car_job,0,1) === "L"){
						if($dateFirm>4){
							$timeTxt = "เลยกำหนด";
						}else{
							$timeTxt = "ปกติ";
						}

					}
					//$fomula= "=IFS(LEFT(K2,1)='H',IF(D2>20,'เกินกำหนด','ปกติ'),LEFT(K2,1)='M',IF(D2>10,'เกินกำหนด','ปกติ'),LEFT(K2,1)='L',IF(D2>5,'เกินกำหนด','ปกติ'))";
					$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$timeTxt);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$res->car_job);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$res->no_regiscar);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$res->car_model);
					$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$res->insure_name);
					$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$res->insure_type);
					$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$res->payment_st);
					$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$res->date_bill);
					$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$res->user_con);
					// $objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$res->firm_doit);
					// $objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$res->firm_sparepart);
					// $objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$res->firm_all);
					// $objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$res->exzept);
						
			
				
				
					
				$no++;	
				$r++;
                }				
					
				$objPHPExcel->getActiveSheet()->getStyle('A2'.':W'.($r+1))->getFont()->setName('Arial');
				$objPHPExcel->getActiveSheet()->getStyle('A2'.':W'.($r+1))->getFont()->setSize(8);
				$objPHPExcel->getActiveSheet()->getStyle('A2:W'.($r+2))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
				
											
				
				
			
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':W'.($r+2))->getFont()->setName('Candara');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':W'.($r+2))->getFont()->setSize(16);
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':W'.($r+2))->getFont()->setBold(true);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':W'.($r+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle('A2:W'.($r+2))->applyFromArray(
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
$objPHPExcel->getActiveSheet()->setTitle('ระยะเวลาอนุมัติ');

$objPHPExcel->createSheet();    
$objPHPExcel->setActiveSheetIndex(1);

$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'เลขเครม');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'วันที่เข้าซ่อม');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'วันที่DMS');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'จำนวนวัน');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'สถานะวัน');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'ประเภทงาน');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ป้ายทะเบียน');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'รุ่นรถ');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'ประกัน');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'ประเภทประกัน');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'สถานะ');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'วันที่ BILL');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'พนักงาน');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'เลขที่ job');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'อนุมัติค่าเเรง');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'อนุมัติค่าอะไหล่');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'อนุมัติทั้งหมด');
$objPHPExcel->getActiveSheet()->setCellValue('S1', 'ค่า Excess');





$objPHPExcel->getActiveSheet()->getStyle('A1:W1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
$objPHPExcel->getActiveSheet()->getStyle('A1:W1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

$objPHPExcel->getActiveSheet()->getStyle('A1:W1')->applyFromArray(
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

				

    
 				$r = 0;
				$no = 1;
				$total = 0;
                $total2 = 0;
						


				//for($i=1;$i<13;$i++){

                 $response_02 = DB::table('tbl_claim')->selectRaw("no_job,no_claim,date_cliam,date_firmins ,date_repair,date_dms,car_job,no_regiscar,insure_name,insure_type,payment_st,car_brand,car_model,date_bill,user_con")->whereRaw("date_bill  BETWEEN '". $fromdate ."' AND '". $todate ."'")->get();
				//  $claimS = "SELECT no_job,no_claim,date_cliam,date_firmins ,date_repair,date_dms,car_job,no_regiscar,insure_name,insure_type,payment_st,car_brand,car_model,date_bill,user_con 
				//   			FROM tbl_claim WHERE  date_bill  BETWEEN '".$fromdate."' AND '".$todate."'";
	            // $q_claims = mysql_query($claimS);
	              
	            foreach ($response_02 as $res) {
                    $objPHPExcel->getActiveSheet()->getStyle('E')->getNumberFormat()->setFormatCode('############');
					$objPHPExcel->getActiveSheet()->getStyle('C:D')->getNumberFormat()->setFormatCode('yyyy-mm-dd');
					$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
					$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$res->no_claim);
					$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$res->date_repair);
					$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$res->date_dms);
					$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),'=IF(D'.($r+2).'="0000-00-00",NOW()-C'.($r+2).',D'.($r+2).'-C'.($r+2).')');

					if($res->date_dms == "0000-00-00" || $res->date_dms === ""){
						$dateNow=date_create(date('Y-m-d'));
					}else{
						$dateNow=date_create($res->date_dms);
					}
					
					$dateCli=date_create($res->date_repair);
					$diff=date_diff($dateCli,$dateNow);							
					$dateFirm = $diff->format("%R%a days");
					if(substr($res->car_job,0,1) === "H"){
						if($dateFirm>21){
							$timeTxt = "เลยกำหนด";
						}else{
							$timeTxt = "ปกติ";
						}

					}elseif(substr($res->car_job,0,1) === "M"){
						if($dateFirm>11){
							$timeTxt = "เลยกำหนด";
						}else{
							$timeTxt = "ปกติ";
						}

					}elseif(substr($res->car_job,0,1) === "L"){
						if($dateFirm>6){
							$timeTxt = "เลยกำหนด";
						}else{
							$timeTxt = "ปกติ";
						}

					}
					//$fomula= "=IFS(LEFT(K2,1)='H',IF(D2>20,'เกินกำหนด','ปกติ'),LEFT(K2,1)='M',IF(D2>10,'เกินกำหนด','ปกติ'),LEFT(K2,1)='L',IF(D2>5,'เกินกำหนด','ปกติ'))";
					$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$timeTxt);
					$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$res->car_job);
					$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$res->no_regiscar);
					$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$res->car_model);
					$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$res->insure_name);
					$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$res->insure_type);
					$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$res->payment_st);
					$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$res->date_bill);
					$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$res->user_con);
					$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$res->no_job);
					// $objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$res->firm_doit);
					// $objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$res->firm_sparepart);
					// $objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$res->firm_all);
					// $objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$res->exzept);
						
			
				
				
					
				$no++;	
				$r++;
                }
		
					
				
					
				$objPHPExcel->getActiveSheet()->getStyle('A2'.':W'.($r+1))->getFont()->setName('Arial');
				$objPHPExcel->getActiveSheet()->getStyle('A2'.':W'.($r+1))->getFont()->setSize(8);
				$objPHPExcel->getActiveSheet()->getStyle('A2:W'.($r+2))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
				
											
				
				
			
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':W'.($r+2))->getFont()->setName('Candara');
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':W'.($r+2))->getFont()->setSize(16);
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':W'.($r+2))->getFont()->setBold(true);
				
				$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':W'.($r+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
				
				$objPHPExcel->getActiveSheet()->getStyle('A2:W'.($r+2))->applyFromArray(
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

$fname = "tmp/reportEvaluate.xlsx";


$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reportEvaluate.xlsx"');
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