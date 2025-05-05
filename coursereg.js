// Array to hold selected courses
let selectedCourses = [];

/**
 * Filter course items based on search query.
 * The search compares the query against the course title text.
 */
function filterCourses() {
  const query = document.getElementById('courseSearch').value.toLowerCase();
  const courses = document.querySelectorAll('#course-catalog .course-item');
  
  courses.forEach(course => {
    // Assuming the course title is in an <h3> element within each item
    const title = course.querySelector('h3').textContent.toLowerCase();
    if (title.includes(query)) {
      course.style.display = '';  // Show course
    } else {
      course.style.display = 'none'; // Hide course
    }
  });
}

/**
 * Adds a course from the catalog to the registration wizard.
 * Prevents duplicate entry and checks for simple conflicts.
 * 
 * @param {HTMLElement} courseElement - The course item element being added.
 */
function addCourse(courseElement) {
  const courseId = courseElement.dataset.courseId;
  const courseTitle = courseElement.querySelector('h3').textContent;
  
  // Simple conflict checking: prevent adding duplicate courses
  if (selectedCourses.some(course => course.courseId === courseId)) {
    displayConflict(`The course "${courseTitle}" is already added.`);
    return;
  }
  
  // Add course to the selected courses list
  selectedCourses.push({ courseId, courseTitle });
  updateRegistrationWizard();
  
  // Clear any previous conflict messages, if any
  clearConflict();
}

/**
 * Updates the Registration Wizard by listing all selected courses.
 */
function updateRegistrationWizard() {
  const selectedContainer = document.querySelector('#registration-wizard .selected-courses');
  selectedContainer.innerHTML = ''; // Clear previous list
  
  if (selectedCourses.length === 0) {
    selectedContainer.innerHTML = '<p>No courses selected.</p>';
    return;
  }
  
  // Create list items for each selected course
  const ul = document.createElement('ul');
  selectedCourses.forEach(course => {
    const li = document.createElement('li');
    li.textContent = course.courseTitle;
    // Optionally, add a remove button for each course
    const removeBtn = document.createElement('button');
    removeBtn.textContent = 'Remove';
    removeBtn.style.marginLeft = '10px';
    removeBtn.addEventListener('click', () => removeCourse(course.courseId));
    li.appendChild(removeBtn);
    ul.appendChild(li);
  });
  selectedContainer.appendChild(ul);
}

/**
 * Removes a selected course from the registration wizard.
 * @param {string} courseId - The unique id of the course to be removed.
 */
function removeCourse(courseId) {
  selectedCourses = selectedCourses.filter(course => course.courseId !== courseId);
  updateRegistrationWizard();
}

/**
 * Displays a conflict or error message in the Conflict Checker section.
 * @param {string} message - The conflict message to be displayed.
 */
function displayConflict(message) {
  const conflictDiv = document.querySelector('#conflict-checker .conflict-alert');
  conflictDiv.textContent = message;
}

/**
 * Clears the conflict message.
 */
function clearConflict() {
  const conflictDiv = document.querySelector('#conflict-checker .conflict-alert');
  conflictDiv.textContent = '';
}

/**
 * Simulate submission of course registration.
 * This function will send selected courses to the backend or perform further actions.
 */
function submitRegistration() {
  if (selectedCourses.length === 0) {
    alert("Please select at least one course before submission.");
    return;
  }
  // Replace this alert with actual backend integration logic.
  alert(`Registration submitted for ${selectedCourses.length} course(s):\n` + 
        selectedCourses.map(course => course.courseTitle).join(', '));
}

/**
 * Initialize event listeners for the course registration page.
 */
function initializeCourseRegistration() {
  // Attach event listener for course search filtering
  const searchBtn = document.getElementById('searchBtn');
  if (searchBtn) {
    searchBtn.addEventListener('click', filterCourses);
  }

  // Optionally allow real-time filtering on keyup in the search field.
  const searchInput = document.getElementById('courseSearch');
  if (searchInput) {
    searchInput.addEventListener('keyup', filterCourses);
  }
  
  // Attach listeners to each "Add to Registration" button
  const addButtons = document.querySelectorAll('.course-item button.add-course-btn');
  addButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      // Find the closest parent element with class "course-item"
      const courseItem = event.target.closest('.course-item');
      addCourse(courseItem);
    });
  });
  
  // Attach event listener for the submission button in the Registration Wizard
  const submitBtn = document.getElementById('submitRegistration');
  if (submitBtn) {
    submitBtn.addEventListener('click', submitRegistration);
  }
}

// Wait for the DOM to be fully loaded before initializing
document.addEventListener('DOMContentLoaded', initializeCourseRegistration);
