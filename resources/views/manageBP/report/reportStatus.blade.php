<?php
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;



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
			// $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(4);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(9);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(11);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(11);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(7);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(12);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(10);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(5);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(5);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12);
			// $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(14);




			$objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
			$objPHPExcel->getActiveSheet()->setCellValue('B1', 'เลขที่เครม');
			$objPHPExcel->getActiveSheet()->setCellValue('C1', 'วันที่เปลี่ยนสถานะ');
			$objPHPExcel->getActiveSheet()->setCellValue('D1', 'วันที่เครม');
			$objPHPExcel->getActiveSheet()->setCellValue('E1', 'วันที่ประกันออนมัติ');
			$objPHPExcel->getActiveSheet()->setCellValue('F1', 'จำนวนวันประกัน');
			$objPHPExcel->getActiveSheet()->setCellValue('G1', 'สถานะประกัน');
			$objPHPExcel->getActiveSheet()->setCellValue('H1', 'วันที่รับรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('I1', 'ทะเบียนรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('J1', 'ยี่ห้อรถ');
			$objPHPExcel->getActiveSheet()->setCellValue('K1', 'ประเมินค่าอะไหล่');
			$objPHPExcel->getActiveSheet()->setCellValue('L1', 'ประเมินค่าเเรง');
			$objPHPExcel->getActiveSheet()->setCellValue('M1', 'ประเมินรวม');
			$objPHPExcel->getActiveSheet()->setCellValue('N1', 'อนุมัติค่าอะไหล่');
			$objPHPExcel->getActiveSheet()->setCellValue('O1', 'อนุมัติค่าแรง');
			$objPHPExcel->getActiveSheet()->setCellValue('P1', 'อนุมัติรวม');
			$objPHPExcel->getActiveSheet()->setCellValue('Q1', 'ผู้รับเคส');
			$objPHPExcel->getActiveSheet()->setCellValue('R1', '');
			$objPHPExcel->getActiveSheet()->setCellValue('S1', 'จำนวนเงินรับจริง');
			$objPHPExcel->getActiveSheet()->setCellValue('T1', 'วันที่เข้าซ่อม');
			$objPHPExcel->getActiveSheet()->setCellValue('U1', 'วันที่DMS');
			$objPHPExcel->getActiveSheet()->setCellValue('V1', 'จำนวนวันซ่อม');
			$objPHPExcel->getActiveSheet()->setCellValue('W1', 'สถานะซ่อม');
			$objPHPExcel->getActiveSheet()->setCellValue('X1', 'วันนัดหมายรับบริการ');
			$objPHPExcel->getActiveSheet()->setCellValue('Y1', 'หมายเหตุ');
			$objPHPExcel->getActiveSheet()->setCellValue('Z1', 'ประเภทงาน');


			// Set alignments จัดรูปแบบหน้า ตรงกลางซ้ายขวากึ่งกลาง
			//echo date('H:i:s') . " Set alignments\n";
			$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER);
			$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
			// $objPHPExcel->getActiveSheet()->getStyle('A6:L6')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

			// $objPHPExcel->getActiveSheet()->getStyle('A2:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);


			 
			// Set style for header row using alternative method 
			//echo date('H:i:s') . " Set style for header row using alternative method\n";
			$objPHPExcel->getActiveSheet()->getStyle('A1:Y1')->applyFromArray(
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

			 $statusType = [		
							  1 => "A เปิดใบรับรถ",
							  2 =>	 "B รอประกันอนุมัติ",
							  3 =>	 "C ประกันอนุมัติ",
							  4 =>	 "D รออะไหล่",
							  5 =>	 "E อะไหล่ครบ",
							  6 =>	 "F ดำเนินการซ่อม",
							//   7 => "G รถเสร็จสมบูรณ์",
							//   8 =>	 "H รถส่งออก",
							//   9 => "I ขออนุมัติวางบิล",
							//   10 => "J วางบิลเรียบร้อย",
							//   11 =>"K ชำระเงินแล้ว",
							//   12 =>"L ยกเลิกงานเคลม" 
							];
						
      		$r = 1;
			
		   for($i=1;$i<7;$i++){
		   		
			// if($fromdate!=''&&$todate!=''){
			// 	if($payment_st!=''){
			// 	$p_status = 'AND payment_st="'.$payment_st.'"';	
			// 	}
			
			// 	$where = " date_status BETWEEN '".$fromdate."' AND '".$todate."' ".$p_status;
			// }else{
			// 	if($payment_st!=''){
			// 	$p_status = 'AND payment_st="'.$payment_st.'"';	
			// 	}

			// 	$where = "1 ".$p_status;
			// }

			// $sql = "SELECT * FROM tbl_claim  WHERE payment_st='".$statusType[$i]."' AND SUBSTRING(payment_st,1,1) not in ('G','H','I','J','K')   ORDER BY date_cliam ASC";
			// $q = mysql_query($sql)or die(mysql_error());

            $response = DB::table('tbl_claim')->whereRaw("payment_st= ? AND SUBSTRING(payment_st,1,1) not in ('G','H','I','J','K')   ORDER BY date_cliam ASC", [$statusType[$i]])->get();

			//$sql = "SELECT * FROM data_cars  WHERE Car_type='".$i."' and create_date between '".."' and '".."' order by create_date ASC";
			//$result = mysql_query($sql);
			 
			 				
							

			          $objPHPExcel->getActiveSheet()->setCellValue('A'.($r+1),$statusType[$i]);	
			          $objPHPExcel->getActiveSheet()->mergeCells('A'.($r+1).':M'.($r+1));
			          $no = 1;

                      foreach ($response as $row) {
                            	$objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
								$objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$row->no_claim);
								$objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$row->date_status);
								$objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$row->date_cliam);
								$objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$row->date_firmins);
								$objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),'=IFERROR(IF(E'.($r+2).'="0000-00-00",NOW()-D'.($r+2).',E'.($r+2).'-D'.($r+2).'),0)');

								if($row->date_firmins === "0000-00-00"|| $row->date_firmins === ""){
									$dateNow=date_create(date('Y-m-d'));
								}else{
									$dateNow=date_create($row->date_firmins);
								}
								
								$dateCli=date_create($row->date_cliam);
								$diff=date_diff($dateCli,$dateNow);							
								$dateFirm = $diff->format("%R%a days");
								if(substr($row->car_job,0,1)=="H"){
									if($dateFirm>11){
										$timeTxt = "เลยกำหนด";
									}else{
										$timeTxt = "ปกติ";
									}

								}elseif(substr($row->car_job,0,1)=="M"){
									if($dateFirm>6){
										$timeTxt = "เลยกำหนด";
									}else{
										$timeTxt = "ปกติ";
									}

								}elseif(substr($row->car_job,0,1)=="L"){
									if($dateFirm>4){
										$timeTxt = "เลยกำหนด";
									}else{
										$timeTxt = "ปกติ";
									}

								}
								//$fomula= "=IFS(LEFT(K2,1)='H',IF(D2>20,'เกินกำหนด','ปกติ'),LEFT(K2,1)='M',IF(D2>10,'เกินกำหนด','ปกติ'),LEFT(K2,1)='L',IF(D2>5,'เกินกำหนด','ปกติ'))";
								$objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$timeTxt);
								$objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2), $row->date_carin);
								$objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2), $row->no_regiscar);
								$objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$row->car_brand);
								$objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$row->cost_sparepart);
								$objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$row->cost_doit);
								$objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$row->cost_totel);
								$objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$row->firm_sparepart);
								$objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$row->firm_doit);
								$objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$row->firm_all);
								$objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$row->user_con);
								$objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),'');
								$objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$row->total_pay);								
								$objPHPExcel->getActiveSheet()->setCellValue('T'.($r+2),$row->date_repair);
								$objPHPExcel->getActiveSheet()->setCellValue('U'.($r+2),$row->date_dms);
								$objPHPExcel->getActiveSheet()->setCellValue('V'.($r+2),'=IFERROR(IF(U'.($r+2).'="0000-00-00",NOW()-T'.($r+2).',U'.($r+2).'-T'.($r+2).'),0)');

								if($row->date_dms === "0000-00-00"||$row->date_dms === ""){
									$dateNow=date_create(date('Y-m-d'));
								}else{
									$dateNow=date_create($row->date_dms);
								}
								
								$dateCli=date_create($row->date_repair);
								$diff=date_diff($dateCli,$dateNow);							
								$dateFirm = $diff->format("%R%a days");
								if($row->car_job === "H1"){
									if($dateFirm>25){
										$timeTxt = "เลยกำหนด";
									}else{
										$timeTxt = "ปกติ";
									}

								}elseif($row->car_job === "H2"){
									if($dateFirm>35){
										$timeTxt = "เลยกำหนด";
									}else{
										$timeTxt = "ปกติ";
									}

								}elseif($row->car_job === "H3"){
									if($dateFirm>45){
										$timeTxt = "เลยกำหนด";
									}else{
										$timeTxt = "ปกติ";
									}

								}elseif(substr($row->car_job,0,1) === "M"){
									if($dateFirm>11){
										$timeTxt = "เลยกำหนด";
									}else{
										$timeTxt = "ปกติ";
									}

								}elseif(substr($row->car_job,0,1) === "L"){
									if($dateFirm>6){
										$timeTxt = "เลยกำหนด";
									}else{
										$timeTxt = "ปกติ";
									}

								}
								//$fomula= "=IFS(LEFT(K2,1)='H',IF(D2>20,'เกินกำหนด','ปกติ'),LEFT(K2,1)='M',IF(D2>10,'เกินกำหนด','ปกติ'),LEFT(K2,1)='L',IF(D2>5,'เกินกำหนด','ปกติ'))";
								$objPHPExcel->getActiveSheet()->setCellValue('W'.($r+2),$timeTxt);
								$objPHPExcel->getActiveSheet()->setCellValue('X'.($r+2),$row->date_service);	
								$objPHPExcel->getActiveSheet()->setCellValue('Y'.($r+2),$row->remark);	
								$objPHPExcel->getActiveSheet()->setCellValue('Z'.($r+2),$row->car_job);
								
								$r++;
								$no++;
                        }
					$r=$r+1; 
				}
							$objPHPExcel->getActiveSheet()->getStyle('A2'.':Y'.($r+1))->getFont()->setName('Arial');
							$objPHPExcel->getActiveSheet()->getStyle('A2'.':Y'.($r+1))->getFont()->setSize(8);
							$objPHPExcel->getActiveSheet()->getStyle('A2:Y'.($r+2))->getAlignment()->setVertical(\PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_TOP);
							
														
							
							
						
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':Y'.($r+2))->getFont()->setName('Candara');
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':Y'.($r+2))->getFont()->setSize(16);
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':Y'.($r+2))->getFont()->setBold(true);
							
							$objPHPExcel->getActiveSheet()->getStyle('A'.($r+2).':Y'.($r+2))->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
							
							$objPHPExcel->getActiveSheet()->getStyle('A2:Y'.($r+2))->applyFromArray(
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

$fname = "tmp/reportStatus.xlsx";


$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="reportStatus.xlsx"');
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