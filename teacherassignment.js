const schedule = {};
const MAX_HOURS = 20;

document.getElementById("assignForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const name = document.getElementById("teacherName").value.trim();
  const course = document.getElementById("course").value.trim();
  const hours = parseInt(document.getElementById("hours").value);

  if (!name || !course || isNaN(hours)) return;

  if (!schedule[name]) {
    schedule[name] = { courses: [], totalHours: 0 };
  }

  schedule[name].courses.push(`${course} (${hours} hrs)`);
  schedule[name].totalHours += hours;

  const scheduleDiv = document.getElementById("schedule");
  scheduleDiv.innerHTML = `
    <strong>${name}'s Courses:</strong><br>
    ${schedule[name].courses.join("<br>")}<br>
    <strong>Total Hours:</strong> ${schedule[name].totalHours}
  `;

  const warning = document.getElementById("warning");
  if (schedule[name].totalHours > MAX_HOURS) {
    warning.textContent = `⚠️ Warning: ${name} has exceeded the workload limit!`;
  } else {
    warning.textContent = "";
  }

  this.reset();
});

document.getElementById("subForm").addEventListener("submit", function (e) {
  e.preventDefault();

  const absent = document.getElementById("absentTeacher").value.trim();
  const substitute = document.getElementById("substituteTeacher").value.trim();
  const course = document.getElementById("subCourse").value.trim();

  if (!absent || !substitute || !course) return;

  const list = document.getElementById("subList");
  const li = document.createElement("li");
  li.textContent = `${substitute} is substituting for ${absent} in ${course}`;
  list.appendChild(li);

  this.reset();
});