<?php
require 'vendor/autoload.php';

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;

function exportWord()
{
    // ตรวจสอบและล้าง Output Buffer ป้องกันปัญหา header
    if (ob_get_length()) {
        ob_end_clean();
    }

    // สร้างเอกสาร Word ใหม่
    $phpWord = new PhpWord();
    $section = $phpWord->addSection();

    // เพิ่มเนื้อหาในเอกสาร
    $section->addText('ตัวอย่างเอกสารที่สร้างโดย PHPWord', ['name' => 'Arial', 'size' => 16, 'bold' => true]);
    $section->addText('นี่คือตัวอย่างของการสร้างไฟล์ Word ใน PHP', ['name' => 'Arial', 'size' => 12]);

    // เพิ่มบรรทัดใหม่
    $section->addTextBreak(2);

    // เพิ่มรายการแบบ Bullet Point
    $section->addListItem('รายการที่ 1');
    $section->addListItem('รายการที่ 2');
    $section->addListItem('รายการที่ 3');

    // เพิ่มตาราง
    $table = $section->addTable();
    $table->addRow();
    $table->addCell(2000)->addText('หัวข้อ 1');
    $table->addCell(2000)->addText('หัวข้อ 2');
    $table->addRow();
    $table->addCell(2000)->addText('ข้อมูล 1');
    $table->addCell(2000)->addText('ข้อมูล 2');

    // ตั้งชื่อไฟล์
    $fileName = 'exported_document.docx';
    $filePath = sys_get_temp_dir() . '/' . $fileName; // ใช้ temp directory ป้องกันปัญหา permission

    // บันทึกไฟล์ลง temp directory
    $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
    $objWriter->save($filePath);

    // ตรวจสอบว่าไฟล์ถูกสร้างขึ้นหรือไม่
    if (!file_exists($filePath) || filesize($filePath) == 0) {
        die("Error: ไฟล์ Word ไม่สามารถสร้างได้");
    }

    // กำหนด Header เพื่อให้ดาวน์โหลดไฟล์ Word
    header("Content-Type: application/vnd.openxmlformats-officedocument.wordprocessingml.document");
    header("Content-Disposition: attachment; filename=\"$fileName\"");
    header("Content-Length: " . filesize($filePath));
    header("Expires: 0");
    header("Cache-Control: must-revalidate");
    header("Pragma: public");

    // ส่งไฟล์ให้ดาวน์โหลด
    readfile($filePath);
    flush(); // ป้องกันการค้างของ buffer

    // ลบไฟล์ออกหลังจากดาวน์โหลดเสร็จ
    unlink($filePath);
    exit;
}

// เรียกใช้ฟังก์ชันเพื่อส่งไฟล์ให้ดาวน์โหลด
exportWord();
