document.getElementById("childSelect").addEventListener("change", function () {
    const selected = this.value;
    const childData = document.getElementById("childData");
  
    if (selected === "S001") {
      childData.innerHTML = `
        <p><strong>Grade:</strong> A</p>
        <p><strong>Attendance:</strong> 95%</p>
        <p><strong>Last Activity:</strong> Science Project</p>
      `;
    } else {
      childData.innerHTML = `
        <p><strong>Grade:</strong> B+</p>
        <p><strong>Attendance:</strong> 90%</p>
        <p><strong>Last Activity:</strong> English Presentation</p>
      `;
    }
  });
  
  document.getElementById("messageForm").addEventListener("submit", function (e) {
    e.preventDefault();
    const teacher = document.getElementById("teacherName").value.trim();
    const message = document.getElementById("messageText").value.trim();
  
    if (teacher && message) {
      const messageArea = document.getElementById("messageArea");
      const msgDiv = document.createElement("div");
      msgDiv.className = "message";
      msgDiv.textContent = `To ${teacher}: ${message}`;
      messageArea.appendChild(msgDiv);
  
      this.reset();
    }
  });