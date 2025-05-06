let currentCurve = 0;

function calculateRowTotal(row) {
  const scoreInput = row.querySelector('.score');
  const score = parseFloat(scoreInput.value) || 0;
  const maxScore = parseFloat(row.cells[3].textContent) || 100;
  const weight = parseFloat(row.cells[4].textContent) || 0;
  const total = (score / maxScore) * weight;
  return total;
}

function updateGradeEntryGrid() {
  const rows = document.querySelectorAll('#grade-entry tbody tr');
  rows.forEach(row => {
    const rowTotal = calculateRowTotal(row);
    row.querySelector('.total').textContent = rowTotal.toFixed(2);
  });
  updateFinalGrades();
}

function updateFinalGrades() {
  const studentTotals = {};
  const rows = document.querySelectorAll('#grade-entry tbody tr');
  
  rows.forEach(row => {
    const studentName = row.cells[0].textContent.trim();
    const rowTotal = parseFloat(row.querySelector('.total').textContent) || 0;
    if (studentTotals[studentName]) {
      studentTotals[studentName] += rowTotal;
    } else {
      studentTotals[studentName] = rowTotal;
    }
  });
  
  Object.keys(studentTotals).forEach(student => {
    studentTotals[student] = studentTotals[student] * (1 + currentCurve / 100);
  });

  const finalRows = document.querySelectorAll('#finalGradeTable tbody tr');
  finalRows.forEach(row => {
    const nameCell = row.cells[0];
    const gradeCell = row.cells[1];
    const studentName = nameCell.textContent.trim();
    if (studentTotals[studentName] !== undefined) {
      gradeCell.textContent = studentTotals[studentName].toFixed(2);
    } else {
      gradeCell.textContent = '--';
    }
  });
}

function exportFinalGrades() {
  let csvContent = 'Student Name,Final Grade\n';
  const finalRows = document.querySelectorAll('#finalGradeTable tbody tr');
  
  finalRows.forEach(row => {
    const studentName = row.cells[0].textContent.trim();
    const finalGrade = row.cells[1].textContent.trim();
    csvContent += `"${studentName}","${finalGrade}"\n`;
  });
  
  const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
  const url = URL.createObjectURL(blob);
  const link = document.createElement("a");
  link.setAttribute("href", url);
  link.setAttribute("download", "final_grades.csv");
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

function initializeGradebook() {
  const scoreInputs = document.querySelectorAll('#grade-entry input.score');
  scoreInputs.forEach(input => {
    input.addEventListener('input', () => {
      updateGradeEntryGrid();
    });
  });

  const curveButton = document.getElementById('applyCurve');
  if (curveButton) {
    curveButton.addEventListener('click', () => {
      const curveInput = document.getElementById('curveValue');
      let curve = parseFloat(curveInput.value);
      currentCurve = !isNaN(curve) ? curve : 0;
      const curveResult = document.getElementById('curveResult');
      curveResult.textContent = `Curve adjustment of ${currentCurve}% applied.`;
      updateFinalGrades();
    });
  }

  const exportButton = document.getElementById('exportGrades');
  if (exportButton) {
    exportButton.addEventListener('click', exportFinalGrades);
  }

  updateGradeEntryGrid();
}

document.addEventListener('DOMContentLoaded', initializeGradebook);
