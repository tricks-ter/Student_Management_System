document.getElementById("absenceForm").addEventListener("submit", function(event) {
  event.preventDefault();

  let id = document.getElementById("studentId").value;
  let absenceDate = document.getElementById("absenceDate").value;
  let absenceReason = document.getElementById("reason").value;

  alert("Absence Note Submitted:\n" +
        "Student ID: " + id + "\n" +
        "Date: " + absenceDate + "\n" +
        "Reason: " + absenceReason);

  document.getElementById("absenceForm").reset();
});