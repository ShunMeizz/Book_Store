document.addEventListener("DOMContentLoaded", function () {
  var inputBday = document.getElementById("inputBday");
  // inputBday.placeholder = 'Birthdate: (YYYY-MM-DD)';
  var birthdateError = document.getElementById("birthdate-error");

  var dateFormat = /^\d{4}-\d{2}-\d{2}$/;
  var validFormat = false;

  inputBday.addEventListener("input", function () {
    var value = inputBday.value;
    if (!value.match(dateFormat)) {
      // birthdateError.textContent = "Please enter a valid birthdate in the format YYYY-MM-DD";
      birthdateError.style.display = "block";
      inputBday.style.border = "1px solid #f44336";
      inputBday.style.borderRadius = "5px";
      inputBday.style.boxShadow = "0 2px 4px rgba(0, 0, 0, 0.2)";
      validFormat = false;
    } else {
      birthdateError.textContent = "";
      birthdateError.style.display = "none";
      inputBday.style.border = "";
      inputBday.style.boxShadow = "";
      validFormat = true;
    }
  });

  inputBday.addEventListener("blur", function () {
    if (!validFormat) {
      birthdateError.textContent =
        "Please enter a valid birthdate in the format YYYY-MM-DD";
      birthdateError.style.display = "block";
      inputBday.style.border = "1px solid #f44336";
      inputBday.style.borderRadius = "5px";
      inputBday.style.boxShadow = "0 2px 4px rgba(0, 0, 0, 0.2)";
    }
  });
});

var citiesByRegion = {
  NCR: [
    "Caloocan",
    "Las Pinas",
    "Makati",
    "Malabon",
    "Mandaluyong",
    "Manila",
    "Marikina",
    "Muntinlupa",
    "Navotas",
    "Paranaque",
    "Pasay",
    "Pasig",
    "Quezon City",
    "Taguig",
  ],
  CAR: ["Abra", "Apayao", "Benguet", "Ifugao", "Kalinga"],
  ARMM: ["Basilan", "Lanao Del Sur", "Maguindanao", "Sulu", "Tawi-tawi"],
  "Region I": ["Ilocos Norte", "Ilocos Sur", "La Union", "Pangasinan"],
  "Region II": ["Batanes", "Cagayan", "Isabela", "Nueva Vizcaya", "Quirino"],
  "Region III": [
    "Aurora",
    "Bataan",
    "Bulacan",
    "Pampanga",
    "Tarlac",
    "Zambales",
  ],
  "Region IV-A": ["Batangas", "Cavite", "Laguna", "Quezon", "Rizal"],
  "Region IV-B": [
    "Marinduque",
    "Occidental Mindoro",
    "Oriental Mindoro",
    "Palawan",
    "Romblon",
  ],
  "Region V": [
    "Albay",
    "Camarines Norte",
    "Camarines Sur",
    "Catanduanes",
    "Masbate",
    "Sorsogon",
  ],
  "Region VI": [
    "Aklan",
    "Antique",
    "Capiz",
    "Guimaras",
    "Iloilo",
    "Negros Occidental",
  ],
  "Region VII": ["Bohol", "Cebu", "Negros Oriental", "Siquijor"],
  "Region VIII": [
    "Biliran",
    "Eastern Samar",
    "Leyte",
    "Northern Samar",
    "Southern Leyte",
    "Western Samar",
  ],
  "Region IX": [
    "Zamboanga Del Norte",
    "Zamboanga Del Sur",
    "Zamboanga Sibugay",
  ],
  "Region X": [
    "Bukidnon",
    "Camiguin",
    "Lanao Del Norte",
    "Misamis OCcidental",
    "Misamis Oriental",
  ],
  "Region XI": [
    "Compostella Valley",
    "Davao Del Norte",
    "Davao Del Sur",
    "Davao Oriental",
  ],
  "Region XII": [
    "North Cotabato",
    "Sarangani",
    "South Cotabato",
    "Sultan Kudarat",
  ],
  "Region XIII": [
    "Agusan Del Norte",
    "Agusan Del Sur",
    "Dinagat Islands",
    "Surigao Del Norte",
    "Surigao Del Sur",
  ],
};

function populateCities() {
  var regionSelect = document.getElementById("inputAddress-region");
  var citySelect = document.getElementById("inputAddress-city");
  var selectedRegion = regionSelect.value;

  citySelect.innerHTML = "<option value='' disabled selected>City</option>";

  if (selectedRegion in citiesByRegion) {
    citiesByRegion[selectedRegion].forEach(function (city) {
      var option = document.createElement("option");
      option.text = city;
      option.value = city;
      citySelect.add(option);
    });
  }
}

function registerSuccess() {
  var popupWindow = document.getElementById("registration-success-message-box");
  var closeButton = document.getElementById("close-button");

  popupWindow.style.display = "block";

  closeButton.addEventListener("click", function() {
    popupWindow.style.display = "none";
  });
}

function showUsernameError() {
  var usernameError = document.getElementById('username-error');
  if (usernameError) {
      usernameError.style.display = 'block';
  }
}
