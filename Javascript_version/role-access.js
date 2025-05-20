const userTable = document.getElementById("userTable");
const roles = ["Admin", "Editor", "User"];

function populateTable() {
    userTable.innerHTML = "";
    const users = database.getUsers();

    users.forEach(user => {
        const row = document.createElement("tr");

        const idCell = document.createElement("td");
        idCell.textContent = user.id;

        const usernameCell = document.createElement("td");
        usernameCell.textContent = user.username;

        const emailCell = document.createElement("td");
        emailCell.textContent = user.email;

        const roleCell = document.createElement("td");
        roleCell.textContent = user.role;

        const selectCell = document.createElement("td");
        const select = document.createElement("select");

        roles.forEach(role => {
            const option = document.createElement("option");
            option.value = role;
            option.textContent = role;
            if (role === user.role) option.selected = true;
            select.appendChild(option);
        });

        select.addEventListener("change", () => {
            database.updateUserRole(user.id, select.value);
            populateTable();
        });

        selectCell.appendChild(select);

        row.appendChild(idCell);
        row.appendChild(usernameCell);
        row.appendChild(emailCell);
        row.appendChild(roleCell);
        row.appendChild(selectCell);

        userTable.appendChild(row);
    });
}

populateTable();
