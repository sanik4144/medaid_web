document.addEventListener("DOMContentLoaded", function () {
    const passwordInput = document.getElementById("password");

    passwordInput.addEventListener("input", function () {
        const password = passwordInput.value;

        updateRequirement("length", password.length >= 6);
        updateRequirement("uppercase", /[A-Z]/.test(password));
        updateRequirement("lowercase", /[a-z]/.test(password));
        updateRequirement("digit", /[0-9]/.test(password));
    });

    function updateRequirement(id, isValid) {
        const element = document.getElementById(id);
        if (isValid) {
            element.classList.remove("invalid");
            element.classList.add("valid");
            element.textContent = "✅ " + element.textContent.slice(2);
        } else {
            element.classList.remove("valid");
            element.classList.add("invalid");
            element.textContent = "❌ " + element.textContent.slice(2);
        }
    }
});

function validateForm() {
    let name = document.getElementById("name").value.trim();
    let email = document.getElementById("email").value.trim();
    let password = document.getElementById("password").value.trim();
    let confirmPassword = document.getElementById("confirmPassword").value.trim();

    document.getElementById("nameError").innerText = "";
    document.getElementById("emailError").innerText = "";
    document.getElementById("passwordError").innerText = "";
    document.getElementById("confirmPasswordError").innerText = "";

    let hasError = false;

    if (name.length < 6) {
        document.getElementById("nameError").innerText =
            "Name must be at least 6 characters.";
        hasError = true;
    }

    if (!email.includes("@") || !email.includes(".")) {
        document.getElementById("emailError").innerText = "Email is not valid.";
        hasError = true;
    }

    let passwordErrors = [];
    if (password.length < 6) {
        passwordErrors.push("At least 6 characters.");
    }
    if (!/[A-Z]/.test(password)) {
        passwordErrors.push("At least one uppercase letter.");
    }
    if (!/[a-z]/.test(password)) {
        passwordErrors.push("At least one lowercase letter.");
    }
    if (!/[0-9]/.test(password)) {
        passwordErrors.push("At least one digit.");
    }

    if (passwordErrors.length > 0) {
        document.getElementById("passwordError").innerText =
            passwordErrors.join(" ");
        hasError = true;
    }

    if (confirmPassword === "") {
        document.getElementById("confirmPasswordError").innerText =
            "Passwords do not match.";
        hasError = true;
    }

    if (confirmPassword !== password) {
        document.getElementById("confirmPasswordError").innerText =
            "Passwords do not match.";
        hasError = true;
    }

    return !hasError;
}
