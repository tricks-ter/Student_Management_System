const form = document.getElementById("validationForm");
const username = document.getElementById("username");
const email = document.getElementById("email");
const password = document.getElementById("password");

const usernameError = document.getElementById("usernameError");
const emailError = document.getElementById("emailError");
const passwordError = document.getElementById("passwordError");
const formMessage = document.getElementById("formMessage");

function validateEmail(email) {
    const re = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return re.test(email);
}

form.addEventListener("submit", (e) => {
    e.preventDefault();

    let valid = true;

    usernameError.textContent = "";
    emailError.textContent = "";
    passwordError.textContent = "";
    formMessage.textContent = "";

    if (username.value.trim() === "") {
        usernameError.textContent = "Username is required.";
        valid = false;
    }

    if (!validateEmail(email.value.trim())) {
        emailError.textContent = "Please enter a valid email.";
        valid = false;
    }

    if (password.value.length < 6) {
        passwordError.textContent = "Password must be at least 6 characters.";
        valid = false;
    }

    if (valid) {
        formMessage.textContent = "Form submitted successfully!";
        form.reset();
    }
});
