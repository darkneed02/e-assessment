document.addEventListener("DOMContentLoaded", function () {
  const checkboxes = document.querySelectorAll(
    "input[name='ckbDissatisfaction']"
  );
  const txtAreas = [
    "txtCustomerTimeService",
    "txtCustomerProcessingService",
    "txtCustomerPersionService",
    "txtCustomerFacilitate",
    "txtCustomerProductSide",
  ];

  checkboxes.forEach((checkbox) => {
    checkbox.addEventListener("change", function () {
      if (this.checked) {
        checkboxes.forEach((cb) => {
          if (cb !== this) cb.checked = false;
        });

        // ถ้าเลือก "ไม่พึงพอใจ" (ckbSale2) ให้เปิด textarea
        if (this.id === "ckbSale2") {
          txtAreas.forEach((id) =>
            document.getElementById(id).removeAttribute("disabled")
          );
        } else {
          txtAreas.forEach((id) =>
            document.getElementById(id).setAttribute("disabled", "true")
          );
        }
      }
    });
  });

  // ปิด textarea ตั้งแต่โหลดหน้าเว็บ
  txtAreas.forEach((id) =>
    document.getElementById(id).setAttribute("disabled", "true")
  );
});
