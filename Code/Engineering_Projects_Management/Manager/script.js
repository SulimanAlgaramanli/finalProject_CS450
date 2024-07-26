function toggleSidebar() {
  var sidebar = document.getElementById("sidebar");
  var sidebarToggle = document.querySelector(".sidebar-toggle i");
  if (sidebar.classList.contains("hidden")) {
    sidebar.classList.remove("hidden");
    sidebarToggle.classList.remove("fa-bars");
    sidebarToggle.classList.add("fa-times");
    document.body.style.marginRight = "300px";
  } else {
    sidebar.classList.add("hidden");
    sidebarToggle.classList.remove("fa-times");
    sidebarToggle.classList.add("fa-bars");
    document.body.style.marginRight = "0";
  }
}



function printTable() {
  // إنشاء نسخة جديدة من جدول المشاريع بدون العمود الأخير
  var tableClone = document.getElementById("table_projects").cloneNode(true);

  // حذف العمود الأخير الذي يحتوي على أزرار التعديل والحذف
  var rows = tableClone.getElementsByTagName("tr");
  for (var i = 0; i < rows.length; i++) {
    var lastCell = rows[i].cells[rows[i].cells.length - 1];
    lastCell.parentNode.removeChild(lastCell);
  }

  // فتح نافذة جديدة للطباعة
  var printWindow = window.open("", "_blank", "width=1200,height=1000");
  printWindow.document.open();
  printWindow.document.write(`
      <html>
      <head>
          <title>Print Table</title>
          <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
          <style>
              body {
                  font-family: Arial, sans-serif;
                  direction: rtl;
              }
              table {
                  width: 100%;
                  border-collapse: collapse;
                  margin-bottom: 20px;
              }
              th, td {
                  border: 1px solid #ccc;
                  padding: 12px; /* زيادة التباعد لجعل الجدول أكبر وأوضح */
                  text-align: center;
              }
              .date-cell {
                white-space: nowrap; /* منع النص من الانتقال إلى سطر جديد */
              }
              table td a {
                  display: block;
                  width: 100%;
                  height: 100%;
                  text-decoration: none;
                  color: inherit;
              }

          </style>
      </head>
      <body>${tableClone.outerHTML}</body>
      </html>`);
  printWindow.document.close();
  printWindow.print();
}
