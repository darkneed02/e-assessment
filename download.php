<?php
require_once 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Style\Table;
use PhpOffice\PhpWord\Style\Cell;
use PhpOffice\PhpWord\Style\Font;
use PhpOffice\PhpWord\Style\Paragraph;

// Create a new PHPWord Object
$phpWord = new PhpWord();
$phpWord->setDefaultFontName('TH SarabunPSK');
$phpWord->setDefaultFontSize(12);

// Section 1: ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม
$section1 = $phpWord->addSection();

// Title
$section1->addText(
    "สรุปผลแบบสอบถามความพึงพอใจ ความไม่พึงพอใจ และความคาดหวังต่อการให้บริการของ กยท.",
    ['bold' => true, 'size' => 14],
    ['alignment' => 'center']
);

$section1->addText("ตอนที่ 1 ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม", ['bold' => true, 'size' => 12]);

// Table Style
$styleTable = [
    'borderSize' => 6, 
    'borderColor' => '000000',
    'cellMargin' => 80,
    'alignment' => 'center'
];
$phpWord->addTableStyle('SurveyTable', $styleTable);
$table = $section1->addTable('SurveyTable');

// Table Headers
$table->addRow();
$table->addCell(6000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("ข้อมูลทั่วไป", ['bold' => true], ['alignment' => 'center']);
$table->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("จำนวน(คน)", ['bold' => true], ['alignment' => 'center']);
$table->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("ร้อยละ", ['bold' => true], ['alignment' => 'center']);

// Data Rows
$data1 = [
    [['1. เพศ','    1.1 ชาย', '    1.2 หญิง'], ['','6', '4'], ['','60.00', '40.00']],
    [['2. อายุ','    2.1 21 - 40 ปี', '    2.2 41 - 60 ปี', '    2.3 60 ปีขึ้นไป'], ['','3', '3', '4'], ['','30.00', '30.00', '40.00']],
    [['3. ระดับการศึกษาสูงสุด','    3.1 ปริญญาตรี', '    3.2 สูงกว่าปริญญาตรี'], ['','5', '5'], ['','50.00', '50.00']],
    [['4. สถานภาพของผู้รับบริการ', '    4.1 เกษตรกร','    4.2 สถาบันเกษตรกร','    4.3 ผู้ประกอบการ/บริษัท','    4.4 ประชาชนผู้รับบริการ','    4.5 มหาวิทยาลัย','    4.6 อื่นๆ'],['','2','2','2','2','1','1'],['','20.00','20.00','20.00','20.00','10.00','10.00']],
    [['5. จำนวนครั้งที่เคยใช้บริการและซื้อผลิตภัณฑ์ของ กยท.','    5.1 1 ครั้ง','    5.2 2 ครั้ง','    5.3 3 ครั้ง','    5.4 4 ครั้ง','    5.5 อื่นๆ'],['','2','2','2','2','2'],['','20.00','20.00','20.00','20.00','20.00']],
    [['6. ระยะเวลาที่ท่านเป็นลูกค้าของ กยท.','    6.1 1 ปี','    6.2 2 ปี','    6.3 3 ปี','    6.4 มากกว่า 4 ปี','    6.5 อื่นๆ'],['','2','2','2','2','2'],['','20.00','20.00','20.00','20.00','20.00']],
    [['7. บริการหรือผลิตภัณฑ์ของ กยท.ที่ใช้บริการ (ตอบได้มากกว่า 1 ข้อ)','    7.1 ใช้บริการซื้อ-ขายยางผ่านตลาด กยท.','    7.2 ซื้อผลิตภัณฑ์ยางแปรรูปขั้นต้นจาก กยท.','    7.3 ซื้อผลิตภัณฑ์ยางจาก กยท.','    7.4 นำงานวิจัยของ กยท. ไปใช้ประโยชน์','    7.4 นำงานวิจัยของ กยท. ไปใช้ประโยชน์','    7.5 อื่นๆ'],
    ['','2','2','2','2','2'],['','20.00','20.00','20.00','20.00','20.00']]
];

foreach ($data1 as $row) {
    $table->addRow();
    $cell1 = $table->addCell(6000, ['valign' => 'top']);
    foreach ($row[0] as $line) {
        $cell1->addText($line, [], ['alignment' => 'left']);
    }
    
    $cell2 = $table->addCell(2000, ['valign' => 'top']);
    foreach ($row[1] as $line) {
        $cell2->addText($line, ['alignment' => 'center']);
    }
    
    $cell3 = $table->addCell(2000, ['valign' => 'top']);
    foreach ($row[2] as $line) {
        $cell3->addText($line, ['alignment' => 'center']);
    }
}

// Section 2: สรุปผลแบบสอบถามความพึงพอใจ
$section2 = $phpWord->addSection([
    'orientation' => 'landscape',
]);

$section2->addText(
    "ตอนที่2 สรุปผลแบบสอบถามความพึงพอใจ / ไม่พึงพอใจต่อการให้บริการ",
    ['bold' => true, 'size' => 14],
    ['alignment' => 'left']
);

// Table Style
$phpWord->addTableStyle('SurveyTable2', $styleTable);
$table2 = $section2->addTable('SurveyTable2');

// Table Headers
$table2->addRow();
$table2->addCell(4000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])
       ->addText("ประเด็น", ['bold' => true], ['alignment' => 'center']);
$table2->addCell(8000, ['bgColor' => 'D9D9D9', 'gridSpan' => 10, 'valign' => 'center'])
       ->addText("ความพึงพอใจ", ['bold' => true], ['alignment' => 'center']);
$table2->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])
       ->addText("ระดับความพึงพอใจ", ['bold' => true], ['alignment' => 'center']);
$table2->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])
       ->addText("แปลความ", ['bold' => true], ['alignment' => 'center']);

// Sub Headers Row 1
$table2->addRow();
$table2->addCell(4000, ['bgColor' => 'FFFFFF', 'valign' => 'center']);
$subHeaders = ['น้อยมาก (1)', 'น้อย (2)', 'ปานกลาง (3)', 'มาก (4)', 'มากที่สุด (5)'];
foreach ($subHeaders as $header) {
    $table2->addCell(4000, ['bgColor' => 'FFFFFF', 'gridSpan' => 2, 'valign' => 'center'])
          ->addText($header, ['bold' => true, 'color' => 'FF0000'], ['alignment' => 'center']);
}
$table2->addCell(2000, ['bgColor' => 'FFFFFF', 'valign' => 'center']);
$table2->addCell(2000, ['bgColor' => 'FFFFFF', 'valign' => 'center']);

// Data Rows
$data2 = [
    ['1. ด้านเวลา', '', '', '', '', '', '', '', '', '', '', '', ''],
    ['1.1 การให้บริการเป็นไปตามระยะเวลาที่กำหนด', '0', '0', '0', '0', '2', '12.00', '1', '8.00', '7', '70.00', '90.00', 'พึงพอใจ'],
    ['1.2 ความรวดเร็วในการให้บริการ', '-', '-', '-', '-', '2', '12.00', '1', '8.00', '7', '70.00', '90.00', 'พึงพอใจมากที่สุด' ],
    ['2. ด้านขั้นตอนการให้บริการ','', '', '', '', '', '', '', '', '', '', '', ''],
    ['2.1 การติดป้ายประกาศหรือแจ้งข้อมูลเกี่ยวกับขั้นตอนและระยะเวลาในการให้บริการ', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['2.2 การจัดลำดับขั้นตอนการให้บริการตามที่ประกาศไว้', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['2.3 การให้บริการตามลำดับก่อนหลัง เช่น มาก่อนต้องได้รับบริการก่อน', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
];

foreach ($data2 as $row) {
    $table2->addRow();
    foreach ($row as $index => $value) {
        $table2->addCell(2000, ['valign' => 'center'])->addText($value, ['alignment' => 'center']);
    }
}

// Section 3: ความไม่พึงพอใจต่อการให้บริการ
$section3 = $phpWord->addSection([
    'orientation' => 'portrait',
]);

$section3->addText(
    "ตอนที่ 3 ความไม่พึงพอใจต่อการให้บริการ",
    ['bold' => true, 'size' => 14],
    ['alignment' => 'left']
);


// section 4 : ความผูกพันต่อกยท.
$section4 = $phpWord->addSection([
    'orientation' => 'portrait',
]);

$section4->addText(
    "ตอนที่ 4 ความผูกพันต่อกยท.",
    ['bold' => true, 'size' => 14],
    ['alignment' => 'left']
);

// Save File
$filename = 'survey_report.docx';
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('php://output');
exit;
