function gotopage(page) {
  window.location.href = page;
}

/* medicine section scripts */
const medicines = [
  {
    id: 1,
    name: "Paracetamol",
    type: "Pain Reliever",
    description: "Used to treat fever and mild to moderate pain.",
    stock: 24,
    image: "https://via.placeholder.com/300x180?text=Paracetamol",
  },
  {
    id: 2,
    name: "Amoxicillin",
    type: "Antibiotic",
    description: "Treats bacterial infections like pneumonia, bronchitis.",
    stock: 10,
    image: "https://via.placeholder.com/300x180?text=Amoxicillin",
  },
  {
    id: 3,
    name: "Loratadine",
    type: "Antihistamine",
    description: "Relieves allergy symptoms such as runny nose and sneezing.",
    stock: 36,
    image: "https://via.placeholder.com/300x180?text=Loratadine",
  },
  {
    id: 4,
    name: "Ibuprofen",
    type: "Nonsteroidal Anti-inflammatory Drug (NSAID)",
    description: "Used to reduce fever, pain, and inflammation.",
    stock: 15,
    image: "https://via.placeholder.com/300x180?text=Ibuprofen",
  },
  {
    id: 5,
    name: "Metformin",
    type: "Antidiabetic",
    description: "Helps control blood sugar levels in type 2 diabetes.",
    stock: 20,
    image: "https://via.placeholder.com/300x180?text=Metformin",
  },
  {
    id: 6,
    name: "Omeprazole",
    type: "Proton Pump Inhibitor",
    description: "Used to treat gastroesophageal reflux disease (GERD).",
    stock: 18,
    image: "https://via.placeholder.com/300x180?text=Omeprazole",
  },
  {
    id: 7,
    name: "Simvastatin",
    type: "Cholesterol-lowering Medication",
    description: "Used to lower cholesterol and triglyceride levels.",
    stock: 12,
    image: "https://via.placeholder.com/300x180?text=Simvastatin",
  },
  {
    id: 8,
    name: "Aspirin",
    type: "Antiplatelet Agent",
    description: "Used to reduce pain, fever, or inflammation.",
    stock: 30,
    image: "https://via.placeholder.com/300x180?text=Aspirin",
  },
  {
    id: 9,
    name: "Levothyroxine",
    type: "Thyroid Hormone Replacement",
    description: "Used to treat hypothyroidism.",
    stock: 22,
    image: "https://via.placeholder.com/300x180?text=Levothyroxine",
  },
  {
    id: 10,
    name: "Ciprofloxacin",
    type: "Antibiotic",
    description: "Treats various bacterial infections.",
    stock: 14,
    image: "https://via.placeholder.com/300x180?text=Ciprofloxacin",
  },
  {
    id: 11,
    name: "Amlodipine",
    type: "Calcium Channel Blocker",
    description: "Used to treat high blood pressure and angina.",
    stock: 19,
    image: "https://via.placeholder.com/300x180?text=Amlodipine",
  },
];

const medicineList = document.getElementById("medicine-list");

medicines.forEach((medicine) => {
  const medicineCard = `
        <div class="card">
          <img src="${medicine.image}" alt="${medicine.name}">
          <h2>${medicine.name}</h2>
          <p class="type">${medicine.type}</p>
          <p>${medicine.description}</p>
          <p class="stock" >In Stock: ${medicine.stock}</p>
          <button class="buy-button">Buy</button>
        </div>
      `;
  medicineList.innerHTML += medicineCard;
});
