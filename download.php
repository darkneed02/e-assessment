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

    // 🟢 คอลัมน์แรก (ประเด็น) จัดชิดซ้าย
    $cell1 = $table->addCell(6000, ['valign' => 'top']);
    $textRun1 = $cell1->addTextRun();
    foreach ($row[0] as $line) {
        $textRun1->addText($line, [], ['alignment' => 'left']);
        $textRun1->addTextBreak();
    }

    // 🟢 คอลัมน์สอง (จำนวน) จัดกึ่งกลาง
    $cell2 = $table->addCell(2000, ['valign' => 'top']);
    $textRun2 = $cell2->addTextRun(['alignment' => 'center']);
    foreach ($row[1] as $line) {
        $textRun2->addText($line, [], ['alignment' => 'center']);
        $textRun2->addTextBreak();
    }

    // 🟢 คอลัมน์สาม (ร้อยละ) จัดกึ่งกลาง
    $cell3 = $table->addCell(2000, ['valign' => 'top']);
    $textRun3 = $cell3->addTextRun(['alignment' => 'center']);
    foreach ($row[2] as $line) {
        $textRun3->addText($line, [], ['alignment' => 'center']);
        $textRun3->addTextBreak();
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
    ['3. ด้านบุคลากรที่ให้บริการ', '', '', '', '', '', '', '', '', '', '', '', ''],
    ['3.1 ความเหมาะสมในการแต่งกายของผู้ให้บริการ', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['3.2 ความเต็มใจและความพร้อมในการให้บริการอย่างสุภาพ', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['3.3 ความรู้ความสามารถในการให้บริการ เช่น สามารถตอบคำถามชี้แจงข้อสงสัยให้คำแนะนำได้ เป็นต้น', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['3.4 ความซื่อสัตย์สุจริตในการปฏิบัติหน้าที่ เช่น ไม่ขอสิ่งตอบแทน, ไม่รับสินบน, ไม่หาผลประโยชน์ในทางมิชอบ', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['3.5 การให้บริการเหมือนกันทุกรายโดยไม่เลือกปฏิบัต', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['4. ด้านสิ่งอำนวยความสะดวก', '', '', '', '', '', '', '', '', '', '', '', ''],
    ['4.1 ความชัดเจนของป้ายสัญลักษณ์ประชาสัมพันธ์บอกจุดบริการ', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['4.2 จุด /ช่อง การให้บริการมีความเหมาะสมและเข้าถึงได้สะดวก', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['4.3 ความเพียงพอของสิ่งอำนวยความสะดวก เช่น ที่นั่งรอรับบริการ น้ำดื่ม หนังสือพิมพ์ ฯลฯ
(ไม่นับผู้ให้บริการขนส่ง จำนวน 4 ราย)
', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
    ['4.4 ความสะอาดของสถานที่ให้บริการ
(ไม่นับผู้ให้บริการขนส่ง จำนวน 4 ราย)
', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
['5. ด้านผลิตภัณฑ์', '', '', '', '', '', '', '', '', '', '', '', ''],
['5.1 ผลิตภัณฑ์มีคุณภาพดีและเหมาะสมต่อราคา', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
['5.2 คุณสมบัติของผลิตภัณฑ์เป็นไปตามมาตรฐานสากล (ไม่นับผู้ให้บริการขนส่ง จำนวน 4 ราย)', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
['5.3 เจ้าหน้ามีการให้บริการและคำแนะนำหลังการขาย', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-', '-'],
['6. ท่านมีความพึงพอใจต่อการให้บริการในภาพรวมอยู่ในระดับใด', '', '', '', '', '', '', '', '', '', '', '', ''],
];

foreach ($data2 as $row) {
    $table2->addRow();

    foreach ($row as $index => $value) {
        $cellStyle = ['valign' => 'center'];

        // 🟢 กำหนดให้ "ประเด็น" (คอลัมน์แรก) อยู่ชิดซ้าย
        if ($index == 0) {
            $cellStyle['alignment'] = 'left';
        } else {
            $cellStyle['alignment'] = 'center'; // 🟢 คอลัมน์ที่เหลืออยู่ตรงกลาง
        }

        $table2->addCell(2000, $cellStyle)->addText($value, [], ['alignment' => $cellStyle['alignment']]);
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


$phpWord->addTableStyle('DissatisfactionTable', $styleTable);
$table3 = $section3->addTable('DissatisfactionTable');

// Table Headers
$table3->addRow();
$table3->addCell(6000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("สรุปผลการประเมิน", ['bold' => true], ['alignment' => 'center']);
$table3->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("จำนวน(คน)", ['bold' => true], ['alignment' => 'center']);
$table3->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("ร้อยละ", ['bold' => true], ['alignment' => 'center']);

// Data Rows
$data3 = [
    ["1. พึงพอใจทุกด้าน", "11", "61.11"],
    ["2. ไม่พึงพอใจ", "7", "38.89"],
];

foreach ($data3 as $row) {
    $table3->addRow();
    
    // คอลัมน์แรก (ข้อความ พึงพอใจ/ไม่พึงพอใจ)
    $table3->addCell(6000, ['valign' => 'center'])->addText($row[0], [], ['alignment' => 'left']);
    
    // คอลัมน์ที่สอง (จำนวนคน) - จัดให้อยู่กึ่งกลาง
    $table3->addCell(2000, ['valign' => 'center'])->addText($row[1], ['bold' => true, 'color' => ($row[0] == "1. พึงพอใจทุกด้าน" ? 'FF0000' : '000000')], ['alignment' => 'center']);
    
    // คอลัมน์ที่สาม (ร้อยละ) - จัดให้อยู่กึ่งกลาง
    $table3->addCell(2000, ['valign' => 'center'])->addText($row[2], ['bold' => true, 'color' => ($row[0] == "1. พึงพอใจทุกด้าน" ? 'FF0000' : '000000')], ['alignment' => 'center']);
}

// Add spacing
$section3->addTextBreak(1);

// Table 2: รายละเอียดความไม่พึงพอใจ
$table4 = $section3->addTable('DissatisfactionTable');
$table4->addRow();
$table4->addCell(6000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("สรุปผลการประเมินความไม่พึงพอใจ", ['bold' => true], ['alignment' => 'center']);
$table4->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("จำนวน(คน)", ['bold' => true], ['alignment' => 'center']);
$table4->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("ร้อยละ", ['bold' => true], ['alignment' => 'center']);

// Data Rows
$data4 = [
    ["1. ด้านเวลาให้บริการ", "2", "28.57"],
    ["2. ด้านขั้นตอนการให้บริการ", "3", "42.86"],
    ["3. ด้านบุคลากรที่ให้บริการ", "6", "85.71"],
    ["4. ด้านสิ่งอำนวยความสะดวก", "5", "71.43"],
    ["5. ด้านผลิตภัณฑ์", "5", "71.43"],
];



foreach ($data4 as $row){
    $table4->addRow();

    // คอลัมน์แรก
    $table4->addCell(6000, ['valign' => 'center'])->addText($row[0], [], ['alignment' => 'left']);

    //คอลัมน์สอง
    $table4->addCell(2000, ['valign' => 'center'])->addText($row[1], ['bold'=>'true'], ['alignment' => 'center']);

    //คอลัมน์สาม
    $table4->addCell(2000, ['valign' => 'center'])->addText($row[2], ['bold'=>'true'], ['alignment' => 'center']);
}


// section 4 : ความผูกพันต่อกยท.
$section4 = $phpWord->addSection([
    'orientation' => 'portrait',
]);

$section4->addText(
    "ตอนที่ 4 ความผูกพันต่อกยท.",
    ['bold' => true, 'size' => 14],
    ['alignment' => 'left']
);

// Table Style
$styleTable4 = [
    'borderSize' => 6,
    'cellMargin' => 80,
    'alignment' => 'center'
];

$phpWord->addTableStyle('CommitmentTable', $styleTable4);
$table4 = $section4->addTable('CommitmentTable');

// Table Headers
$table4->addRow();
$table4->addCell(5000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("ประเด็น/ด้าน", ['bold' => true], ['alignment' => 'center']);
$table4->addCell(4000, ['bgColor' => 'D9D9D9', 'gridSpan' => 2, 'valign' => 'center'])->addText("มาก", ['bold' => true], ['alignment' => 'center']);
$table4->addCell(4000, ['bgColor' => 'D9D9D9', 'gridSpan' => 2, 'valign' => 'center'])->addText("ปานกลาง", ['bold' => true], ['alignment' => 'center']);
$table4->addCell(4000, ['bgColor' => 'D9D9D9', 'gridSpan' => 2, 'valign' => 'center'])->addText("น้อย", ['bold' => true], ['alignment' => 'center']);
$table4->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("ระดับความผูกพัน", ['bold' => true], ['alignment' => 'center']);
$table4->addCell(2000, ['bgColor' => 'D9D9D9', 'valign' => 'center'])->addText("แปลความ", ['bold' => true], ['alignment' => 'center']);

// Sub Headers Row
$table4->addRow();
$table4->addCell(5000, ['bgColor' => 'FFFFFF', 'valign' => 'center']);
for ($i = 0; $i < 3; $i++) {
    $table4->addCell(2000, ['bgColor' => 'FFFFFF', 'valign' => 'center'])->addText("จำนวน", ['bold' => true], ['alignment' => 'center']);
    $table4->addCell(2000, ['bgColor' => 'FFFFFF', 'valign' => 'center'])->addText("ร้อยละ", ['bold' => true], ['alignment' => 'center']);
}
$table4->addCell(2000, ['bgColor' => 'FFFFFF', 'valign' => 'center']);
$table4->addCell(2000, ['bgColor' => 'FFFFFF', 'valign' => 'center']);

// Data Rows
$data4 = [
    ["1. ท่านสนใจและหาข้อมูลเกี่ยวกับการให้บริการและผลิตภัณฑ์ของ กยท.", "28", "77.51", "6", "16.61", "-", "-", "94.12", "ผูกพันมาก"],
    ["2. ท่านจะกลับมาใช้บริการและซื้อผลิตภัณฑ์ของ กยท. อีกครั้ง", "25", "69.20", "9", "24.91", "-", "-", "91.18", "ผูกพันมาก"],
    ["3. ท่านจะเป็นลูกค้าของ กยท. ต่อไป", "28", "77.51", "6", "16.61", "-", "-", "94.12", "ผูกพันมาก"],
    ["4. ท่านจะแนะนำการให้บริการและผลิตภัณฑ์ของ กยท. แก่ผู้อื่น", "23", "60.35", "11", "28.86", "-", "-", "89.22", "ผูกพันมาก"],
    ["5. ท่านต้องการรับรู้ข้อมูลข่าวสารของการให้บริการและผลิตภัณฑ์ของ กยท.", "25", "65.60", "9", "23.62", "-", "-", "91.18", "ผูกพันมาก"],
];

foreach ($data4 as $row) {
    $table4->addRow();
    $table4->addCell(5000, ['valign' => 'center'])->addText($row[0], [], ['alignment' => 'left']);
    for ($i = 1; $i <= 6; $i++) {
        $table4->addCell(2000, ['valign' => 'center'])->addText($row[$i], [], ['alignment' => 'center']);
    }
    $table4->addCell(2000, ['valign' => 'center'])->addText($row[7], [], ['alignment' => 'center']);
    $table4->addCell(2000, ['valign' => 'center'])->addText($row[8], [], ['alignment' => 'center']);
}

// Save File
$filename = 'survey_report.docx';
header('Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document');
header('Content-Disposition: attachment;filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$objWriter = \PhpOffice\PhpWord\IOFactory::createWriter($phpWord, 'Word2007');
$objWriter->save('php://output');
exit;
