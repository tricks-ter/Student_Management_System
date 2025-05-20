const assignments = [
    { title: "Assignment 1", weight: 0.2 },
    { title: "Midterm", weight: 0.3 },
    { title: "Assignment 2", weight: 0.2 },
    { title: "Final Exam", weight: 0.3 }
];

const students = database.getUsers().filter(u => u.role === "User");
const header = document.getElementById("gradebookHeader");
const body = document.getElementById("gradebookBody");

const grades = {};

function buildHeader() {
    assignments.forEach(a => {
        const th = document.createElement("th");
        th.textContent = `${a.title} (${a.weight * 100}%)`;
        header.insertBefore(th, header.lastElementChild);
    });
}

function buildRows() {
    students.forEach(student => {
        grades[student.id] = {};
        const row = document.createElement("tr");

        const nameTd = document.createElement("td");
        nameTd.textContent = student.username;
        row.appendChild(nameTd);

        assignments.forEach(a => {
            const td = document.createElement("td");
            const input = document.createElement("input");
            input.type = "number";
            input.className = "grade-input";
            input.value = 0;
            input.min = 0;
            input.max = 100;
            input.addEventListener("input", () => {
                grades[student.id][a.title] = parseFloat(input.value) || 0;
                updateTotal(student.id, totalTd);
            });
            grades[student.id][a.title] = 0;
            td.appendChild(input);
            row.appendChild(td);
        });

        const totalTd = document.createElement("td");
        totalTd.textContent = "0";
        row.appendChild(totalTd);

        body.appendChild(row);
    });
}

function updateTotal(studentId, cell) {
    let total = 0;
    assignments.forEach(a => {
        total += (grades[studentId][a.title] || 0) * a.weight;
    });
    cell.textContent = total.toFixed(1);
}

buildHeader();
buildRows();
