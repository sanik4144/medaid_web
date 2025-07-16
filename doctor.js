let doctorsData = [];

window.onload = function () {
  fetch('doctors.json')
    .then(res => res.json())
    .then(data => {
      doctorsData = data;
      renderDoctors(data); // Render all doctors initially
    });

  document.getElementById('department').addEventListener('input', () => {
    const department = document.getElementById('department').value.toLowerCase();
    let filtered = doctorsData.filter(doc =>
      department === "" || doc.department.toLowerCase() === department
    );
    renderDoctors(filtered);
  });

  document.getElementById('doctorName').addEventListener('input', () => {
    const name = document.getElementById('doctorName').value.toLowerCase();
    let filtered = doctorsData.filter(doc =>
      (name === "" || doc.name.toLowerCase().includes(name))
    );
    renderDoctors(filtered);  // Render filtered doctors
  });

  document.getElementById('searchBtn').addEventListener('click', () => {
    const department = document.getElementById('department').value.toLowerCase();
    const name = document.getElementById('doctorName').value.toLowerCase();
    let filtered = doctorsData.filter(doc =>
      (department === "" || doc.department.toLowerCase() === department) &&
      (name === "" || doc.name.toLowerCase().includes(name))
    );
    renderDoctors(filtered);  // Render filtered doctors
  });
};

function renderDoctors(list) {
  const container = document.querySelector('.doctor-list');
  container.innerHTML = '';
  if (list.length === 0) {
    container.innerHTML = '<p>No doctors found.</p>';
    return;
  }

  list.forEach(doc => {
    const div = document.createElement('div');
    div.className = 'doctor-card';

    div.innerHTML = `
      <img src="https://via.placeholder.com/140x180?text=Doctor" alt="${doc.name}">
      <div class="doctor-details">
        <div class="doctor-name">${doc.name}</div>
        <div class="doctor-specialty"><span>Speciality -</span> ${doc.speciality || 'Not Specified'}</div>
        <div class="doctor-degree"><span>Degree -</span> ${doc.degree || 'Not Specified'}</div>
        <div class="doctor-buttons">
          <button>Get Appointment</button>
          <button>Doctor's Profile</button>
        </div>
      </div>
    `;
    container.appendChild(div);
  });
}
