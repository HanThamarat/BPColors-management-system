<?php

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Illuminate\Support\Facades\DB;

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
                       
       $spreadsheet = new Spreadsheet();
       $objPHPExcel = $spreadsheet;
   
   
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
   $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(16);
   $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(13);
   $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(8);
   $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(10);
   $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(10);
   
   
   $objPHPExcel->getActiveSheet()->setCellValue('A1', '#');
   $objPHPExcel->getActiveSheet()->setCellValue('B1', 'ประกัน');
   $objPHPExcel->getActiveSheet()->setCellValue('C1', 'เลขทะเบียน');
   $objPHPExcel->getActiveSheet()->setCellValue('D1', 'เลขที่เคลม');
   $objPHPExcel->getActiveSheet()->setCellValue('E1', 'วันที่เปลี่ยนสถานะ');
   $objPHPExcel->getActiveSheet()->setCellValue('F1', 'สถานะ');
   $objPHPExcel->getActiveSheet()->setCellValue('G1', 'เลขที่กรมธรรม์');
   $objPHPExcel->getActiveSheet()->setCellValue('H1', 'วันที่ลงระบบ');
   $objPHPExcel->getActiveSheet()->setCellValue('I1', 'เลขที่ JOB');
   $objPHPExcel->getActiveSheet()->setCellValue('J1', 'ประเภทรถ');
   $objPHPExcel->getActiveSheet()->setCellValue('K1', 'ประเภทประกัน');
   $objPHPExcel->getActiveSheet()->setCellValue('L1', 'ประเภทลูกค้า');
   $objPHPExcel->getActiveSheet()->setCellValue('M1', 'วันที่เคลม');
   $objPHPExcel->getActiveSheet()->setCellValue('N1', 'วันที่นำรถเข้า');
   $objPHPExcel->getActiveSheet()->setCellValue('O1', 'วันที่ส่งมอบ');
   $objPHPExcel->getActiveSheet()->setCellValue('P1', 'วันที่วางบิล');
   $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'เลขที่ Invoice');
   $objPHPExcel->getActiveSheet()->setCellValue('R1', 'เลขที่ Vat Invoice');
   $objPHPExcel->getActiveSheet()->setCellValue('S1', 'วันที่ประกันจ่าย');
   $objPHPExcel->getActiveSheet()->setCellValue('T1', 'ยอดจากประกัน');
   $objPHPExcel->getActiveSheet()->setCellValue('U1', 'อนุมัติค่าเเรง');
   $objPHPExcel->getActiveSheet()->setCellValue('V1', 'อนุมัติค่าอะไหล่');
   $objPHPExcel->getActiveSheet()->setCellValue('W1', 'อนุมัติทั้งหมด');
   
   
   
   
   
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
   
                   // $objPHPExcel->getActiveSheet()->getStyle('B:B')->getNumberFormat()->setFormatCode('dd/mm/yyyy');
                   // $objPHPExcel->getActiveSheet()->getStyle('C:C')->getNumberFormat()->setFormatCode('_-[$฿-41E]* #,##0.00_-;-[$฿-41E]* #,##0.00_-;_-[$฿-41E]* "-"??_-;_-@_-');
                   // $objPHPExcel->getActiveSheet()->getStyle('D:D')->getNumberFormat()->setFormatCode('0.00%');
                   // $objPHPExcel->getActiveSheet()->getStyle('E:E')->getNumberFormat()->setFormatCode('_-[$฿-41E]* #,##0.00_-;-[$฿-41E]* #,##0.00_-;_-[$฿-41E]* "-"??_-;_-@_-');
                   // $objPHPExcel->getActiveSheet()->getStyle('F:F')->getNumberFormat()->setFormatCode('0.00');
   
       
                    $r = 0;
                   $no = 1;
                   $total = 0;
                   $total2 = 0;
                           

                    
                    $response = DB::table('tbl_claim')->whereRaw('payment_st = "J วางบิลเรียบร้อย" AND total_pay is null or total_pay = "" AND  insure_name!="เคลมใน" order by insure_name')->get(); 

                    if (count($response) !== 0) {
                        foreach ($response as $res) {
                            $objPHPExcel->getActiveSheet()->setCellValue('A'.($r+2),$no);
                            $objPHPExcel->getActiveSheet()->setCellValue('B'.($r+2),$res->insure_name);
                            $objPHPExcel->getActiveSheet()->setCellValue('C'.($r+2),$res->no_regiscar);
                            $objPHPExcel->getActiveSheet()->setCellValue('D'.($r+2),$res->no_claim);
                            $objPHPExcel->getActiveSheet()->setCellValue('E'.($r+2),$res->date_status);
                            $objPHPExcel->getActiveSheet()->setCellValue('F'.($r+2),$res->payment_st);
                            $objPHPExcel->getActiveSheet()->setCellValue('G'.($r+2),$res->no_policy);
                            $objPHPExcel->getActiveSheet()->setCellValue('H'.($r+2),$res->date_create);
                            $objPHPExcel->getActiveSheet()->setCellValue('I'.($r+2),$res->no_job);
                            $objPHPExcel->getActiveSheet()->setCellValue('J'.($r+2),$res->car_type);
                            $objPHPExcel->getActiveSheet()->setCellValue('K'.($r+2),$res->insure_type);
                            $objPHPExcel->getActiveSheet()->setCellValue('L'.($r+2),$res->cus_resource);
                            $objPHPExcel->getActiveSheet()->setCellValue('M'.($r+2),$res->date_cliam);
                            $objPHPExcel->getActiveSheet()->setCellValue('N'.($r+2),$res->date_carin);
                            $objPHPExcel->getActiveSheet()->setCellValue('O'.($r+2),$res->date_send);
                            $objPHPExcel->getActiveSheet()->setCellValue('P'.($r+2),$res->date_bill);
                            $objPHPExcel->getActiveSheet()->setCellValue('Q'.($r+2),$res->bill_no);
                            $objPHPExcel->getActiveSheet()->setCellValue('R'.($r+2),$res->invoice_no);
                            $objPHPExcel->getActiveSheet()->setCellValue('S'.($r+2),$res->date_transfer);
                            $objPHPExcel->getActiveSheet()->setCellValue('T'.($r+2),$res->total_pay);
                            $objPHPExcel->getActiveSheet()->setCellValue('U'.($r+2),$res->firm_doit);
                            $objPHPExcel->getActiveSheet()->setCellValue('V'.($r+2),$res->firm_sparepart);
                            $objPHPExcel->getActiveSheet()->setCellValue('W'.($r+2),$res->firm_all);
          
                            $no++;	
                            $r++;
                       }     
                    } else {
                        redirect()->route('postreport');
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

$fname = "tmp/dereport.xlsx";


$xlsxWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, 'Xlsx');
$xlsxWriter = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($objPHPExcel);
// Redirect output to a client’s web browser (Xlsx)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="dereport.xlsx"');
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