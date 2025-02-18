<?php
    include('../class/db_connect.php');
    include('../lib/vendor/autoload.php');
    $conn = db_connect();

    use PhpOffice\PhpSpreadsheet\Spreadsheet;
    use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
    \PhpOffice\PhpSpreadsheet\Cell\Cell::setValueBinder(new \PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder());

    $error_chk = false;
    if($_POST['txtMonth'] && $_POST['txtYear']){
        if($rs = select_tb_assessment_date($conn,$_POST['txtMonth'],$_POST['txtYear'])){
            if($rs && pg_num_rows($rs) > 0){
                $spreadsheet = new Spreadsheet();
                $sheet = $spreadsheet->getActiveSheet();
                $header = ['ด้าน','เดือน','ปี','เพศ','อายุ','ระดับการศึกษาสูงสุด','สถานภาพของผู้มารับบริการ','จำนวนครั้งที่ท่านเคยใช้บริการหรือซื้อผลิตภัณฑ์ของ กยท.','ระยะเวลาที่ท่านเป็นลูกค้าของ กยท.','ท่านเคยใช้บริการหรือซื้อผลิตภัณฑ์ กยท. ข้อใดบ้าง','การให้บริการเป็นไปตามระยะเวลาที่กำหนด','ความรวดเร็วในการให้บริการ','การติดป้ายประกาศหรือแจ้งข้อมูลเกี่ยวกับขั้นตอนและระยะเวลาการให้บริการ','การจัดลำดับขั้นตอนการให้บริการตามที่ประกาศไว้','การให้บริการตามลำดับก่อนหลัง','ความเหมาะสมในการแต่งกายของผู้ให้บริการ','ความเต็มใจและความพร้อมในการให้บริการอย่าสุภาพ','ความรู้ความสามารถในการให้บริการ','ความซื่อสัตย์สุจริตในการปฏิบัติหน้าที่','การให้บริการเหมือนกันทุกรายโดยไม่เลือกปฏิบัติ','ความชัดเจนของป้าย สัญลักษณ์ ประชาสัมพันธ์ บอกจุดบริการ','จุด /ช่อง การให้บริการมีความเหมาะสมและเข้าถึง ได้สะดวก','ความเพียงพอของสิ่งอำนวยความสะดวก','ความสะอาดของสถานที่ให้บริการ','ผลิตภัณฑ์มีคุณภาพดีและเหมาะสมต่อราคา','คุณสมบัติของผลิตภัณฑ์เป็นไปตามมาตรฐานสากล','เจ้าหน้ามีการให้บริการและคำแนะนำหลังการขาย','ท่านมีความพึงพอใจ / ไม่พึงพอใจต่อการให้บริการในภาพรวม อยู่ในระดับใด','ท่านสนใจและหาข้อมูลเกี่ยวกับการให้บริการและผลิตภัณฑ์ของ กยท.','ท่านจะกลับมาใช้บริการและซื้อผลิตภัณฑ์ของ กยท. อีกครั้ง','ท่านจะเป็นลูกค้าของ กยท. ต่อไป','ท่านจะแนะนำการให้บริการและผลิตภัณฑ์ของ กยท.แก่ผู้อื่น','ท่านต้องการรับรู้ข้อมูลข่าวสารของการให้บริการและผลิตภัณฑ์ของ กยท.','ปัญหา','ข้อเสนอแนะ'];
                $sheet->fromArray($header, NULL, 'A1');
                $row = 2;
                while($data = pg_fetch_assoc($rs)){
                    $sheet->setCellValue('A'. $row, $data['department']);
                    $sheet->setCellValue('B'. $row, $data['month']);
                    $sheet->setCellValue('C'. $row, $data['year']);
                    $sheet->setCellValue('D'. $row, $data['a1_1']);
                    $sheet->setCellValue('E'. $row, $data['a1_2']);
                    $sheet->setCellValue('F'. $row, $data['a1_3']);
                    $sheet->setCellValue('G'. $row, $data['a1_4']);
                    $sheet->setCellValue('H'. $row, $data['a1_5']);
                    $sheet->setCellValue('I'. $row, $data['a1_6']);
                    $sheet->setCellValue('J'. $row, $data['a1_7']);
                    $sheet->setCellValue('K'. $row, $data['a2_1_1']);
                    $sheet->setCellValue('L'. $row, $data['a2_1_2']);
                    $sheet->setCellValue('M'. $row, $data['a2_2_1']);
                    $sheet->setCellValue('N'. $row, $data['a2_2_2']);
                    $sheet->setCellValue('O'. $row, $data['a2_2_3']);
                    $sheet->setCellValue('P'. $row, $data['a2_3_1']);
                    $sheet->setCellValue('Q'. $row, $data['a2_3_2']);
                    $sheet->setCellValue('R'. $row, $data['a2_3_3']);
                    $sheet->setCellValue('S'. $row, $data['a2_3_4']);
                    $sheet->setCellValue('T'. $row, $data['a2_3_5']);
                    $sheet->setCellValue('U'. $row, $data['a2_4_1']);
                    $sheet->setCellValue('V'. $row, $data['a2_4_2']);
                    $sheet->setCellValue('W'. $row, $data['a2_4_3']);
                    $sheet->setCellValue('X'. $row, $data['a2_4_4']);
                    $sheet->setCellValue('Y'. $row, $data['a2_5_1']);
                    $sheet->setCellValue('Z'. $row, $data['a2_5_2']);
                    $sheet->setCellValue('AA'. $row, $data['a2_5_3']);
                    $sheet->setCellValue('AB'. $row, $data['a2_6']);
                    $sheet->setCellValue('AC'. $row, $data['a3_1']);
                    $sheet->setCellValue('AD'. $row, $data['a3_2']);
                    $sheet->setCellValue('AE'. $row, $data['a3_3']);
                    $sheet->setCellValue('AF'. $row, $data['a3_4']);
                    $sheet->setCellValue('AG'. $row, $data['a3_5']);
                    $sheet->setCellValue('AH'. $row, $data['a4_1']);
                    $sheet->setCellValue('AI'. $row, $data['a4_2']);
                    $row++;
                }
                pg_close($conn);
                $writer = new Xlsx($spreadsheet);
                header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
                header('Content-Disposition: attachment; filename="'. urlencode('assessment-'.$_POST['txtMonth'].'-'.$_POST['txtYear'].'.xlsx').'"');
                $writer->save('php://output');
                exit();
            }else{
                $error_chk = true;
                echo "<script>alert('ไม่พบข้อมูลที่ท่านเลือก'); </script>";
            }
        }
    }else{
        $error_chk = true;
        echo "<script>alert('กรุณาระบุ เดือน/ปี เพื่อดาวน์โหลด'); </script>";
    }

    pg_close($conn);
    if($error_chk){
        echo "<script>javascript:history.back(1); </script>";
    }else{
        header("Location: ../export.html");
    }
?>