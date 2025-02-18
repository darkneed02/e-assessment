<?php
include('../class/db_connect.php');
$conn = db_connect();

/**
 * 🔹 ฟังก์ชันรับค่าจาก $_POST และตรวจสอบ
 */
function validate_input($post)
{
    $fields = [
        'txtSide', 'txtMonth', 'txtYear', 'txtSubService', 'rdoSex', 'rdoAge',
        'rdoEducation', 'rdoJob', 'rdoUsed', 'rdoCustomerYear',
        'rdoTime1', 'rdoTime2', 'rdoService1', 'rdoService2', 'rdoService3',
        'rdoPersonService1', 'rdoPersonService2', 'rdoPersonService3', 'rdoPersonService4', 'rdoPersonService5',
        'rdoFacilities1', 'rdoFacilities2', 'rdoFacilities3', 'rdoFacilities4',
        'rdoProduct1', 'rdoProduct2', 'rdoProduct3', 'rdoOverall1',
        'rdoAffiliation1', 'rdoAffiliation2', 'rdoAffiliation3', 'rdoAffiliation4', 'rdoAffiliation5',
        'txtProblem', 'txtSuggestions', 'ckbDissatisfaction', 'txtCustomerTimeService',
        'txtCustomerProcessingService', 'txtCustomerPersionService', 'txtCustomerFacilitate', 'txtCustomerProductSide'
    ];

    $data = [];
    foreach ($fields as $field) {
        $data[$field] = isset($post[$field]) ? trim($post[$field]) : '';
    }

    // ✅ บันทึกเฉพาะค่าแรกที่ถูกเลือกจาก txtSale
    $txtSale = "";
    for ($i = 1; $i <= 5; $i++) {
        if (!empty($post['ckbSale' . $i])) {
            $txtSale = ($post['ckbSale' . $i] == 'Other' ? $post['txtSaleOther'] : $post['ckbSale' . $i]);
            break; // หยุดที่ค่าแรกที่เจอ
        }
    }
    $data['txtSale'] = $txtSale;

    return $data;
}


/**
 * 🔹 ฟังก์ชันจัดการการบันทึกข้อมูล
 */
function handle_request($conn)
{
    if (empty($_POST['txtSide']) || empty($_POST['txtMonth']) || empty($_POST['txtYear'])) {
        echo "<script>alert('กรุณากรอก (ด้าน) และ (เดือน/ปี) ให้ครบ ขอบคุณค่ะ!'); </script>";
        echo "<script>javascript:history.back(1); </script>";
        exit();
    }

    // 🔹 รับค่าจากฟอร์ม
    $data = validate_input($_POST);

    // 🔹 เรียกใช้ฟังก์ชัน `insert_tb_assessment()` โดยไม่ต้องส่ง `uid`
    if (insert_tb_assessment($conn, $data)) {
        echo "<script>alert('บันทึกเอกสารเรียบร้อย ขอบคุณค่ะ'); </script>";
        header("Location: ../thankyou.html");
        exit();
    } else {
        echo "<script>alert('เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง!');</script>";
        echo "<script>javascript:history.back(1); </script>";
    }

    pg_close($conn);
}

// 🚀 **เรียกใช้งานฟังก์ชันหลัก**
handle_request($conn);
?>
