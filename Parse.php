<?php
// require_once "src/PHPExcel.php";
include 'PHPExcel/PHPExcel/IOFactory.php';
date_default_timezone_set('America/Los_Angeles');
$conn = mysqli_connect('localhost','root','!@#$%^','voip');

// Instantiate a new PHPExcel object
$objPHPExcel = new PHPExcel(); 
// Set the active Excel worksheet to sheet 0
$objPHPExcel->setActiveSheetIndex(0); 


$query = "SELECT * FROM members";
$result = mysqli_query($conn,$query);

$data = array();
$count = 0;
while($record = mysqli_fetch_assoc($result)){
	$data[$count]['id'] = $record['id'];
	$data[$count]['name'] = $record['name'];
	$data[$count]['email'] = $record['email'];
    $data[$count]['company'] = $record['company'];
    $data[$count]['phone'] = $record['phone'];
    $count++;
}

$row = 1;

$objPHPExcel->getActiveSheet()->SetCellValue("A".$row, "ID");
$objPHPExcel->getActiveSheet()->SetCellValue("B".$row, "NAME");
$objPHPExcel->getActiveSheet()->SetCellValue("C".$row, "EMAIL");
$objPHPExcel->getActiveSheet()->SetCellValue("D".$row, "COMPANY");
$objPHPExcel->getActiveSheet()->SetCellValue("E".$row, "PHONE");

//  Loop through each row of the worksheet in turn
foreach($data as $key => $value) {
    
    $row++;
    // $column = PHPExcel_Cell::stringFromColumnIndex($index);
    $objPHPExcel->getActiveSheet()->SetCellValue("A".$row, $value['id']);
    $objPHPExcel->getActiveSheet()->SetCellValue("B".$row, $value['name']);
    $objPHPExcel->getActiveSheet()->SetCellValue("C".$row, $value['email']);
    $objPHPExcel->getActiveSheet()->SetCellValue("D".$row, $value['company']);
    $objPHPExcel->getActiveSheet()->SetCellValue("E".$row, $value['phone']);

    

}

// Instantiate a Writer to create an OfficeOpenXML Excel .xlsx file
$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel); 
// Write the Excel file to filename some_excel_file.xlsx in the current directory
$objWriter->save('./assets/docs/members_list.xlsx');


//$objWriter = new PHPExcel_Writer_CSV($objPHPExcel);
//$objWriter->setDelimiter(',');
//$objWriter->setEnclosure('');
//$objWriter->setLineEnding("\r\n");
//$objWriter->setSheetIndex(0);
//$objWriter->save('./assets/docs/members_list.csv');


header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="./assets/docs/members_list.xlsx"');
header('Cache-Control: max-age=0');


$objWriter->save('php://output');

 ?>