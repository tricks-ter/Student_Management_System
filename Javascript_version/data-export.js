const exportBtn = document.getElementById("exportBtn");
const formatSelect = document.getElementById("format");
const tableBody = document.querySelector("#exportTable tbody");

function populateTable() {
    const users = database.getUsers();
    tableBody.innerHTML = "";

    users.forEach(user => {
        const row = document.createElement("tr");

        const id = document.createElement("td");
        id.textContent = user.id;

        const name = document.createElement("td");
        name.textContent = user.username;

        const email = document.createElement("td");
        email.textContent = user.email;

        const role = document.createElement("td");
        role.textContent = user.role;

        row.appendChild(id);
        row.appendChild(name);
        row.appendChild(email);
        row.appendChild(role);

        tableBody.appendChild(row);
    });
}

function exportCSV(data) {
    const csv = [
        ["ID", "Username", "Email", "Role"],
        ...data.map(u => [u.id, u.username, u.email, u.role])
    ].map(e => e.join(",")).join("\n");

    const blob = new Blob([csv], { type: "text/csv" });
    const url = URL.createObjectURL(blob);

    const a = document.createElement("a");
    a.href = url;
    a.download = "userdata.csv";
    a.click();
    URL.revokeObjectURL(url);
}

function exportPDF(data) {
    let content = "ID\tUsername\tEmail\tRole\n";
    data.forEach(u => {
        content += `${u.id}\t${u.username}\t${u.email}\t${u.role}\n`;
    });

    const blob = new Blob([content], { type: "application/pdf" });
    const url = URL.createObjectURL(blob);

    const a = document.createElement("a");
    a.href = url;
    a.download = "userdata.pdf";
    a.click();
    URL.revokeObjectURL(url);
}

exportBtn.addEventListener("click", () => {
    const format = formatSelect.value;
    const users = database.getUsers();

    if (format === "csv") {
        exportCSV(users);
    } else {
        exportPDF(users);
    }
});

populateTable();
