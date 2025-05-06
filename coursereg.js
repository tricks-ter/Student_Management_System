let selectedCourses = [];

function filterCourses() {
  const query = document.getElementById('courseSearch').value.toLowerCase();
  const courses = document.querySelectorAll('#course-catalog .course-item');

  courses.forEach(course => {
    const title = course.querySelector('h3').textContent.toLowerCase();
    if (title.includes(query)) {
      course.style.display = '';
    } else {
      course.style.display = 'none';
    }
  });
}

function addCourse(courseElement) {
  const courseId = courseElement.dataset.courseId;
  const courseTitle = courseElement.querySelector('h3').textContent;

  if (selectedCourses.some(course => course.courseId === courseId)) {
    displayConflict(`The course "${courseTitle}" is already added.`);
    return;
  }

  selectedCourses.push({ courseId, courseTitle });
  updateRegistrationWizard();
  clearConflict();
}

function updateRegistrationWizard() {
  const selectedContainer = document.querySelector('#registration-wizard .selected-courses');
  selectedContainer.innerHTML = '';

  if (selectedCourses.length === 0) {
    selectedContainer.innerHTML = '<p>No courses selected.</p>';
    return;
  }

  const ul = document.createElement('ul');
  selectedCourses.forEach(course => {
    const li = document.createElement('li');
    li.textContent = course.courseTitle;

    const removeBtn = document.createElement('button');
    removeBtn.textContent = 'Remove';
    removeBtn.style.marginLeft = '10px';
    removeBtn.addEventListener('click', () => removeCourse(course.courseId));
    li.appendChild(removeBtn);

    ul.appendChild(li);
  });
  selectedContainer.appendChild(ul);
}

function removeCourse(courseId) {
  selectedCourses = selectedCourses.filter(course => course.courseId !== courseId);
  updateRegistrationWizard();
}

function displayConflict(message) {
  const conflictDiv = document.querySelector('#conflict-checker .conflict-alert');
  conflictDiv.textContent = message;
}

function clearConflict() {
  const conflictDiv = document.querySelector('#conflict-checker .conflict-alert');
  conflictDiv.textContent = '';
}

function submitRegistration() {
  if (selectedCourses.length === 0) {
    alert("Please select at least one course before submission.");
    return;
  }

  alert(`Registration submitted for ${selectedCourses.length} course(s):\n` + 
        selectedCourses.map(course => course.courseTitle).join(', '));
}

function initializeCourseRegistration() {
  const searchBtn = document.getElementById('searchBtn');
  if (searchBtn) {
    searchBtn.addEventListener('click', filterCourses);
  }

  const searchInput = document.getElementById('courseSearch');
  if (searchInput) {
    searchInput.addEventListener('keyup', filterCourses);
  }

  const addButtons = document.querySelectorAll('.course-item button.add-course-btn');
  addButtons.forEach(button => {
    button.addEventListener('click', (event) => {
      const courseItem = event.target.closest('.course-item');
      addCourse(courseItem);
    });
  });

  const submitBtn = document.getElementById('submitRegistration');
  if (submitBtn) {
    submitBtn.addEventListener('click', submitRegistration);
  }
}

document.addEventListener('DOMContentLoaded', initializeCourseRegistration);
