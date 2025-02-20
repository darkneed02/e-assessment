<?php
require_once 'class/db_connect.php';
$conn = db_connect();

$query = 'select department,subservice,uid_asses,"createDte" from  public.tb_assessment';
$result = pg_query($conn, $query);

if (!$result) {
  die("เกิดข้อผิดพลาดในการดึงข้อมูล: " . pg_last_error($conn));
}

pg_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ประวัติการทำแบบประเมิน</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="img/L21-65.png" rel="icon">
  <!-- <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon"> -->

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link
    href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i"
    rel="stylesheet">

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

  <!-- ✅ DataTables CSS -->
  <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

  <style>
    body {
      font-family: 'Prompt', sans-serif;
      background-color: #f8f9fa;
    }
  </style>
</head>

<body>
  <main>
    <div class="container my-4">
      <div class="card shadow-lg rounded-3">
        <div class="card-header text-center">
          <h5 class="mb-0">📌 ประวัติการทำแบบประเมิน</h5>
        </div>
        <div class="card-body">
          <br>
          <div class="table-responsive">
            <table id="assessmentTable" class="table table-bordered table-striped ">
              <thead class="text-center">
                <tr>
                  <th width="5%" class="text-center">#</th>
                  <th class="text-center">ด้าน</th>
                  <th class="text-center">บริการย่อย</th>
                  <th class="text-center">วันที่</th>
                  <th width="20%" class="text-center">รายละเอียด</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $index = 1;
                while ($row = pg_fetch_assoc($result)) {

                  $date = new DateTime($row['createDte']);
                  $department = $row['department'] == 'Serviceside' ? 'บริการ' : ($row['department'] == 'Productside' ? 'ผลิตภัณฑ์' : $row['department']);


                  echo "<tr>";
                  echo "<td class='text-center'>{$index}</td>";
                  echo "<td>$department</td>";
                  echo "<td>{$row['subservice']}</td>";
                  echo "<td>" . $date->format('d-m-') . ($date->format('Y') + 543) . " " . $date->format('H:i') . "</td>";
                  echo "<td>";
                  // ปุ่มรายละเอียด
                  echo "<a href='details-assessments.php?id={$row['uid_asses']}' class='btn btn-outline-success btn-sm'>";
                  echo "📄 รายละเอียด";
                  echo "</a> ";
                  // ปุ่มดาวน์โหลดไฟล์
                  echo "<a href='download.php?id={$row['uid_asses']}' class='btn btn-outline-primary btn-sm'>";
                  echo "⬇️ นำข้อมูลออก";
                  echo "</a>";
                  echo "</td>";
                  echo "</tr>";
                  $index++;
                }
                ?>
              </tbody>
            </table>
          </div>
        </div>
        <div class="card-footer text-muted text-center">
          📜 รายการทำแบบประเมินล่าสุด
        </div>
      </div>
    </div>
  </main>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i
      class="bi bi-arrow-up-short"></i></a>

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

  <!-- ✅ jQuery -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!-- ✅ Bootstrap 5 JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <!-- ✅ DataTables JS -->
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

  <!-- ✅ DataTables Initialization -->
  <script>
    $(document).ready(function() {
      $('#assessmentTable').DataTable({
        "language": {
          "search": "🔍 ค้นหา:",
          "lengthMenu": "แสดง _MENU_ รายการ",
          "info": "แสดง _START_ ถึง _END_ จากทั้งหมด _TOTAL_ รายการ",
          "paginate": {
            "first": "หน้าแรก",
            "last": "หน้าสุดท้าย",
            "next": "ถัดไป",
            "previous": "ก่อนหน้า"
          }
        }
      });
    });
  </script>
</body>

</html>