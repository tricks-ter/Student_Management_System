function calculateOverallGrade() {
  const assignmentRows = document.querySelectorAll('#assignmentTable tbody tr');
  let totalPercentage = 0;
  let count = 0;

  assignmentRows.forEach(row => {
    const score = parseFloat(row.querySelector('.score').textContent) || 0;
    const maxScore = parseFloat(row.cells[2].textContent) || 100;
    const percentage = (score / maxScore) * 100;
    totalPercentage += percentage;
    count++;
  });

  const overallGrade = count > 0 ? (totalPercentage / count).toFixed(2) : '--';
  return overallGrade;
}

function updateOverallGradeDisplay() {
  const overallGradeDisplay = document.getElementById('finalGradeDisplay');
  const overallGrade = calculateOverallGrade();
  overallGradeDisplay.textContent = overallGrade + '%';
}

function initializeAssignments() {
  updateOverallGradeDisplay();
}

function initializeStudentGradeBook() {
  initializeAssignments();
}

document.addEventListener('DOMContentLoaded', initializeStudentGradeBook);
