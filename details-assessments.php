<?php

require_once 'class/db_connect.php';

$conn = db_connect();

$id = $_GET['id'];

$query = "select * from  public.tb_assessment where uid_asses = '$id'";
$result = pg_query($conn, $query);

if (!$result) {
    die("เกิดข้อผิดพลาดในการดึงข้อมูล: " . pg_last_error($conn));
}

$row = pg_fetch_assoc($result);

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <title>รายละเอียดแบบสอบถาม</title>
    <meta content="" name="description">
    <meta content="" name="keywords">

    <!-- Favicons -->
    <link href="img/L21-65.png" rel="icon">
    <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

    <!-- Google Fonts -->
    <!-- <link href="https://fonts.gstatic.com" rel="preconnect">
        <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet"> -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Prompt:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!-- Vendor CSS Files -->
    <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
    <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
    <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
    <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
    <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">

    <!-- Template Main CSS File -->
    <link href="assets/css/style.css" rel="stylesheet">

    <!-- My CSS-->
    <link href="css/img-style.css" rel="stylesheet">

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        body {
            font-family: 'Prompt', sans-serif;
            background-color: #f8f9fa;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-label {
            font-weight: 600;
        }

        .btn-submit {
            width: 100%;
            padding: 10px;
            font-size: 18px;
        }
    </style>

</head>

<body style="font-family:Prompt;">
    <main>
        <form action="php/saveForm.php" method="post">
            <div class="container">
                <img src="img/L21-65.png" alt="" class="center-image mb-3 mt-5">
                <h3 style="text-align: center; font-family:Prompt;">แบบสอบถามความพึงพอใจ ความไม่พึงพอใจ และความผูกพันต่อการให้บริการของ กยท.</h3>


                <div class="row justify-content-center mb-3">
                    <div class="col-8">
                        <div class="form-group row">
                            <div class="col-sm">
                                <label for="txtSide" class="col col-form-label">ด้าน</label>
                                <select id="txtSide" name="txtSide" class="form-select" required>
                                    <option value="Productside" <?php echo ($row['department'] == 'Productside') ? 'selected' : ''; ?>>ด้านผลิตภัณฑ์</option>
                                    <option value="Serviceside" <?php echo ($row['department'] == 'Serviceside') ? 'selected' : ''; ?>>ด้านบริการ</option>
                                </select>
                            </div>
                            <div class="col-sm" id="subServiceContainer">
                                <label for="txtSubService" class="col col-form-label">บริการย่อย</label>
                                <select id="txtSubService" name="txtSubService" class="form-select">
                                     <option value="">กรุณาเลือกบริการย่อย</option>
                                    <option value="JoinProject" <?php echo ($row['subservice'] == 'JoinProject') ? 'selected' : ''; ?>>เข้าร่วมโครงการ</option>
                                    <option value="Funding" <?php echo ($row['subservice'] == 'Funding') ? 'selected' : ''; ?>>การขอทุน</option>
                                    <option value="TestCenter" <?php echo ($row['subservice'] == 'TestCenter') ? 'selected' : ''; ?>>ศูนย์ทดสอบ</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row justify-content-center mb-3">
                    <div class="col-8">
                        <div class="form-group row">
                            <div class="col-sm">
                                <label for="inputPassword" class="col col-form-label">เดือน</label>
                                <select id="txtMonth" name="txtMonth" class="form-select" required>
                                    <option value="มกราคม" <?php echo ($row['month'] == 'มกราคม') ? 'selected' : ''; ?>>มกราคม</option>
                                    <option value="กุมภาพันธ์" <?php echo ($row['month'] == 'กุมภาพันธ์') ? 'selected' : ''; ?>>กุมภาพันธ์</option>
                                    <option value="มีนาคม" <?php echo ($row['month'] == 'มีนาคม') ? 'selected' : ''; ?>>มีนาคม</option>
                                    <option value="เมษายน" <?php echo ($row['month'] == 'เมษายน') ? 'selected' : ''; ?>>เมษายน</option>
                                    <option value="พฤษภาคม" <?php echo ($row['month'] == 'พฤษภาคม') ? 'selected' : ''; ?>>พฤษภาคม</option>
                                    <option value="มิถุนายน" <?php echo ($row['month'] == 'มิถุนายน') ? 'selected' : ''; ?>>มิถุนายน</option>
                                    <option value="กรกฎาคม" <?php echo ($row['month'] == 'กรกฎาคม') ? 'selected' : ''; ?>>กรกฎาคม</option>
                                    <option value="สิงหาคม" <?php echo ($row['month'] == 'สิงหาคม') ? 'selected' : ''; ?>>สิงหาคม</option>
                                    <option value="กันยายน" <?php echo ($row['month'] == 'กันยายน') ? 'selected' : ''; ?>>กันยายน</option>
                                    <option value="ตุลาคม" <?php echo ($row['month'] == 'ตุลาคม') ? 'selected' : ''; ?>>ตุลาคม</option>
                                    <option value="พฤษจิกายน" <?php echo ($row['month'] == 'พฤษจิกายน') ? 'selected' : ''; ?>>พฤษจิกายน</option>
                                    <option value="ธันวาคม" <?php echo ($row['month'] == 'ธันวาคม') ? 'selected' : ''; ?>>ธันวาคม</option>
                                </select>
                            </div>
                            <div class="col-sm">
                                <label for="inputPassword" class="col col-form-label">ปี</label>
                                <select id="txtYear" name="txtYear" class="form-select" required>
                                    <option value="กรุณาเลือก" selected>กรุณาเลือก</option>
                                    <option value="2567" <?php echo ($row['year'] == '2567') ? 'selected' : ''; ?>>2567</option>
                                    <option value="2568" <?php echo ($row['year'] == '2568') ? 'selected' : ''; ?>>2568</option>
                                    <option value="2569" <?php echo ($row['year'] == '2569') ? 'selected' : ''; ?>>2569</option>
                                    <option value="2570" <?php echo ($row['year'] == '2570') ? 'selected' : ''; ?>>2570</option>
                                    <option value="2571" <?php echo ($row['year'] == '2571') ? 'selected' : ''; ?>>2571</option>
                                    <option value="2572" <?php echo ($row['year'] == '2572') ? 'selected' : ''; ?>>2572</option>
                                    <option value="2573" <?php echo ($row['year'] == '2573') ? 'selected' : ''; ?>>2573</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>


                <section class="section">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <br>
                                    <h6 style="font-family:Prompt;"><b><u>ข้อชี้แจง</u></b> กรุณาเลือกข้อที่ตรงกับความเป็นจริงและในช่องที่ตรงกับความคิดเห็นของท่านมากที่สุด</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <br>
                                    <h6 style="font-family:Prompt;"><b><u>ตอนที่ 1 ข้อมูลทั่วไปของผู้ตอบแบบสอบถาม</u></b></h6>
                                    <hr>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-2 pt-0"><b>1. เพศ</b></legend>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rdoSex" id="rdoSex1" value="ชาย"
                                                <?php echo (strpos($row['a1_1'], 'ชาย') !== false) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="rdoSex1">1) ชาย</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rdoSex" id="rdoSex2" value="หญิง"
                                                <?php echo (strpos($row['a1_1'], 'หญิง') !== false) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="rdoSex2">2) หญิง</label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-2 pt-0"><b>2. อายุ</b></legend>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rdoAge" id="rdoAge1" value="ต่ำกว่า 20 ปี"
                                                <?php echo (strpos($row['a1_2'], 'ต่ำกว่า 20 ปี') !== false) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="rdoAge1">1) ต่ำกว่า 20 ปี</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rdoAge" id="rdoAge2" value="21 - 40 ปี"
                                                <?php echo (strpos($row['a1_2'], '21 - 40 ปี') !== false) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="rdoAge2">2) 21 - 40 ปี</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rdoAge" id="rdoAge3" value="41 - 60 ปี"
                                                <?php echo (strpos($row['a1_2'], '41 - 60 ปี') !== false) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="rdoAge3">3) 41 - 60 ปี</label>
                                            </div>
                                        </div>
                                        <div class="col-sm-2">
                                            <div class="form-check">
                                                <input class="form-check-input" type="radio" name="rdoAge" id="rdoAge4" value="60 ปีขึ้นไป"
                                                <?php echo (strpos($row['a1_2'], '60 ปีขึ้นไป') !== false) ? 'checked' : ''; ?>>
                                                <label class="form-check-label" for="rdoAge4">4) 60 ปีขึ้นไป</label>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-2 pt-0"><b>3. ระดับการศึกษาสูงสุด</b></legend>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoEducation" id="rdoEducation1" value="ต่ำกว่าปริญญาตรี"
                                                    <?php echo (strpos($row['a1_3'], 'ต่ำกว่าปริญญาตรี') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoEducation1">1) ต่ำกว่าปริญญาตรี</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoEducation" id="rdoEducation2" value="ปริญญาตรี"
                                                    <?php echo (strpos($row['a1_3'], 'ปริญญาตรี') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoEducation2">2) ปริญญาตรี</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-3">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoEducation" id="rdoEducation3" value="สูงกว่าปริญญาตรี"
                                                    <?php echo (strpos($row['a1_3'], 'สูงกว่าปริญญาตรี') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoEducation3">3) สูงกว่าปริญญาตรี</label>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-12 pt-0"><b>4. สถานภาพของผู้มารับบริการ</b></legend>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoJob" id="rdoJob1" value="เกษตรกร"
                                                    <?php echo (strpos($row['a1_4'], 'เกษตรกร') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoJob1">1) เกษตรกร</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoJob" id="rdoJob2" value="สถาบันเกษตรกร"
                                                    <?php echo (strpos($row['a1_4'], 'สถาบันเกษตรกร') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoJob2">2) สถาบันเกษตรกร</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoJob" id="rdoJob3" value="ผู้ประกอบการ/บริษัท"
                                                    <?php echo (strpos($row['a1_4'], 'ผู้ประกอบการ/บริษัท') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoJob3">3) ผู้ประกอบการ/บริษัท</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoJob" id="rdoJob4" value="ประชาชนผู้รับบริการ"
                                                    <?php echo (strpos($row['a1_4'], 'ประชาชนผู้รับบริการ') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoJob4">4) ประชาชนผู้รับบริการ</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoJob" id="rdoJob5" value="มหาวิทยาลัย"
                                                    <?php echo (strpos($row['a1_4'], 'มหาวิทยาลัย') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoJob5">5) มหาวิทยาลัย</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoJob" id="rdoJob6" value="Other"
                                                    <?php echo (strpos($row['a1_4'], 'Other') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoJob6">6) อื่นๆ โปรดระบุ</label>
                                                    <textarea class="form-control" id="txtJobOther" name="txtJobOther" placeholder="อื่นๆ โปรดระบุ"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-12 pt-0"><b>5. จำนวนครั้งที่ท่านเคยใช้บริการหรือซื้อผลิตภัณฑ์ของ กยท.</b></legend>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoUsed" id="rdoUsed1" value="1 ครั้ง"
                                                    <?php echo (strpos($row['a1_5'], '1 ครั้ง') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoUsed1">1) 1 ครั้ง</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoUsed" id="rdoUsed2" value="2 ครั้ง"
                                                    <?php echo (strpos($row['a1_5'], '2 ครั้ง') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoUsed2">2) 2 ครั้ง</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoUsed" id="rdoUsed3" value="3 ครั้ง"
                                                    <?php echo (strpos($row['a1_5'], '3 ครั้ง') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoUsed3">3) 3 ครั้ง</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoUsed" id="rdoUsed4" value="4 ครั้ง"
                                                    <?php echo (strpos($row['a1_5'], '4 ครั้ง') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoUsed4">4) 4 ครั้ง</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoUsed" id="rdoUsed5" value="Other"
                                                    <?php echo (strpos($row['a1_5'], 'Other') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoJob6">5) อื่นๆ โปรดระบุ</label>
                                                    <textarea class="form-control" name="txtUsedOther" id="txtUsedOther" placeholder="อื่นๆ โปรดระบุ"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-12 pt-0"><b>6. ระยะเวลาที่ท่านเป็นลูกค้าของ กยท.</b></legend>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoCustomerYear" id="rdoCustomerYear1" value="1 ปี"
                                                    <?php echo (strpos($row['a1_6'], '1 ปี') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoCustomerYear1">1) 1 ปี</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoCustomerYear" id="rdoCustomerYear2" value="2 ปี"
                                                    <?php echo (strpos($row['a1_6'], '2 ปี') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoCustomerYear2">2) 2 ปี</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoCustomerYear" id="rdoCustomerYear3" value="3 ปี"
                                                    <?php echo (strpos($row['a1_6'], '3 ปี') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoCustomerYear3">3) 3 ปี</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoCustomerYear" id="rdoCustomerYear4" value="4 ปี"
                                                    <?php echo (strpos($row['a1_6'], '4 ปี') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoCustomerYear4">4) 4 ปี</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="radio" name="rdoCustomerYear" id="rdoCustomerYear5" value="Other"
                                                    <?php echo (strpos($row['a1_6'], 'Other') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoJob6">5) อื่นๆ โปรดระบุ</label>
                                                    <textarea class="form-control" name="txtCustomerYearOther" id="txtCustomerYearOther" placeholder="อื่นๆ โปรดระบุ"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <fieldset class="row mb-3">
                                        <legend class="col-form-label col-sm-12 pt-0"><b>7. ท่านเคยใช้บริการหรือซื้อผลิตภัณฑ์ กยท. ข้อใดบ้าง (ตอบได้มากกว่า 1 ข้อ)</b></legend>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ckbSale1" id="ckbSale1" value="ใช้บริการซื้อ-ขายยางผ่านตลาด กยท."
                                                    <?php echo (strpos($row['a1_7'], 'ใช้บริการซื้อ-ขายยางผ่านตลาด กยท.') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="ckbSale1">1) ใช้บริการซื้อ-ขายยางผ่านตลาด กยท.</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ckbSale2" id="ckbSale2" value="ซื้อผลิตภัณฑ์ยางแปรรูปขั้นต้นจาก กยท."
                                                    <?php echo (strpos($row['a1_7'], 'ซื้อผลิตภัณฑ์ยางแปรรูปขั้นต้นจาก กยท.') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="ckbSale2">2) ซื้อผลิตภัณฑ์ยางแปรรูปขั้นต้นจาก กยท.</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ckbSale3" id="ckbSale3" value="ซื้อผลิตภัณฑ์ยางจาก กยท."
                                                    <?php echo (strpos($row['a1_7'], 'ซื้อผลิตภัณฑ์ยางจาก กยท.') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="ckbSale3">3) ซื้อผลิตภัณฑ์ยางจาก กยท.</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ckbSale4" id="ckbSale4" value="นำงานวิจัยของ กยท. ไปใช้ประโยชน์"
                                                    <?php echo (strpos($row['a1_7'], 'นำงานวิจัยของ กยท. ไปใช้ประโยชน์') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="ckbSale4">4) นำงานวิจัยของ กยท. ไปใช้ประโยชน์</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-4">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ckbSale5" id="ckbSale5" value="Other"
                                                    <?php echo (strpos($row['a1_7'], 'Other') !== false) ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="rdoJob6">5) อื่นๆ โปรดระบุ</label>
                                                    <textarea class="form-control" name="txtSaleOther" id="txtSaleOther" placeholder="อื่นๆ โปรดระบุ"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <br>
                                    <h6 style="font-family:Prompt;"><b><u>ตอนที่ 2 ความพึงพอใจ / ไม่พึงพอใจต่อการให้บริการ</u></b></h6>
                                    <!-- <h6 style="font-family:Prompt;"><b><u>คำอธิบาย</u></b>: โปรดเลือกระดับความพึงพอใจ โดยเลือกตัวเลือกในช่องที่ตรงกับความพึงพอใจของท่าน</h6> -->
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6 style="font-family:Prompt;"><b><u>คำอธิบาย</u></b>: โปรดเลือกระดับความพึงพอใจ โดยเลือกตัวเลือกในช่องที่ตรงกับความพึงพอใจของท่าน</h6>
                                        </div>
                                        <div class="col-sm-12">
                                            <h6 style="font-family:Prompt;"><b>ระดับ 5 </b>: พึงพอใจมากที่สุด <b>ระดับ 4 </b>: พึงพอใจมาก <b>ระดับ 3 </b>: พึงพอใจปานกลาง <b>ระดับ 2 </b>: พึงพอใจน้อย <b>ระดับ 1 </b>: พึงพอใจน้อยที่สุด</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <table class="table table-bordered table-hover" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th scope="col" rowspan="0" style="background-color: #eeeeee;">ประเด็น/ด้าน</th>
                                                <th scope="col" colspan="5" style="background-color: #eeeeee;">ระดับความพึงพอใจ</th>
                                                <!-- <th scope="col" colspan="2">ระดับความไม่พึงพอใจ</th> -->
                                            </tr>
                                            <tr>
                                                <th scope="col" style="background-color: #f7f7f7;">พอใจมาก</th>
                                                <th scope="col" style="background-color: #f7f7f7;">พอใจ</th>
                                                <th scope="col" style="background-color: #f7f7f7;">พอใจน้อย</th>
                                                <th scope="col" style="background-color: #f7f7f7;">ไม่พอใจ</th>
                                                <th scope="col" style="background-color: #f7f7f7;">ไม่พอใจมาก</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td colspan="6" style="text-align: left;"><b>1. ด้านเวลา</b></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">1.1 การให้บริการเป็นไปตามระยะเวลาที่กำหนด</td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime1" id="rdoTime11" value="พอใจมาก" <?php echo ($row['a2_1_1'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime1" id="rdoTime12" value="พอใจ" <?php echo ($row['a2_1_1'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime1" id="rdoTime13" value="พอใจน้อย" <?php echo ($row['a2_1_1'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime1" id="rdoTime14" value="ไม่พอใจ" <?php echo ($row['a2_1_1'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime1" id="rdoTime15" value="ไม่พอใจมาก" <?php echo ($row['a2_1_1'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">1.2 ความรวดเร็วในการให้บริการ</td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime2" id="rdoTime21" value="พอใจมาก" <?php echo ($row['a2_1_2'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime2" id="rdoTime22" value="พอใจ" <?php echo ($row['a2_1_2'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime2" id="rdoTime23" value="พอใจน้อย" <?php echo ($row['a2_1_2'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime2" id="rdoTime24" value="ไม่พอใจ" <?php echo ($row['a2_1_2'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoTime2" id="rdoTime25" value="ไม่พอใจมาก" <?php echo ($row['a2_1_2'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: left;"><b>2. ด้านขั้นตอนการให้บริการ</b></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">2.1 การติดป้ายประกาศหรือแจ้งข้อมูลเกี่ยวกับขั้นตอนและระยะเวลาการให้บริการ</td>
                                                <td><input class="form-check-input" type="radio" name="rdoService1" id="rdoService11" value="พอใจมาก" <?php echo ($row['a2_2_1'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService1" id="rdoService12" value="พอใจ" <?php echo ($row['a2_2_1'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService1" id="rdoService13" value="พอใจน้อย" <?php echo ($row['a2_2_1'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService1" id="rdoService14" value="ไม่พอใจ" <?php echo ($row['a2_2_1'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService1" id="rdoService15" value="ไม่พอใจมาก" <?php echo ($row['a2_2_1'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">2.2 การจัดลำดับขั้นตอนการให้บริการตามที่ประกาศไว้</td>
                                                <td><input class="form-check-input" type="radio" name="rdoService2" id="rdoService21" value="พอใจมาก" <?php echo ($row['a2_2_2'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService2" id="rdoService22" value="พอใจ" <?php echo ($row['a2_2_2'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService2" id="rdoService23" value="พอใจน้อย" <?php echo ($row['a2_2_2'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService2" id="rdoService24" value="ไม่พอใจ" <?php echo ($row['a2_2_2'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService2" id="rdoService25" value="ไม่พอใจมาก" <?php echo ($row['a2_2_2'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">2.3 การให้บริการตามลำดับก่อนหลัง เช่น มาก่อนต้องได้รับบริการก่อน</td>
                                                <td><input class="form-check-input" type="radio" name="rdoService3" id="rdoService31" value="พอใจมาก" <?php echo ($row['a2_2_3'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService3" id="rdoService32" value="พอใจ" <?php echo ($row['a2_2_3'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService3" id="rdoService33" value="พอใจน้อย" <?php echo ($row['a2_2_3'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService3" id="rdoService34" value="ไม่พอใจ" <?php echo ($row['a2_2_3'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoService3" id="rdoService35" value="ไม่พอใจมาก" <?php echo ($row['a2_2_3'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: left;"><b>3. ด้านบุคลากรที่ให้บริการ</b></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">3.1 ความเหมาะสมในการแต่งกายของผู้ให้บริการ</td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService1" id="rdoPersonService11" value="พอใจมาก" <?php echo ($row['a2_3_1'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService1" id="rdoPersonService12" value="พอใจ" <?php echo ($row['a2_3_1'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService1" id="rdoPersonService13" value="พอใจน้อย" <?php echo ($row['a2_3_1'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService1" id="rdoPersonService14" value="ไม่พอใจ" <?php echo ($row['a2_3_1'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService1" id="rdoPersonService15" value="ไม่พอใจมาก" <?php echo ($row['a2_3_1'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">3.2 ความเต็มใจและความพร้อมในการให้บริการอย่าสุภาพ</td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService2" id="rdoPersonService21" value="พอใจมาก" <?php echo ($row['a2_3_2'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService2" id="rdoPersonService22" value="พอใจ" <?php echo ($row['a2_3_2'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService2" id="rdoPersonService23" value="พอใจน้อย" <?php echo ($row['a2_3_2'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService2" id="rdoPersonService24" value="ไม่พอใจ" <?php echo ($row['a2_3_2'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService2" id="rdoPersonService25" value="ไม่พอใจมาก" <?php echo ($row['a2_3_2'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">3.3 ความรู้ความสามารถในการให้บริการ เช่น สามารตอบคำถาม ชี้แจงข้อสงสัยให้คำแนะนำได้ เป็นต้น</td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService3" id="rdoPersonService31" value="พอใจมาก" <?php echo ($row['a2_3_3'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService3" id="rdoPersonService32" value="พอใจ" <?php echo ($row['a2_3_3'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService3" id="rdoPersonService33" value="พอใจน้อย" <?php echo ($row['a2_3_3'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService3" id="rdoPersonService34" value="ไม่พอใจ" <?php echo ($row['a2_3_3'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService3" id="rdoPersonService35" value="ไม่พอใจมาก" <?php echo ($row['a2_3_3'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">3.4 ความซื่อสัตย์สุจริตในการปฏิบัติหน้าที่ เช่น ไม่ขอสิ่งตอบแทน, ไม่รับสินบน, ไม่หาผลประโยชน์ในทางมิชอบ</td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService4" id="rdoPersonService41" value="พอใจมาก" <?php echo ($row['a2_3_4'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService4" id="rdoPersonService42" value="พอใจ" <?php echo ($row['a2_3_4'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService4" id="rdoPersonService43" value="พอใจน้อย" <?php echo ($row['a2_3_4'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService4" id="rdoPersonService44" value="ไม่พอใจ" <?php echo ($row['a2_3_4'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService4" id="rdoPersonService45" value="ไม่พอใจมาก" <?php echo ($row['a2_3_4'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">3.5 การให้บริการเหมือนกันทุกรายโดยไม่เลือกปฏิบัติ</td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService5" id="rdoPersonService51" value="พอใจมาก" <?php echo ($row['a2_3_5'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService5" id="rdoPersonService52" value="พอใจ" <?php echo ($row['a2_3_5'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService5" id="rdoPersonService53" value="พอใจน้อย" <?php echo ($row['a2_3_5'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService5" id="rdoPersonService54" value="ไม่พอใจ" <?php echo ($row['a2_3_5'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoPersonService5" id="rdoPersonService55" value="ไม่พอใจมาก" <?php echo ($row['a2_3_5'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: left;"><b>4. ด้านสิ่งอานวยความสะดวก</b></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">4.1 ความชัดเจนของป้ายสัญลักษณ์ประชาสัมพันธ์บอกจุดบริการ</td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities1" id="rdoFacilities11" value="พอใจมาก" <?php echo ($row['a2_4_1'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities1" id="rdoFacilities12" value="พอใจ" <?php echo ($row['a2_4_1'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities1" id="rdoFacilities13" value="พอใจน้อย" <?php echo ($row['a2_4_1'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities1" id="rdoFacilities14" value="ไม่พอใจ" <?php echo ($row['a2_4_1'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities1" id="rdoFacilities15" value="ไม่พอใจมาก" <?php echo ($row['a2_4_1'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">4.2 จุด /ช่อง การให้บริการมีความเหมาะสมและเข้าถึงได้สะดวก</td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities2" id="rdoFacilities21" value="พอใจมาก" <?php echo ($row['a2_4_2'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities2" id="rdoFacilities22" value="พอใจ" <?php echo ($row['a2_4_2'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities2" id="rdoFacilities23" value="พอใจน้อย" <?php echo ($row['a2_4_2'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities2" id="rdoFacilities24" value="ไม่พอใจ" <?php echo ($row['a2_4_2'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities2" id="rdoFacilities25" value="ไม่พอใจมาก" <?php echo ($row['a2_4_2'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">4.3 ความเพียงพอของสิ่งอำนวยความสะดวก เช่น ที่นั่งรอรับบริการ น้ำดื่ม หนังสือพิมพ์ ฯลฯ (ไม่นับผู้ให้บริการขนส่ง จำนวน 4 ราย)</td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities3" id="rdoFacilities31" value="พอใจมาก" <?php echo ($row['a2_4_3'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities3" id="rdoFacilities32" value="พอใจ" <?php echo ($row['a2_4_3'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities3" id="rdoFacilities33" value="พอใจน้อย" <?php echo ($row['a2_4_3'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities3" id="rdoFacilities34" value="ไม่พอใจ" <?php echo ($row['a2_4_3'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities3" id="rdoFacilities35" value="ไม่พอใจมาก" <?php echo ($row['a2_4_3'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">4.4 ความสะอาดของสถานที่ให้บริการ (ไม่นับผู้ให้บริการขนส่ง จำนวน 4 ราย)</td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities4" id="rdoFacilities41" value="พอใจมาก" <?php echo ($row['a2_4_4'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities4" id="rdoFacilities42" value="พอใจ" <?php echo ($row['a2_4_4'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities4" id="rdoFacilities43" value="พอใจน้อย" <?php echo ($row['a2_4_4'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities4" id="rdoFacilities44" value="ไม่พอใจ" <?php echo ($row['a2_4_4'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoFacilities4" id="rdoFacilities45" value="ไม่พอใจมาก" <?php echo ($row['a2_4_4'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" style="text-align: left;"><b>5. ด้านผลิตภัณฑ์</b></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">5.1 ผลิตภัณฑ์มีคุณภาพดีและเหมาะสมต่อราคา</td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct1" id="rdoProduct11" value="พอใจมาก" <?php echo ($row['a2_5_1'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct1" id="rdoProduct12" value="พอใจ" <?php echo ($row['a2_5_1'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct1" id="rdoProduct13" value="พอใจน้อย" <?php echo ($row['a2_5_1'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct1" id="rdoProduct14" value="ไม่พอใจ" <?php echo ($row['a2_5_1'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct1" id="rdoProduct15" value="ไม่พอใจมาก" <?php echo ($row['a2_5_1'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">5.2 คุณสมบัติของผลิตภัณฑ์เป็นไปตามมาตรฐานสากล (ไม่นับผู้ให้บริการขนส่ง จำนวน 4 ราย)</td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct2" id="rdoProduct21" value="พอใจมาก" <?php echo ($row['a2_5_2'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct2" id="rdoProduct22" value="พอใจ" <?php echo ($row['a2_5_2'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct2" id="rdoProduct23" value="พอใจน้อย" <?php echo ($row['a2_5_2'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct2" id="rdoProduct24" value="ไม่พอใจ" <?php echo ($row['a2_5_2'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct2" id="rdoProduct25" value="ไม่พอใจมาก" <?php echo ($row['a2_5_2'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">5.3 เจ้าหน้ามีการให้บริการและคำแนะนำหลังการขาย</td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct3" id="rdoProduct31" value="พอใจมาก" <?php echo ($row['a2_5_3'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct3" id="rdoProduct32" value="พอใจ" <?php echo ($row['a2_5_3'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct3" id="rdoProduct33" value="พอใจน้อย" <?php echo ($row['a2_5_3'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct3" id="rdoProduct34" value="ไม่พอใจ" <?php echo ($row['a2_5_3'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoProduct3" id="rdoProduct35" value="ไม่พอใจมาก" <?php echo ($row['a2_5_3'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">6. ท่านมีความพึงพอใจ / ไม่พึงพอใจต่อการให้บริการในภาพรวม อยู่ในระดับใด</td>
                                                <td><input class="form-check-input" type="radio" name="rdoOverall1" id="rdoOverall11" value="พอใจมาก" <?php echo ($row['a2_6'] == 'พอใจมาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoOverall1" id="rdoOverall12" value="พอใจ" <?php echo ($row['a2_6'] == 'พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoOverall1" id="rdoOverall13" value="พอใจน้อย" <?php echo ($row['a2_6'] == 'พอใจน้อย') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoOverall1" id="rdoOverall14" value="ไม่พอใจ" <?php echo ($row['a2_6'] == 'ไม่พอใจ') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoOverall1" id="rdoOverall15" value="ไม่พอใจมาก" <?php echo ($row['a2_6'] == 'ไม่พอใจมาก') ? 'checked' : ''; ?>></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <br>
                                    <h6 style="font-family:Prompt;"><b><u>ตอนที่ 3 ความไม่พึงพอใจต่อการให้บริการ</u></b></h6>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6 style="font-family:Prompt;"><b><u>คำอธิบาย</u></b>: หากเลือกตอบความไม่พึงพอใจ โปรดระบุความไม่พึงพอใจ พร้อมข้อเสนอแนะเพื่อการปรับปรุง</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <fieldset class="row mb-3">
                                        <div class="row">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ckbDissatisfaction" id="ckbSale1" value="พึงพอใจทุกด้าน" <?php echo ($row['a_5'] == 'พึงพอใจทุกด้าน') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="ckbSale1">พึงพอใจทุกด้าน (ข้ามไปทำส่วนที่ 4)</label>
                                                </div>
                                            </div>
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="ckbDissatisfaction" id="ckbSale2" value="ไม่พึงพอใจ" <?php echo ($row['a_5'] == 'ไม่พึงพอใจ') ? 'checked' : ''; ?>>
                                                    <label class="form-check-label" for="ckbSale2">ไม่พึงพอใจ (ตอบได้มากกว่า 1 ข้อ)</label>
                                                </div>
                                            </div>

                                        </div>
                                    </fieldset>
                                    <fieldset class="row mb-3">
                                        <div class="row">
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <label class="form-check-label mb-1" for="rdoJob6"><b>1. ด้านเวลาให้บริการ</b> โปรดระบุ พร้อมข้อเสนอแนะเพื่อการปรับปรุง</label>
                                                <textarea class="form-control  mb-1" name="txtCustomerTimeService" id="txtCustomerTimeService" placeholder="อื่นๆ โปรดระบุ" ><?php echo $row['a_5_1']; ?></textarea>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <label class="form-check-label mb-1" for="rdoJob6"><b>2. ด้านขั้นตอนการให้บริการ</b> โปรดระบุ พร้อมข้อเสนอแนะเพื่อการปรับปรุง</label>
                                                <textarea class="form-control mb-1" name="txtCustomerProcessingService" id="txtCustomerProcessingService" placeholder="อื่นๆ โปรดระบุ" ><?php echo $row['a_5_2']; ?>"</textarea>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <label class="form-check-label mb-1" for="rdoJob6"><b>3. ด้านบุคลากรที่ให้บริการ</b> โปรดระบุ พร้อมข้อเสนอแนะเพื่อการปรับปรุง</label>
                                                <textarea class="form-control mb-1" name="txtCustomerPersionService" id="txtCustomerPersionService" placeholder="อื่นๆ โปรดระบุ" ><?php echo $row['a_5_3']; ?></textarea>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <label class="form-check-label mb-1" for="rdoJob6"><b>4. ด้านสิ่งอำนวยความสะดวก</b> โปรดระบุ พร้อมข้อเสนอแนะเพื่อการปรับปรุง</label>
                                                <textarea class="form-control mb-1" name="txtCustomerFacilitate" id="txtCustomerFacilitate" placeholder="อื่นๆ โปรดระบุ" ><?php echo $row['a_5_4']; ?></textarea>
                                            </div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-1"></div>
                                            <div class="col-sm-10">
                                                <label class="form-check-label mb-1" for="rdoJob6"><b>5. ด้านผลิตภัณฑ์</b> โปรดระบุ พร้อมข้อเสนอแนะเพื่อการปรับปรุง</label>
                                                <textarea class="form-control mb-1" name="txtCustomerProductSide" id="txtCustomerProductSide" placeholder="อื่นๆ โปรดระบุ"><?php echo $row['a_5_5']; ?></textarea>
                                            </div>
                                            <div class="col-sm-1"></div>
                                        </div>
                                    </fieldset>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <br>
                                    <h6 style="font-family:Prompt;"><b><u>ตอนที่ 4 ความผูกพันต่อกยท.</u></b></h6>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h6 style="font-family:Prompt;"><b><u>คำอธิบาย</u></b>: โปรดเลือกระดับความผูกพัน โดยเลือกตัวเลือกในช่องที่ตรงกับความผูกพันของท่าน</h6>
                                        </div>
                                        <div class="col-sm-12">
                                            <h6 style="font-family:Prompt;"><b>ระดับ 3 </b>: ความผูกพันมาก <b>ระดับ 2 </b>: ความผูกพันปานกลาง <b>ระดับ 1 </b>: ความผูกพันน้อย</h6>
                                        </div>
                                    </div>
                                    <hr>
                                    <table class="table table-bordered table-hover" style="text-align: center;">
                                        <thead>
                                            <tr>
                                                <th scope="col" rowspan="2" style="background-color: #eeeeee;">ประเด็น/ด้าน</th>
                                                <th scope="col" colspan="3" style="background-color: #eeeeee;">ระดับความผูกพัน</th>
                                            </tr>
                                            <tr>
                                                <th scope="col" style="background-color: #f7f7f7;">มาก</th>
                                                <th scope="col" style="background-color: #f7f7f7;">ปานกลาง</th>
                                                <th scope="col" style="background-color: #f7f7f7;">น้อย</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: left;">1. ท่านสนใจและหาข้อมูลเกี่ยวกับการให้บริการและผลิตภัณฑ์ของ กยท.</td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation1" id="rdoAffiliation11" value="มาก" <?php echo ($row['a3_1'] == 'มาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation1" id="rdoAffiliation12" value="ปานกลาง" <?php echo ($row['a3_1'] == 'ปานกลาง') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation1" id="rdoAffiliation13" value="น้อย" <?php echo ($row['a3_1'] == 'น้อย') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">2. ท่านจะกลับมาใช้บริการและซื้อผลิตภัณฑ์ของ กยท. อีกครั้ง</td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation2" id="rdoAffiliation21" value="มาก" <?php echo ($row['a3_2'] == 'มาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation2" id="rdoAffiliation22" value="ปานกลาง" <?php echo ($row['a3_2'] == 'ปานกลาง') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation2" id="rdoAffiliation23" value="น้อย" <?php echo ($row['a3_2'] == 'น้อย') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">3. ท่านจะเป็นลูกค้าของ กยท. ต่อไป</td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation3" id="rdoAffiliation31" value="มาก" <?php echo ($row['a3_3'] == 'มาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation3" id="rdoAffiliation32" value="ปานกลาง" <?php echo ($row['a3_3'] == 'ปานกลาง') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation3" id="rdoAffiliation33" value="น้อย" <?php echo ($row['a3_3'] == 'น้อย') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">4. ท่านจะแนะนำการให้บริการและผลิตภัณฑ์ของ กยท.แก่ผู้อื่น</td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation4" id="rdoAffiliation41" value="มาก" <?php echo ($row['a3_4'] == 'มาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation4" id="rdoAffiliation42" value="ปานกลาง" <?php echo ($row['a3_4'] == 'ปานกลาง') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation4" id="rdoAffiliation43" value="น้อย" <?php echo ($row['a3_4'] == 'น้อย') ? 'checked' : ''; ?>></td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">5. ท่านต้องการรับรู้ข้อมูลข่าวสารของการให้บริการและผลิตภัณฑ์ของ กยท.</td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation5" id="rdoAffiliation51" value="มาก" <?php echo ($row['a3_5'] == 'มาก') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation5" id="rdoAffiliation52" value="ปานกลาง" <?php echo ($row['a3_5'] == 'ปานกลาง') ? 'checked' : ''; ?>></td>
                                                <td><input class="form-check-input" type="radio" name="rdoAffiliation5" id="rdoAffiliation53" value="น้อย" <?php echo ($row['a3_5'] == 'น้อย') ? 'checked' : ''; ?>></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">
                                    <br>
                                    <h6 style="font-family:Prompt;"><b><u>ตอนที่ 5 ปัญหา / ข้อเสนอแนะ</u></b></h6>
                                    <hr>
                                    <!-- <div class="row mb-3">
                                            <label class="col-sm-2 col-form-label"><u>ปัญหา</u></label>
                                            <div class="col-sm-10">
                                                <textarea id="txtProblem" name="txtProblem" class="form-control" style="height: 100px"></textarea>
                                            </div>
                                            </div> -->
                                    <div class="row mb-3">
                                        <label class="col-sm-2 col-form-label"><u>ข้อเสนอแนะ</u></label>
                                        <div class="col-sm-10">
                                            <textarea id="txtSuggestions" name="txtSuggestions" class="form-control" style="height: 100px"><?php echo $row['a4_2']; ?></textarea>
                                        </div>
                                    </div>
                                    <hr>

                                    <h5 class="card-title" style="text-align: center; font-family:Prompt;">ขอขอบคุณในความร่วมมือที่ท่านได้เสียสละเวลาให้ข้อมูลที่เป็นประโยชน์ครั้งนี้</h5>
                                </div>
                            </div>
                            <!-- <div class="row mb-5 mt-3">
                                <div class="col-sm-12" style="text-align: center; font-family:Prompt;">
                                    <button type="submit" class="btn btn-primary" disabled>ส่งแบบสอบถาม</button>
                                </div>
                            </div> -->
                        </div>
                    </div>
                </section>
            </div>
        </form>
    </main>

    <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/chart.js/chart.umd.js"></script>
    <script src="assets/vendor/echarts/echarts.min.js"></script>
    <script src="assets/vendor/quill/quill.js"></script>
    <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
    <script src="assets/vendor/tinymce/tinymce.min.js"></script>
    <script src="assets/vendor/php-email-form/validate.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>
</body>

</html>