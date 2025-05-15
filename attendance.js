const students = [
    { id: "S001", name: "Lamia" },
    { id: "S002", name: "Samia" },
    { id: "S003", name: "Namia" }
  ];
  
  const attendanceTable = document.getElementById("attendanceTable");
  
  for (let i = 0; i < students.length; i++) {
    const student = students[i];
  
    const row = document.createElement("tr");
  
    const idCell = document.createElement("td");
    idCell.textContent = student.id;
  
    const nameCell = document.createElement("td");
    nameCell.textContent = student.name;
  
    const statusCell = document.createElement("td");
    const select = document.createElement("select");
  
    const options = ["Present", "Absent", "Late"];
    for (let j = 0; j < options.length; j++) {
      const option = document.createElement("option");
      option.value = options[j];
      option.textContent = options[j];
      select.appendChild(option);
    }
  
    statusCell.appendChild(select);
  
    row.appendChild(idCell);
    row.appendChild(nameCell);
    row.appendChild(statusCell);
  
    attendanceTable.appendChild(row);
  }
  
  function submitAttendance() {
    const rows = attendanceTable.getElementsByTagName("tr");
    const attendanceRecord = [];
  
    for (let i = 0; i < rows.length; i++) {
      const cells = rows[i].getElementsByTagName("td");
      const id = cells[0].textContent;
      const select = cells[2].getElementsByTagName("select")[0];
      const status = select.value;
  
      attendanceRecord.push({ id, status });
    }
  
    console.log("Attendance Submitted:", attendanceRecord);
    alert("Attendance submitted successfully!");
  }
  
  const absenceForm = document.getElementById("absenceForm");
  absenceForm.addEventListener("submit", function (e) {
    e.preventDefault();
  
    const id = document.getElementById("absentID").value;
    const reason = document.getElementById("reason").value;
  
    if (id && reason) {
      alert("Absence note submitted for " + id + ":\n" + reason);
      absenceForm.reset();
    }
  });