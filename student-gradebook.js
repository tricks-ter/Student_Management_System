/**
 * Calculate the overall grade based on the assignments listed.
 * The overall grade is the average percentage across all assignments.
 */
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
    
    // Calculate average percentage if there are assignments
    const overallGrade = count > 0 ? (totalPercentage / count).toFixed(2) : '--';
    return overallGrade;
  }
  
  /**
   * Update the overall grade display from calculated value.
   */
  function updateOverallGradeDisplay() {
    const overallGradeDisplay = document.getElementById('finalGradeDisplay');
    const overallGrade = calculateOverallGrade();
    overallGradeDisplay.textContent = overallGrade + '%';
  }
  
  /**
   * Simulate fetching assignment data and updating the table.
   * In a real scenario, this could be an Ajax/API call.
   */
  function initializeAssignments() {
    // Example: If you wanted to dynamically update the assignments,
    // here is where you'd manipulate the DOM using data from an API.
    // Currently, the table is prepopulated in the HTML.
    
    // For demonstration, update overall grade display.
    updateOverallGradeDisplay();
  }
  
  /**
   * Initialize the student grade book page.
   */
  function initializeStudentGradeBook() {
    // Load assignment data if needed and update grade display
    initializeAssignments();
  }
  
  // Initialize once the DOM is fully loaded
  document.addEventListener('DOMContentLoaded', initializeStudentGradeBook);
  