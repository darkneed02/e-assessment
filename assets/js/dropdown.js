$(document).ready(function () {
  $("#txtSide").change(function () {
    if ($(this).val() === "Serviceside") {
      $("#subServiceContainer").show(); // แสดง dropdown บริการย่อย
    } else {
      $("#subServiceContainer").hide(); // ซ่อน dropdown บริการย่อย
      $("#txtSubService").val("กรุณาเลือก"); // รีเซ็ตค่า
    }
  });
});
