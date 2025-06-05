let doctorsData = [];
let visibleCount = 6;

window.onload = function () {
  fetch('doctors.json')
    .then(res => res.json())
    .then(data => {
      doctorsData = data;
      renderDoctors(data.slice(0, visibleCount));
    });

  document.getElementById('searchBtn').addEventListener('click', () => {
    const department = document.getElementById('department').value.toLowerCase();
    const name = document.getElementById('doctorName').value.toLowerCase();
    let filtered = doctorsData.filter(doc =>
      (department === "" || doc.department.toLowerCase() === department) &&
      (name === "" || doc.name.toLowerCase().includes(name))
    );
    visibleCount = 6;
    renderDoctors(filtered.slice(0, visibleCount), filtered);
  });

  document.getElementById('showMoreBtn').addEventListener('click', () => {
    const department = document.getElementById('department').value.toLowerCase();
    const name = document.getElementById('doctorName').value.toLowerCase();
    let filtered = doctorsData.filter(doc =>
      (department === "" || doc.department.toLowerCase() === department) &&
      (name === "" || doc.name.toLowerCase().includes(name))
    );

    visibleCount += 3;
    renderDoctors(filtered.slice(0, visibleCount), filtered);
  });
};

function renderDoctors(list, fullList = doctorsData) {
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

  const showMoreBtn = document.getElementById('showMoreBtn');
  showMoreBtn.style.display = list.length >= fullList.length ? 'none' : 'block';
}

