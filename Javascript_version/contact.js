document.getElementById("contactForm").addEventListener("submit", function (e) {
    e.preventDefault();

    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const subject = document.getElementById("subject").value.trim();
    const message = document.getElementById("message").value.trim();

    if (!name || !email || !subject || !message) {
        document.getElementById("formResponse").textContent = "Please fill all fields.";
        return;
    }

    const submission = {
        id: Date.now(),
        name,
        email,
        subject,
        message,
        timestamp: new Date().toISOString()
    };

    console.log("Contact form submitted:", submission);

    document.getElementById("formResponse").textContent = "Message sent! We'll get back to you soon.";
    document.getElementById("contactForm").reset();
});
