const database = {
    users: [
        { id: 1, username: "admin", email: "admin@example.com", role: "Admin" },
        { id: 2, username: "jane_doe", email: "jane@example.com", role: "Editor" },
        { id: 3, username: "john_smith", email: "john@example.com", role: "User" },
        { id: 4, username: "student101", email: "student101@example.com", role: "User" }
    ],
    updateUserRole(userId, newRole) {
        const user = this.users.find(u => u.id === userId);
        if (user) user.role = newRole;
    },
    getUsers() {
        return this.users;
    }
};
