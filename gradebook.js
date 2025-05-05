// Global variable to store the current curve percentage (default 0%)
let currentCurve = 0;

/**
 * Calculate the weighted total for a single row.
 * Formula: (score / maxScore) * weight
 *
 * @param {HTMLTableRowElement} row - The row in the grade entry grid.
 */
function calculateRowTotal(row) {
  // Retrieve the score input element from the row
  const scoreInput = row.querySelector('.score');
  // Parse values (assuming maxScore and weight are in the table cells)
  const score = parseFloat(scoreInput.value) || 0;
  // The max score is in cell index 3 (fourth cell)
  const maxScore = parseFloat(row.cells[3].textContent) || 100;
  // The weight is in cell index 4 (fifth cell)
  const weight = parseFloat(row.cells[4].textContent) || 0;
  
  // Calculate weighted total
  const total = (score / maxScore) * weight;
  return total;
}

/**
 * Update all rows in the Grade Entry Grid.
 * For each row, recalculate its weighted total and update its display.
 */
function updateGradeEntryGrid() {
  const rows = document.querySelectorAll('#grade-entry tbody tr');
  rows.forEach(row => {
    const rowTotal = calculateRowTotal(row);
    // Update the "Calculated Total" cell (assumed to be the 6th cell)
    row.querySelector('.total').textContent = rowTotal.toFixed(2);
  });
  updateFinalGrades();
}

/**
 * Recalculate final grades for each student by summing 
 * the calculated totals from all assignments and 
 * applying any curve adjustment.
 */
function updateFinalGrades() {
  // Create an object to map student names to their summed grade totals
  const studentTotals = {};
  const rows = document.querySelectorAll('#grade-entry tbody tr');
  
  rows.forEach(row => {
    const studentName = row.cells[0].textContent.trim();
    const rowTotal = parseFloat(row.querySelector('.total').textContent) || 0;
    // Sum totals per student (supporting multiple entries per student)
    if (studentTotals[studentName]) {
      studentTotals[studentName] += rowTotal;
    } else {
      studentTotals[studentName] = rowTotal;
    }
  });
  
  // Apply the curve adjustment factor (newTotal = total * (1 + curve/100))
  Object.keys(studentTotals).forEach(student => {
    studentTotals[student] = studentTotals[student] * (1 + currentCurve / 100);
  });
  
  // Update the Final Grades table by matching student names
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

/**
 * Export the final grades to a CSV file.
 */
function exportFinalGrades() {
  let csvContent = 'Student Name,Final Grade\n';
  const finalRows = document.querySelectorAll('#finalGradeTable tbody tr');
  
  finalRows.forEach(row => {
    const studentName = row.cells[0].textContent.trim();
    const finalGrade = row.cells[1].textContent.trim();
    csvContent += `"${studentName}","${finalGrade}"\n`;
  });
  
  // Create a Blob with the CSV content and trigger a download
  const blob = new Blob([csvContent], { type: 'text/csv;charset=utf-8;' });
  const url = URL.createObjectURL(blob);
  const link = document.createElement("a");
  link.setAttribute("href", url);
  link.setAttribute("download", "final_grades.csv");
  document.body.appendChild(link);
  link.click();
  document.body.removeChild(link);
}

/**
 * Initialize event listeners on the Grade Entry Grid and Curve Calculator.
 */
function initializeGradebook() {
  // Attach event listener to each score input for dynamic recalculation
  const scoreInputs = document.querySelectorAll('#grade-entry input.score');
  scoreInputs.forEach(input => {
    input.addEventListener('input', () => {
      updateGradeEntryGrid();
    });
  });
  
  // Event listener for applying a curve adjustment
  const curveButton = document.getElementById('applyCurve');
  if (curveButton) {
    curveButton.addEventListener('click', () => {
      const curveInput = document.getElementById('curveValue');
      let curve = parseFloat(curveInput.value);
      // Update global curve value; default to 0 if invalid
      currentCurve = !isNaN(curve) ? curve : 0;
      // Display feedback in the curveResult area
      const curveResult = document.getElementById('curveResult');
      curveResult.textContent = `Curve adjustment of ${currentCurve}% applied.`;
      updateFinalGrades();
    });
  }
  
  // Event listener for exporting the final grades as CSV
  const exportButton = document.getElementById('exportGrades');
  if (exportButton) {
    exportButton.addEventListener('click', exportFinalGrades);
  }
  
  // Initial calculation when the page loads
  updateGradeEntryGrid();
}

// Initialize the gradebook logic when the page content is fully loaded
document.addEventListener('DOMContentLoaded', initializeGradebook);
