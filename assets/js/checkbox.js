document.addEventListener("DOMContentLoaded", function () {
  // กำหนด mapping ของ radio และ checkbox กับ textarea ที่เกี่ยวข้อง
  const controls = [
    { radioId: "rdoJob6", textareaId: "txtJobOther" },
    { radioId: "rdoUsed5", textareaId: "txtUsedOther" },
    { radioId: "rdoCustomerYear5", textareaId: "txtCustomerYearOther" },
    { checkboxId: "ckbSale5", textareaId: "txtSaleOther" },
  ];

  // ฟังก์ชันเปิด/ปิด textarea ตามการเลือก
  function toggleTextarea(input, textareaId) {
    const textarea = document.getElementById(textareaId);
    if (input.checked) {
      textarea.removeAttribute("disabled");
    } else {
      textarea.setAttribute("disabled", "true");
      textarea.value = ""; // ล้างค่าเมื่อ disabled
    }
  }

  // วนลูปผูก event กับ radio และ checkbox
  controls.forEach(({ radioId, checkboxId, textareaId }) => {
    const input = document.getElementById(radioId || checkboxId);
    const textarea = document.getElementById(textareaId);

    if (input && textarea) {
      // ปิด textarea ตั้งแต่เริ่มต้น
      textarea.setAttribute("disabled", "true");

      // กำหนด event listener ให้ checkbox และ radio
      input.addEventListener("change", function () {
        toggleTextarea(input, textareaId);
      });
    }
  });
});
