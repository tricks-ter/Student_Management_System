const courseList = document.getElementById("courseList");
const form = document.getElementById("courseForm");
const msg = document.getElementById("registrationMsg");

const availableCourses = [
    { code: "CS101", name: "Intro to Computer Science", credits: 3 },
    { code: "MATH201", name: "Calculus I", credits: 4 },
    { code: "ENG301", name: "English Composition", credits: 2 },
    { code: "PHY110", name: "Physics Fundamentals", credits: 3 },
    { code: "HIST101", name: "World History", credits: 2 }
];

function renderCourses() {
    courseList.innerHTML = "";
    availableCourses.forEach(course => {
        const div = document.createElement("div");
        div.className = "course-item";
        div.innerHTML = `
      <label>
        <input type="checkbox" name="course" value="${course.code}">
        <strong>${course.code}</strong> - ${course.name} (${course.credits} credits)
      </label>
    `;
        courseList.appendChild(div);
    });
}

form.addEventListener("submit", function (e) {
    e.preventDefault();

    const selected = Array.from(
        document.querySelectorAll("input[name='course']:checked")
    ).map(input => input.value);

    if (selected.length === 0) {
        msg.textContent = "Please select at least one course.";
        msg.style.color = "red";
        return;
    }

    msg.textContent = `Registration successful for: ${selected.join(", ")}`;
    msg.style.color = "green";

    // Simulate save to "database"
    console.log("Registered courses:", selected);
    form.reset();
});

renderCourses();
