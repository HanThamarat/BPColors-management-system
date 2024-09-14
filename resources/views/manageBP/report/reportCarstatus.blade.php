<?php
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;


 	// $date = $_REQUEST['res'];   
 	// $s_date = explode('-', $date); 
	// $years= $_POST['years'];
 	// $fromdate = $_POST['fromdate'];
 	// $todate = $_POST['todate'];
	
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



$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
$objPHPExcel->getActiveSheet()->setCellValue('B1', 'วันที่เข้าซ่อม');
$objPHPExcel->getActiveSheet()->setCellValue('C1', 'วันที่DMS');
$objPHPExcel->getActiveSheet()->setCellValue('D1', 'ระยะเวลา');
$objPHPExcel->getActiveSheet()->setCellValue('E1', 'สถานะเวลา');
$objPHPExcel->getActiveSheet()->setCellValue('F1', 'สถานะการซ่อม');
$objPHPExcel->getActiveSheet()->setCellValue('G1', 'วันที่ส่งมอบระบบ');
$objPHPExcel->getActiveSheet()->setCellValue('H1', 'ป้ายทะเบียน');
$objPHPExcel->getActiveSheet()->setCellValue('I1', 'รุ่นรถ');
$objPHPExcel->getActiveSheet()->setCellValue('J1', 'เลขที่ใบสั่งซ่อม');
$objPHPExcel->getActiveSheet()->setCellValue('K1', 'ประเภทการซ่อม');
$objPHPExcel->getActiveSheet()->setCellValue('L1', 'ประกัน');
$objPHPExcel->getActiveSheet()->setCellValue('M1', 'วันที่ส่งมอบ');
$objPHPExcel->getActiveSheet()->setCellValue('N1', 'ค่าเเรง');
$objPHPExcel->getActiveSheet()->setCellValue('O1', 'ค่าอะไหล่');
$objPHPExcel->getActiveSheet()->setCellValue('P1', 'ยอดรวม');
$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'SA');
$objPHPExcel->getActiveSheet()->setCellValue('R1', 'หมายเหตุ');





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
						


				$response = DB::table('tbl_claim')->selectRaw("*, DATEDIFF(CASE WHEN date_dms IS NULL THEN CURRENT_DATE() ELSE date_dms END,date_repair) AS dateDelays")->whereRaw("SUBSTRING(payment_st,1,1) not in ('G','H','I','J','K','L') and date_repair<>'0000-00-00' ORDER BY date_cliam ASC")->get();


                foreach ($response as $res) {
                    	$objPHPExcel->getActiveSheet()->getStyle('D')->getNumberFormat()->setFormatCode('############');
                    	$objPHPExcel->getActiveSheet()->getStyle('B:C')->getNumberFormat()->setFormatCode('yyyy-mm-dd');
                    	$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
                    	$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$res->date_repair);
                    	$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$res->date_dms == null || $res->date_dms == '' ? "0000-00-00" : $res->date_dms);
                    	$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$res->dateDelays);
                    	// $objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),'=IF(C'.($r+2).'="0000-00-00",NOW()-B'.($r+2).',C'.($r+2).'-B'.($r+2).')');

                    	if($res-> date_dms == "0000-00-00" || $res->date_dms == null){
                    		$dateNow=date_create(date('Y-m-d'));
                    	}else{
                    		$dateNow=date_create($res->date_dms);
                    	}
                        
                    	$dateCli=date_create($res->date_repair);
                    	$diff=date_diff($dateCli,$dateNow);							
                    	$dateFirm = $diff->format("%a");
                    	if(substr($res->car_job,0,1)=="H"){
                    		if($dateFirm>21){
                    			$timeTxt = "เลยกำหนด";
                    		}else{
                    			$timeTxt = "ปกติ";
                    		}

                    	}elseif(substr($res->car_job,0,1)=="M"){
                    		if($dateFirm>11){
                    			$timeTxt = "เลยกำหนด";
                    		}else{
                    			$timeTxt = "ปกติ";
                    		}

                    	}elseif(substr($res->car_job,0,1)=="L"){
                    		if($dateFirm>6){
                    			$timeTxt = "เลยกำหนด";
                    		}else{
                    			$timeTxt = "ปกติ";
                    		}

                    	}
                    	//$fomula= "=IFS(LEFT(K2,1)='H',IF(D2>20,'เกินกำหนด','ปกติ'),LEFT(K2,1)='M',IF(D2>10,'เกินกำหนด','ปกติ'),LEFT(K2,1)='L',IF(D2>5,'เกินกำหนด','ปกติ'))";
                    	$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$timeTxt);
                    	$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$res->job_status);
                    	$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$res->date_send);
                    	$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$res->no_regiscar);
                    	$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$res->car_model);
                    	$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$res->no_job);
                    	$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$res->car_job);
                    	$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$res->insure_name);
                    	$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$res->date_send_next);
                    	$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$res->firm_doit);
                    	$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$res->firm_sparepart);
                    	$objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$res->firm_all);
                    	$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$res->user_con);
                    	$objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$res->note_service);			
                
                    
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

$objPHPExcel->getActiveSheet()->setTitle('repair total day');

$objPHPExcel->createSheet();    
$objPHPExcel->setActiveSheetIndex(1);

$objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
$objPHPExcel->getActiveSheet()->setCellValue('A1', 'รายงานผลรวมของระยะเวลาการซ่อม');

$SA = DB::table('tbl_claim')->selectRaw("user_con")->whereRaw("SUBSTRING(payment_st,1,1) not in ('G','H','I','J','K','L') and date_repair<>'0000-00-00' GROUP BY user_con")->get();

$saCell = 2;

$objPHPExcel->getActiveSheet()->setCellValue('A2', '#');
foreach ($SA as $key => $value) {
	$objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
	$objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
	$objPHPExcel->getActiveSheet()->setCellValue([($saCell), (2)], @$value->user_con);
	$saCell++;
}

$lobList = DB::table('tbl_claim')->selectRaw("
	car_job, 
	CASE 
		WHEN car_job = 'H1' THEN '25 วัน'
		WHEN car_job = 'H2' THEN '35 วัน'
		WHEN car_job = 'H3' THEN '45 วัน'
		WHEN car_job = 'L-เบา' THEN '6 วัน'
		WHEN car_job = 'M-กลาง' THEN '14 วัน'
	END AS jobDue
")->whereRaw("SUBSTRING(payment_st,1,1) not in ('G','H','I','J','K','L') and date_repair<>'0000-00-00' GROUP BY car_job ")->get();

$r = 3;
$saRow = 4;
$saCell = 2;

foreach ($lobList as $key => $value) {
	$objPHPExcel->getActiveSheet()->getStyle('A'.($r).':'.'C'.($r))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('ffb703');
	$objPHPExcel->getActiveSheet()->setCellValue('A'.($r),"{$value->car_job} ({$value->jobDue})");
	$car_job = $value->car_job;
	$carList = DB::table('tbl_claim')->selectRaw("date_repair ,no_regiscar, no_claim")->whereRaw("SUBSTRING(payment_st,1,1) not in ('G','H','I','J','K','L') and date_repair<>'0000-00-00' and car_job = '". $value->car_job ."' GROUP BY no_regiscar, no_claim ,car_job, date_repair")->get();
	$r++;
	foreach ($carList as $key => $value) {
		$dateCli=date_create($value->date_repair);
		$diff=date_diff($dateCli,$dateNow);		
		
		if($car_job == "H1" && $diff->days > 25){
			$objPHPExcel->getActiveSheet()->getStyle('A'.($r).':'.'C'.($r))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('e85d04');
		} else if ($car_job == "H2" && $diff->days > 35) {
			$objPHPExcel->getActiveSheet()->getStyle('A'.($r).':'.'C'.($r))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('e85d04');
		} else if ($car_job == "H3" && $diff->days > 45) {
			$objPHPExcel->getActiveSheet()->getStyle('A'.($r).':'.'C'.($r))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('e85d04');
		} else if ($car_job == "L-เบา" && $diff->days > 6) {
			$objPHPExcel->getActiveSheet()->getStyle('A'.($r).':'.'C'.($r))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('e85d04');
		} else if ($car_job == "M-กลาง" && $diff->days > 14) {
			$objPHPExcel->getActiveSheet()->getStyle('A'.($r).':'.'C'.($r))->getFill()->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)->getStartColor()->setARGB('e85d04');
		}
		$objPHPExcel->getActiveSheet()->setCellValue('A'.($r), @$value->no_regiscar);
		$no_regis = @$value->no_regiscar;
		$noClaim =  @$value->no_claim;
		foreach ($SA as $key => $value) {
			$recheckPA = DB::table('tbl_claim')->selectRaw("DATEDIFF(CASE WHEN date_dms IS NULL THEN CURRENT_DATE() ELSE date_dms END,date_repair) AS dateDelays")->whereRaw("SUBSTRING(payment_st,1,1) not in ('G','H','I','J','K','L') and date_repair<>'0000-00-00' and user_con = '".  @$value->user_con ."' and no_claim = '". $noClaim ."'")->get();
			$objPHPExcel->getActiveSheet()->setCellValue([($saCell), ($saRow)], @$recheckPA[0] === null ? '0' : @$recheckPA[0]->dateDelays);
			$saCell++;
		}
		$saRow++;
		$saCell = 2;
		$r++;
	}
	$saRow++;
}

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

$fname = "tmp/reportCarstatus.xlsx";


$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reportCarstatus.xlsx"');
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