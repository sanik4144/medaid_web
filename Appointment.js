document.addEventListener("DOMContentLoaded", function () {
  const form = document.getElementById("appointmentForm");

  form.addEventListener("submit", function (e) {
    e.preventDefault();

    let isValid = true;

    function showError(id, message) {
      document.getElementById(id).innerText = message;
      isValid = false;
    }

    function clearErrors() {
      document.querySelectorAll(".error").forEach(el => el.innerText = "");
    }

    clearErrors();

    const name = document.getElementById("patientName").value.trim();
    const gender = document.getElementById("gender").value;
    const contact = document.getElementById("contact").value.trim();
    const email = document.getElementById("email").value.trim();
    const requestFor = document.getElementById("requestFor").value;
    const speciality = document.getElementById("speciality").value;
    const doctor = document.getElementById("doctor").value;
    const appointmentDate = document.getElementById("appointmentDate").value;
    const appointmentTime = document.getElementById("appointmentTime").value;

    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    if (name === "") showError("nameError", "Please enter the patient name.");
    if (gender === "" || gender === "Select Gender") showError("genderError", "Please select gender.");
    if (contact === "") showError("contactError", "Please enter a contact number.");
    if (email === "") {
        showError("emailError", "Please enter an email.");
    } else if (!emailPattern.test(email)) {
        showError("emailError", "Please enter a valid email address.");
    }
    if (requestFor === "") showError("requestError", "Please select a request type.");
    if (speciality === "") showError("specialityError", "Please select a speciality.");
    if (doctor === "") showError("doctorError", "Please select a doctor.");
    if (appointmentDate === "") showError("dateError", "Please select an appointment date.");
    if (appointmentTime === "") showError("timeError", "Please select an appointment time.");

    if (isValid) {
      form.submit();
    }
  });
});
