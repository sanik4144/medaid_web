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

    if (name === "") showError("nameError", "Please enter the patient name.");
    if (gender === "" || gender === "Select Gender") showError("genderError", "Please select gender.");
    if (contact === "") showError("contactError", "Please enter a contact number.");
    if (email === "") showError("emailError", "Please enter an email.");
    if (requestFor === "") showError("requestError", "Please select a request type.");
    if (speciality === "") showError("specialityError", "Please select a speciality.");
    if (doctor === "") showError("doctorError", "Please select a doctor.");

    if (isValid) {
      // ✅ Submit the form to the PHP backend
      form.submit();  // this sends the data to appointment.php
    }
  });
});
