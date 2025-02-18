<?php
$dbhost = 'localhost';
$dbname = 'e_pr_db';
$dbusername = 'postgres';
$dbpassword = '123456789';

function db_connect()
{
    global $dbhost, $dbname, $dbusername, $dbpassword;
    $conn = pg_connect("host=$dbhost dbname=$dbname user=$dbusername password=$dbpassword");
    if (!$conn) {
        die("Connection failed: " . pg_last_error());
    }
    return $conn;
}

/**
 * 🔹 ฟังก์ชันบันทึกข้อมูลลง `tb_assessment`
 */
function insert_tb_assessment($conn, $data)
{
    // Escape string เพื่อป้องกัน SQL Injection
    foreach ($data as $key => $value) {
        $data[$key] = pg_escape_string($conn, $value);
    }

    // SQL Query
    $query = sprintf(
        "INSERT INTO public.tb_assessment (
            department, month, year, a1_1, a1_2, a1_3, a1_4, a1_5, a1_6, a1_7, 
            a2_1_1, a2_1_2, a2_2_1, a2_2_2, a2_2_3, a2_3_1, a2_3_2, a2_3_3, 
            a2_3_4, a2_3_5, a2_4_1, a2_4_2, a2_4_3, a2_4_4, a2_5_1, a2_5_2, a2_5_3, 
            a2_6, a3_1, a3_2, a3_3, a3_4, a3_5, a4_1, a4_2, subservice, a_5, 
            a_5_1, a_5_2, a_5_3, a_5_4, a_5_5
        ) VALUES (
            '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s', 
            '%s', '%s', '%s', '%s', '%s'
        )",
        $data['txtSide'], $data['txtMonth'], $data['txtYear'], $data['rdoSex'], $data['rdoAge'],
        $data['rdoEducation'], $data['rdoJob'], $data['rdoUsed'], $data['rdoCustomerYear'], $data['txtSale'],
        $data['rdoTime1'], $data['rdoTime2'], $data['rdoService1'], $data['rdoService2'], $data['rdoService3'],
        $data['rdoPersonService1'], $data['rdoPersonService2'], $data['rdoPersonService3'], $data['rdoPersonService4'], $data['rdoPersonService5'],
        $data['rdoFacilities1'], $data['rdoFacilities2'], $data['rdoFacilities3'], $data['rdoFacilities4'],
        $data['rdoProduct1'], $data['rdoProduct2'], $data['rdoProduct3'], $data['rdoOverall1'],
        $data['rdoAffiliation1'], $data['rdoAffiliation2'], $data['rdoAffiliation3'], $data['rdoAffiliation4'], $data['rdoAffiliation5'],
        $data['txtProblem'], $data['txtSuggestions'], $data['txtSubService'], $data['ckbDissatisfaction'],
        $data['txtCustomerTimeService'], $data['txtCustomerProcessingService'], $data['txtCustomerPersionService'],
        $data['txtCustomerFacilitate'], $data['txtCustomerProductSide']
    );

    return pg_query($conn, $query);
}


function select_tb_assessment_all($conn)
{
    $query = "SELECT * FROM public.tb_assessment";
    return pg_query($conn, $query);
}

function select_tb_assessment_date($conn, $month, $year)
{
    $query = "SELECT * FROM public.tb_assessment WHERE month = '$month' AND year = '$year'";
    return pg_query($conn, $query);
}
