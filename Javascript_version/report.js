const studentSelect = document.getElementById("studentSelect");
const generateBtn = document.getElementById("generateBtn");
const reportOutput = document.getElementById("reportOutput");
const commentField = document.getElementById("comment");

const students = database.getUsers().filter(u => u.role === "User");


students.forEach(student => {
    const option = document.createElement("option");
    option.value = student.id;
    option.textContent = `${student.username} (${student.email})`;
    studentSelect.appendChild(option);
});

const simulatedGrades = {
    "Assignment 1": 85,
    "Midterm": 78,
    "Assignment 2": 90,
    "Final Exam": 88
};

generateBtn.addEventListener("click", () => {
    const studentId = parseInt(studentSelect.value);
    const student = students.find(s => s.id === studentId);
    const comment = commentField.value.trim();

    let total = 0;
    let reportHTML = `<h3>Progress Report for ${student.username}</h3>`;

    for (const [title, grade] of Object.entries(simulatedGrades)) {
        reportHTML += `<p><strong>${title}:</strong> ${grade}%</p>`;
        total += grade;
    }

    const average = (total / Object.keys(simulatedGrades).length).toFixed(1);
    reportHTML += `<p><strong>Average:</strong> ${average}%</p>`;
    reportHTML += `<p><strong>Teacher Comment:</strong> ${comment || "N/A"}</p>`;

    reportOutput.innerHTML = reportHTML;
});
